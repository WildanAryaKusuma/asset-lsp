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
        $subtotal = $request->price * $request->quantity;

        // Cari transaksi unpaid yang sudah ada untuk user
        $transaction = Transaction::firstOrCreate(
            [
                'user_id' => auth()->user()->id,
                'payment_status' => 'unpaid'
            ],
            [
                'total_price' => 0, // Awalnya 0, akan diupdate di checkout
                'payment_status' => 'unpaid',
            ]
        );

        // Data untuk cart
        $cartData = [
            'transaction_id' => $transaction->id,
            'product_id' => intval($request->product_id),
            'quantity' => $request->quantity,
            'subtotal' => $subtotal,
        ];

        // Simpan ke tabel carts
        Cart::create($cartData);

        return redirect('/pembelian')->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    
    public function buy(Request $request, $id) 
    {
        // dd($id);

        $product = Product::findOrFail($id);
        return view('pembeliwan.buy', [
            'product' => $product
        ]);
        
    }

    public function checkout()
    {
        // Ambil transaksi unpaid untuk user yang sedang login
        $transaction = Transaction::where('user_id', auth()->user()->id)
            ->where('payment_status', 'unpaid')
            ->first();

        if (!$transaction) {
            return redirect('/pembelian')->with('error', 'Tidak ada item dalam keranjang untuk di-checkout.');
        }

        // Hitung total harga dari semua item di cart
        $totalPrice = Cart::where('transaction_id', $transaction->id)->sum('subtotal');

        // Update transaksi menjadi paid dan set total_price
        $transaction->update([
            'total_price' => $totalPrice,
            'payment_status' => 'paid'
        ]);

        return redirect('/transactions')->with('success', 'Checkout berhasil!');
    }


    
}