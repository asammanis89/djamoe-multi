<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\FlyerController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization; 

/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES (LOGIN / LOGOUT)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN PANEL ROUTES (DILINDUNGI)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin,superadmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Resources
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('locations', LocationController::class);
    Route::resource('articles', ArticleController::class);
    Route::resource('abouts', AboutController::class);
    Route::resource('flyers', FlyerController::class);

    // Hanya SUPER_ADMIN yang bisa kelola user
    Route::middleware(['role:superadmin'])->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
        Route::put('users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
        Route::put('users/{user}/activate', [UserController::class, 'activate'])->name('users.activate');
    });
});


/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES (PUBLIC - DENGAN LOKALISASI)
|--------------------------------------------------------------------------
*/

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function() {

    /** RUTE WEB YANG DIPANGGIL LANGSUNG OLEH PENGGUNA **/
    
    Route::get('/', [PageController::class, 'index'])->name('home');
    Route::get('/aktivitas', [PageController::class, 'aktivitas'])->name('aktivitas');
    Route::get('/outlet', [PageController::class, 'outlet'])->name('outlet');
    Route::get('/tentang-kami', [PageController::class, 'about'])->name('about');
    
    // PRODUK
    Route::get('/produk', [PageController::class, 'produk'])->name('produk.index');
    
    // Rute AJAX tidak ada di sini

}); // <-- AKHIR DARI GRUP LOKALISASI


/*
|--------------------------------------------------------------------------
| API ROUTES (PUBLIC - TANPA LOKALISASI)
|--------------------------------------------------------------------------
*/

// ===============================================
// REVISI: KEMBALIKAN Rute AJAX ke SINI (DI LUAR GRUP)
// ===============================================
// Ini akan memperbaiki error 404 "halaman kosong" Anda
Route::get('/produk/kategori/{category}', [PageController::class, 'getProductsByCategory'])->name('produk.kategori');
Route::get('/produk/detail/{product}', [PageController::class, 'getProductDetail'])->name('produk.detail');