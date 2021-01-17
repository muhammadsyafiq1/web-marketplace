<nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top" data-aos="fade-down">
    <div class="container-fluid">
        <button class="btn btn-secondary d-md-none mr-auto mr-2" id="menu-toggle">
            &laquo; Menu
        </button>
        <button 
            class="navbar-toggler" 
            type="button" 
            data-toggle="collapse" 
            data-target="#navbarSupportedContent"
        >
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- desktop menu -->
        <ul class="navbar-nav d-none d-lg-flex ml-auto">
            <li class="nav-item dropdown">
                <a 
                    href="#" 
                    class="nav-link" 
                    id="navbarDropdown" 
                    role="button" 
                    data-toggle="dropdown"
                >
                <img 
                    src="/frontend/images/icon-user.png" 
                    alt="user" 
                    class="rounded-circle mr-2 profile-picture"
                    />
                    Hi, {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu">
                    <a href="dashboard-account.html" class="dropdown-item">Setting</a>
                    <div class="dropdown-divider"></div>
                    <a href="/" class="dropdown-item">Logout</a>
                </div>
            </li>
            <li class="nav-item">
                @php
                    $carts = \App\Models\Cart::where('user_id', Auth::user()->id)->count();
                @endphp
                @if ($carts > 0)
                    <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
                        <img src="/frontend/images/icon-cart-filled.svg" alt="empty">
                        <div class="card-badge">{{ $carts }}</div>
                    </a>
                @else
                    <a href="#" class="nav-link d-inline-block mt-2 disabled">
                        <img src="/frontend/images/icon-cart-empty.svg" alt="empty">
                    </a>
                @endif
            </li>
        </ul>
        <!-- mobile menu -->
        <ul class="navbar-nav d-block d-lg-none">
            <li class="nav-item">
                <a href="#" class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
                    Hi, {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu">
                    <a href="dashboard-account.html" class="dropdown-item">Setting</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ url('/logout') }}" class="dropdown-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Sign out
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            <li class="nav-item">
                @php
                    $carts = \App\Models\Cart::where('user_id', Auth::user()->id)->count();
                @endphp
                @if ($carts > 0)
                    <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
                        <img src="/frontend/images/icon-cart-filled.svg" alt="empty">
                        <div class="card-badge">{{ $carts }}</div>
                    </a>
                @else
                    <a href="#" class="nav-link d-inline-block mt-2 disabled">
                        <img src="/frontend/images/icon-cart-empty.svg" alt="empty">
                    </a>
                @endif
            </li>
        </ul>
        </div>
    </div>
</nav>