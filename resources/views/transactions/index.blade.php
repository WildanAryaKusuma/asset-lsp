@extends('layouts.main')

@section('container')
    <h3 class="mb-4">Halaman Data Transaksi</h3>

    <table class="table table-responsive">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Product</th>
                <th>Harga Produk</th>
                <th>Kuantitas</th>
                <th>Total Harga</th>
                <th>Dibayar Pada</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $transaction->product->name }}</td>
                    <td>Rp. {{ number_format($transaction->product->price, 0, ',' , '.') }}</td>
                    <td>{{ $transaction->quantity }}</td>
                    <td>Rp. {{ number_format($transaction->total_price, 0, ',' , '.') }}</td>
                    <td>{{ $transaction->updated_at }}</td>
                    <td>
                        <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-primary">Show</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
