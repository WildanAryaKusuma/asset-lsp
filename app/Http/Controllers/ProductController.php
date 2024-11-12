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

    public function storeCart(Request $request)
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

        return redirect('/carts')->with('success', 'Produk berhasil ditambahkan ke keranjang');
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
        $transaction = Transaction::where('user_id', auth()->user()->id)
            ->where('payment_status', 'unpaid')
            ->first();

        if (!$transaction) {
            return redirect('/carts')->with('error', 'Tidak ada item dalam keranjang untuk di-checkout.');
        }

        $cartItems = Cart::where('transaction_id', $transaction->id)->get();
        $totalPrice = 0;

        foreach ($cartItems as $item) {
            $product = $item->product;

            if ($product->stock < $item->quantity) {
                return redirect('/carts')->with('error', "Stok untuk produk {$product->name} tidak mencukupi.");
            }

            $product->stock -= $item->quantity;
            $product->save();

            $totalPrice += $item->subtotal;
        }

        $transaction->update([
            'total_price' => $totalPrice,
            'payment_status' => 'paid'
        ]);

        return redirect('/transactions')->with('success', 'Checkout berhasil!');
    }



    
}