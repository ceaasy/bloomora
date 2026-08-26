@extends('layouts.guest')

@section('title', 'Login - Bloomora')

@section('content')
    <div class="guest-card card-pink mx-auto">

        <form method="POST" action="{{ route('customer.login') }}">
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

            <button type="submit" class="btn btn-bloomora-pink text-white w-100">Login</button>
        </form>

        <p class="guest-footer-link text-center mt-3 mb-0">
            Belum Punya Akun? <a href="{{ route('customer.register') }}" class="link-pink text-decoration-none">Daftar
                Sini</a>
        </p>
    </div>
@endsection
