@extends('layouts.customer')

@section('title', 'Tentang Kami - Bloomora')

@section('content')
    <div class="mb-4 text-center">
        <img src="{{ asset('img/banner.png') }}" alt="Produk Bloomora" class="rounded-4 shadow-sm"
            style="width: 95%; height: auto;">
    </div>

    <div class="text-center mb-4">
        <span class="badge rounded-pill mb-2 px-3 py-2 about-badge">
            TENTANG KAMI
        </span>
        <h3 class="fw-bold about-heading">Kenalan Sama Bloomora</h3>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="rounded-4 shadow-sm p-4 h-100 about-intro-box">
                <p class="mb-0 text-muted">
                    Bloomora adalah toko buket dan hampers online yang hadir untuk membantu kamu merayakan setiap
                    momen berharga bersama orang tersayang. Kami menghadirkan rangkaian bunga dan hampers dengan
                    kualitas terbaik, dikemas rapi, dan bisa disesuaikan dengan kebutuhanmu.
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row g-3 mb-3">
                <div class="col-6">
                    <div class="rounded-4 shadow-sm text-center p-3 about-gradient-card">
                        <div class="fw-bold fs-4">4.9/5</div>
                        <small>Rating Pelanggan</small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="rounded-4 shadow-sm text-center p-3 about-solid-pink-card">
                        <div class="fw-bold fs-4">10+</div>
                        <small>Produk</small>
                    </div>
                </div>
            </div>

            <div class="rounded-4 p-3 shadow-sm d-flex align-items-center justify-content-between about-cta-strip">
                <span class="small fw-semibold about-cta-text">
                    Yuk, Temukan Hadiah dan Kreasi Spesial Untuk Orang Tersayang
                </span>
                <a href="{{ route('customer.catalog.index') }}"
                    class="btn btn-sm text-nowrap ms-2 rounded-pill btn-about-cta">
                    Lihat Produk
                </a>
            </div>
        </div>
    </div>

    <h5 class="fw-bold mb-3 text-center about-heading">Kenapa Pilih Bloomora?</h5>
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="rounded-4 shadow-sm p-3 d-flex align-items-center gap-3 about-gradient-card">
                <span class="fa fa-heart fa-lg"></span>
                <div>
                    <div class="fw-semibold">Artificial Flowers</div>
                    <small class="subtext">Dipilih dan dirangkai langsung setiap hari</small>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="rounded-4 shadow-sm p-3 d-flex align-items-center gap-3 about-outline-card">
                <span class="fa fa-magic fa-lg icon"></span>
                <div>
                    <div class="fw-semibold title">Bisa Custom</div>
                    <small class="text-muted">Sesuai request dan budget kamu</small>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="rounded-4 shadow-sm p-3 d-flex align-items-center gap-3 about-outline-card">
                <span class="fa fa-cube fa-lg icon"></span>
                <div>
                    <div class="fw-semibold title">Kemasan Rapi</div>
                    <small class="text-muted">Aesthetic dan siap foto untuk instagram</small>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="rounded-4 shadow-sm p-3 d-flex align-items-center gap-3 about-gradient-card">
                <span class="fa fa-clock-o fa-lg"></span>
                <div>
                    <div class="fw-semibold">Kirim Cepat</div>
                    <small class="subtext">Sampai tepat waktu dan aman di perjalanan</small>
                </div>
            </div>
        </div>
    </div>

    <h5 class="fw-bold mb-3 text-center about-heading">Hubungi Kami</h5>
    <div class="row g-3 text-center">
        <div class="col-6 col-md-3">
            <div class="rounded-4 shadow-sm p-3 h-100 contact-card">
                <span class="fa fa-map-marker fa-lg mb-2 d-block icon"></span>
                <small class="d-block text-muted">Lokasi</small>
                <span class="fw-semibold value">Purbalingga, Jawa Tengah</span>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="rounded-4 shadow-sm p-3 h-100 contact-card">
                <span class="fa fa-phone fa-lg mb-2 d-block icon"></span>
                <small class="d-block text-muted">Telepon</small>
                <span class="fw-semibold value">{{ config('services.whatsapp.number') }}</span>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="rounded-4 shadow-sm p-3 h-100 contact-card">
                <span class="fa fa-envelope fa-lg mb-2 d-block icon"></span>
                <small class="d-block text-muted">Email</small>
                <span class="fw-semibold value">bloomora@gmail.com</span>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="rounded-4 shadow-sm p-3 h-100 contact-card">
                <span class="fa fa-clock-o fa-lg mb-2 d-block icon"></span>
                <small class="d-block text-muted">Jam Buka</small>
                <span class="fw-semibold value">08.00–21.00</span>
            </div>
        </div>
    </div>
@endsection
