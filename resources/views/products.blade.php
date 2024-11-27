@extends('layouts.main')

@section('container')
    <h3 class="mb-4">Halaman Produk Makanan</h3>

    <form action="{{ route('products') }}" method="GET" class="mb-4">
        <input type="text" name="search" id="search-input" class="form-control" placeholder="Cari produk..."
            value="{{ request('search') }}">
    </form>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mt-4">
                <div class="card">
                    <img style="max-height: 400px"
                        src="{{ $product->image ? asset('storage/' . $product->image) : asset('asset/food/' . str_replace(' ', '', $product->name) . '.jpg') }}"
                        alt="{{ $product->name }}" class="card-img-top" height="300px">

                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p>In <small><a href="#" class="text-decoration-none">Kategori Buku</a></small></p>
                        <h6 class="card-text">Rp. {{ number_format($product->price, 0, ',', '.') }}</h6>
                        <small class="card-text">Stok : {{ $product->stock }}</small>
                        <p class="card-text">{{ $product->description }}</p>

                        <form action="{{ route('cartbuy.create', $product->id) }}" method="post">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-dark"
                                onclick="return confirm('Mau membeli produk ini?')">Masukkan Keranjang</button>
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
