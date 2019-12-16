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

Route::resource('nasabah', 'NasabahController');
Route::get('api/nasabah', 'NasabahController@apiNasabah')->name('api.nasabah');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/nasabah', 'NasabahController@index')->name('nasabah');

Route::get('/exportnasabah', 'NasabahController@exportPDF')->name('nasabah.export');

Route::resource('pinjaman', 'PinjamanController');
Route::get('api/pinjaman', 'PinjamanController@apiPinjaman')->name('api.pinjaman');
Route::get('/pinjaman', 'PinjamanController@index')->name('pinjaman');