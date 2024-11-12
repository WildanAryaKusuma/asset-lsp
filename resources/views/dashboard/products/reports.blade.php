@extends('layouts.dashboard')

@section('container')
    <h3 class="mb-4">Halaman {{ $title }}</h3>

    <table class="table table-responsive">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Kuantitas</th>
                <th>Subtotal</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $report->product->name }}</td>
                    <td>{{ $report->product->price }}</td>
                    <td>{{ $report->quantity }}</td>
                    <td>{{ $report->subtotal }}</td>
                    <td>{{ $report->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
