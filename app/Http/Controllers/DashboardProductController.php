<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(10);

        return view('dashboard.products.index', [
            'products' => $products,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.products.create', ['title' => 'Tambah Produk']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Proses upload file
        if ($request->file('image')) {
            $path = $request->file('image')->store('post-images', 'public'); // Simpan di storage/public/property-images
            $validateData['image'] = $path; // Simpan path ke database
        }

        $product = Product::create($validateData);

        // Tambahkan report saat produk baru dibuat
        $stockDifference = $validateData['stock']; // Jumlah stok awal

        Report::create([
            'product_id' => $product->id,
            'type' => 'masuk',
            'quantity' => $stockDifference,
            'description' => 'Penambahan stok product baru',
            'subtotal' => $product->price * $stockDifference
        ]);

        return redirect()->route('dashboard.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('dashboard.products.edit', [
            'product' => $product,
            'title' => 'Edit Produk'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->file('image')) {
            // Hapus gambar lama jika ada
            if ($request->oldImage) {
                $image_url = 'public/' . $request->oldImage;
                Storage::delete($image_url);
            }
            // Upload gambar baru
            $validateData['image'] = $request->file('image')->store('post-images', 'public');
        }

        // Update data produk
        $newStock = $validateData['stock'];
        $stockDifference = $newStock - $product->stock;

        $product->update($validateData);

        // Log perubahan stok di laporan
        if ($stockDifference > 0) {
            // Penambahan stok
            Report::create([
                'product_id' => $product->id,
                'type' => 'masuk',
                'quantity' => $stockDifference,
                'description' => 'Penambahan stok',
                'subtotal' => $product->price * $stockDifference,
            ]);
        } elseif ($stockDifference < 0) {
            // Pengurangan stok
            Report::create([
                'product_id' => $product->id,
                'type' => 'keluar',
                'quantity' => abs($stockDifference),
                'description' => 'Pengurangan stok',
                'subtotal' => $product->price * abs($stockDifference),
            ]);
        }

        return redirect()->route('dashboard.products.index')->with('success', 'Produk berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }

        $product->delete();

        return redirect()->route('dashboard.products.index')->with('success', 'Produk berhasil dihapus!');
    }

}
