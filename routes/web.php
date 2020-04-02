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




Auth::routes();


Route::group(['middleware' => 'auth'], function(){
    Route::get('/', function () {
        return view('layouts.master');
    });
    Route::resource('/pasien', 'PasienController');
    Route::resource('/tipe_dokter', 'TipeDokterController')->except([
        'create', 'show'
    ]);
    Route::resource('/dokter', 'DokterController');
    Route::resource('/data-perawat', 'PerawatController');
    Route::resource('/status-pengobatan', 'StatusPengobatanController');
    Route::resource('/rawat-inap', 'RawatInapController');
    Route::get('/kamar','RawatInapController@select_inap')->name('select_kamar');
    Route::resource('/riwayat-pasien', 'RiwayatPasienController');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['middleware' => ['Admin']], function(){
        Route::resource('/tipe_dokter', 'TipeDokterController')->except([
            'create', 'show'
        ]);
        Route::resource('/dokter', 'DokterController');
        Route::resource('/data-perawat', 'PerawatController');
    });

    Route::group(['middleware' => ['Dokter']], function(){
        Route::resource('/pasien', 'PasienController');
        Route::resource('/data-perawat', 'PerawatController');
    });

    Route::group(['middleware' => ['Perawat']], function(){
        Route::resource('/pasien', 'PasienController');
    });

    Route::group(['middleware' => ['adminOrDokter']], function(){
        Route::resource('/data-perawat', 'PerawatController');
    });

    Route::group(['middleware' => ['dokterOrPerawat']], function(){
        Route::resource('/riwayat-pasien', 'RiwayatPasienController');
    });
});


