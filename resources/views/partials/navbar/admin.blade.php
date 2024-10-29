<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
    <div class="container">
        <a href="#" class="navbar-brand">DanMarketPlace</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item me-3"><a href="/admin" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">Home</a></li>
                <li class="nav-item me-3 dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->is('admin/user', 'admin/operator' ) ? 'active' : '' }}" data-bs-toggle="dropdown">User</a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/user" class="dropdown-item {{ request()->is('admin/user') ? 'active' : '' }}">Pembeli</a></li>
                        <li><a href="/admin/operator" class="dropdown-item  {{ request()->is('admin/operator') ? 'active' : '' }}">Operator</a></li>
                    </ul>
                </li>
                <li class="nav-item me-3"><a href="/admin/pembeli" class="nav-link {{ request()->is('admin/pembeli') ? 'active' : '' }}">Pembeli</a></li>
                <li class="nav-item me-3 dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->is('admin/product-all', 'admin/product-in', 'admin/product-out') ? 'active' : '' }}" data-bs-toggle="dropdown">Product</a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/product-all" class="dropdown-item {{ request()->is('admin/product-all') ? 'active' : '' }}">Semua Produk</a></li>
                        <li><a href="/admin/product-in" class="dropdown-item {{ request()->is('admin/product-in') ? 'active' : '' }}">Produk Masuk</a></li>
                        <li><a href="/admin/product-out" class="dropdown-item {{ request()->is('admin/product-out') ? 'active' : '' }}">Produk Keluar</a></li>
                    </ul>
                </li>
                <li class="nav-item me-3 dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->is('admin/pemasukan-day', 'admin/pemasukan-month', '/admin/pemasukan-all') ? 'active' : '' }}" data-bs-toggle="dropdown">Pemasukan</a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/pemasukan-day" class="dropdown-item {{ request()->is('admin/pemasukan-day') ? 'active' : '' }}">Harian</a></li>
                        <li><a href="/admin/pemasukan-month" class="dropdown-item {{ request()->is('admin/pemasukan-month') ? 'active' : '' }}">Bulanan</a></li>
                        <li><a href="/admin/pemasukan-all" class="dropdown-item {{ request()->is('admin/pemasukan-all') ? 'active' : '' }}" >Keseluruhan</a></li>
                    </ul>
                </li>
                <li class="nav-item me-3 dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->is('admin/pengeluaran-month', 'admin/pengeluaran-all') ? 'active' : '' }}" data-bs-toggle="dropdown">Pengeluaran</a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/pengeluaran-month" class="dropdown-item {{ request()->is('admin/pengeluaran-month') ? 'active' : '' }}">Bulanan</a></li>
                        <li><a href="/admin/pengeluaran-all" class="dropdown-item {{ request()->is('admin/pengeluaran-all') ? 'active' : '' }}">Keseluruhan</a></li>
                    </ul>
                </li>
                @auth
                    <li class="nav-item me-3 dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Welcome,
                            {{ auth()->user()->name }}</a>
                        <ul class="dropdown-menu">
                            <li><a href="/admin" class="dropdown-item">Dashboard</a></li>
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