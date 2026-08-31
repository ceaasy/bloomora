@extends('layouts.customer')

@section('title', 'Home - Bloomora')

@section('content')
    <div class="rounded-4 p-4 p-md-5 mb-4 shadow-sm position-relative overflow-hidden"
        style="background: linear-gradient(135deg, #FFF8FA 0%, #F7D3E1 100%);">
        <div class="position-absolute rounded-circle"
            style="width: 220px; height: 220px; background: #ffffff55; top: -90px; right: 30%;">
        </div>

        <div class="position-absolute rounded-circle"
            style="width: 120px; height: 120px; background: #D6336C18; bottom: -50px; left: -30px;">
        </div>

        <div class="row align-items-center g-4 position-relative">
            <div class="col-md-6 text-center text-md-start">
                <span class="badge rounded-pill mb-3 px-3 py-2"
                    style="background-color: #ffffffaa; color: #D6336C; font-weight: 600; letter-spacing: .5px;">
                    🌸 TOKO BUKET & HAMPERS
                </span>
                <h1 class="mb-3" style="line-height: 1.1;">
                    <span
                        style="display: block; font-family: 'Poppins', sans-serif;
                        font-size: 1.2rem; font-weight: 500; letter-spacing: 2px;
                        color: #8E6874;">
                        Welcome to
                    </span>

                    <span
                        style="display: block; font-family: 'Playfair Display', serif;
                        font-size: 3.5rem; font-weight: 700;
                        color: #D6336C;">
                        Bloomora!
                    </span>
                </h1>
                <p class="mb-2 fs-5" style="color: #4A3F3F;">Setiap Moment Lebih Bermakna Bersama BLOOMORA</p>
                <p class="text-muted mb-4">Temukan Hadiah dan Kreasi Spesial Untuk Orang Tersayang</p>
                <a href="#" class="btn text-white px-4 py-2 shadow-sm"
                    style="background-color: #D6336C; border-color: #D6336C; border-radius: 50px;">
                    <span class="fa fa-shopping-bag me-2"></span>Belanja Sekarang
                </a>
            </div>
            <div class="col-md-6 d-flex justify-content-md-end">
                <img src="{{ asset('img/buket.jpeg') }}" alt="Bloomora" class="rounded-4 shadow"
                    style="width: 100%; max-width: 320px; aspect-ratio: 1/1; object-fit: cover;">
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="rounded-4 shadow-sm p-4 h-100 d-flex flex-column align-items-center text-center text-white"
                style="background: linear-gradient(160deg, #f084aa, #B4275A);">
                <span class="fa fa-truck fa-2x mb-3"></span>
                <small class="fw-semibold">Pengiriman Cepat & Aman</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="rounded-4 shadow-sm p-4 h-100 d-flex flex-column align-items-center text-center"
                style="background-color: #ec7aa0; color: #fff7f9;">
                <span class="fa fa-check-circle fa-2x mb-3" style="color: #F0B8CB;"></span>
                <small class="fw-semibold">Produk Berkualitas Pilihan Terbaik</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="rounded-4 shadow-sm p-4 h-100 d-flex flex-column align-items-center text-center"
                style="background-color: #e477a4; border: 1px solid #F0B8CB;">
                <span class="fa fa-gift fa-2x mb-3" style="color: #D6336C;"></span>
                <small class="fw-semibold" style="color: #ffffff;">Bisa Custom</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="rounded-4 shadow-sm p-4 h-100 d-flex flex-column align-items-center text-center text-white"
                style="background: linear-gradient(160deg, #f084aa, #B4275A);">
                <span class="fa fa-heart fa-2x mb-3"></span>
                <small class="fw-semibold">Pelayanan Ramah</small>
            </div>
        </div>
    </div>
@endsection
