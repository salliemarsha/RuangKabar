<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\PenggunaController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware('auth', 'role:admin');
Route::get('/penulis/dashboard', [PenulisController::class, 'dashboard'])->middleware('auth', 'role:penulis');
Route::get('/beranda', [PenggunaController::class, 'beranda'])->middleware(['auth', 'role:pengguna']);


