<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $transaction = Transaction::where('is_buy', 1)->latest()->get();
        return view('pembelian.index', [
            'transactions' => $transaction
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   
        $transaction = Transaction::findOrFail($id);
        return view('pembelian.edit', [
            'transaction' => $transaction
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $total_price = $request->price * $request->quantity;
        // dd($total_price);

        $validateData = [
            'user_id' => auth()->user()->id,
            'product_id' => intval($request->product_id),
            'quantity' => $request->quantity,
            'total_price' => $total_price,
        ];

        Transaction::whereId($id)->update($validateData);
        
        return redirect('/pembelian');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Transaction::destroy($id);
        return back();
    }
}