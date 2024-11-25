@extends('layouts.home')

@section('container')
<div class="min-vh-100">
    <!-- Hero Section -->
    <div class="hero-section position-relative overflow-hidden bg-gradient-dark py-5">
        <div class="container py-5">
            <div class="text-center py-5">
                <h1 class="display-4 fw-bold text-white mb-3">
                    Temukan Makanan Terbaik<br>di Sekitarmu
                </h1>
                <p class="lead text-light mb-4 mx-auto" style="max-width: 600px;">
                    Marketplace makanan terlengkap dengan ribuan pilihan menu dari berbagai penjual terpercaya
                </p>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container py-5">
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="p-4 rounded-3 feature-card text-center">
                    <div class="mb-3">
                        🍽️
                    </div>
                    <h3 class="h5 fw-semibold">Beragam Pilihan</h3>
                    <p class="text-muted small">Ribuan menu makanan dari berbagai kategori</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded-3 feature-card text-center">
                    <div class="mb-3">
                        🚚
                    </div>
                    <h3 class="h5 fw-semibold">Pengiriman Cepat</h3>
                    <p class="text-muted small">Layanan pengiriman super cepat ke lokasi Anda</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded-3 feature-card text-center">
                    <div class="mb-3">
                        ⭐
                    </div>
                    <h3 class="h5 fw-semibold">Penjual Terverifikasi</h3>
                    <p class="text-muted small">Semua penjual telah melalui verifikasi</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="container py-5">
        <div class="text-center py-4">
            <h2 class="h3 fw-semibold mb-3">Siap Memesan?</h2>
            <p class="text-muted mb-4">Temukan makanan favoritmu sekarang</p>
            <a href="/products" class="btn btn-warning px-5 py-2">
                Lihat Menu
            </a>
        </div>
    </div>
</div>

<style>
.bg-gradient-dark {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
}

.feature-card {
    background-color: #f8f9fa;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.feature-card div {
    font-size: 2rem;
}

.btn-warning {
    background-color: #ffc107;
    border: none;
    font-weight: 500;
}

.btn-warning:hover {
    background-color: #ffb300;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255,193,7,0.3);
}
</style>
@endsection