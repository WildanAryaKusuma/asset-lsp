@extends('layouts.dashboard')

@section('container')
    <h3>Halaman Beranda
        @if (auth()->user()->role != 'operator')
        Admin
        @else
        Operator
        @endif
    </h3>
@endsection
