@extends('layouts.main')

@section('container')
    <h3 class="mb-4">Halaman Data Transaksi</h3>

    <table class="table table-responsive">
    <thead>
        <tr>
            <th>#</th>
            <th>Pesanan</th> <!-- New Column for Order Summary -->
            <th>Total Harga</th>
            <th>Dibayar Pada</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
            <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>
                    <ul class="list-unstyled">
                        @foreach ($transaction->carts as $item)
                        <li>{{ $item->product->name }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>Rp. {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                <td>{{ $transaction->updated_at }}</td>
                <td>
                    <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-primary">Show</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
