@extends('layouts.guest')

@section('title', 'Login - Admin')
@section('page_title', 'Login Admin')

@section('content')
    <div class="text-center mb-4">
        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 login-icon-circle-admin">
            <span class="fa fa-lock"></span>
        </div>
        <h4 class="fw-bold mb-1 login-welcome-title-admin">
            Selamat Datang Admin!!
        </h4>
        <p class="text-muted mb-0" style="font-size: 0.9rem;">
            Masuk untuk mengelola toko Bloomora
        </p>
    </div>
    <div class="guest-card card-maroon mx-auto">

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password"
                    class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" id="remember" name="remember" class="form-check-input">
                <label for="remember" class="form-check-label">Remember Me</label>
            </div>

            <button type="submit" class="btn btn-bloomora-maroon text-white w-100">Login</button>
        </form>
    </div>
@endsection
