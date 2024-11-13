@extends('layouts.dashboard')

@section('container')
    <h3 class="mb-4">Halaman Data {{ $title }}</h3>

    <div class="card text-start bg-dark text-white" style="width: 320px">
        <div class="card-body">
            <h5 class="card-title">Total {{ $title }}</h5>
            <p class="card-text">Rp. {{ number_format($total, 0, ',', '.') }}</p>
        </div>
    </div>

    <table class="table table-responsive mt-4">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Pembeli</th>
                <th>Produk</th>
                <th>Pemasukan</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $transaction->user->name }}</td>
                    <td>
                        <ul class="list-unstyled">
                            @foreach ($transaction->carts as $item)
                                <li>{{ $item->product->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>Rp. {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                    <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="my-5">
        {{ $transactions->links() }}
    </div>
@endsection
