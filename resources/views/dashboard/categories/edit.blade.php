@extends('layouts.dashboard')

@section('container')
    <h3 class="mb-5">Halaman Edit Kategori</h3>

    <form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nama Kategori</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}">
        </div>

        <button type="submit" class="btn btn-dark mt-3 mb-5">Simpan</button>
    </form>
@endsection
