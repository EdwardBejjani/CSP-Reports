@extends('app')
@section('title', 'Dashboard')

@section('content')
    <div class="vh-100-custom mt-15">
        @if (Route::is('dashboard.index'))
            <div class="d-flex justify-content-center">
                <h5 class="text-center text-white fw-bold text-shadow">Welcome to the reports dashboard! <br> Choose an operation from the selection above to start</h5>
            </div>
        @endif
        @if (Route::is('dashboard.new_users_date'))
            <div class="d-flex justify-content-center">
                <form action="{{ route('dashboard.new_users') }}" method="get" class="d-flex gap-2">
                    <input type="number" name="year" placeholder="YYYY" min="2000" max="{{ date('Y') }}"
                        value="{{ request('year', date('Y')) }}" class="form-control input">
                    <input type="number" name="month" placeholder="MM" min="1" max="12"
                        value="{{ request('month', date('m')) }}" class="form-control input">
                    <button type="submit" class="btn-glass">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        @endif
        @if (Route::is('dashboard.inactive_users_date'))
            <div class="d-flex justify-content-center">
                <form action="{{ route('dashboard.inactive_users') }}" method="get" class="d-flex gap-2">
                    <input type="number" name="year" placeholder="YYYY" min="2000" max="{{ date('Y') }}"
                        value="{{ request('year', date('Y')) }}" class="form-control input">
                    <input type="number" name="month" placeholder="MM" min="1" max="12"
                        value="{{ request('month', date('m')) }}" class="form-control input">
                    <button type="submit" class="btn-glass">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        @endif
        @if (Route::is('dashboard.payments_date'))
            <div class="d-flex justify-content-center">
                <form action="{{ route('dashboard.payments') }}" method="get" class="d-flex gap-2">
                    <select name="collector" id="collector">
                        <option value="" selected>Select a collector</option>
                        @if ($user->username == 'ramy.b')
                        <option value="marwan02">Marwan</option>
                        <option value="basel">Bassel</option>
                        @elseif ($user->name == 'georges.f')
                        <option value="">No Collectors available</option>
                        @endif
                    </select>
                    <input type="number" name="year" placeholder="YYYY" min="2015" max="{{ date('Y') }}"
                        value="{{ request('year', date('Y')) }}" class="form-control input">
                    <input type="number" name="month" placeholder="MM" min="1" max="12"
                        value="{{ request('month', date('m')) }}" class="form-control input">
                    <button type="submit" class="btn-glass">
                        <i class="fas fa-search"></i>
                    </button>
            </div>
        @endif
    </div>
@endsection
