@extends('layouts.app')

@section('title', 'Detail - Admin Page')
@section('page-title', 'ADMIN PAGE')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail - Admin page</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">


                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th>No</th>
                            <td>{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <th width="180">Photo</th>
                            <td>
                                <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('images/default-avatar.png') }}"
                                    alt="Foto {{ $user->name }}" width="80" height="80" class="rounded-circle"
                                    style="object-fit: cover;">
                            </td>
                        <tr>
                            <th width="180">Name</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Terdaftar Pada</th>
                            <td>{{ $user->created_at->format('d F Y H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Diperbarui Pada</th>
                            <td>{{ $user->updated_at->format('d F Y H:i:s') }}</td>
                        </tr>
                    </table>

                </div>

                <div class="card-footer">
                    <a href="{{ route('admin.admin.index') }}" class="btn text-white"
                        style="background-color: #6c757d; border-color: #6c757d;">
                        <span class="fa fa-arrow-left"></span>
                        Back
                    </a>
                    <a href="{{ route('admin.admin.edit', encrypt($user->id)) }}" class="btn text-white"
                        style="background-color: #0d6efd; border-color: #0d6efd;">
                        <span class="fa fa-edit"></span> Update
                    </a>
                    <a href="#" onclick="handleDestroy('{{ route('admin.admin.destroy', encrypt($user->id)) }}')"
                        class="btn btn-danger">
                        <span class="fa fa-trash"></span>Delete
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection
