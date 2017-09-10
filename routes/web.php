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
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\CheckHome;
use App\Http\Middleware;

Route::prefix('kandidat')->group(function () {
	Route::get('/', 'KandidatController@index');
	Route::post('/store/{id_pemilihan}', 'KandidatController@store');
	Route::post('/update/{id_pemilihan}/{no_urut}', 'KandidatController@update');
	Route::get('/delete/{id_pemilihan}/{no_urut}', 'KandidatController@destroy');
	Route::get('/listKandidat', 'KandidatController@listPerPemilihan');
	Route::get('/list', 'KandidatController@listKandidat');
});

Route::prefix('penjagaTPS')->group(function () {
	Route::get('/','penjagaTPSController@index');
	Route::get('/list','penjagaTPSController@find');
	Route::get('/edit', 'penjagaTPSController@edit');
	Route::get('/delete/{id}', 'penjagaTPSController@destroy');
	Route::post('/update/{id}', 'penjagaTPSController@update');
	Route::post('/store', 'penjagaTPSController@store');
});

Route::get('/laravel', function () {
     return Redirect::to('http://laravel.com');
});
Route::get('/materialize', function () {
     return Redirect::to('http://materializecss.com');
});

Route::get('/', 'LoginController@index')->middleware(CheckHome::class);
Route::post('/login','LoginController@store');
Route::get('/logout', 'LoginController@logout');

Route::prefix('pemilihan')->group(function () {
	Route::get('/','PemilihanController@index');
	Route::get('/list','PemilihanController@find');
	Route::get('/admin/pemilihan/edit/{id}', 'PemilihanController@editByAdminPemilihan');
	Route::get('/admin/fakultas/edit/{id}', 'PemilihanController@editByAdminFakultas');
	Route::post('/delete/{id}', 'PemilihanController@destroy');
	Route::post('/update/{id}', 'PemilihanController@update');
	Route::post('/store', 'PemilihanController@store');
	Route::get('/findByNPM', 'PemilihanController@findByNPM');
	Route::get('/findPemilihanByNPM', 'PemilihanController@findPemilihanByNPM');
});

Route::prefix('dashboard')->group(function () {
	Route::get('/','DashboardController@index');
	Route::get('/statistik/{id_pemilihan}','DashboardController@statistik');
});

Route::prefix('pemilih')->group(function(){
	Route::get('/', 'PemilihController@index');
	Route::get('/list/{id}', 'PemilihController@find');
	Route::get('/edit', 'PemilihController@edit');
	Route::post('/delete/', 'PemilihController@destroy');
	Route::post('/update/{id}', 'PemilihController@update');
	Route::post('/importExcel/{id}', 'PemilihController@importExcel');
	Route::post('/store/{id}', 'PemilihController@store');
	Route::get('/downloadTemplate','PemilihController@downloadTemplate');
	Route::get('/downloadExample','PemilihController@downloadExample');
});

Route::prefix('admin')->group(function (){
	Route::get('/', 'AdminController@index');
	Route::get('/faq', 'AdminController@faq');
	Route::get('/list', 'AdminController@findAllAdmin');
	Route::get('/edit', 'AdminController@edit');
	Route::post('/store', 'AdminController@storeAdmin');
	Route::post('/delete/{id}', 'AdminController@destroy');
	Route::post('/update/{id}', 'AdminController@updateAdminFakultas');
	Route::post('/pemilihan/update/{id}', 'AdminController@updateAdminPemilihan');
});