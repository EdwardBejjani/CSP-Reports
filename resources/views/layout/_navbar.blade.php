<nav class="d-flex justify-content-between align-items-center px-3 py-2 text-white custom-navbar fixed-top">
    <a class="d-flex align-items-center gap-3 ms-3 text-decoration-none" href="{{ route('dashboard.index') }}">
        <img src="{{ asset('assets/images/logo.png') }}" alt="CloudSP" class="navbar-logo" style="height: 50px;">
        <h2 class="m-0 fw-bold text-shadow text-white">CSP REPORTS</h2>
    </a>
    <div class="d-flex align-items-center justify-content-end">
        @auth
            <button class="btn btn-glass-light btn-pad fw-bold me-1" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <i class="fa fa-bars text-white"></i>
            </button>
        @endauth
        @guest
            <a href="{{ route('auth.login') }}" class=" btn-glass fw-bold text-white text-shadow">Login</a>
        @endguest
    </div>
</nav>
