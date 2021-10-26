<?php

use Illuminate\Support\Facades\Route;

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
    return view('dashboard.index');
})->name('dashboard');
Route::get('/sapi', function () {
    return view('sapi.index');
});
Route::get('/layout', function () {
    return view('layout.main');
});
Route::get('/index', function () {
    return view('index');
});

Route::get('/sapikeluar', function () {
    return view('Sapi_Keluar');
});

Route::get('/hasilperah', function () {
    return view('Hasil_Perah');
});

