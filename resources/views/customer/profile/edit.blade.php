@extends('layouts.app')

@section('title', 'Ubah Profil - Bloomora')

@section('content')
    <div class="card card-bloomora">
        <div class="card-body p-4">
            <h5 class="card-title mb-4" style="color:#D6336C;">Ubah Profil</h5>

            <div class="text-center mb-4">
                @if ($customer->profile_photo)
                    <img src="{{ asset('storage/' . $customer->profile_photo) }}" alt="Foto Profil" class="rounded-circle"
                        style="width:100px;height:100px;object-fit:cover;">
                @else
                    <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center"
                        style="width:100px;height:100px;">
                        <i class="fa fa-user fa-2x text-secondary"></i>
                    </div>
                @endif
            </div>

            <form method="POST" action="{{ route('customer.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $customer->name) }}"
                        class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $customer->email) }}"
                        class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}"
                        class="form-control @error('phone') is-invalid @enderror">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" id="address" name="address" value="{{ old('address', $customer->address) }}"
                        class="form-control @error('address') is-invalid @enderror">
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="profile_photo" class="form-label">Foto Profil</label>
                    <input type="file" id="profile_photo" name="profile_photo" accept="image/*"
                        class="form-control @error('profile_photo') is-invalid @enderror">
                    @error('profile_photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru</label>
                    <input type="password" id="password" name="password"
                        class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                </div>

                <button type="submit" class="btn btn-bloomora-pink">Simpan Perubahan</button>
            </form>
        </div>
    </div>
@endsection
