@extends('layouts.guest')

@section('title', 'Login - Bloomora')
@section('page_title', 'LOGIN')

@section('content')

    <div class="text-center mb-4">
        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3"
            style="width: 64px; height: 64px; background-color: #FBE3EC;">
            <span class="fa fa-user-circle-o" style="color: #D6336C; font-size: 1.5rem;"></span>
        </div>
        <h4 class="fw-bold mb-1" style="color: #D6336C; font-family: 'Playfair Display', serif;">
            Selamat Datang Kembali
        </h4>
        <p class="text-muted mb-0" style="font-size: 0.9rem;">
            Masuk untuk melanjutkan belanja produk favoritmu
        </p>
    </div>

    <div class="guest-card card-pink mx-auto position-relative overflow-hidden">

        <div class="position-absolute rounded-circle"
            style="width: 120px; height: 120px; background: #ffffff55; top: -50px; right: -40px;"></div>

        <form method="POST" action="{{ route('customer.login') }}" class="position-relative">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password"
                    class="form-control @error('password') is-invalid @enderror">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" id="remember" name="remember" class="form-check-input">
                <label for="remember" class="form-check-label">Remember Me</label>
            </div>

            <button type="submit" class="btn btn-bloomora-pink text-white w-100">Login</button>
        </form>

        <p class="guest-footer-link text-center mt-3 mb-0 position-relative">
            Belum Punya Akun? <a href="{{ route('customer.register') }}" class="link-pink text-decoration-none">Daftar
                Sini</a>
        </p>
    </div>
@endsection
