@extends('layouts.app')

@section('title', 'Detail - Shipment Page')
@section('page-title', 'ORDER MANAGEMENT')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail - Shipment page</h1>
    </div>

    <div class="p-4 rounded-4 mb-4 info-box">
        <div class="row g-3">
            <div class="col-md-6">
                <p class="small text-muted mb-1">Order ID</p>
                <div class="p-2 rounded-3 info-value-box">
                    #BLM-{{ str_pad($shipment->order->id, 4, '0', STR_PAD_LEFT) }}
                </div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Customer</p>
                <div class="p-2 rounded-3 info-value-box">{{ $shipment->order->customer->name }}</div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Tracking Number</p>
                <div class="p-2 rounded-3 info-value-box">{{ $shipment->tracking_number ?? '-' }}</div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Status</p>
                <div class="p-2 rounded-3 info-value-box">{{ $shipment->status }}</div>
            </div>
        </div>
    </div>

    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('admin.ordermanagements.edit', $shipment->order->id) }}" class="btn btn-status-order">
            <span class="fa fa-box"></span> Update Status Pesanan
        </a>
        <a href="{{ route('admin.paymentmanagements.edit', $shipment->order->payment->id) }}"
            class="btn btn-status-payment">
            <span class="fa fa-money"></span> Update Status Pembayaran
        </a>
        <a href="{{ route('admin.shipmentmanagements.edit', $shipment->id) }}" class="btn btn-status-shipment">
            <span class="fa fa-truck"></span> Update Status Pengiriman
        </a>
        <a href="{{ route('admin.ordermanagements.index') }}" class="btn text-white btn-cancel-gray">
            <span class="fa fa-arrow-left"></span> Back
        </a>
    </div>

@endsection
