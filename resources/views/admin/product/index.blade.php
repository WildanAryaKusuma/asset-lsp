@extends('layouts.admin')

@section('container')
    <h3 class="mb-4">Halaman Data {{ $title }}</h3>

    <a href="{{ $title == "Produk Masuk" ? route('product-in.create') : route('product-out.create') }}" class="btn btn-primary my-3">Tambah {{ $title }}</a>
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Produk</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Stok</th>
                <th class="text-center">Aksi</th>
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
                    <td>
                        <div class="d-flex justify-content-center text-center">
                            <a href="{{ $title == "Produk Masuk" ? route('product-in.edit', $product->id) : route('product-out.edit', $product->id) }}" class="btn btn-link text-decoration-none">Edit</a>
                            <form action="{{ $title == "Produk Masuk" ? route('product-in.destroy', $product->id) : route('product-out.destroy', $product->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link text-decoration-none text-danger" onclick="return window.confirm('Apakah kamu yakin?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
