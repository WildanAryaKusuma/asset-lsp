<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminKeuanganController extends Controller
{
    public function dayPemasukan()
    {
        $transactions = Transaction::where('payment_status', 'paid')
        ->whereDate('created_at', now()->toDateString())
        ->latest()
        ->get();
        
        $total = Transaction::where('payment_status', 'paid')
        ->whereDate('created_at', now()->toDateString())
        ->sum('total_price');;

        return view('admin.pemasukan.index', [
            'transactions' => $transactions, 
            'title' => 'Pemasukan Hari Ini', 
            'total' => $total
        ]);
    }
    public function monthPemasukan() 
    {
        $transactions = Transaction::where('payment_status', 'paid')
        ->whereYear('created_at', date('Y'))
        ->whereMonth('created_at', date('m'))
        ->latest()->get();
        
        $total = Transaction::where('payment_status', 'paid')
        ->whereYear('created_at', date('Y'))
        ->whereMonth('created_at', date('m'))
        ->sum('total_price');;

        return view('admin.pemasukan.index', [
            'transactions' => $transactions, 
            'title' => 'Pemasukan Bulan Ini', 
            'total' => $total
        ]);
    }
    public function allPemasukan() 
    {
        $transactions = Transaction::where('payment_status', 'paid')->latest()->get();
        
        $total = Transaction::where('payment_status', 'paid')
        ->sum('total_price');;

        return view('admin.pemasukan.index', [
            'transactions' => $transactions, 
            'title' => 'Pemasukan Keseluruhan', 
            'total' => $total
        ]);
    }
    public function monthPengeluaran() 
    {
        $products = Product::where('status', 'masuk')
        ->whereYear('created_at', date('Y'))
        ->whereMonth('created_at', date('m'))
        ->latest()
        ->paginate(6);
        
        $totalValue = Product::whereYear('created_at', date('Y'))
        ->whereMonth('created_at', date('m'))
        ->selectRaw('SUM(stock * price) as total_value')
        ->value('total_value');

        return view('admin.pengeluaran.index', [
            'title' => 'Pengeluaran Bulan Ini', 
            'products' => $products, 
            'total' => $totalValue
        ]);
    }
    public function allPengeluaran() 
    {
        $products = Product::where('status', 'masuk')->latest()->paginate(6);
        $totalValue = Product::selectRaw('SUM(stock * price) as total_value')->value('total_value');

        return view('admin.pengeluaran.index', [
            'products' => $products,
            'title' => 'Pengeluaran Keseluruhan Ini', 
            'total' => $totalValue
        ]);
    }
}