@extends('layouts.customer')

@section('title', 'Detail Pesanan')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 detail-heading">Detail Pesanan #BLM-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</h1>
    </div>
    @php
        if ($order->pickup_method === 'Dikirim') {
            $tahapan = ['Diproses', 'Disiapkan', 'Siap Dikirim', 'Dibayar', 'Selesai'];
        } else {
            $tahapan = ['Diproses', 'Disiapkan', 'Siap Diambil', 'Dibayar', 'Selesai'];
        }

        if ($order->status === 'Selesai') {
            $tahapAktif = 4;
        } elseif ($order->payment->status === 'Sudah Dibayar') {
            $tahapAktif = 3;
        } else {
            $tahapAktif = array_search($order->status, ['Diproses', 'Disiapkan', 'Siap Diambil/Dikirim']);
        }
    @endphp

    <div class="d-flex justify-content-between mb-4 position-relative">
        <div class="position-absolute step-connector"></div>
        @foreach ($tahapan as $index => $tahap)
            <div class="text-center" style="flex: 1; position: relative; z-index: 2;">
                <div
                    class="mx-auto d-flex align-items-center justify-content-center rounded-circle mb-1 step-circle {{ $index <= $tahapAktif ? 'is-active' : 'is-inactive' }}">
                    {{ $index + 1 }}
                </div>
                <small
                    class="step-label {{ $index <= $tahapAktif ? 'is-active' : 'is-inactive' }}">{{ $tahap }}</small>
            </div>
        @endforeach
    </div>

    <div class="p-4 rounded-4 mb-4 info-box">
        <h6 class="fw-bold mb-3 info-box-title">Informasi Penerima</h6>
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
                <p class="small text-muted mb-1">Tanggal Pengambilan/Pengiriman</p>
                <div class="p-2 rounded-3 info-value-box">
                    {{ \Carbon\Carbon::parse($order->delivery_date)->format('d F Y') }}</div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Alamat</p>
                <div class="p-2 rounded-3 info-value-box">{{ $order->shipping_address ?? '-' }}
                </div>
            </div>
        </div>
    </div>
    <div class="p-4 rounded-4 mb-4 info-box">
        <h6 class="fw-bold mb-3 info-box-title">Pesan Kartu Ucapan & Kustomisasi</h6>

        @if ($order->greeting_card)
            <p class="small text-muted mb-1">Kartu Ucapan</p>
            <div class="p-2 rounded-3 mb-3 info-value-box">"{{ $order->greeting_card }}"</div>
        @endif

        @if ($order->order_notes)
            <p class="small text-muted mb-1">Notes</p>
            <div class="p-2 rounded-3 mb-3 info-value-box">{{ $order->order_notes }}</div>
        @endif

        @if ($order->reference_photo)
            <p class="small text-muted mb-1">Foto Referensi</p>
            <img src="{{ asset('storage/' . $order->reference_photo) }}" alt="Foto referensi" class="rounded-3"
                style="max-width: 200px;">
        @endif
    </div>

    <div class="mt-4 mb-4">
        <h6 class="fw-bold mb-3 info-box-title">Produk Yang Dipesan</h6>

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
                            <th>Aksi</th>
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
                                <td>
                                    @if ($order->status === 'Selesai')
                                        @php
                                            $alreadyReviewed = \App\Models\Review::where('order_id', $order->id)
                                                ->where('product_id', $detail->product->id)
                                                ->where('customer_id', auth('customer')->id())
                                                ->exists();
                                        @endphp

                                        @if ($alreadyReviewed)
                                            <button type="button" class="btn btn-sm rounded-pill btn-review-done" disabled>
                                                Sudah Diulas
                                            </button>
                                        @else
                                            <a href="{{ route('customer.reviews.create', [$order->id, $detail->product->id]) }}"
                                                class="btn btn-sm rounded-pill btn-review-active">
                                                Beri Ulasan
                                            </a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="p-3 rounded-3 h-100 info-box">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="fw-bold mb-0 info-box-title">Informasi Pembayaran</h6>
                    <span class="badge rounded-pill status-badge-pending">
                        {{ $order->payment->status }}
                    </span>
                </div>
                <p class="small text-muted mb-1">Metode Pembayaran</p>
                <div class="p-2 rounded-3 mb-3 info-value-box">
                    {{ $order->payment->payment_method }}</div>
                <p class="small text-muted mb-1">Jumlah Pembayaran</p>
                <div class="p-2 rounded-3 info-value-box">
                    Rp{{ number_format($order->payment->amount, 0, ',', '.') }}</div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="p-3 rounded-3 h-100 info-box">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="fw-bold mb-0 info-box-title">Informasi Pengiriman</h6>
                    <span class="badge rounded-pill status-badge-pending">
                        {{ $order->shipment->status }}
                    </span>
                </div>
                <p class="small text-muted mb-1">Metode Pengiriman</p>
                <div class="p-2 rounded-3 mb-3 info-value-box">{{ $order->pickup_method }}</div>
                <p class="small text-muted mb-1">Nomor Resi</p>
                <div class="p-2 rounded-3 info-value-box">
                    {{ $order->shipment->tracking_number ?? '- (belum tersedia)' }}</div>
            </div>
        </div>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('customer.orders.index') }}" class="btn rounded-pill px-4 btn-back-detail">
            Kembali
        </a>
    </div>

@endsection
