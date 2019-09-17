<?php

namespace App\Http\Controllers;

use App\Monitor;
use App\Training;
use App\Result;
use Illuminate\Http\Request;

class KlasifikasiController extends Controller
{
    public function tabelKlasifikasi ()
    {
        $monitor = Monitor::orderBy('created_at', 'desc')->get();
        return view('tabel_klasifikasi')->with('monitor', $monitor);
    }

    public function grafik ()
    {
        return view('grafik');
    }

    public function riwayatKlasifikasi ()
    {
        $result = Result::orderBy('created_at', 'desc')->get();
        return view('riwayat_klasifikasi')->with('result', $result);
    }

    public function simpanSungai (Request $request)
    {
        $this->klasifikasi($request);

        return redirect()->back();
    }

    /**
     * fungsi ini adalah fungsi utama untuk proses klasifikasi,
     * membandingkan kelas 1 dan kelas 2 kemudian memilih hasil yang
     * memiliki nilai terbesar.
     * 
     * @param object $data
     */
    private function klasifikasi (Request $request)
    {
        $hasil = $this->simpanHasilObjek($request);
        $kelas_1 = $this->proses($hasil, 1);
        $kelas_2 = $this->proses($hasil, 2);
        if ($kelas_1 > $kelas_2) {
            $hasil->classes = 1;
            $hasil->save();
        }
        else if ($kelas_1 < $kelas_2) {
            $hasil->classes = 2;
            $hasil->save();
        }
    }

    /**
     * fungsi ini digunakan untuk mengkalikan semua hasil perhitungan.
     * 
     * @param object $data
     * @param int $kelas
     * 
     * @return float
     */
    private function proses ($data, $kelas)
    {
        $tmp = [];
        array_push($tmp, $this->mengolahKasus('pH', $data, $kelas));
        array_push($tmp, $this->mengolahKasus('turbidity', $data, $kelas));
        array_push($tmp, $this->mengolahKasus('temperature', $data, $kelas));
        array_push($tmp, $this->menghitungRataRataKelas($kelas));
        $hasil = 1;
        foreach ($tmp as $key => $value) {
            $hasil *= $value; 
        }

        return $hasil;
    }

    /**
     * fungsi ini digunakan untuk menghitung jumlah atribut yang sama dengan
     * data training kemudian dibagi dengan jumlah kelas.
     * 
     * @param string $atribut
     * @param object $data
     * @param int $kelas
     * 
     * @return float
     */
    private function mengolahKasus ($atribut, $data, $kelas)
    {
        $jumlah_kasus = Training::where($atribut, round($data[$atribut], 1))
                        ->where('classes', $kelas)->count();
        $jumlah_kelas = $this->menghitungKelas($kelas);

        return round(($jumlah_kasus/$jumlah_kelas), 1);
    }

    /**
     * fungsi ini digunakan untuk menghitung nilai rata-rata
     * dari kelas yang ada pada data training.
     * 
     * @param int $kelas
     * 
     * @return float
     */
    private function menghitungRataRataKelas ($kelas)
    {
        $hasil = $this->menghitungKelas($kelas) / Training::count();
        return round($hasil, 1);
    }

    /**
     * fungsi ini digunakan untuk menghitung jumlah kelas pada
     * data training.
     * 
     * @param int $kelas
     * 
     * @return int
     */
    private function menghitungKelas ($kelas)
    {
        $data_training = Training::all();
        $hasil = count($data_training->where('classes', $kelas));
        return $hasil;
    }

    /**
     * fungsi ini digunakan untuk menyimpan nilai rata-rata
     * ke tabel Results dan menghapus semua data di tabel
     * Monitors.
     * 
     * @param object $data
     * 
     * @return object
     */
    private function simpanHasilObjek (Request $request)
    {
        $hasil = Result::create([
            'name' => $request->name,
            'pH' => $this->menghitungNilaiRataRataObjek('pH'),
            'turbidity' => $this->menghitungNilaiRataRataObjek('turbidity'),
            'temperature' => $this->menghitungNilaiRataRataObjek('temperature')
        ]);
        Monitor::truncate();

        return $hasil;
    }

    /**
     * fungsi ini digunakan untuk menghitung rata-rata
     * dari atribut yang ada pada tabel Monitors.
     * 
     * @param string $atribut
     * 
     * @return int
     */
    private function menghitungNilaiRataRataObjek ($atribut)
    {
        return round(Monitor::avg($atribut), 1);
    }
}
