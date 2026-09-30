<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware('auth', 'role:admin');
Route::get('/penulis/dashboard', [PenulisController::class, 'dashboard'])->middleware('auth', 'role:penulis');
Route::get('/beranda', [PenggunaController::class, 'beranda'])->middleware(['auth', 'role:pengguna']);


