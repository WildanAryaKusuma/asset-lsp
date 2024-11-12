@extends('layouts.admin')

@section('container')
    <h3 class="mb-5">Halaman Tambah {{ $title }}</h3>

    <form action="{{ $title == "Produk Masuk" ? route('product-in.store') : route('product-out.store') }}" method="post">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-md-12">
                <label for="name" class="form-label">Nama Produk</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" cols="23" rows="4" class="form-control"></textarea>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" id="price" class="form-control">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <label for="status" class="form-label">Status Produk</label>
                <input type="text" name="status" id="status" class="form-control" value="{{ $title == "Produk Masuk" ? 'masuk' : 'keluar' }}" readonly>
            </div>
        </div>

        <button class="btn btn-dark mt-4" type="submit">Submit</button>
    </form>
@endsection
