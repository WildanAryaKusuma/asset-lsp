@extends('layouts.main')

@section('container')
    <h3 class="mb-4">Halaman Data Transaksi</h3>

    <table class="table table-responsive">
        <thead>
            <tr>
                <th>#</th>
                <th>Pesanan</th> <!-- New Column for Order Summary -->
                <th>Total Harga</th>
                <th>Status</th>
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
                    <td>
                        @if ($transaction->status == 'paid')
                            <span class="badge bg-danger">Menunggu Pengiriman</span>
                        @elseif ($transaction->status == 'delivered')
                            <span class="badge bg-warning text-dark">Dalam Pengiriman</span>
                        @elseif ($transaction->status == 'done')
                            <span class="badge bg-success">Barang Diterima</span>
                        @endif
                    </td>
                    <td>{{ $transaction->updated_at }}</td>
                    <td>
                        @if ($transaction->status == 'paid')
                            <span class="text-muted">Menunggu pengiriman...</span>
                        @elseif ($transaction->status == 'delivered')
                            <form action="{{ route('transactions.update', $transaction->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="done">
                                <button type="submit" class="btn btn-success">Sudah Diterima</button>
                            </form>
                        @elseif ($transaction->status == 'done')
                            <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-dark">Detail</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
