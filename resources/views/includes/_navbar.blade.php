@auth
<nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top"
      data-aos="fade-down">
      <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">
          <img src="/frontend/images/logo.svg" alt="logo">
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarResponsive"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="{{ route('home') }}" class="nav-link {{ (request()->is('/')) ? 'active' : '' }} ">Home</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('category.product') }}" class="nav-link {{ (request()->is('categories')) ? 'active' : '' }} ">Categories</a>
            </li>
          </ul>
          <!-- desktop menu -->
          <ul class="navbar-nav d-none d-lg-flex">
            <li class="nav-item dropdown">
                <a
                    href="#"
                    class="nav-link"
                    id="navbarDropdown"
                    role="button"
                    data-toggle="dropdown"
                >

                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" height="40" class="rounded-circle" />
                    Hi, {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu">
                    @if (Auth::user()->roles === 'admin')
                      <a href="{{ route('admin.dashboard') }}" class="dropdown-item">Dashboard</a>
                    @else
                      <a href="{{ route('user.dashboard') }}" class="dropdown-item">Dashboard User</a>
                    @endif
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
        <!-- mobile menu -->
        <ul class="navbar-nav d-block d-lg-none">
            <li class="nav-item">
                <a href="#" class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
                    Hi, {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu">
                  <a href="dashboard-account.html" class="dropdown-item">Setting</a>
                  @if (Auth::user()->roles === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item">Dashboard</a>
                  @else
                    <a href="{{ route('user.dashboard') }}" class="dropdown-item">Dashboard User</a>
                  @endif
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
@else
<nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top"data-aos="fade-down">
  <div class="container">
    <a href="{{ route('home') }}" class="navbar-brand">
      <img src="/frontend/images/logo.svg" alt="logo">
    </a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarResponsive">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link {{ (request()->is('/')) ? 'active' : '' }} " class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('category.product') }}" class="nav-link {{ (request()->is('categories')) ? 'active' : '' }}" class="nav-link">Categories</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Rewards</a>
          </li>
            <li class="nav-item">
              <a href="{{ route('login') }}" class="nav-link">Sign In</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('register') }}" class="btn btn-success nav-link px-4 text-white">Sign Up</a>
            </li>
        </ul>
      </div>
  </div>
</nav>
@endauth



