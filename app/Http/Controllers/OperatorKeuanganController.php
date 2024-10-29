<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OperatorKeuanganController extends Controller
{
    public function dayPemasukan() 
    {
        $transactions = Transaction::where('is_transaction', 1)
        ->whereDate('created_at', now()->toDateString())
        ->latest()
        ->get();
        
        $total = Transaction::where('is_transaction', 1)
        ->whereDate('created_at', now()->toDateString())
        ->sum('total_price');;

        return view('operator.pemasukan.index', [
            'transactions' => $transactions, 
            'title' => 'Pemasukan Hari Ini', 
            'total' => $total
        ]);
    }
    public function monthPemasukan() 
    {
        $transactions = Transaction::where('is_transaction', 1)
        ->whereYear('created_at', date('Y'))
        ->whereMonth('created_at', date('m'))
        ->latest()->get();
        
        $total = Transaction::where('is_transaction', 1)
        ->whereYear('created_at', date('Y'))
        ->whereMonth('created_at', date('m'))
        ->sum('total_price');;

        return view('operator.pemasukan.index', [
            'transactions' => $transactions, 
            'title' => 'Pemasukan Bulan Ini', 
            'total' => $total
        ]);
    }
    public function allPemasukan() 
    {
        $transactions = Transaction::where('is_transaction', 1)->latest()->get();
        
        $total = Transaction::where('is_transaction', 1)
        ->sum('total_price');;

        return view('operator.pemasukan.index', [
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

        return view('operator.pengeluaran.index', [
            'products' => $products, 
            'title' => 'Pengeluaran Bulan Ini', 
            'total' => $totalValue
        ]);
    }
    public function allPengeluaran() 
    {
        $products = Product::where('status', 'masuk')->latest()->paginate(6);
        $totalValue = Product::selectRaw('SUM(stock * price) as total_value')->value('total_value');

        return view('operator.pengeluaran.index', [
            'products' => $products,
            'title' => 'Pengeluaran Keseluruhan Ini', 
            'total' => $totalValue
        ]);
    }
}