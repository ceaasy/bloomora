@extends('layouts.app')

@section('title', 'Data Customer - Bloomora')
@section('page-title', 'CUSTOMER PAGE')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0" style="color: #4A3F3F;">Data Customer</h1>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td>
                                <img src="{{ $customer->profile_photo ? asset('storage/' . $customer->profile_photo) : asset('images/default-avatar.png') }}"
                                    alt="Foto {{ $customer->name }}" width="40" height="40" class="rounded-circle"
                                    style="object-fit: cover;">
                            </td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>
                                <a href="{{ route('admin.customers.show', encrypt($customer->id)) }}"
                                    class="btn btn-link text-dark p-0 mx-2">
                                    <span class="fa fa-eye"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
