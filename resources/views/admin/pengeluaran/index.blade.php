@extends('layouts.admin')

@section('container')
    <h3 class="mb-4">Halaman Data {{ $title }}</h3>

    <div class="card text-start bg-primary text-white" style="width: 350px">
        <div class="card-body">
            <h5 class="card-title">Total {{ $title }}</h5>
            <p class="card-text">Rp. {{ number_format($total, 0, ',' , '.') }}</p>
        </div>
    </div>
    

    <table class="table table-responsive mt-4">
        <thead>
            <tr>
                <th>#</th>
                <th>Produk</th>
                <th>Harga Produk</th>
                <th>Stock Masuk</th>
                <th>Pengeluaran</th>
                <th>Tanggal Masuk Barang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $product->name  }}</td>
                    <td>Rp. {{ number_format($product->price, 0, ',' , '.') }}</td>
                    <td>{{ $product->stock  }}</td>
                    <td>Rp. {{ number_format($product->price * $product->stock, 0, ',' , '.') }}</td>
                    <td>{{ $product->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="my-5">
        {{ $products->links() }}
    </div>
@endsection
