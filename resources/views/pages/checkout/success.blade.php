@extends('layouts.customer')

@section('title', 'Pesanan Berhasil')

@section('content')
    <div class="container py-5 d-flex justify-content-center">
        <div class="p-5 rounded-4 text-center success-box">

            <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle success-icon-circle">
                <span class="fa fa-check fa-2x"></span>
            </div>

            <h5 class="fw-bold mb-1" style="color: #4A3F3F;">Pesanan Berhasil Dibuat!</h5>
            <p class="text-muted mb-4">Terima kasih, pesanan kamu sudah kami terima</p>

            <div class="p-3 rounded-3 mb-4 order-number-box">
                <p class="small text-muted mb-1">No. Pesanan</p>
                <p class="fw-bold mb-0 order-number-value">#BLM-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</p>
            </div>

            <a href="{{ route('customer.orders.show', $order->id) }}"
                class="btn w-100 rounded-pill py-2 mb-2 btn-view-order">
                Lihat Detail Pesanan
            </a>
            <a href="{{ route('customer.catalog.index') }}" class="btn w-100 rounded-pill py-2 btn-back-catalog">
                Kembali
            </a>

        </div>
    </div>
@endsection
