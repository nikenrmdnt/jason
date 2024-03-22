<?php

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


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::resource('users', \App\Http\Controllers\UserController::class)->middleware('auth');
Route::resource('kategoriwisata', \App\Http\Controllers\KategoriWisataController::class)->middleware('auth');
Route::resource('/obwis', \App\Http\Controllers\ObjekWisataController::class)->middleware('auth');
Route::resource('kategoriberita', \App\Http\Controllers\KategoriBeritaController::class)->middleware('auth');
Route::resource('penginapan', \App\Http\Controllers\PenginapanController::class)->middleware('auth');
Route::resource('pelanggan', \App\Http\Controllers\PelangganController::class)->middleware('auth');
Route::resource('berita', \App\Http\Controllers\BeritaController::class)->middleware('auth');
Route::resource('karyawan', \App\Http\Controllers\KaryawanController::class)->middleware('auth');
Route::resource('paketwisata', \App\Http\Controllers\PaketWisataController::class)->middleware('auth');
Route::resource('reservasi', \App\Http\Controllers\ReservasiController::class)->middleware('auth');
Route::resource('laporan', \App\Http\Controllers\LaporanController::class)->middleware('auth');
Route::resource('profil-pelanggan', \App\Http\Controllers\ProfilPelangganController::class)->middleware('auth');
Route::resource('reservasib', \App\Http\Controllers\Reservasib::class)->middleware('auth');
Route::get('/search', [App\Http\Controllers\LaporanController::class, 'search'])->name('search');
Route::get('/generateLaporan', [App\Http\Controllers\LaporanController::class, 'downloadpdf']);