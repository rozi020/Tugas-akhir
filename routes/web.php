<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SapiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;

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
// Auth Things
    // Login
    Route::get('/', [LoginController::class, 'login'])->name('login');
    Route::post('/postLogin', [LoginController::class, 'postLogin']);
    // Register
    Route::post('/register', [LoginController::class, 'register']);
    // Logout
    Route::get('/logout', [LoginController::class, 'logout']);

// Admin Panel - Admin Only
Route::group(['middleware' => ['auth','checkRole:1']], function(){
    Route::get('/pengurus', [UserController::class, 'pengurus']);
    Route::get('/pengurus/load/table-pengurus', [UserController::class, 'LoadTablePengurus']);
    Route::get('/pengurus/load/data-pengurus', [UserController::class, 'LoadDataPengurus']);
    Route::get('/pengurus/delete/{id}', [UserController::class, 'destroy']);
    Route::post('/pengurus/add', [UserController::class, 'store']);
});

// Admin Panel - Admin dan Pengurus bisa akses
Route::group(['middleware' => ['auth','checkRole:1,2']], function(){
    // Dashboard
    Route::get('/dashboard', [LoginController::class, 'dashboard']);

    // Menu Sapi
    Route::get('/daftar-sapi', [SapiController::class, 'daftarsapi']);
    Route::get('/sapi-masuk', [SapiController::class, 'sapimasuk']);
    Route::get('/sapi-keluar', [SapiController::class, 'sapikeluar']);
    Route::get('/hasil-perah', [SapiController::class, 'hasilperah']);
});

?>