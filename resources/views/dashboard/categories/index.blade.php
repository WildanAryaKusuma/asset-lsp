@extends('layouts.dashboard')

@section('container')
    <h3 class="mb-4">Halaman Data Kategori</h3>

    <a href="{{ route('categories.create') }}" class="btn btn-dark my-3">Tambah Kategori</a>

    <table class="table table-responsive">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Kategori</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <div class="d-flex justify-content-center text-center">
                            <a href="{{ route('categories.edit', $category->id) }}"
                                class="btn btn-link text-decoration-none">Edit</a>

                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link text-decoration-none text-danger"
                                    onclick="return confirm('Apakah kamu yakin?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="my-5">
        {{ $categories->links() }}
    </div>
@endsection
