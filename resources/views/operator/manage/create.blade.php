@extends('layouts.operator')

@section('container')
    <h3 class="mb-5">Halaman Tambah Operator</h3>

    <form action="{{ route('list.store') }}" method="post">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-md-12">
                <label for="name" class="form-label">Nama Operator</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <label for="role" class="form-label">Role</label>
                <input type="text" name="role" id="role" class="form-control" value="operator" readonly>
            </div>
        </div>

        <button class="btn btn-primary mt-4" type="submit">Submit</button>
    </form>
@endsection
