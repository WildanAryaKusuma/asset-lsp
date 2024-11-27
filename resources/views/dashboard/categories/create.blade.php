@extends('layouts.dashboard')

@section('container')
    <h3 class="mb-5">Halaman Tambah Kategori</h3>

    <form action="{{ route('categories.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Kategori</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>

        <button type="submit" class="btn btn-dark mt-4">Tambah Kategori</button>
    </form>
@endsection
