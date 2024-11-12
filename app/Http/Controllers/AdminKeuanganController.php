<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminKeuanganController extends Controller
{
    /**
     * Pemasukan hari ini
     */
    public function dayPemasukan()
    {
        $transactions = Transaction::where('payment_status', 'paid')
            ->whereDate('created_at', now()->toDateString())
            ->latest()
            ->get();

        $total = $transactions->sum('total_price'); // Menggunakan koleksi untuk menghitung total

        return view('admin.pemasukan.index', [
            'transactions' => $transactions,
            'title' => 'Pemasukan Hari Ini',
            'total' => $total
        ]);
    }

    /**
     * Pemasukan bulan ini
     */
    public function monthPemasukan()
    {
        $transactions = Transaction::where('payment_status', 'paid')
            ->whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->latest()
            ->get();

        $total = $transactions->sum('total_price'); // Menggunakan koleksi untuk menghitung total

        return view('admin.pemasukan.index', [
            'transactions' => $transactions,
            'title' => 'Pemasukan Bulan Ini',
            'total' => $total
        ]);
    }

    /**
     * Pemasukan keseluruhan
     */
    public function allPemasukan()
    {
        $transactions = Transaction::where('payment_status', 'paid')
            ->latest()
            ->get();

        $total = $transactions->sum('total_price'); // Menggunakan koleksi untuk menghitung total

        return view('admin.pemasukan.index', [
            'transactions' => $transactions,
            'title' => 'Pemasukan Keseluruhan',
            'total' => $total
        ]);
    }

    /**
     * Pengeluaran bulan ini
     */
    public function monthPengeluaran()
    {
        // Ambil laporan dengan type 'masuk' berdasarkan bulan dan tahun sekarang
        $reports = Report::where('type', 'masuk')
            ->whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->latest()
            ->paginate(10);

        // Total pengeluaran berdasarkan 'subtotal' saja untuk bulan ini
        $totalValue = Report::where('type', 'masuk') // Menggunakan 'masuk' untuk laporan pengeluaran
            ->whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->sum('subtotal'); // Hanya menjumlahkan subtotal tanpa perlu menghitung quantity

        return view('admin.pengeluaran.index', [
            'title' => 'Pengeluaran Bulan Ini',
            'reports' => $reports,
            'total' => $totalValue
        ]);
    }

    /**
     * Pengeluaran keseluruhan
     */
    public function allPengeluaran()
    {
        // Ambil laporan dengan type 'keluar' untuk pengeluaran keseluruhan
        $reports = Report::where('type', 'masuk') // Menggunakan 'masuk' untuk laporan pengeluaran
            ->latest()
            ->paginate(10);

        // Total pengeluaran berdasarkan 'subtotal' saja untuk keseluruhan
        $totalValue = Report::where('type', 'masuk') // Menggunakan 'masuk' untuk laporan pengeluaran
            ->sum('subtotal'); // Hanya menjumlahkan subtotal tanpa perlu menghitung quantity

        return view('admin.pengeluaran.index', [
            'reports' => $reports,
            'title' => 'Pengeluaran Keseluruhan',
            'total' => $totalValue
        ]);
    }

}
