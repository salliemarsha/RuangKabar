<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CommentController;

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
Route::resource('/articles', ArticleController::class)->middleware(['auth', 'role:admin,penulis']);
Route::resource('/categories', CategoryController::class)->middleware(['auth', 'role:admin']);
Route::resource('/tags', TagController::class)->middleware(['auth', 'role:admin']);
Route::resource('/comments', CommentController::class)->middleware('auth');


