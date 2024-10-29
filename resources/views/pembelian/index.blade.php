@extends('layouts.main')

@section('container')
    <h3 class="mb-4">Halaman Data Pembelian</h3>

    <table class="table table-responsive">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Product</th>
                <th>Harga Produk</th>
                <th>Kuantitas</th>
                <th>Total Harga</th>
                <th class="text-center">Aksi</th>
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
                    <td>
                        <div class="d-flex justify-content-center text-center">
                            <form action="{{ route('pembelian.transaksi', $transaction->id) }}" method="post">
                                @csrf
                                @method('POST')
                                <button class="btn btn-link text-decoration-none text-success" onclick="return window.confirm('Apakah kamu yakin transaksi?')">Transaksi</button>
                            </form>
                            <a href="{{ route('pembelian.edit', $transaction->id) }}" class="btn btn-link text-decoration-none">Edit</a>
                            <form action="{{ route('pembelian.destroy', $transaction->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link text-decoration-none text-danger" onclick="return window.confirm('Apakah kamu yakin hapus?')">Delete</button>
                            </form>
                        </div>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
