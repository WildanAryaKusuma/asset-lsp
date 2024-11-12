@extends('layouts.dashboard')

@section('container')
    <h3 class="mb-5">Halaman Edit Produk</h3>

    <form action="{{ route('dashboard.products.update', $product->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" id="description" class="form-control">{{ $product->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}">
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ $product->stock }}">
        </div>

        <button type="submit" class="btn btn-dark mt-4">Simpan</button>
    </form>
@endsection
