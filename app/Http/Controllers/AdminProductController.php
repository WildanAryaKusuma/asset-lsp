<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create', ['title' => 'Tambah Produk']);
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
            'stock' => 'required',
        ]);

        Product::create($validateData);

        return redirect()->route('admin.products.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', [
            'product' => $product,
            'title' => 'Edit Produk'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $newStock = $request->stock;
        $stockDifference = $newStock - $product->stock;

        // Update data produk
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $newStock,
        ]);

        // Log perubahan stok di laporan
        if ($stockDifference > 0) {
            // Penambahan stok
            Report::create([
                'product_id' => $product->id,
                'type' => 'masuk',
                'quantity' => $stockDifference,
                'description' => 'Penambahan stok',
                'subtotal' => $product->price * $stockDifference 
            ]);
        } elseif ($stockDifference < 0) {
            Report::create([
                'product_id' => $product->id,
                'type' => 'keluar',
                'quantity' => abs($stockDifference),
                'description' => 'Pengurangan stok',
                'subtotal' => $product->price * abs($stockDifference)
            ]);
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
