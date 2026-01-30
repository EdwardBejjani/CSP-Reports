@extends('app')

@section('title', 'Dashboard')

@section('content')
    <div class="vh-100-custom mt-15">
        @if (Route::is('dashboard.index'))
                <div class="d-flex justify-content-center">
                    <h5 class="text-center text-white fw-bold text-shadow">
                        Welcome to the reports dashboard!
                        <br>
                        Choose an operation from the selection above to start
                    </h5>
                </div>
                <h2 class="text-white text-shadow text-center mt-5 fw-bold">
                    This Month's Analytics
                </h2>
                <div class="row row-cols-3 mt-3 mx-3">
                    <div class="col">
                        <div class="card-glass-dark p-4 d-flex flex-column align-items-center justify-content-center"
                            style="height: 40vh;">
                            <h3 class="text-white text-shadow text-center fw-bold">
                                <i class="fa fa-user-plus fa-2x mb-2"></i>
                                <br>
                                New Users
                            </h3>
                            <h1 class="text-white text-shadow text-center fw-bold" style="font-size: 72pt;">
                                {{ count($new_users) }}
                            </h1>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card-glass-dark p-4 d-flex flex-column align-items-center justify-content-center"
                            style="height: 40vh;">
                            <h3 class="text-white text-shadow text-center fw-bold"><i
                                    class="fa fa-user-minus fa-2x mb-2"></i><br>Deactivated Users</h3>
                            <h1 class="text-white text-shadow text-center fw-bold" style="font-size: 72pt;">
                                {{ count($inactive_users) }}
                            </h1>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card-glass-dark p-4 d-flex flex-column align-items-center justify-content-center"
                            style="height: 40vh;">
                            <h3 class="text-white text-shadow text-center fw-bold"><i
                                    class="fa fa-coins fa-2x mb-2"></i><br>Payments Collected</h3>
                            <h1 class="text-white text-shadow text-center fw-bold" style="font-size: 60pt;">
                                {{ $payments['payments_collected'] }} / {{ $payments['total_users'] }}
                            </h1>
                            <h4 class="text-white text-shadow text-center">
                                {{ $payments['payments_left'] }} left
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @if (Route::is('dashboard.new_users_date'))
        <div class="d-flex justify-content-center">
            <form action="{{ route('dashboard.new_users') }}" method="get" class="d-flex gap-2">
                <input type="number" name="year" placeholder="YYYY" min="2000" max="{{ date('Y') }}"
                    value="{{ request('year', date('Y')) }}" class="form-control input">
                <input type="number" name="month" placeholder="MM" min="1" max="12" value="{{ request('month', date('m')) }}"
                    class="form-control input">
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
                <input type="number" name="month" placeholder="MM" min="1" max="12" value="{{ request('month', date('m')) }}"
                    class="form-control input">
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
                    @if ($user->username == 'ramy.b' || $user->username == 'pascale.b')
                        <option value="marwan02">Marwan</option>
                        <option value="basel">Bassel</option>
                        <option value="office">Office</option>
                    @elseif ($user->name == 'georges.f')
                        <option value="">No Collectors available</option>
                    @endif
                </select>
                <input type="number" name="year" placeholder="YYYY" min="2015" max="{{ date('Y') }}"
                    value="{{ request('year', date('Y')) }}" class="form-control input">
                <input type="number" name="month" placeholder="MM" min="1" max="12" value="{{ request('month', date('m')) }}"
                    class="form-control input">
                <button type="submit" class="btn-glass">
                    <i class="fas fa-search"></i>
                </button>
        </div>
    @endif
    </div>
@endsection
