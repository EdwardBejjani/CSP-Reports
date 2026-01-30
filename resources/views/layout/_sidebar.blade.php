@auth
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header mt-2 d-flex justify-content-between align-items-center">
            <h5 class="offcanvas-title text-white ps-2 fw-bold" id="offcanvasExampleLabel">Menu</h5>
            <button type="button" class="text-reset btn-glass-light btn-x" data-bs-dismiss="offcanvas" aria-label="Close"><i
                    class="fa-solid fa-xmark" style="color: #ffffff;"></i></button>
        </div>
        <div class="offcanvas-body">
            <nav class="nav flex-column gap-3">
                <a href="{{ route('dashboard.index') }}"
                    class="d-flex justify-content-between align-items-center btn-glass-light fw-bold text-decoration-none">HOME
                    <i class="fa fa-home"></i></a>
                <a href="{{ route('dashboard.new_users_date') }}"
                    class="d-flex justify-content-between align-items-center btn-glass-light fw-bold text-decoration-none">NEW
                    USERS <i class="fa fa-user-plus me-1"></i></a>
                <a href="{{ route('dashboard.inactive_users_date') }}"
                    class="d-flex justify-content-between align-items-center btn-glass-light fw-bold text-decoration-none">DEACTIVATED
                    USERS <i class="fa fa-user-minus me-1"></i></a>
                <a href="{{ route('dashboard.payments_date') }}"
                    class="d-flex justify-content-between align-items-center btn-glass-light fw-bold text-decoration-none">PAYMENTS
                    <i class="fa fa-coins me-1"></i> </a>
                <a href="{{ route('dashboard.transactions_form') }}"
                    class="d-flex justify-content-between align-items-center btn-glass-light fw-bold text-decoration-none">
                    TRANSACTIONS
                    <i class="fa fa-money-bill-wave me-1"></i>
                </a>
                <a href="{{ route('dashboard.support') }}"
                    class="d-flex justify-content-between align-items-center btn-glass-light fw-bold text-decoration-none">SUPPORT
                    <i class="fa fa-phone me-1"></i> </a>
                <form action="{{ route('auth.logout') }}" method="POST"
                    class="d-flex justify-content-between align-items-center">
                    @csrf
                    <button type="submit"
                        class="w-100 btn-glass-light fw-bold text-white text-shadow d-flex justify-content-between align-items-center">
                        LOGOUT <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </nav>
        </div>
    </div>
@endauth
