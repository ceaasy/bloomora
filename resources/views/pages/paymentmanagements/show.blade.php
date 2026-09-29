@extends('layouts.app')

@section('title', 'Detail - Payment Page')
@section('page-title', 'ORDER MANAGEMENT')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 admin-page-title">Detail - Payment page</h1>
    </div>

    <div class="p-4 rounded-4 mb-4 info-box">
        <div class="row g-3">
            <div class="col-md-6">
                <p class="small text-muted mb-1">Order ID</p>
                <div class="p-2 rounded-3 info-value-box">
                    #BLM-{{ str_pad($payment->order->id, 4, '0', STR_PAD_LEFT) }}
                </div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Customer</p>
                <div class="p-2 rounded-3 info-value-box">{{ $payment->order->customer->name }}</div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Payment Method</p>
                <div class="p-2 rounded-3 info-value-box">{{ $payment->payment_method }}</div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Amount</p>
                <div class="p-2 rounded-3 info-value-box">
                    Rp{{ number_format($payment->amount, 0, ',', '.') }}</div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Payment Date</p>
                <div class="p-2 rounded-3 info-value-box">
                    {{ $payment->payment_date ? $payment->payment_date->format('d-m-Y') : '-' }}</div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Status</p>
                <div class="p-2 rounded-3 info-value-box">{{ $payment->status }}</div>
            </div>
        </div>
    </div>

    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('admin.ordermanagements.edit', $payment->order->id) }}" class="btn btn-status-order">
            <span class="fa fa-box"></span> Update Status Pesanan
        </a>
        <a href="{{ route('admin.paymentmanagements.edit', $payment->id) }}" class="btn btn-status-payment">
            <span class="fa fa-money"></span> Update Status Pembayaran
        </a>
        <a href="{{ route('admin.shipmentmanagements.edit', $payment->order->shipment->id) }}"
            class="btn btn-status-shipment">
            <span class="fa fa-truck"></span> Update Status Pengiriman
        </a>
        <a href="{{ route('admin.ordermanagements.index') }}" class="btn text-white btn-cancel-gray">
            <span class="fa fa-arrow-left"></span> Back
        </a>
    </div>
@endsection
