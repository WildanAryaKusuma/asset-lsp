@extends('layouts.dashboard')

@section('container')
    <h3 class="mb-4">Halaman Data Produk</h3>


    <a href="{{ route('dashboard.products.create') }}" class="btn btn-dark my-3">Tambah Produk</a>

    <form action="{{ route('dashboard.products.index') }}" method="GET" class="mb-4">
        <input type="text" name="search" class="form-control my-2" placeholder="Cari produk..."
            value="{{ request('search') }}">
    </form>

    <table class="table table-responsive">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Produk</th>
                <th>Gambar Produk</th>
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
                    <td>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="img-thumbnail rounded"
                                style="max-width: 250px; max-height: 200px; object-fit: cover;">
                        @else
                            <i>no image</i>
                        @endif
                    </td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <div class="d-flex justify-content-center text-center">
                            <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                class="btn btn-link text-decoration-none">Edit</a>

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

    <div class="my-5">
        {{ $products->links() }}
    </div>
@endsection
