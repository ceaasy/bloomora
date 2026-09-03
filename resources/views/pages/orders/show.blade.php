@extends('layouts.customer')

@section('title', 'Detail Pesanan')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0" style="color: #450404;">Detail Pesanan #BLM-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</h1>
    </div>
    @php
        $tahapan = ['Diproses', 'Disiapkan', 'Dikirim/Diambil', 'Dibayar', 'Selesai'];
        $tahapAktif = array_search($order->status, $tahapan);
    @endphp

    <div class="d-flex justify-content-between mb-4 position-relative">
        <div class="position-absolute"
            style="top: 16px; left: 5%; right: 5%; height: 2px; background-color: #FBE3EC; z-index: 0;"></div>
        @foreach ($tahapan as $index => $tahap)
            <div class="text-center" style="flex: 1; position: relative; z-index: 2;">
                <div class="mx-auto d-flex align-items-center justify-content-center rounded-circle mb-1"
                    style="width: 32px; height: 32px; position: relative; z-index: 2; background-color: {{ $index <= $tahapAktif ? '#D6336C' : '#FBE3EC' }};
                           color: {{ $index <= $tahapAktif ? 'white' : '#B96F84' }};">
                    {{ $index + 1 }}
                </div>
                <small style="color: {{ $index <= $tahapAktif ? '#D6336C' : '#B96F84' }};">{{ $tahap }}</small>
            </div>
        @endforeach
    </div>


    <div class="p-4 rounded-4 mb-4" style="background-color: #FFFAF7; border: 1px solid #FBE3EC;">
        <h6 class="fw-bold mb-3" style="color: #D6336C;">Informasi Penerima</h6>
        <div class="p-4 rounded-4 mb-4" style="background-color: #FFFAF7; border: 1px solid #FBE3EC;">
            <h6 class="fw-bold mb-3" style="color: #D6336C;">Informasi Penerima</h6>
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
                    <p class="small text-muted mb-1">Tanggal Pengambilan/Pengiriman</p>
                    <div class="p-2 rounded-3" style="background-color: #FBE3EC;">
                        {{ \Carbon\Carbon::parse($order->delivery_date)->format('d F Y') }}</div>
                </div>
                <div class="col-md-6">
                    <p class="small text-muted mb-1">Alamat</p>
                    <div class="p-2 rounded-3" style="background-color: #FBE3EC;">{{ $order->shipping_address ?? '-' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="p-4 rounded-4 mb-4" style="background-color: #FFFAF7; border: 1px solid #FBE3EC;">
        <div class="p-4 rounded-4 mb-4" style="background-color: #FFFAF7; border: 1px solid #FBE3EC;">
            <h6 class="fw-bold mb-3" style="color: #D6336C;">Pesan Kartu Ucapan & Kustomisasi</h6>

            @if ($order->greeting_card)
                <p class="small text-muted mb-1">Kartu Ucapan</p>
                <div class="p-2 rounded-3 mb-3" style="background-color: #FBE3EC;">"{{ $order->greeting_card }}"</div>
            @endif

            @if ($order->order_notes)
                <p class="small text-muted mb-1">Notes</p>
                <div class="p-2 rounded-3 mb-3" style="background-color: #FBE3EC;">{{ $order->order_notes }}</div>
            @endif

            @if ($order->reference_photo)
                <p class="small text-muted mb-1">Foto Referensi</p>
                <img src="{{ asset('storage/' . $order->reference_photo) }}" alt="Foto referensi" class="rounded-3"
                    style="max-width: 200px;">
            @endif
        </div>

        <div class="mt-4">
            <h6 class="fw-bold mb-3" style="color: #D6336C;">Produk Yang Dipesan</h6>

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
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="p-3 rounded-3 h-100" style="background-color: #FFFAF7; border: 1px solid #FBE3EC;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="fw-bold mb-0" style="color: #D6336C;">Informasi Pembayaran</h6>
                        <span class="badge rounded-pill" style="background-color: #fff3cd; color: #856404;">
                            {{ $order->payment->status }}
                        </span>
                    </div>
                    <p class="small text-muted mb-1">Metode Pembayaran</p>
                    <div class="p-2 rounded-3 mb-3" style="background-color: #FBE3EC;">
                        {{ $order->payment->payment_method }}</div>
                    <p class="small text-muted mb-1">Jumlah Pembayaran</p>
                    <div class="p-2 rounded-3" style="background-color: #FBE3EC;">
                        Rp{{ number_format($order->payment->amount, 0, ',', '.') }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-3 rounded-3 h-100" style="background-color: #FFFAF7; border: 1px solid #FBE3EC;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="fw-bold mb-0" style="color: #D6336C;">Informasi Pengiriman</h6>
                        <span class="badge rounded-pill" style="background-color: #fff3cd; color: #856404;">
                            {{ $order->shipment->status }}
                        </span>
                    </div>
                    <p class="small text-muted mb-1">Metode Pengiriman</p>
                    <div class="p-2 rounded-3 mb-3" style="background-color: #FBE3EC;">{{ $order->pickup_method }}</div>
                    <p class="small text-muted mb-1">Nomor Resi</p>
                    <div class="p-2 rounded-3" style="background-color: #FBE3EC;">
                        {{ $order->shipment->tracking_number ?? '- (belum tersedia)' }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex gap-2">
        @if ($order->status === 'Selesai')
            <a href="#" class="btn rounded-pill px-4" style="background-color: #D6336C; color: white;">
                Beri Ulasan
            </a>
        @else
            <button type="button" class="btn rounded-pill px-4" style="background-color: #FBE3EC; color: #B96F84;"
                disabled>
                Beri Ulasan
            </button>
        @endif
        <a href="{{ route('customer.orders.index') }}" class="btn rounded-pill px-4"
            style="border: 1px solid #B96F84; color: #B96F84;">
            Kembali
        </a>
    </div>

@endsection
