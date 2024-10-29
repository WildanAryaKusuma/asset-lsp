<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     
    public function index()
    {
        $products = Product::where('status', 'keluar')->latest()->get();
        return view('admin.product.index',[
            'products' => $products,
            'title' => "Produk Keluar"
        ] );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create', [
            'title' => "Produk Keluar"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'status' => 'required',
        ]);
        
        // dd($validateData);
        
        Product::create($validateData);

        return redirect()->route('product-out.index');
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
        $product = Product::findOrFail($id);
        return view('admin.product.edit', [
            'product' => $product,
            'title' => "Produk Keluar"
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'status' => 'required',
        ]);
        
        // dd($validateData);
        
        Product::whereId($id)->update($validateData);

        return redirect()->route('product-out.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);
        return back();
    }
}