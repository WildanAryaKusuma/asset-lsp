<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;

class ProductController extends Controller
{
    public function index() 
    {
        $products = Product::where('status', 'masuk')->latest()->paginate(6);
        return view('products', [
            'products' => $products
        ]);
    }

    public function create(Request $request, $id) 
    {
        // dd($id);
        $product = Product::findOrFail($id);
        return view('pembelian.buy', [
            'product' => $product
        ]);
    }

    public function storePembelian(Request $request) 
    {
        $total_price = $request->price * $request->quantity;
        // dd($total_price);

        $validateData = [
            'user_id' => auth()->user()->id,
            'product_id' => intval($request->product_id),
            'quantity' => $request->quantity,
            'total_price' => $total_price,
            'is_buy' => 1
        ];

        // dd($validateData);

        Transaction::create($validateData);
        return redirect('/pembelian');

    }
    
    public function buy(Request $request, $id) 
    {
        // dd($id);

        $product = Product::findOrFail($id);
        return view('pembelian.buy', [
            'product' => $product
        ]);
        
    }

    
}