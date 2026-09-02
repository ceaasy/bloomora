@extends('layouts.customer')

@section('title', 'Pesanan Berhasil')

@section('content')
    <div class="container py-5 d-flex justify-content-center">
        <div class="p-5 rounded-4 text-center" style="background-color: #FBE3EC; max-width: 480px;">

            <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle"
                style="width: 80px; height: 80px; background-color: #d4edda;">
                <span class="fa fa-check fa-2x" style="color: #28a745;"></span>
            </div>

            <h5 class="fw-bold mb-1" style="color: #4A3F3F;">Pesanan Berhasil Dibuat!</h5>
            <p class="text-muted mb-4">Terima kasih, pesanan kamu sudah kami terima</p>

            <div class="p-3 rounded-3 bg-white mb-4">
                <p class="small text-muted mb-1">No. Pesanan</p>
                <p class="fw-bold mb-0" style="color: #D6336C;">#BLM-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</p>
            </div>

            <a href="#" class="btn w-100 rounded-pill py-2 mb-2" style="background-color: #D6336C; color: white;">
                Lihat Detail Pesanan
            </a>
            <a href="{{ route('customer.catalog.index') }}" class="btn w-100 rounded-pill py-2"
                style="border: 1px solid #D6336C; color: #D6336C;">
                Kembali
            </a>

        </div>
    </div>
@endsection
