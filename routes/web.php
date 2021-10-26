<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SapiController;

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
    return view('login.index');
})->name('login');

Route::get('/sapi', [SapiController::class, 'sapi']);
Route::get('/sapi-keluar', [SapiController::class, 'sapikeluar']);


Route::get('/hasilperah', function () {
    return view('hasilperah.Hasil_Perah');
});

