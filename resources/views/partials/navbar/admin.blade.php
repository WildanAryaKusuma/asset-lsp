<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
        <a href="#" class="navbar-brand">DanMarketPlace</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item me-3"><a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">Home</a></li>
                <li class="nav-item me-3"><a href="/dashboard/user" class="nav-link {{ request()->is('dashboard/pembeli') ? 'active' : '' }}">Pembeli</a></li>
                <li class="nav-item me-3 dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->is('dashboard/products', 'dashboard/products-in', 'dashboard/products-out') ? 'active' : '' }}" data-bs-toggle="dropdown">Data Buku</a>
                    <ul class="dropdown-menu">
                        <li><a href="/dashboard/products" class="dropdown-item {{ request()->is('dashboard/products') ? 'active' : '' }}">List Buku</a></li>
                        <li><a href="/dashboard/products" class="dropdown-item {{ request()->is('dashboard/products') ? 'active' : '' }}">Kategori Buku</a></li>
                    </ul>
                </li>
                <li class="nav-item me-3"><a href="#" class="nav-link {{ request()->is('dashboard/pembeli') ? 'active' : '' }}">Pesanan</a></li>
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