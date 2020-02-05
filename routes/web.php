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
    return view('login');
});
Route::post('/login','LoginController@index');
Route::get('/logout','LoginController@logout');
Route::get('/gantipass','LoginController@gantipass');
Route::post('/storepass','LoginController@storepass');


Route::get('/umkm','UMKMController@index');
Route::post('/umkm','UMKMController@kategori');
Route::get('/umkm/add','UMKMController@add');
Route::post('/umkm/store','UMKMController@store');
Route::get('/umkm/edit/{no}','UMKMController@edit');
Route::post('/umkm/update','UMKMController@update');
Route::get('/umkm/delete/{id}','UMKMController@delete');
Route::get('/umkm/search','UMKMController@search');
Route::get('/umkm/cetak_pdf/', 'UMKMController@cetak_pdf');
Route::get('/umkm/export_excel', 'UMKMController@export_excel');
Route::post('/umkm/import_excel', 'UMKMController@import_excel');

Route::get('/penduduk', 'PendudukController@index');
Route::post('/penduduk','PendudukController@kategori');
Route::get('/penduduk/search','PendudukController@search');
Route::get('/penduduk/add','PendudukController@add');
Route::post('/penduduk/add/kriteria','PendudukController@addkriteria');
Route::post('/penduduk/store','PendudukController@store');
Route::get('/penduduk/delete/{id}','PendudukController@delete');
Route::get('/penduduk/edit/{id_lokasi}','PendudukController@edit');
Route::post('/penduduk/update','PendudukController@update');
Route::get('/penduduk/cetak_pdf/{jenis}', 'PendudukController@cetak_pdf');
Route::get('/penduduk/export_excel/{jenis}', 'PendudukController@export_excel');
Route::post('/penduduk/import_excel', 'PendudukController@import_excel');




Route::get('/sampelpenduduk', 'SampelPendudukController@index');
Route::post('/sampelpenduduk','SampelPendudukController@kategori');
Route::get('/sampelpenduduk/search','SampelPendudukController@search');
Route::post('/sampelpenduduk/store','SampelPendudukController@store');
Route::get('/sampelpenduduk/add','SampelPendudukController@add');
Route::get('/sampelpenduduk/edit/{id_alternatif}','SampelPendudukController@edit');
Route::post('/sampelpenduduk/update','SampelPendudukController@update');
Route::get('/sampelpenduduk/delete/{id}','SampelPendudukController@delete');
Route::get('/sampelpenduduk/cetak_pdf/{jenis}', 'SampelPendudukController@cetak_pdf');
Route::get('/sampelpenduduk/export_excel/{jenis}', 'SampelPendudukController@export_excel');
Route::post('/sampelpenduduk/import_excel', 'SampelPendudukController@import_excel');



Route::post('/user','UserController@kategori');
Route::get('/user','UserController@index');
Route::get('/user/delete/{id_user}','UserController@delete');
Route::get('/user/search','UserController@search');
Route::get('/user/cetak_pdf/{jenis}', 'UserController@cetak_pdf');
Route::get('/user/export_excel', 'UserController@export_excel');

Route::get('/logedit','Log_EditController@index');
Route::get('/logedit/search','Log_EditController@search');
Route::get('/logedit/cetak_pdf', 'Log_EditController@cetak_pdf');
Route::get('/logedit/export_excel', 'Log_EditController@export_excel');

Route::get('/rekomend','RekomendasiController@index');
Route::get('/rekomend/result','RekomendasiController@result');