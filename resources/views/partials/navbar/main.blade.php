<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
        <a href="#" class="navbar-brand">DanMarketPlace</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item me-3"><a href="/"
                        class="nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                <li class="nav-item me-3"><a href="/products"
                        class="nav-link {{ request()->is('products') ? 'active' : '' }}">Products</a></li>
                <li class="nav-item me-3"><a href="/carts"
                        class="nav-link {{ request()->is('carts') ? 'active' : '' }}">Cart</a></li>
                <li class="nav-item me-3"><a href="/transactions"
                        class="nav-link {{ request()->is('transactions') ? 'active' : '' }}">Transaksi</a></li>
                @auth
                    <li class="nav-item me-3 dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Welcome,
                            {{ auth()->user()->name }}</a>
                        <ul class="dropdown-menu">
                            <li><a href="/" class="dropdown-item">Dashboard</a></li>
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
