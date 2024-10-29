@extends('layouts.auth')

@section('container')
    <div class="row justify-content-center" style="margin-top: 13rem;">
        <div class="col-md-4">
            <main class="form-registration text-center">
                <h3>Please Register</h3>
                <form action="{{ route('auth.store') }}" method="post">
                    @csrf
                    @method('POST')
                    <input type="text" name="name" placeholder="Username" class="form-control @error('name') is-invalid @enderror" style="height: 3.5rem;">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <input type="email" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" style="height: 3.5rem;">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <input type="password" name="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" style="height: 3.5rem;">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <input type="hidden" name="role" value="user">
                    <input type="hidden" name="is_buy" value="0">
                    <button class="btn btn-primary w-100 mt-3" type="submit">Submit</button>
                </form> 
            </main>
            <small class="d-block text-center mt-3">Already Registered? <a href="/login">Login</a></small>
        </div>
    </div>
@endsection