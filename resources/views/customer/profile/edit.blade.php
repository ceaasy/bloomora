@extends('layouts.customer')

@section('title', 'Ubah Profil - Bloomora')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title text-center mb-4 profile-title">UBAH PROFIL</h5>

                    <form method="POST" action="{{ route('customer.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="text-center mb-4">
                            <label for="profile_photo" style="cursor:pointer;">
                                @if ($customer->profile_photo)
                                    <img src="{{ asset('storage/' . $customer->profile_photo) }}" alt="Foto Profil"
                                        class="rounded-circle profile-photo-circle">
                                @else
                                    <div
                                        class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center profile-photo-placeholder">
                                        <i class="fa fa-user fa-2x text-secondary"></i>
                                    </div>
                                @endif
                                <div class="small mt-1 profile-photo-label">Ubah foto</div>
                            </label>
                            <input type="file" id="profile_photo" name="profile_photo" accept="image/*" class="d-none">
                            @error('profile_photo')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $customer->name) }}"
                                class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}"
                                class="form-control @error('phone') is-invalid @enderror">
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $customer->email) }}"
                                class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" id="address" name="address"
                                value="{{ old('address', $customer->address) }}"
                                class="form-control @error('address') is-invalid @enderror">
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" id="password" name="password"
                                class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Password Confirmation</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">Simpan</button>
                            <a href="{{ route('customer.home') }}" class="btn btn-outline-secondary px-4">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('profile_photo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(ev) {
                const img = document.querySelector(
                    'label[for="profile_photo"] img, label[for="profile_photo"] div');
                if (img.tagName === 'IMG') {
                    img.src = ev.target.result;
                } else {
                    const newImg = document.createElement('img');
                    newImg.src = ev.target.result;
                    newImg.className = 'rounded-circle profile-photo-circle';
                    img.replaceWith(newImg);
                }
            };
            reader.readAsDataURL(file);
        });
    </script>
@endpush
