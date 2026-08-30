@extends('layouts.app')

@section('title', 'Create New - Admin Page')
@section('page-title', 'ADMIN PAGE')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Update - Admin page</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('admin.admin.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="profile_photo" class="form-label">Profile Photo</label>

                            <div class="d-flex align-items-center gap-3 mb-2">
                                <img id="photo-preview"
                                    src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('images/default-avatar.png') }}"
                                    alt="Preview" width="80" height="80" class="rounded-circle border"
                                    style="object-fit: cover;">
                            </div>

                            <input type="file" name="profile_photo" id="profile_photo" accept="image/*"
                                class="form-control @error('profile_photo') is-invalid @enderror"
                                onchange="previewPhoto(event)">


                            @error('profile_photo')
                                <div class="invalid-feedack d-block">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') ?? $user->name }}"
                                class="form-control @error('name') is-invalid @enderror">

                            @error('name')
                                <div class="invalid-feedack d-block">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') ?? $user->email }}"
                                class="form-control @error('email') is-invalid @enderror">

                            @error('email')
                                <div class="invalid-feedack d-block">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror">

                            @error('password')
                                <div class="invalid-feedack d-block">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password </label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control">
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <span class="fa fa-save"></span>
                                Save
                            </button>

                            <a href="{{ route('admin.admin.index') }}" class="btn text-white"
                                style="background-color: #6c757d; border-color: #6c757d;">
                                <span class="fa fa-times-circle"></span>
                                Cancle
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewPhoto(event) {
            const file = event.target.files[0];
            if (file) {
                document.getElementById('photo-preview').src = URL.createObjectURL(file);
            }
        }
    </script>
@endsection
