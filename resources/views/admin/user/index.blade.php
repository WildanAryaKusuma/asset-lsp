@extends('layouts.admin')

@section('container')
    <h3 class="mb-4">Halaman Data Pembeli</h3>

    <a href="{{ route('user.create') }}" class="btn btn-dark my-3">Tambah Pembeli</a>
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Pembeli</th>
                <th>Email</th>
                <th>Akun Dibuat</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d-m-Y') }}</td>
                    <td>
                        <div class="d-flex justify-content-center text-center">
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-link text-decoration-none">Edit</a>
                            <form action="{{ route('user.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link text-decoration-none text-danger" onclick="return window.confirm('Apakah kamu yakin?')">Delete</button>
                            </form>
                        </div>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
