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

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('nasabah', 'NasabahController');
Route::get('api/nasabah', 'NasabahController@apiNasabah')->name('api.nasabah');
Route::get('/nasabah', 'NasabahController@index')->name('nasabah');
Route::get('/exportnasabah', 'NasabahController@exportPDF')->name('nasabah.export');
Route::get('api/getnasabah', 'NasabahController@getNasabah')->name('getnasabah');

Route::resource('pinjaman', 'PinjamanController');
Route::get('api/pinjaman', 'PinjamanController@apiPinjaman')->name('api.pinjaman');
Route::get('/pinjaman', 'PinjamanController@index')->name('pinjaman');
Route::get('/exportpinjaman', 'PinjamanController@exportPDF')->name('pinjaman.export');
Route::get('api/getpinjaman', 'PinjamanController@getPinjaman')->name('getpinjaman');

Route::resource('angsuran', 'AngsuranController');
Route::get('api/angsuran', 'AngsuranController@apiAngsuran')->name('api.angsuran');
Route::get('/angsuran', 'AngsuranController@index')->name('angsuran');
Route::get('/exportangsuran', 'AngsuranController@exportPDF')->name('angsuran.export');
Route::get('api/getangsuran', 'AngsuranController@getAngsuran')->name('getangsuran');
