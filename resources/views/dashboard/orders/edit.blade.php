@extends('layouts.dashboard')

@section('container')
    <h3 class="mb-5">Halaman Ubah Status Pesanan</h3>

    <form action="{{ route('orders.update', $order->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="status" class="form-label">Status Pesanan</label>
            <select name="status" id="status" class="form-select">
                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
            </select>
        </div>

        <button type="submit" class="btn btn-dark mt-3 mb-5">Simpan</button>
    </form>
@endsection
