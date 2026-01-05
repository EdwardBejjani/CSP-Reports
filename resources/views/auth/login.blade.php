@extends('app')

@section('title', 'Login')

@section('content')

    <section class="d-flex align-items-center justify-content-center vh-100-custom">
        <div class="col-10 col-md-8 col-lg-6 col-xl-4">
            <div class="card-glass p-5">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="CSP Logo" class="mb-4" style="width: 20%;">
                    </div>
                    <h1 class="fw-bold text-white text-center mb-3 text-shadow mb-4">Login</h1>
                    <form method="POST" action="{{ route('auth.loginSubmit') }}" class="d-flex flex-column align-items-center">
                        @csrf
                        <div class="mb-3 w-100">
                            <input type="username" class="form-control input" id="username" name="username"
                                placeholder="Username" required autofocus>
                            @error('username')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 w-100">
                            <input type="password" class="form-control input" id="password" name="password"
                                placeholder="Password" required>
                            @error('password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn-glass fs-6 fw-bold text-white px-4 py-2">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection