<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function showIncomingProducts()
    {
        $incomingReports = Report::where('type', 'masuk')->latest()->get();
        return view('admin.products.reports', ['reports' => $incomingReports, 'title' => 'Produk Masuk']);
    }

    public function showOutgoingProducts()
    {
        $outgoingReports = Report::where('type', 'keluar')->latest()->get();
        return view('admin.products.reports', ['reports' => $outgoingReports, 'title' => 'Produk Keluar']);
    }

}
