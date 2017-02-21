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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::group(['prefix' => '/admin','middleware'=>['admin']], function(){
	Route::get('/', 'HomeController@index');
	Route::resource('jabatan', 'JabatanController');
	Route::resource('golongan', 'GolonganController');
	Route::resource('katelembur', 'KategoriLemburController');
});

Route::group(['prefix' => '/hrd','middleware'=>['hrd']], function(){
	Route::get('/', 'HomeController@index');
	Route::resource('jabatan-hrd', 'JabatanController');
	Route::resource('pegawai', 'PegawaiController');
	
});

Route::group(['prefix' => '/keuangan','middleware'=>['keuangan']], function(){
	Route::get('/', 'HomeController@index');
	Route::resource('golem', 'hrdController');
	Route::get('golem/tambah-golongan/{kode}', 'hrdController@addgol')->name('addgol');
	Route::get('golem/edit-golongan/{idg}/{idkl}', 'hrdController@golemedit')->name('upgol');
	Route::resource('lemburpegawai', 'lemburPegawaiController');
});

Route::group(['prefix' => '/pegawai','middleware'=>['pegawai']], function(){
	Route::get('/', 'HomeController@index');
	
});
