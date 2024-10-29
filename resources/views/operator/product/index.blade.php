@extends('layouts.operator')

@section('container')
    <h3 class="mb-4">Halaman Data {{ $title }}</h3>

    <table class="table table-responsive">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Produk</th>
                <th>Deskripsi</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
