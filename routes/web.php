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

Route::get('/home', function () {
		if (Auth::user()->permission == 'admin') {
	    	return redirect(url('/admin'));
		}elseif (Auth::user()->permission == 'hrd') {
	    	return redirect(url('/hrd'));
		}elseif (Auth::user()->permission == 'keuangan') {
	    	return redirect(url('/keuangan'));
		}elseif (Auth::user()->permission == 'pegawai') {
	    	return redirect(url('/pegawai'));
		}
});


Route::get('403', function () {
    return view('errors.403');
})->name('cannotacces');

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
	Route::resource('golem-hrd', 'hrdController');
	Route::get('golem-hrd/tambah-golongan/{kode}', 'hrdController@addgol')->name('addgol-hrd');
	Route::get('golem-hrd/edit-golongan/{idg}/{idkl}', 'hrdController@golemedit')->name('upgol-hrd');
	
});

Route::group(['prefix' => '/keuangan','middleware'=>['keuangan']], function(){
	Route::get('/', 'HomeController@index');
	Route::resource('golem', 'hrdController');
	Route::get('golem/tambah-golongan/{kode}', 'hrdController@addgol')->name('addgol');
	Route::get('golem/edit-golongan/{idg}/{idkl}', 'hrdController@golemedit')->name('upgol');
	Route::resource('lemburpegawai', 'lemburPegawaiController');
	Route::resource('tunjangan', 'tunjanganController');
	Route::resource('pegawai-tunjangan', 'tunjanganPegawaiController');
	Route::get('pegawai-tunjangan/{id}/create', 'tunjanganPegawaiController@createtunjangan')->name('create-tunjangan');
	Route::resource('penggajian', 'penggajianController');
});

Route::group(['prefix' => '/pegawai','middleware'=>['pegawai']], function(){
	Route::get('/', 'HomeController@index');
	Route::get('gaji', 'penggajianController@gaji')->name('gaji');
	Route::get('ambil-gaji/{id}', 'penggajianController@ambil');
});
