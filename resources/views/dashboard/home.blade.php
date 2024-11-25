@extends('layouts.dashboardhome')

@section('container')
<div class="container-fluid py-4 px-5">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-dark bg-gradient text-white">
                <div class="card-body p-4">
                    <h4 class="fw-light mb-1">Selamat Datang,</h4>
                    <h3 class="fw-bold">
                        {{ auth()->user()->name }} 
                        <span class="badge bg-white text-dark ms-2 mt-2">
                            {{ auth()->user()->role != 'operator' ? 'Admin' : 'Operator' }}
                        </span>
                    </h3>
                    <p class="mb-0 opacity-75">{{ \Carbon\Carbon::now()->format('l, d F Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Aksi Cepat</h5>
                    <div class="row g-3">
                        <div class="col-sm-6 col-md-3">
                            <a href="/dashboard/products/create" class="text-decoration-none">
                                <div class="d-flex align-items-center p-3 bg-light rounded">
                                    <i class="bi bi-plus-circle fs-4 text-primary me-3"></i>
                                    <div>
                                        <h6 class="mb-0 text-dark">Tambah Produk</h6>
                                        <small class="text-muted">Tambah produk baru</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <a href="/dashboard/products" class="text-decoration-none">
                                <div class="d-flex align-items-center p-3 bg-light rounded">
                                    <i class="bi bi-box-seam fs-4 text-primary me-3"></i>
                                    <div>
                                        <h6 class="mb-0 text-dark">Kelola Produk</h6>
                                        <small class="text-muted">Lihat semua produk</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <a href="/dashboard/pemasukan-day" class="text-decoration-none">
                                <div class="d-flex align-items-center p-3 bg-light rounded">
                                    <i class="bi bi-graph-up-arrow fs-4 text-primary me-3"></i>
                                    <div>
                                        <h6 class="mb-0 text-dark">Pemasukan</h6>
                                        <small class="text-muted">Laporan pemasukan</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <a href="#" class="text-decoration-none">
                                <div class="d-flex align-items-center p-3 bg-light rounded">
                                    <i class="bi bi-clipboard-data fs-4 text-primary me-3"></i>
                                    <div>
                                        <h6 class="mb-0 text-dark">Laporan Keuangan</h6>
                                        <small class="text-muted">Ringkasan keuangan</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-md-3">
            <div class="card border-0 shadow-sm h-100 px-3">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-cart-check fs-4 text-success me-2"></i>
                        <h6 class="text-muted mb-0">Total Transaksi</h6>
                    </div>
                    <h4 class="mb-0 fw-bold">{{ $totalTransaksi }}</h4>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card border-0 shadow-sm h-100 px-2">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-people fs-4 text-secondary me-2"></i>
                        <h6 class="text-muted mb-0">Total Pembeli</h6>
                    </div>
                    <h4 class="mb-0 fw-bold">{{ $totalPembeli }}</h4>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-box fs-4 text-warning me-2"></i>
                        <h6 class="text-muted mb-0">Total Produk</h6>
                    </div>
                    <h4 class="mb-0 fw-bold">{{ $totalProduk }}</h4>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-currency-dollar fs-4 text-danger me-2"></i>
                        <h6 class="text-muted mb-0">Pendapatan Hari Ini</h6>
                    </div>
                    <h4 class="mb-0 fw-bold">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Section -->
    <div class="row g-3">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-exclamation-triangle text-warning me-2"></i>
                        <h5 class="mb-0">Produk Stok Rendah</h5>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($produkStokRendah->isEmpty())
                        <div class="text-center py-4">
                            <i class="bi bi-check-circle text-success fs-1"></i>
                            <p class="mt-2 mb-0">Tidak ada produk dengan stok rendah</p>
                        </div>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach($produkStokRendah as $produk)
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="bi bi-box-seam me-2 text-muted"></i>
                                            <strong>{{ $produk->name }}</strong>
                                        </div>
                                        <span class="badge bg-warning text-dark">Stok: {{ $produk->stock }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-graph-up text-primary me-2"></i>
                        <h5 class="mb-0">Laporan Keuangan</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="text-muted mb-2">Pemasukan Hari Ini</label>
                        <h5 class="mb-0">Rp {{ number_format($laporanKeuangan['pemasukanHariIni'], 0, ',', '.') }}</h5>
                    </div>
                    <div>
                        <label class="text-muted mb-2">Pemasukan Bulan Ini</label>
                        <h5 class="mb-0">Rp {{ number_format($laporanKeuangan['pemasukanBulanIni'], 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection