<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardKeuanganController;
use App\Http\Controllers\DashboardOperatorController;

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authenticate'])->name('auth.authenticate');

Route::get('register', [AuthController::class, 'register'])->name('auth.register');
Route::post('register', [AuthController::class, 'store'])->name('auth.store');

Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/', function () {
    return view('home');
});

Route::get('products', [ProductController::class, 'index'])->name('products');

Route::middleware(['auth'])->group(function () {

    Route::middleware('role:admin,operator')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard.home');
        });

        Route::resource('dashboard/user', DashboardUserController::class);
        Route::resource('dashboard/operator', DashboardOperatorController::class);

        Route::name('dashboard.')->group(function () {
            Route::resource('dashboard/products', DashboardProductController::class);
        });

        Route::get('/dashboard/products-in', [ReportController::class, 'showIncomingProducts'])->name('dashboard.products-in.index');
        Route::get('/dashboard/products-out', [ReportController::class, 'showOutgoingProducts'])->name('dashboard.products-out.index');
        Route::get('dashboard/pembeli', [DashboardUserController::class, 'pembeli'])->name('dashboard.pembeli');
        Route::get('dashboard/pemasukan-day', [DashboardKeuanganController::class, 'dayPemasukan'])->name('pemasukan.day');
        Route::get('dashboard/pemasukan-month', [DashboardKeuanganController::class, 'monthPemasukan'])->name('pemasukan.month');
        Route::get('dashboard/pemasukan-all', [DashboardKeuanganController::class, 'allPemasukan'])->name('pemasukan.all');
    });

    Route::middleware('role:admin')->group(function () {
        Route::get('dashboard/pengeluaran-month', [DashboardKeuanganController::class, 'monthPengeluaran'])->name('pengeluaran.month');
        Route::get('dashboard/pengeluaran-all', [DashboardKeuanganController::class, 'allPengeluaran'])->name('pengeluaran.all');
    });

    // Rute buat user doangan
    Route::middleware('role:user')->group(function () {
        Route::resource('carts', CartController::class);
        Route::post('carts/buy/{id}', [CartController::class, 'create'])->name('cartbuy.create');
        Route::post('carts/transaction', [CartController::class, 'checkout'])->name('cart.transaksi');
        Route::resource('transactions', TransactionController::class);
    });
});

