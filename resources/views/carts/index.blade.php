@extends('layouts.main')

@section('container')
    <h3 class="mb-4">Halaman Data Keranjang</h3>

    @if(session('error'))
        <div id="error-alert" class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if(session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('products') }}" class="btn btn-primary mt-3 mb-4">Tambah Pesanan</a>

    <table class="table table-responsive">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Product</th>
                <th>Harga Produk</th>
                <th>Kuantitas</th>
                <th>Subtotal</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carts as $cart)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $cart->product->name }}</td>
                    <td>Rp. {{ number_format($cart->product->price, 0, ',' , '.') }}</td>
                    <td>{{ $cart->quantity }}</td>
                    <td>Rp. {{ number_format($cart->subtotal, 0, ',' , '.') }}</td>
                    <td>
                        <div class="d-flex justify-content-center text-center">
                            <a href="{{ route('carts.edit', $cart->id) }}" class="btn btn-link text-decoration-none">Edit</a>
                            <form action="{{ route('carts.destroy', $cart->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link text-decoration-none text-danger" onclick="return window.confirm('Apakah kamu yakin hapus?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($carts->isNotEmpty())
        <div class="d-flex justify-content-end" style="margin-right: 1rem">
            <form action="{{ route('cart.transaksi') }}" method="post">
                @csrf
                @method('POST')
                <button type="submit" class="btn btn-dark my-3" onclick="return window.confirm('Apakah kamu ingin checkout?')">Checkout</button>
            </form>
        </div>
    @endif
    
@endsection
