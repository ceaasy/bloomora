@extends('layouts.guest')

@section('title', 'Registrasi - Bloomora')
@section('page_title', 'Registrasi')

@section('content')

    <div class="text-center mb-4">
        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3"
            style="width: 64px; height: 64px; background-color: #FBE3EC;">
            <span class="fa fa-user-plus" style="color: #D6336C; font-size: 1.5rem;"></span>
        </div>
        <h4 class="fw-bold mb-1" style="color: #D6336C; font-family: 'Playfair Display', serif;">
            Yuk, Gabung di Bloomora!
        </h4>
        <p class="text-muted mb-0" style="font-size: 0.9rem;">
            Buat akun untuk mulai memesan buket dan hampers favoritmu
        </p>
    </div>

    <div class="guest-card card-pink mx-auto position-relative overflow-hidden">

        <div class="position-absolute rounded-circle"
            style="width: 120px; height: 120px; background: #ffffff55; top: -50px; right: -40px;"></div>

        <form method="POST" action="{{ route('customer.register') }}" class="position-relative">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                    class="form-control @error('phone') is-invalid @enderror">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" id="address" name="address" value="{{ old('address') }}"
                    class="form-control @error('address') is-invalid @enderror">
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password"
                    class="form-control @error('password') is-invalid @enderror">
                <div class="form-text">Minimal 8 karakter</div>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Password Confirmation</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
            </div>

            <button type="submit" class="btn btn-bloomora-pink text-white w-100">Daftar</button>
        </form>

        <p class="guest-footer-link text-center mt-3 mb-0 position-relative">
            Sudah Punya Akun? <a href="{{ route('customer.login') }}" class="link-pink text-decoration-none">Login</a>
        </p>
    </div>
@endsection
