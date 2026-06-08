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

Route::get('/buku/search', [BukuController::class, 'search'])
    ->name('buku.search');

// Buku
Route::resource('buku', BukuController::class);

// Anggota
Route::resource('anggota', AnggotaController::class);