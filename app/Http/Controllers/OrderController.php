<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil transaksi dengan status paid, delivered, atau done
        $orders = Transaction::with('user')
            ->whereIn('status', ['paid', 'delivered', 'done'])
            ->latest()
            ->paginate(10);

        return view('dashboard.orders.index', compact('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Hanya bisa mengedit jika status adalah 'paid'
        $order = Transaction::where('id', $id)
            ->where('status', 'paid')
            ->firstOrFail();

        return view('dashboard.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:delivered', // Admin hanya bisa mengubah ke 'delivered'
        ]);

        $order = Transaction::findOrFail($id);
        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->route('orders.index')->with('success', 'Status pesanan berhasil diperbarui!');
    }
}
