@extends('layouts.main')

@section('container')
    <h3 class="mb-4" id="title-page">Halaman Detail Data Transaksi</h3>

    <div class="container mt-5">
        <div class="card" id="receipt">
            <div class="card-body">
                <h4>DanMarketPlace Receipt</h4>
                <p class="mt-4">Date : {{ $transaction->updated_at }}</p>
                <p>Transaction Id : {{ $transaction->id }}</p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction->carts as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>Rp. {{ number_format($item->product->price, 0, ',', '.') }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rp. {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p class="fs-5 fw-bold">Total : <span class="text-success">Rp.
                        {{ number_format($transaction->total_price, 0, ',', '.') }} </span></p>
            </div>
        </div>
    </div>


    <button onclick="print()" class="btn btn-primary mt-5" id="print-button">Cetak</button>

    <script>
        function script() {
            windows.print
        }
    </script>

    <style>
        @media print {

            #print-button,
            #title-page {
                display: none;
            }
        }
    </style>
@endsection
