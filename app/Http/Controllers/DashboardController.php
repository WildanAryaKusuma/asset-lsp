<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTransaksi = Transaction::where('payment_status', 'paid')->count();
        $totalPembeli = User::where('role', 'user')->count();
        $totalProduk = Product::count();
        $pendapatanHariIni = Transaction::where('payment_status', 'paid')
            ->whereDate('created_at', now()->toDateString())
            ->sum('total_price');

        $produkStokRendah = Product::where('stock', '<=', 10)->get();
        $laporanKeuangan = [
            'pemasukanHariIni' => $pendapatanHariIni,
            'pemasukanBulanIni' => Transaction::where('payment_status', 'paid')
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->sum('total_price'),
        ];

        return view('dashboard.home', compact(
            'totalTransaksi',
            'totalPembeli',
            'totalProduk',
            'pendapatanHariIni',
            'produkStokRendah',
            'laporanKeuangan'
        ));
    }
}
