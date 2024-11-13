<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Report;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::whereHas('transaction', function ($query) {
            $query->where('payment_status', 'unpaid')
                ->where('user_id', auth()->id());
        })->latest()
            ->paginate(10);

        return view('carts.index', [
            'carts' => $carts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id) // nangkep parameter id
    {
        $product = Product::findOrFail($id);
        return view('carts.buy', [
            'product' => $product
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $subtotal = $request->price * $request->quantity;

        $transaction = Transaction::firstOrCreate(
            [
                'user_id' => auth()->user()->id,
                'payment_status' => 'unpaid'
            ],
            [
                'total_price' => 0,
                'payment_status' => 'unpaid',
            ]
        );

        $cartData = [
            'transaction_id' => $transaction->id,
            'product_id' => intval($request->product_id),
            'quantity' => $request->quantity,
            'subtotal' => $subtotal,
        ];

        Cart::create($cartData);

        return redirect('/carts')->with('success', 'Produk berhasil ditambahkan ke keranjang');
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

            Report::create([
                'product_id' => $product->id,
                'type' => 'keluar',
                'quantity' => $item->quantity,
                'description' => 'Pengurangan stok akibat checkout',
                'subtotal' => $product->price * $item->quantity
            ]);

            $totalPrice += $item->subtotal;
        }

        $transaction->update([
            'total_price' => $totalPrice,
            'payment_status' => 'paid'
        ]);
        
        auth()->user()->update(['is_transaction' => 1]);

        return redirect('/transactions')->with('success', 'Checkout berhasil!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cart = Cart::findOrFail($id);
        return view('carts.edit', [
            'transaction' => $cart
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subtotal = $request->price * $request->quantity;

        $validateData = [
            'product_id' => intval($request->product_id),
            'quantity' => $request->quantity,
            'subtotal' => $subtotal,
        ];

        Cart::whereId($id)->update($validateData);

        return redirect('/carts')->with('success', 'Cart updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Cart::destroy($id);
        return back();
    }
}
