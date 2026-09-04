@extends('layouts.app')

@section('title', 'Detail - Order Page')
@section('page-title', 'ORDER MANAGEMENT')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail - Order page</h1>
    </div>

    <div class="p-4 rounded-4 mb-4" style="background-color: #FFFAF7; border: 1px solid #FBE3EC;">
        <h6 class="fw-bold mb-3" style="color: #D6336C;">Info Pesanan & Pelanggan</h6>
        <div class="row g-3">
            <div class="col-md-6">
                <p class="small text-muted mb-1">Order ID</p>
                <div class="p-2 rounded-3" style="background-color: #FBE3EC;">
                    #BLM-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                </div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Customer</p>
                <div class="p-2 rounded-3" style="background-color: #FBE3EC;">{{ $order->customer->name }}</div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Status</p>
                <div class="p-2 rounded-3" style="background-color: #FBE3EC;">{{ $order->status }}</div>
            </div>
        </div>
    </div>

    <div class="p-4 rounded-4 mb-4" style="background-color: #FFFAF7; border: 1px solid #FBE3EC;">
        <h6 class="fw-bold mb-3" style="color: #D6336C;">Info Penerima & Pengiriman</h6>
        <div class="row g-3">
            <div class="col-md-6">
                <p class="small text-muted mb-1">Nama Penerima</p>
                <div class="p-2 rounded-3" style="background-color: #FBE3EC;">{{ $order->recipient_name }}</div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">No. Telepon Penerima</p>
                <div class="p-2 rounded-3" style="background-color: #FBE3EC;">{{ $order->recipient_phone }}</div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Metode Pengambilan</p>
                <div class="p-2 rounded-3" style="background-color: #FBE3EC;">{{ $order->pickup_method }}</div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Tanggal Pengambilan/Pengiriman</p>
                <div class="p-2 rounded-3" style="background-color: #FBE3EC;">
                    {{ $order->delivery_date->format('d F Y') }}
                </div>
            </div>
            <div class="col-12">
                <p class="small text-muted mb-1">Alamat Pengiriman</p>
                <div class="p-2 rounded-3" style="background-color: #FBE3EC;">{{ $order->shipping_address ?? '-' }}</div>
            </div>
        </div>
    </div>

    <div class="p-4 rounded-4 mb-4" style="background-color: #FFFAF7; border: 1px solid #FBE3EC;">
        <h6 class="fw-bold mb-3" style="color: #D6336C;">Kustomisasi & Catatan Pesanan</h6>

        @if ($order->greeting_card)
            <p class="small text-muted mb-1">Kartu Ucapan</p>
            <div class="p-2 rounded-3 mb-3" style="background-color: #FBE3EC;">"{{ $order->greeting_card }}"</div>
        @endif

        @if ($order->order_notes)
            <p class="small text-muted mb-1">Catatan Pesanan</p>
            <div class="p-2 rounded-3 mb-3" style="background-color: #FBE3EC;">{{ $order->order_notes }}</div>
        @endif

        @if ($order->reference_photo)
            <p class="small text-muted mb-1">Foto Referensi</p>
            <img src="{{ asset('storage/' . $order->reference_photo) }}" alt="Foto referensi" class="rounded-3"
                style="max-width: 200px;">
        @endif
    </div>

    <div class="mb-4">
        <h6 class="fw-bold mb-3" style="color: #D6336C;">Rincian Produk</h6>
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <table class="table table-bordered table-hover align-middle">
                    <thead>
                        <tr style="background-color: #FBE3EC;">
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

    <div class="card border-0 shadow-sm mb-4" style="max-width: 350px;">
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
            <div class="d-flex justify-content-between fw-bold" style="color: #D6336C;">
                <span>TOTAL</span>
                <span>Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('admin.ordermanagements.edit', $order->id) }}" class="btn"
            style="background-color: #4361ee; color: white;">
            Update Status
        </a>
        <a href="{{ route('admin.ordermanagements.index') }}" class="btn text-white"
            style="background-color: #6c757d; border-color: #6c757d;">
            <span class="fa fa-arrow-left"></span>
            Back
        </a>
    </div>

@endsection
