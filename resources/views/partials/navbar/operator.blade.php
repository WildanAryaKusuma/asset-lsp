<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
        <a href="#" class="navbar-brand">DanMarketPlace</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item me-3"><a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">Home</a></li>
                <li class="nav-item me-3 dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">User</a>
                    <ul class="dropdown-menu">
                        <li><a href="/dashboard/pembeli" class="dropdown-item">Pembeli</a></li>
                        <li><a href="/dashboard/operator" class="dropdown-item">Operator</a></li>
                    </ul>
                </li>
                <li class="nav-item me-3"><a href="/dashboard/pembeli" class="nav-link {{ request()->is('admin/pembeli') ? 'active' : '' }}">Pembeli</a></li>
                <li class="nav-item me-3 dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Product</a>
                    <ul class="dropdown-menu">
                        <li><a href="/dashboard/products" class="dropdown-item">Semua Produk</a></li>
                        <li><a href="/dashboard/products-in" class="dropdown-item">Produk Masuk</a></li>
                        <li><a href="/dashboard/products-out" class="dropdown-item">Produk Keluar</a></li>
                    </ul>
                </li>
                <li class="nav-item me-3 dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pemasukan</a>
                    <ul class="dropdown-menu">
                        <li><a href="/dashboard/pemasukan-day" class="dropdown-item">Harian</a></li>
                        <li><a href="/dashboard/pemasukan-month" class="dropdown-item">Bulanan</a></li>
                        <li><a href="/dashboard/pemasukan-all" class="dropdown-item">Keseluruhan</a></li>
                    </ul>
                </li>
                @auth
                    <li class="nav-item me-3 dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Welcome,
                            {{ auth()->user()->name }}</a>
                        <ul class="dropdown-menu">
                            <li><a href="/dashboard" class="dropdown-item">Dashboard</a></li>
                            <li>
                                <form action="{{ route('auth.logout') }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <button class="dropdown-item" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item me-3">
                        <a href="/login" class="nav-link {{ request()->is('login') ? 'active' : '' }}">Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>