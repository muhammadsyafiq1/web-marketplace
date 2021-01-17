<div class="border-right" id="sidebar-wrapper">
    <div class="sidebar-heading text-center">
        <img src="/frontend/images/dashboard-store-logo.svg" alt="logo" class="my-4">
    </div>
    <div class="list-group list-group-flush">
        <a href="{{ route('user.dashboard') }}" class="list-group-item list-group-item-action {{ (request()->is('dashboard-user*')) ? 'active' : '' }}">
            Dashboard
        </a>
        <a href="{{ route('products.index') }}" class="list-group-item list-group-item-action {{ (request()->is('products*')) ? 'active' : '' }}">
            My products
        </a>
        <a href="{{ route('transaction.user') }}" class="list-group-item list-group-item-action {{ (request()->is('transactions-user*')) ? 'active' : '' }}">
            Transactions
        </a>
        <a href="{{ route('store.setting') }}" class="list-group-item list-group-item-action {{ (request()->is('store-setting*')) ? 'active' : '' }}">
            Store setting
        </a>
        <a href="{{ route('account') }}" class="list-group-item list-group-item-action {{ (request()->is('account*')) ? 'active' : '' }}">
            My account
        </a>
        <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="list-group-item list-group-item-action">
            Sign out
        </a>
        <form action="{{ url('/logout') }}" id="logout-form" method="POST" style="display: none">
        @csrf
        </form>
    </div>
</div>