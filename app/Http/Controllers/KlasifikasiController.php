<?php

namespace App\Http\Controllers;

use App\Monitor;
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
        $monitor = Monitor::all();
        return view('riwayat_klasifikasi')->with('monitor', $monitor);
    }
}
