@extends('layouts.app')

@section('title', 'Order Page - Admin')
@section('page-title', 'Order Management')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0" style="color: #4A3F3F;">Daftar Pesanan</h1>
    </div>

    <ul class="nav nav-pills mb-4">
        <li class="nav-item">
            <a class="nav-link active" style="background-color: #D6336C;"
                href="{{ route('admin.ordermanagements.index') }}">Order</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#">Payment</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#">Shipment</a>
        </li>
    </ul>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Pesanan</th>
                        <th>Customer</th>
                        <th>Tanggal Pesan</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>#BLM-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $order->customer->name }}</td>
                            <td>{{ $order->created_at->format('d-m-Y') }}</td>
                            <td>Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                <a href="{{ route('admin.ordermanagements.show', $order->id) }}"
                                    class="btn btn-link text-dark p-0 mx-2">
                                    <span class="fa fa-eye"></span>
                                </a>
                                <a href="{{ route('admin.ordermanagements.edit', $order->id) }}"
                                    class="btn btn-link p-0 mx-2" style="color: #0d6efd;">
                                    <span class="fa fa-edit"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript">
        @if (Session::has('success'))
            Swal.fire({
                title: "Berhasil!",
                text: "{{ Session::get('success') }}",
                icon: "success",
                draggable: true
            });
        @endif
    </script>
@endpush
