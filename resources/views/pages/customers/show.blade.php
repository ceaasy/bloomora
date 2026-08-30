@extends('layouts.app')

@section('title', 'Detail - Customer Page')
@section('page-title', 'CUSTOMER PAGE')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail - Customer page</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">

                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th>No</th>
                            <td>{{ $customer->id }}</td>
                        </tr>
                        <tr>
                            <th width="180">Photo</th>
                            <td>
                                <img src="{{ $customer->profile_photo ? asset('storage/' . $customer->profile_photo) : asset('images/default-avatar.png') }}"
                                    alt="Foto {{ $customer->name }}" width="80" height="80" class="rounded-circle"
                                    style="object-fit: cover;">
                            </td>
                        <tr>
                            <th width="180">Name</th>
                            <td>{{ $customer->name }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $customer->phone }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $customer->email }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $customer->address }}</td>
                        </tr>
                        <tr>
                            <th>Terdaftar Pada</th>
                            <td>{{ $customer->created_at->format('d F Y H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Diperbarui Pada</th>
                            <td>{{ $customer->updated_at->format('d F Y H:i:s') }}</td>
                        </tr>
                    </table>

                </div>

                <div class="card-footer">
                    <a href="{{ route('admin.customers.index') }}" class="btn text-white"
                        style="background-color: #6c757d; border-color: #6c757d;">
                        <span class="fa fa-arrow-left"></span>
                        Back
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection
