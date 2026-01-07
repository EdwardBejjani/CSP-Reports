<nav class="row row-cols-3 custom-navbar fixed-top">
    <div class="d-flex align-items-center justify-content-start gap-3">
        <a href="{{ route('dashboard.home') }}" class="flex items-center ">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" style="height: 40px">
        </a>
        <a href="{{ route('dashboard.home') }}" class="text-white text-shadow fw-bold fs-2 ps-2">CSP Reports</a>
    </div>
    <div class="d-flex align-items-center justify-content-center gap-3">
        @auth
        <a href="{{ route('dashboard.new_users_date') }}" class="btn-glass fw-bold text-white text-shadow"><i class="fa fa-user-plus"></i></a>
        <a href="{{ route('dashboard.inactive_users_date') }}" class="btn-glass fw-bold text-white text-shadow"><i class="fa fa-user-minus"></i></a>
        <a href="{{ route('dashboard.payments_date') }}" class="btn-glass fw-bold text-white text-shadow"><i class="fa fa-coins"></i></a>
        @endauth
    </div>
    <div class="d-flex align-items-center justify-content-end gap-3">
        @auth
            <a href="{{ route('dashboard.index') }}" class=" btn-glass fw-bold text-white text-shadow">
                <i class="fas fa-home"></i>
            </a>
            <form action="{{ route('auth.logout') }}" method="POST">
                @csrf
                <button type="submit" class=" btn-glass fw-bold text-white text-shadow">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        @endauth
        @guest
            <a href="{{ route('auth.login') }}" class=" btn-glass fw-bold text-white text-shadow">Login</a>
        @endguest
    </div>
</nav>
