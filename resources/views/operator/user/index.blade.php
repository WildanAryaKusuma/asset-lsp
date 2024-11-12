@extends('layouts.operator')

@section('container')
    <h3 class="mb-4">Halaman Data Pembeli</h3>

    <a href="{{ route('pembeli.create') }}" class="btn btn-dark my-3">Tambah Pembeli</a>
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Pembeli</th>
                <th>Email</th>
                <th>Akun Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
