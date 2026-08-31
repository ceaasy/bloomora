@extends('layouts.customer')

@section('title', 'Tentang Kami - Bloomora')

@section('content')
    <div class="mb-4 text-center">
        <img src="{{ asset('img/about.jpeg') }}" alt="Produk Bloomora" class="rounded-4 shadow-sm"
            style="width: 75%; height: auto;">
    </div>

    <div class="text-center mb-4">
        <span class="badge rounded-pill mb-2 px-3 py-2" style="background-color: #FBE3EC; color: #D6336C; font-weight: 600;">
            TENTANG KAMI
        </span>
        <h3 class="fw-bold" style="color: #4A3F3F;">Kenalan Sama Bloomora</h3>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="rounded-4 shadow-sm p-4 h-100" style="background-color: #FFFAF7; border: 1px solid #F0B8CB;">
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
                    <div class="rounded-4 shadow-sm text-center p-3 text-white"
                        style="background: linear-gradient(160deg, #D6336C, #B4275A);">
                        <div class="fw-bold fs-4">4.9/5</div>
                        <small>Rating Pelanggan</small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="rounded-4 shadow-sm text-center p-3" style="background-color: #db5d85; color: #FFFAF7;">
                        <div class="fw-bold fs-4">10+</div>
                        <small>Produk</small>
                    </div>
                </div>
            </div>

            <div class="rounded-4 p-3 shadow-sm d-flex align-items-center justify-content-between"
                style="background: linear-gradient(135deg, #FBE3EC 0%, #F7D3E1 100%);">
                <span class="small fw-semibold" style="color: #4A3F3F;">
                    Yuk, Temukan Hadiah dan Kreasi Spesial Untuk Orang Tersayang
                </span>
                <a href="#" class="btn text-white btn-sm text-nowrap ms-2"
                    style="background-color: #D6336C; border-color: #D6336C; border-radius: 50px;">
                    Lihat Produk
                </a>
            </div>
        </div>
    </div>

    <h5 class="fw-bold mb-3 text-center" style="color: #4A3F3F;">Kenapa Pilih Bloomora?</h5>
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="rounded-4 shadow-sm p-3 d-flex align-items-center gap-3 text-white"
                style="background: linear-gradient(160deg, #D6336C, #B4275A);">
                <span class="fa fa-heart fa-lg"></span>
                <div>
                    <div class="fw-semibold">Artificial Flowers</div>
                    <small style="opacity: .9;">Dipilih dan dirangkai langsung setiap hari</small>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="rounded-4 shadow-sm p-3 d-flex align-items-center gap-3"
                style="background-color: #FFFAF7; border: 1px solid #F0B8CB;">
                <span class="fa fa-magic fa-lg" style="color: #D6336C;"></span>
                <div>
                    <div class="fw-semibold" style="color: #4A3F3F;">Bisa Custom</div>
                    <small class="text-muted">Sesuai request dan budget kamu</small>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="rounded-4 shadow-sm p-3 d-flex align-items-center gap-3"
                style="background-color: #FFFAF7; border: 1px solid #F0B8CB;">
                <span class="fa fa-cube fa-lg" style="color: #D6336C;"></span>
                <div>
                    <div class="fw-semibold" style="color: #4A3F3F;">Kemasan Rapi</div>
                    <small class="text-muted">Aesthetic dan siap foto untuk instagram</small>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="rounded-4 shadow-sm p-3 d-flex align-items-center gap-3 text-white"
                style="background: linear-gradient(160deg, #D6336C, #B4275A);">
                <span class="fa fa-clock-o fa-lg"></span>
                <div>
                    <div class="fw-semibold">Kirim Cepat</div>
                    <small style="opacity: .9;">Sampai tepat waktu dan aman di perjalanan</small>
                </div>
            </div>
        </div>
    </div>

    <h5 class="fw-bold mb-3 text-center" style="color: #4A3F3F;">Hubungi Kami</h5>
    <div class="row g-3 text-center">
        <div class="col-6 col-md-3">
            <div class="rounded-4 shadow-sm p-3 h-100" style="background-color: #FFFAF7; border: 1px solid #F0B8CB;">
                <span class="fa fa-map-marker fa-lg mb-2 d-block" style="color: #D6336C;"></span>
                <small class="d-block text-muted">Lokasi</small>
                <span class="fw-semibold" style="color: #4A3F3F;">Purbalingga, Jawa Tengah</span>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="rounded-4 shadow-sm p-3 h-100" style="background-color: #FFFAF7; border: 1px solid #F0B8CB;">
                <span class="fa fa-phone fa-lg mb-2 d-block" style="color: #D6336C;"></span>
                <small class="d-block text-muted">Telepon</small>
                <span class="fw-semibold" style="color: #4A3F3F;">08xxxxxxxxxx</span>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="rounded-4 shadow-sm p-3 h-100" style="background-color: #FFFAF7; border: 1px solid #F0B8CB;">
                <span class="fa fa-envelope fa-lg mb-2 d-block" style="color: #D6336C;"></span>
                <small class="d-block text-muted">Email</small>
                <span class="fw-semibold" style="color: #4A3F3F;">bloomora@gmail.com</span>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="rounded-4 shadow-sm p-3 h-100" style="background-color: #FFFAF7; border: 1px solid #F0B8CB;">
                <span class="fa fa-clock-o fa-lg mb-2 d-block" style="color: #D6336C;"></span>
                <small class="d-block text-muted">Jam Buka</small>
                <span class="fw-semibold" style="color: #4A3F3F;">08.00–21.00</span>
            </div>
        </div>
    </div>
@endsection
