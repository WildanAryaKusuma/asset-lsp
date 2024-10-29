@extends('layouts.admin')

@section('container')
    <h3 >Halaman Data Pembeli</h3>
    <small class="mb-4">List pembeli yang sudah belanja di DanMarketPlace</small>

    <table class="table table-responsive mt-5">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Pembeli</th>
                <th>Email</th>
                <th>Beli di Tanggal</th>
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
