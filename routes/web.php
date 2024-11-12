<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminKeuanganController;
use App\Http\Controllers\AdminOperatorController;
use App\Http\Controllers\OperatorKeuanganController;

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

    Route::get('/dashboard', function () {
        return view('dashboard.home');
    });

    Route::resource('dashboard/user', AdminUserController::class);
    Route::resource('dashboard/operator', AdminOperatorController::class);

    Route::name('dashboard.')->group(function () {
        Route::resource('dashboard/products', AdminProductController::class);
    });

    Route::get('/dashboard/products-in', [ReportController::class, 'showIncomingProducts'])->name('admin.produkmasuk.index');
    Route::get('/dashboard/products-out', [ReportController::class, 'showOutgoingProducts'])->name('admin.produkkeluar.index');
    Route::get('dashboard/pembeli', [AdminUserController::class, 'pembeli'])->name('admin.pembeli');
    Route::get('dashboard/pemasukan-day', [AdminKeuanganController::class, 'dayPemasukan'])->name('pemasukan.day');
    Route::get('dashboard/pemasukan-month', [AdminKeuanganController::class, 'monthPemasukan'])->name('pemasukan.month');
    Route::get('dashboard/pemasukan-all', [AdminKeuanganController::class, 'allPemasukan'])->name('pemasukan.all');
    Route::get('dashboard/pengeluaran-month', [AdminKeuanganController::class, 'monthPengeluaran'])->name('pengeluaran.month');
    Route::get('dashboard/pengeluaran-all', [AdminKeuanganController::class, 'allPengeluaran'])->name('pengeluaran.all');

    Route::resource('carts', CartController::class);
    Route::post('carts/buy/{id}', [CartController::class, 'create'])->name('cartbuy.create');
    Route::post('carts/transaction', [CartController::class, 'checkout'])->name('cart.transaksi');
    Route::resource('transactions', TransactionController::class);
});
