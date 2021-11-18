<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SapiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\UserConfigurationController;

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
    // Data Pengurus
    Route::get('/pengurus', [PengurusController::class, 'pengurus']);
    Route::get('/pengurus/load/table-pengurus', [PengurusController::class, 'LoadTablePengurus']);
    Route::get('/pengurus/load/data-pengurus', [PengurusController::class, 'LoadDataPengurus']);
    Route::get('/pengurus/delete/{id}', [PengurusController::class, 'destroy']);
    Route::post('/pengurus/add', [PengurusController::class, 'store']);
    Route::post('/pengurus/update/password/{id}', [PengurusController::class, 'updatePassword']);

    // Log History Pengurus
    Route::get('/history', [HistoryController::class, 'history']);
    Route::get('/history/load/table-history', [HistoryController::class, 'LoadTableHistory']);
    Route::get('/history/load/data-history', [HistoryController::class, 'LoadDataHistory']);

    // Pengeluaran
    Route::get('/pengeluaran', [PengeluaranController::class, 'index']);
    Route::get('/pengeluaran/load/table-pengeluaran', [PengeluaranController::class, 'LoadTablePengeluaran']);
    Route::get('/pengeluaran/load/data-pengeluaran', [PengeluaranController::class, 'LoadDataPengeluaran']);
    Route::get('/pengeluaran/delete/{id}', [PengeluaranController::class, 'destroy']);
    Route::post('/pengeluaran/add', [PengeluaranController::class, 'store']);
    Route::post('/pengeluaran/update/{id}', [PengeluaranController::class, 'update']);
});

// Admin Panel - Admin dan Pengurus bisa akses
Route::group(['middleware' => ['auth','checkRole:1,2']], function(){
    // Dashboard
    Route::get('/dashboard', [LoginController::class, 'dashboard']);

    // User Configuration
    // Profile
    Route::get('/profile', [UserConfigurationController::class, 'profile']);
    Route::post('/profile/update', [UserConfigurationController::class, 'updateProfile']);

    // Password
    Route::get('/password', [UserConfigurationController::class, 'password']);
    Route::post('/password/update', [UserConfigurationController::class, 'updatePassword']);

    // Activity History
    Route::get('/activity', [UserConfigurationController::class, 'activity']);

    // Menu Sapi
    // Daftar Sapi
    Route::get('/daftar-sapi', [SapiController::class, 'daftarsapi']);
    Route::get('/daftar-sapi/load/table-daftarsapi', [SapiController::class, 'LoadTableDaftarSapi']);
    Route::get('/daftar-sapi/load/data-daftarsapi', [SapiController::class, 'LoadDataDaftarSapi']);
    Route::get('/daftar-sapi/delete/{id}', [SapiController::class, 'destroyDaftarSapi']);
    Route::post('/daftar-sapi/add', [SapiController::class, 'storeDaftarSapi']);
    Route::post('/daftar-sapi/update/{id}', [SapiController::class, 'updateDaftarSapi']);

    // Sapi Keluar
    Route::get('/sapi-keluar', [SapiController::class, 'sapikeluar']);
    Route::get('/sapi-keluar/load/table-sapikeluar', [SapiController::class, 'LoadTableSapiKeluar']);
    Route::get('/sapi-keluar/load/data-sapikeluar', [SapiController::class, 'LoadDataSapiKeluar']);
    Route::get('/sapi-keluar/delete/{id}', [SapiController::class, 'destroySapiKeluar']);
    Route::post('/sapi-keluar/add', [SapiController::class, 'storeSapiKeluar']);
    Route::post('/sapi-keluar/update/{id}', [SapiController::class, 'updateSapiKeluar']);

    // Hasil Perah
    Route::get('/hasil-perah', [SapiController::class, 'hasilperah']);
    Route::get('/hasil-perah/load/table-hasilperah', [SapiController::class, 'LoadTableHasilPerah']);
    Route::get('/hasil-perah/load/data-hasilperah', [SapiController::class, 'LoadDataHasilPerah']);
    Route::get('/hasil-perah/delete/{id}', [SapiController::class, 'destroyHasilPerah']);
    Route::post('/hasil-perah/add', [SapiController::class, 'storeHasilPerah']);
    Route::post('/hasil-perah/update/{id}', [SapiController::class, 'updateHasilPerah']);
});

?>