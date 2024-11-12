@extends('layouts.auth')

@section('container')
    <div class="row justify-content-center" style="margin-top: 13rem;">
        <div class="col-md-4">
            <main class="form-signin text-center">
                <h3>Please Login</h3>
                <form action="{{ route('auth.authenticate') }}" method="post">
                    @csrf
                    @method('POST')
                    <input type="email" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" style="height: 3.5rem;">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <input type="password" name="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" style="height: 3.5rem;">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <button class="btn btn-dark w-100 mt-3" type="submit">Submit</button>
                </form> 
            </main>
            <small class="d-block text-center mt-3">Not Registered? <a href="/register">Register Now!</a></small>
        </div>
    </div>
@endsection