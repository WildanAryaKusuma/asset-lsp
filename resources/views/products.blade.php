@extends('layouts.main')

@section('container')
    <h3 class="mb-4">Halaman Produk Makanan</h3>

    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-4 mt-4">
            <div class="card">
                <img style="max-height: 400px" src="{{ asset('asset/food/'. str_replace(' ', '', $product->name). '.jpg') }}" alt=""
                    class="card-img-top" height="300px">
                <div class="card-body">

                    <h5 class="card-title">{{ $product->name }}</h5>
                    <h6 class="card-text">Rp. {{ number_format($product->price, 0, ',' , '.') }}</h6>
                    <small class="card-text">Stok : {{ $product->stock }}</small>
                    <p class="card-text">{{ $product->description }}</p>

                    <form action="{{ route('buy.create', $product->id) }}" method="post">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Mau membeli product ini?')">Masukkan Keranjang</button>
                    </form>

                </div>
            </div>
        </div>
        @endforeach

        <div class="my-5">
            {{ $products->links() }}
        </div>

    </div>
@endsection
