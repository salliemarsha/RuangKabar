<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\PengelolaanPenggunaController;
use App\Http\Controllers\Admin\AuthorApplicationController as AdminAuthorApplicationController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublicCategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AuthorApplicationController;
use App\Models\Article;
use App\Models\Category;

Route::get('/', function () {
    $articles = Article::with(['category', 'user', 'tags'])
        ->where('status', 'published')
        ->latest()
        ->take(6)
        ->get();

    $categories = Category::where('is_active', true)
        ->orderBy('name')
        ->get();

    return view('home', compact('articles', 'categories'));
});

Route::get('/kategori/{category:slug}', [PublicCategoryController::class, 'show'])
    ->name('kategori.show');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/pengaturan-akun', [AccountController::class, 'edit'])
        ->name('account.settings');

    Route::patch('/pengaturan-akun/profil', [AccountController::class, 'updateProfile'])
        ->name('account.profile.update');

    Route::post('/pengaturan-akun/foto-profil', [AccountController::class, 'updateProfilePhoto'])
        ->name('account.profile-photo.update');

    Route::delete('/pengaturan-akun/foto-profil', [AccountController::class, 'deleteProfilePhoto'])
        ->name('account.profile-photo.destroy');

    Route::patch('/pengaturan-akun/password', [AccountController::class, 'updatePassword'])
        ->name('account.password.update');

    Route::delete('/pengaturan-akun', [AccountController::class, 'destroy'])
        ->name('account.destroy');

    Route::post('/notifications/{id}/read', [NotificationController::class, 'read'])
        ->name('notifications.read');

    Route::post('/notifications/read-all', [NotificationController::class, 'readAll'])
        ->name('notifications.read-all');

    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])
        ->name('notifications.destroy');

    Route::delete('/notifications', [NotificationController::class, 'destroyAll'])
        ->name('notifications.destroy-all');
});

Route::post('/pengajuan-penulis', [AuthorApplicationController::class, 'store'])
    ->middleware(['auth', 'role:pengguna'])
    ->name('author-applications.store');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/articles', [ArticleController::class, 'adminIndex'])
            ->name('articles.index');

        Route::get('/users', [PengelolaanPenggunaController::class, 'index'])
            ->name('users.index');

        Route::put('/users/{user}', [PengelolaanPenggunaController::class, 'update'])
            ->name('users.update');

        Route::patch('/users/{user}/status', [PengelolaanPenggunaController::class, 'status'])
            ->name('users.status');

        Route::patch('/users/{user}/password', [PengelolaanPenggunaController::class, 'password'])
            ->name('users.password');

        Route::delete('/users/{user}', [PengelolaanPenggunaController::class, 'destroy'])
            ->name('users.destroy');

        Route::get('/author-applications', [AdminAuthorApplicationController::class, 'index'])
            ->name('author-applications.index');

        Route::patch('/author-applications/{authorApplication}/approve', [AdminAuthorApplicationController::class, 'approve'])
            ->name('author-applications.approve');

        Route::patch('/author-applications/{authorApplication}/reject', [AdminAuthorApplicationController::class, 'reject'])
            ->name('author-applications.reject');
    });

Route::middleware(['auth', 'role:penulis'])
    ->prefix('penulis')
    ->name('penulis.')
    ->group(function () {
        Route::get('/dashboard', [PenulisController::class, 'dashboard'])
            ->name('dashboard');

        Route::get('/articles', [ArticleController::class, 'writerIndex'])
            ->name('articles.index');
    });

Route::get('/beranda', [PenggunaController::class, 'beranda'])
    ->middleware(['auth', 'role:pengguna'])
    ->name('pengguna.beranda');

Route::patch('/categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])
    ->middleware(['auth', 'role:admin'])
    ->name('categories.toggle-status');

Route::resource('/categories', CategoryController::class)
    ->middleware(['auth', 'role:admin']);

Route::resource('/tags', TagController::class)
    ->middleware(['auth', 'role:admin']);

Route::get('/reports/articles', [ReportController::class, 'articles'])
    ->middleware(['auth', 'role:admin'])
    ->name('reports.articles');

Route::get('/articles', [ArticleController::class, 'index'])
    ->name('articles.index');

Route::middleware(['auth', 'role:admin,penulis'])->group(function () {
    Route::get('/articles/create', [ArticleController::class, 'create'])
        ->name('articles.create');

    Route::post('/articles', [ArticleController::class, 'store'])
        ->name('articles.store');

    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])
        ->name('articles.edit');

    Route::put('/articles/{article}', [ArticleController::class, 'update'])
        ->name('articles.update');

    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])
        ->name('articles.destroy');
});

Route::get('/articles/{article}', [ArticleController::class, 'show'])
    ->name('articles.show');

Route::post('/comments', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('comments.store');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/comments', [CommentController::class, 'index'])
        ->name('comments.index');

    Route::put('/comments/{comment}', [CommentController::class, 'update'])
        ->name('comments.update');

    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
        ->name('comments.destroy');
});
