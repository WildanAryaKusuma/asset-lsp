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
        $transactions = Transaction::latest()->get();
        return view('transactions.index', [
            'transactions' => $transactions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {   
        $transaction = Transaction::findOrFail($id);
        
        $total_price = $transaction->product->price * $transaction->quantity;

        $validateData = [
            'user_id' => auth()->user()->id,
            'product_id' => $transaction->product_id,
            'quantity' => $transaction->quantity,
            'total_price' => $total_price,
            'is_buy' => 0,
            'is_transaction' => 1
        ];

        $stockProduct = $transaction->product->stock;
        $newStock = $stockProduct - $transaction->quantity;
                
        User::whereId($validateData['user_id'])->update(['is_transaction' => 1]);
        Product::whereId($validateData['product_id'])->update(['stock' => $newStock]);
        Transaction::whereId($id)->update($validateData);
        
        return redirect('/transactions');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = Transaction::with('carts.product')->findOrFail($id);
        return view('transactions.detail', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}