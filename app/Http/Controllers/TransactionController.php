<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menampilkan transaksi user berdasarkan status
        $transactions = Transaction::with('carts.product')
            ->where('user_id', auth()->user()->id)
            ->whereIn('status', ['paid', 'delivered', 'done'])
            ->latest()
            ->get();

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Menampilkan detail transaksi
        $transaction = Transaction::with('carts.product')
            ->where('user_id', auth()->user()->id)
            ->findOrFail($id);

        return view('transactions.detail', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi hanya bisa mengubah status delivered ke done
        $transaction = Transaction::where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->where('status', 'delivered')
            ->firstOrFail();

        $transaction->update([
            'status' => $request->status,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui!');
    }
}
