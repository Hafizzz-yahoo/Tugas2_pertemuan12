<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;

Route::get('/', function () {
    return view('home');
})->name('home');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

// Buku
Route::resource('buku', BukuController::class);

Route::get('/buku/kategori/{kategori}', [BukuController::class, 'filterKategori'])
    ->name('buku.kategori');

// Anggota
Route::resource('anggota', AnggotaController::class);