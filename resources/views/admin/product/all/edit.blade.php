@extends('layouts.admin')

@section('container')
    <h3 class="mb-5">Halaman Edit Produk</h3>

    <form action="{{ route('product-all.update', $product->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <label for="name" class="form-label">Nama Produk</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" cols="23" rows="4" class="form-control">{{ $product->description }}</textarea>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control"  value="{{ $product->stock }}">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <label for="status" class="form-label">Status Produk</label>
                <select name="status" id="status" class="form-control">
                    <option value="masuk" {{ $product->status == "masuk" ? 'selected' : '' }}>Masuk</option>
                    <option value="keluar" {{ $product->status == "keluar" ? 'selected' : '' }}>Keluar</option>
                </select>
            </div>
        </div>

        <button class="btn btn-dark mt-4" type="submit">Submit</button>
    </form>
@endsection
