@extends('layouts.app')

@section('title', 'Payment Page - Admin')
@section('page-title', 'Order Management')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0" style="color: #4A3F3F;">Daftar Pembayaran</h1>
    </div>

    <ul class="nav nav-pills mb-4">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.ordermanagements.index') }}">Order</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" style="background-color: #D6336C;"
                href="{{ route('admin.paymentmanagements.index') }}">Payment</a>
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
                        <th>Payment Method</th>
                        <th>Amount</th>
                        <th>Payment Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>#BLM-{{ str_pad($payment->order->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $payment->order->customer->name }}</td>
                            <td>{{ $payment->payment_method }}</td>
                            <td>Rp{{ number_format($payment->amount, 0, ',', '.') }}</td>
                            <td>{{ $payment->payment_date ? $payment->payment_date->format('d-m-Y') : '-' }}</td>
                            <td>{{ $payment->status }}</td>
                            <td>
                                <a href="{{ route('admin.paymentmanagements.show', $payment->id) }}"
                                    class="btn btn-link text-dark p-0 mx-2">
                                    <span class="fa fa-eye"></span>
                                </a>
                                <a href="{{ route('admin.paymentmanagements.edit', $payment->id) }}"
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
