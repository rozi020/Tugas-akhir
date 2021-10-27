<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SapiController;
use App\Http\Controllers\LoginController;

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

Route::get('/', [LoginController::class, 'login']);
Route::get('/dashboard', [LoginController::class, 'dashboard']);

Route::get('/daftar-sapi', [SapiController::class, 'daftarsapi']);
Route::get('/sapi-masuk', [SapiController::class, 'sapimasuk']);
Route::get('/sapi-keluar', [SapiController::class, 'sapikeluar']);
Route::get('/hasil-perah', [SapiController::class, 'hasilperah']);

?>