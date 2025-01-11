<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::post('proses_register', [AuthController::class, 'proses_register'])->name('proses_register');

Route::group(['middleware' => ['auth']], function () {
    Route::get('admin', [AdminController::class, 'index'])->name('admin');
    Route::get('dataobat', [AdminController::class, 'dataobat'])->name('dataobat');
    Route::post('postdataobat', [AdminController::class, 'postobat'])->name('postobat');
    Route::get('hapusobat/{id}', [AdminController::class, 'hapusobat'])->name('hapusobat');
    Route::get('dataperiode', [AdminController::class, 'dataperiode'])->name('dataperiode');
    Route::get('datapegawai', [AdminController::class, 'datapegawai'])->name('datapegawai');
    Route::post('postdatapegawai', [AdminController::class, 'postpegawai'])->name('postpegawai');
    Route::get('hapuspegawai/{id}', [AdminController::class, 'hapuspegawai'])->name('hapuspegawai');
    Route::get('perhitungan', [AdminController::class, 'perhitungan'])->name('perhitungan');
});
