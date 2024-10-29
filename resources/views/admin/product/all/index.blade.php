@extends('layouts.admin')

@section('container')
    <h3 class="mb-4">Halaman Data Semua Produk</h3>
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Produk</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->status }}</td>
                    <td>
                        <a href="{{ route('product-all.edit', $product->id) }}"
                            class="btn btn-link text-decoration-none">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
