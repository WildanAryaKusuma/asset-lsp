@extends('layouts.dashboard')

@section('container')
    <h3>Halaman Beranda Admin</h3>
    <h6>Selamat Datang, {{ auth()->user()->name }} !</h6>
@endsection
