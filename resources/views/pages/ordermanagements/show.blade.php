@extends('layouts.app')

@section('title', 'Detail - Order Page')
@section('page-title', 'ORDER MANAGEMENT')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail - Order page</h1>
    </div>

    <div class="p-4 rounded-4 mb-4 info-box">
        <h6 class="fw-bold mb-3 info-box-title">Info Pesanan & Pelanggan</h6>
        <div class="row g-3">
            <div class="col-md-6">
                <p class="small text-muted mb-1">Order ID</p>
                <div class="p-2 rounded-3 info-value-box">
                    #BLM-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                </div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Customer</p>
                <div class="p-2 rounded-3 info-value-box">{{ $order->customer->name }}</div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Status</p>
                <div class="p-2 rounded-3 info-value-box">{{ $order->status }}</div>
            </div>
        </div>
    </div>

    <div class="p-4 rounded-4 mb-4 info-box">
        <h6 class="fw-bold mb-3 info-box-title">Status Pembayaran & Pengiriman</h6>
        <div class="row g-3">
            <div class="col-md-6">
                <p class="small text-muted mb-1">Status Pembayaran</p>
                <div class="p-2 rounded-3 d-flex justify-content-between align-items-center info-value-box">
                    <span>{{ $order->payment->status }}</span>
                    <a href="{{ route('admin.paymentmanagements.show', $order->payment->id) }}"
                        class="small info-detail-link">
                        Detail &raquo;
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Status Pengiriman</p>
                <div class="p-2 rounded-3 d-flex justify-content-between align-items-center info-value-box">
                    <span>{{ $order->shipment->status }}</span>
                    <a href="{{ route('admin.shipmentmanagements.show', $order->shipment->id) }}"
                        class="small info-detail-link">
                        Detail &raquo;
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="p-4 rounded-4 mb-4 info-box">
        <h6 class="fw-bold mb-3 info-box-title">Info Penerima & Pengiriman</h6>
        <div class="row g-3">
            <div class="col-md-6">
                <p class="small text-muted mb-1">Nama Penerima</p>
                <div class="p-2 rounded-3 info-value-box">{{ $order->recipient_name }}</div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">No. Telepon Penerima</p>
                <div class="p-2 rounded-3 info-value-box">{{ $order->recipient_phone }}</div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Metode Pengambilan</p>
                <div class="p-2 rounded-3 info-value-box">{{ $order->pickup_method }}</div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Tanggal Pengambilan/Pengiriman</p>
                <div class="p-2 rounded-3 info-value-box">
                    {{ $order->delivery_date->format('d F Y') }}
                </div>
            </div>
            <div class="col-12">
                <p class="small text-muted mb-1">Alamat Pengiriman</p>
                <div class="p-2 rounded-3 info-value-box">{{ $order->shipping_address ?? '-' }}</div>
            </div>
        </div>
    </div>

    <div class="p-4 rounded-4 mb-4 info-box">
        <h6 class="fw-bold mb-3 info-box-title">Kustomisasi & Catatan Pesanan</h6>

        @if ($order->greeting_card)
            <p class="small text-muted mb-1">Kartu Ucapan</p>
            <div class="p-2 rounded-3 mb-3 info-value-box">"{{ $order->greeting_card }}"</div>
        @endif

        @if ($order->order_notes)
            <p class="small text-muted mb-1">Catatan Pesanan</p>
            <div class="p-2 rounded-3 mb-3 info-value-box">{{ $order->order_notes }}</div>
        @endif

        @if ($order->reference_photo)
            <p class="small text-muted mb-1">Foto Referensi</p>
            <img src="{{ asset('storage/' . $order->reference_photo) }}" alt="Foto referensi" class="rounded-3"
                style="max-width: 200px;">
        @endif
    </div>

    <div class="mb-4">
        <h6 class="fw-bold mb-3 info-box-title">Rincian Produk</h6>
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <table class="table table-bordered table-hover align-middle">
                    <thead>
                        <tr class="cart-table-header">
                            <th>Produk</th>
                            <th>Ukuran</th>
                            <th>Qty</th>
                            <th>Kustomisasi</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderDetails as $detail)
                            <tr>
                                <td>{{ $detail->product->name }}</td>
                                <td>{{ $detail->size }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>
                                    @foreach ($detail->customization_selected ?? [] as $opt)
                                        <div class="small">{{ $opt['name'] }}</div>
                                    @endforeach
                                </td>
                                <td>Rp{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4 order-summary-box">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">Subtotal Produk</span>
                <span>Rp{{ number_format($order->subtotal, 0, ',', '.') }}</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">Ongkir</span>
                <span>Rp{{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between fw-bold checkout-total">
                <span>TOTAL</span>
                <span>Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('admin.ordermanagements.edit', $order->id) }}" class="btn btn-status-order">
            <span class="fa fa-box"></span> Update Status Pesanan
        </a>
        <a href="{{ route('admin.paymentmanagements.edit', $order->payment->id) }}" class="btn btn-status-payment">
            <span class="fa fa-money"></span> Update Status Pembayaran
        </a>
        <a href="{{ route('admin.shipmentmanagements.edit', $order->shipment->id) }}" class="btn btn-status-shipment">
            <span class="fa fa-truck"></span> Update Status Pengiriman
        </a>
        <a href="{{ route('admin.ordermanagements.index') }}" class="btn text-white btn-cancel-gray">
            <span class="fa fa-arrow-left"></span> Back
        </a>
    </div>

@endsection
