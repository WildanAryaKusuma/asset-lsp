<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardKeuanganController;

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authenticate'])->name('auth.authenticate');

Route::get('register', [AuthController::class, 'register'])->name('auth.register');
Route::post('register', [AuthController::class, 'store'])->name('auth.store');

Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/', function () {
    return view('home');
});

Route::get('about', function () {
    return view('about');
});

Route::get('products', [ProductController::class, 'index'])->name('products');

Route::middleware(['auth'])->group(function () {

    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.home');
        Route::resource('dashboard/user', DashboardUserController::class);
        Route::resource('dashboard/categories', CategoryController::class);
        Route::name('dashboard.')->group(function () {
            Route::resource('dashboard/products', DashboardProductController::class);
        });
    });

    // Rute buat user doangan
    Route::middleware('role:user')->group(function () {
        Route::resource('carts', CartController::class);
        Route::post('carts/buy/{id}', [CartController::class, 'create'])->name('cartbuy.create');
        Route::post('carts/transaction', [CartController::class, 'checkout'])->name('cart.transaksi');
        Route::resource('transactions', TransactionController::class);
    });
});

