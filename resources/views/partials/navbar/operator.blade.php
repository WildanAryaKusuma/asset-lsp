<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
    <div class="container">
        <a href="#" class="navbar-brand">DanMarketPlace</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item me-3"><a href="/operator" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">Home</a></li>
                <li class="nav-item me-3 dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">User</a>
                    <ul class="dropdown-menu">
                        <li><a href="/operator/pembeli" class="dropdown-item">Pembeli</a></li>
                        <li><a href="/operator/list" class="dropdown-item">Operator</a></li>
                    </ul>
                </li>
                <li class="nav-item me-3"><a href="/operator/pembeli" class="nav-link {{ request()->is('admin/pembeli') ? 'active' : '' }}">Pembeli</a></li>
                <li class="nav-item me-3 dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Product</a>
                    <ul class="dropdown-menu">
                        <li><a href="/operator/product-all" class="dropdown-item">Semua Produk</a></li>
                        <li><a href="/operator/product-in" class="dropdown-item">Produk Masuk</a></li>
                        <li><a href="/operator/product-out" class="dropdown-item">Produk Keluar</a></li>
                    </ul>
                </li>
                <li class="nav-item me-3 dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pemasukan</a>
                    <ul class="dropdown-menu">
                        <li><a href="/operator/pemasukan-day" class="dropdown-item">Harian</a></li>
                        <li><a href="/operator/pemasukan-month" class="dropdown-item">Bulanan</a></li>
                        <li><a href="/operator/pemasukan-all" class="dropdown-item">Keseluruhan</a></li>
                    </ul>
                </li>
                @auth
                    <li class="nav-item me-3 dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Welcome,
                            {{ auth()->user()->name }}</a>
                        <ul class="dropdown-menu">
                            <li><a href="/operator" class="dropdown-item">Dashboard</a></li>
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