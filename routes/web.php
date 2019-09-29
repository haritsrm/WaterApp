<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Training;

Route::get('/informasi', function () {
    return view('index');
});

Route::get('/data-training', function () {
    $trainings = Training::all();

    return view('data-training')->with('trainings', $trainings);
});

Route::get('/', 'KlasifikasiController@tabelKlasifikasi')->name('tabelKlasifikasi');
Route::get('/grafik', 'KlasifikasiController@grafik')->name('grafik');
Route::get('/riwayat', 'KlasifikasiController@riwayatKlasifikasi')->name('riwayatKlasifikasi');
Route::post('/simpan', 'KlasifikasiController@simpanSungai')->name('simpanSungai');
Route::delete('/hapusRiwayat/{id}', 'KlasifikasiController@hapusRiwayatKlasifikasi')->name('hapusRiwayat');
Route::post('/importTraining', 'KlasifikasiController@importTraining')->name('importTraining');
Route::delete('/hapusTraining/{id}', 'KlasifikasiController@hapusDataTraining')->name('hapusTraining');
