<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Product;
use App\Models\Category;
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
                ->orWhere('author', 'like', '%' . $request->search . '%')
                ->orWhere('publisher', 'like', '%' . $request->search . '%');
        }

        $products = $query->with('category')->latest()->paginate(10);

        return view('dashboard.products.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.products.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Proses upload file
        if ($request->file('image')) {
            $path = $request->file('image')->store('post-images', 'public'); // Simpan di storage/public/property-images
            $validateData['image'] = $path; // Simpan path ke database
        }

        $product = Product::create($validateData);

        // Tambahkan report saat produk baru dibuat
        $stockDifference = $validateData['stock']; // Jumlah stok awal

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
            'categories' => Category::all()
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'category_id' => 'required|exists:categories,id',
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
