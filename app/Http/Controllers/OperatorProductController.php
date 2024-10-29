<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class OperatorProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     
    public function all()
    {
        $products = Product::latest()->get();
        return view('operator.product.all.index',[
            'products' => $products,
        ] );
    }
    public function in()
    {
        $products = Product::where('status', 'masuk')->latest()->get();
        return view('operator.product.index',[
            'products' => $products,
            'title' => "Produk Masuk"
        ] );
    }
    public function out()
    {
        $products = Product::where('status', 'keluar')->latest()->get();
        return view('operator.product.index',[
            'products' => $products,
            'title' => "Produk Keluar"
        ] );
    }


}