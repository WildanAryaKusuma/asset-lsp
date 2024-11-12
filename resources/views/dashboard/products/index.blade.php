@extends('layouts.dashboard')

@section('container')
    <h3 class="mb-4">Halaman Data Produk</h3>

    <a href="{{ route('dashboard.products.create') }}" class="btn btn-dark my-3">Tambah Produk</a>
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
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <div class="d-flex justify-content-center text-center">
                            <a href="{{ route('dashboard.products.edit', $product->id) }}" class="btn btn-link text-decoration-none">Edit</a>

                            @if (auth()->user()->role != 'operator')
                                <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-link text-decoration-none text-danger"
                                        onclick="return confirm('Apakah kamu yakin?')">Delete</button>
                                </form>
                            @endif

                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
