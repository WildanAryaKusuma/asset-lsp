<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
        <a href="#" class="navbar-brand">DanMarketPlace</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item me-3"><a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">Home</a></li>
                <li class="nav-item me-3 dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->is('dashboard/user', 'dashboard/operator' ) ? 'active' : '' }}" data-bs-toggle="dropdown">User</a>
                    <ul class="dropdown-menu">
                        <li><a href="/dashboard/user" class="dropdown-item {{ request()->is('dashboard/user') ? 'active' : '' }}">Pembeli</a></li>
                        <li><a href="/dashboard/operator" class="dropdown-item  {{ request()->is('dashboard/operator') ? 'active' : '' }}">Operator</a></li>
                    </ul>
                </li>
                <li class="nav-item me-3"><a href="/dashboard/pembeli" class="nav-link {{ request()->is('dashboard/pembeli') ? 'active' : '' }}">Pembeli</a></li>
                <li class="nav-item me-3 dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->is('dashboard/products', 'dashboard/products-in', 'dashboard/products-out') ? 'active' : '' }}" data-bs-toggle="dropdown">Product</a>
                    <ul class="dropdown-menu">
                        <li><a href="/dashboard/products" class="dropdown-item {{ request()->is('dashboard/products') ? 'active' : '' }}">Semua Produk</a></li>
                        <li><a href="/dashboard/products-in" class="dropdown-item {{ request()->is('dashboard/products-in') ? 'active' : '' }}">Produk Masuk</a></li>
                        <li><a href="/dashboard/products-out" class="dropdown-item {{ request()->is('dashboard/products-out') ? 'active' : '' }}">Produk Keluar</a></li>
                    </ul>
                </li>
                <li class="nav-item me-3 dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->is('dashboard/pemasukan-day', 'dashboard/pemasukan-month', '/dashboard/pemasukan-all') ? 'active' : '' }}" data-bs-toggle="dropdown">Pemasukan</a>
                    <ul class="dropdown-menu">
                        <li><a href="/dashboard/pemasukan-day" class="dropdown-item {{ request()->is('dashboard/pemasukan-day') ? 'active' : '' }}">Harian</a></li>
                        <li><a href="/dashboard/pemasukan-month" class="dropdown-item {{ request()->is('dashboard/pemasukan-month') ? 'active' : '' }}">Bulanan</a></li>
                        <li><a href="/dashboard/pemasukan-all" class="dropdown-item {{ request()->is('dashboard/pemasukan-all') ? 'active' : '' }}" >Keseluruhan</a></li>
                    </ul>
                </li>
                <li class="nav-item me-3 dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->is('dashboard/pengeluaran-month', 'dashboard/pengeluaran-all') ? 'active' : '' }}" data-bs-toggle="dropdown">Pengeluaran</a>
                    <ul class="dropdown-menu">
                        <li><a href="/dashboard/pengeluaran-month" class="dropdown-item {{ request()->is('dashboard/pengeluaran-month') ? 'active' : '' }}">Bulanan</a></li>
                        <li><a href="/dashboard/pengeluaran-all" class="dropdown-item {{ request()->is('dashboard/pengeluaran-all') ? 'active' : '' }}">Keseluruhan</a></li>
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