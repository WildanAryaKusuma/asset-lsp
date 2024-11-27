@extends('layouts.dashboard')

@section('container')
    <h3 class="mb-4">Halaman Data Pesanan</h3>

    <table class="table table-responsive">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Total Harga</th>
                <th>Status Pembayaran</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td>
                        @if ($order->status == 'paid')
                            <span class="badge bg-danger">{{ ucfirst($order->status) }}</span>
                        @elseif ($order->status == 'delivered')
                            <span class="badge bg-warning text-dark">{{ ucfirst($order->status) }}</span>
                        @elseif ($order->status == 'done')
                            <span class="badge bg-success">{{ ucfirst($order->status) }}</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-center text-center">
                            @if ($order->status == 'paid') <!-- Tampilkan aksi jika status 'paid' -->
                                <a href="{{ route('orders.edit', $order->id) }}"
                                    class="btn btn-link text-decoration-none">Ubah Status</a>
                            @else
                                <span class="text-muted">Tidak ada aksi</span>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="my-5">
        {{ $orders->links() }}
    </div>
@endsection
