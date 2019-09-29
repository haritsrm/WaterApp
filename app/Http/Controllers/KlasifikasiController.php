<?php

namespace App\Http\Controllers;

use App\Monitor;
use App\Training;
use App\Result;

use App\Imports\TrainingImport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class KlasifikasiController extends Controller
{
    public function importTraining(Request $request) 
	{
		$file = $request->file('file');
        Excel::import(new TrainingImport, $file);
        
		return redirect()->back();
    }
    
    public function hapusDataTraining ($id)
    {
        $training = Training::find($id);
        if ($training) {
            $training->delete();
        }

        return redirect()->back();
    }

    public function tabelKlasifikasi (Request $request)
    {
        $data = $this->klasifikasi($request);
        $kelas = $data['classes'];
        $monitor = Monitor::orderBy('created_at', 'desc')->get();
        return view('tabel_klasifikasi')->with('monitor', $monitor)->with('kelas', $kelas);
    }

    public function riwayatKlasifikasi ()
    {
        $result = Result::orderBy('created_at', 'desc')->get();
        return view('riwayat_klasifikasi')->with('result', $result);
    }

	public function exportRiwayatKlasifikasi ()
	{
		return Excel::download(new RiwayatKlasifikasi, 'result.xlsx');
    }
    
    public function hapusRiwayatKlasifikasi ($id)
    {
        $result = Result::find($id);
        if ($result) {
            $result->delete();
        }

        return redirect()->back();
    }

    public function simpanSungai (Request $request)
    {
        $hasil = $this->klasifikasi($request);
        Result::create($hasil);
        Monitor::truncate();

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
            $hasil['classes'] = 1;
            return $hasil;
        }
        else if ($kelas_1 < $kelas_2) {
            $hasil['classes'] = 2;
            return $hasil;
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

        return $jumlah_kasus/$jumlah_kelas;
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
        $hasil = [
            'name' => $request->name,
            'pH' => $this->menghitungNilaiRataRataObjek('pH'),
            'turbidity' => $this->menghitungNilaiRataRataObjek('turbidity'),
            'temperature' => $this->menghitungNilaiRataRataObjek('temperature')
        ];

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
