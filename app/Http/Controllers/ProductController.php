<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('stock', '>', 0) 
        ->latest()
        ->paginate(6);

        return view('products', [
            'products' => $products
        ]);
    }
}