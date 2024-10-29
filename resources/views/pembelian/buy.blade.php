@extends('layouts.main')

@section('container')
    <h3 class="mb-5">Halaman Pembelian Produk</h3>

    <div class="container mb-5">
        <form action="{{ route('buy.store') }}" method="post">
            @csrf
            @method('POST')
            <div class="my-3">
                <img src="{{ asset('asset/food/' . str_replace(' ', '', $product->name) . '.jpg') }}"
                    alt="{{ $product->name }}" height="300px" width="300px">
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="name" class="form-label">Nama Produk</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" readonly>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}" readonly>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" required>
                </div>
            </div>

            <input type="hidden" name="product_id" value="{{ $product->id }}">
    
            <button class="btn btn-primary mt-4" type="submit">Submit</button>
        </form>
    </div>
    
@endsection
