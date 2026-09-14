@extends('layouts.app')

@section('title', 'Detail - Shipment Page')
@section('page-title', 'ORDER MANAGEMENT')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail - Shipment page</h1>
    </div>

    <div class="p-4 rounded-4 mb-4" style="background-color: #FFFAF7; border: 1px solid #FBE3EC;">
        <div class="row g-3">
            <div class="col-md-6">
                <p class="small text-muted mb-1">Order ID</p>
                <div class="p-2 rounded-3" style="background-color: #FBE3EC;">
                    #BLM-{{ str_pad($shipment->order->id, 4, '0', STR_PAD_LEFT) }}
                </div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Customer</p>
                <div class="p-2 rounded-3" style="background-color: #FBE3EC;">{{ $shipment->order->customer->name }}</div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Tracking Number</p>
                <div class="p-2 rounded-3" style="background-color: #FBE3EC;">{{ $shipment->tracking_number ?? '-' }}</div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Status</p>
                <div class="p-2 rounded-3" style="background-color: #FBE3EC;">{{ $shipment->status }}</div>
            </div>
        </div>
    </div>

    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('admin.ordermanagements.edit', $shipment->order->id) }}" class="btn"
            style="background-color: #4361ee; color: white;">
            <span class="fa fa-box"></span> Update Status Pesanan
        </a>
        <a href="{{ route('admin.paymentmanagements.edit', $shipment->order->payment->id) }}" class="btn"
            style="background-color: #D6336C; color: white;">
            <span class="fa fa-money"></span> Update Status Pembayaran
        </a>
        <a href="{{ route('admin.shipmentmanagements.edit', $shipment->id) }}" class="btn"
            style="background-color: #B96F84; color: white;">
            <span class="fa fa-truck"></span> Update Status Pengiriman
        </a>
        <a href="{{ route('admin.ordermanagements.index') }}" class="btn text-white"
            style="background-color: #6c757d; border-color: #6c757d;">
            <span class="fa fa-arrow-left"></span> Back
        </a>
    </div>

@endsection
