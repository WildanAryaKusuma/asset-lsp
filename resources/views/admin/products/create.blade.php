@extends('layouts.admin')

@section('container')
    <h3 class="mb-5">Halaman Produk</h3>

    <form action="{{ route('admin.products.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" name="price" id="price" class="form-control">
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" name="stock" id="stock" class="form-control">
        </div>

        <button type="submit" class="btn btn-dark mt-4">Tambah Produk</button>
    </form>
@endsection
