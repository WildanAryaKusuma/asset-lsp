<?php

use App\Http\Controllers\AdminKeuanganController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\OperatorUserController;
use App\Http\Controllers\AdminOperatorController;
use App\Http\Controllers\AdminProductInController;
use App\Http\Controllers\OperatorManageController;
use App\Http\Controllers\AdminProductAllController;
use App\Http\Controllers\AdminProductOutController;
use App\Http\Controllers\OperatorKeuanganController;
use App\Http\Controllers\OperatorProductController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\TransactionController;

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authenticate'])->name('auth.authenticate');

Route::get('register', [AuthController::class, 'register'])->name('auth.register');
Route::post('register', [AuthController::class, 'store'])->name('auth.store');

Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/', function () {
    return view('home');
});

Route::get('products', [ProductController::class, 'index'])->name('products');

Route::get('/admin', function () {
    return view('admin.home');
});
    
    

Route::middleware(['auth'])->group(function () {
    
        Route::resource('admin/user', AdminUserController::class);
        Route::resource('admin/operator', AdminOperatorController::class);
        Route::resource('admin/product-in', AdminProductInController::class);
        Route::resource('admin/product-out', AdminProductOutController::class);
        Route::resource('admin/product-all', AdminProductAllController::class);
        Route::get('admin/pembeli', [AdminUserController::class, 'pembeli'])->name('admin.pembeli');

        Route::get('admin/pemasukan-day', [AdminKeuanganController::class, 'dayPemasukan'])->name('pemasukan.day');
        Route::get('admin/pemasukan-month', [AdminKeuanganController::class, 'monthPemasukan'])->name('pemasukan.month');
        Route::get('admin/pemasukan-all', [AdminKeuanganController::class, 'allPemasukan'])->name('pemasukan.all');


        Route::get('admin/pengeluaran-month', [AdminKeuanganController::class, 'monthPengeluaran'])->name('pengeluaran.month');
        Route::get('admin/pengeluaran-all', [AdminKeuanganController::class, 'allPengeluaran'])->name('pengeluaran.all');

        Route::get('operator/pemasukan-day', [OperatorKeuanganController::class, 'dayPemasukan'])->name('pemasukan.operator.day');
        Route::get('operator/pemasukan-month', [OperatorKeuanganController::class, 'monthPemasukan'])->name('pemasukan.operator.month');
        Route::get('operator/pemasukan-all', [OperatorKeuanganController::class, 'allPemasukan'])->name('pemasukan.operator.all');

        Route::get('/operator', function () {
            return view('operator.home');
        });
        
        Route::resource('operator/pembeli', OperatorUserController::class);
        Route::resource('operator/list', OperatorManageController::class);
        Route::get('operator/user', [OperatorUserController::class, 'pembeli'])->name('operator.pembeli');
        Route::get('operator/product-all', [OperatorProductController::class, 'all'])->name('operator.product-all');
        Route::get('operator/product-in', [OperatorProductController::class, 'in'])->name('operator.product-in');
        Route::get('operator/product-out', [OperatorProductController::class, 'out'])->name('operator.product-out');

        Route::post('products/buy/{buy}', [ProductController::class, 'create'])->name('buy.create');
        Route::post('products/store', [ProductController::class, 'storePembelian'])->name('buy.store');

        Route::resource('pembelian', PembelianController::class);
        Route::resource('transactions', TransactionController::class);
        Route::post('cart/transaction', [ProductController::class, 'checkout'])->name('cart.transaksi');

});