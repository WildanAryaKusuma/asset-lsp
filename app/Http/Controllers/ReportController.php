<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function showIncomingProducts(Request $request)
    {
        $query = Report::where('type', 'masuk')->latest();

        if ($request->has('search')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $incomingReports = $query->paginate(10);

        return view('dashboard.products.reports', [
            'reports' => $incomingReports,
            'title' => 'Produk Masuk'
        ]);
    }

    public function showOutgoingProducts(Request $request)
    {
        $query = Report::where('type', 'keluar')->latest();

        if ($request->has('search')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $outgoingReports = $query->paginate(10);

        return view('dashboard.products.reports', [
            'reports' => $outgoingReports,
            'title' => 'Produk Keluar'
        ]);
    }


}
