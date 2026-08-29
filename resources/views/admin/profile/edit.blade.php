@extends('layouts.app')

@section('title', 'Ubah Profil Admin - Bloomora')
@section('page-title', 'UBAH PROFILE')

@section('content')
    <div class="card card-bloomora">
        <div class="card-body p-4">
            <h5 class="card-title text-center mb-4" style="color:#9C2B3A;">UBAH PROFIL</h5>

            <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="text-center mb-4">
                    <label for="profile_photo" style="cursor:pointer;">
                        @if ($admin->profile_photo)
                            <img src="{{ asset('storage/' . $admin->profile_photo) }}" alt="Foto Profil"
                                class="rounded-circle"
                                style="width:100px;height:100px;object-fit:cover;border:1px solid #9C2B3A;">
                        @else
                            <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center"
                                style="width:100px;height:100px;border:1px solid #9C2B3A;">
                                <i class="bi bi-person fs-1 text-secondary"></i>
                            </div>
                        @endif
                        <div class="small mt-1" style="color:#9C2B3A;">Ubah foto</div>
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
                    <input type="text" id="name" name="name" value="{{ old('name', $admin->name) }}"
                        class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $admin->email) }}"
                        class="form-control @error('email') is-invalid @enderror">
                    @error('email')
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
                        class="form-control @error('password_confirmation') is-invalid @enderror">
                    @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">Simpan</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary px-4">Batal</a>
                </div>
            </form>
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
                    newImg.className = 'rounded-circle';
                    newImg.style.cssText =
                        'width:100px;height:100px;object-fit:cover;border:1px solid #9C2B3A;';
                    img.replaceWith(newImg);
                }
            };
            reader.readAsDataURL(file);
        });
    </script>
@endpush
