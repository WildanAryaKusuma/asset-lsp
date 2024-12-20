@extends('layouts.dashboard')

@section('container')
    <h3 class="mb-5">Halaman Edit Operator</h3>

    <form action="{{ route('operator.update', $user->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <label for="name" class="form-label">Nama Operator</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
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
                <input type="text" name="role" id="role" class="form-control" value="{{ $user->role }}" readonly>
            </div>
        </div>

        <button class="btn btn-dark mt-4" type="submit">Submit</button>
    </form>
@endsection
