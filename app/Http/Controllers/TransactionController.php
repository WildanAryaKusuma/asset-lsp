<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Product;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::where('status', 'paid')
        ->where('user_id', auth()->user()->id)
        ->latest()
        ->get();

        return view('transactions.index', [
            'transactions' => $transactions
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = Transaction::with('carts.product')->findOrFail($id);
        return view('transactions.detail', compact('transaction'));
    }
}