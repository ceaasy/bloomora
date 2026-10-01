@extends('layouts.customer')

@section('title', 'Home - Bloomora')

@section('content')
    <section class="bloomora-hero mb-4">
        <div class="hero-decoration hero-decoration-one"></div>
        <div class="hero-decoration hero-decoration-two"></div>

        <div class="row align-items-center g-4 position-relative">

            <div class="col-lg-6">
                <div class="hero-content">

                    <div class="hero-label">
                        <span></span>
                        WELCOME TO BLOOMORA!!
                    </div>

                    <h1 class="hero-title">
                        Little Gifts,
                        <span>Lasting Memories</span>
                    </h1>

                    <p class="hero-description">
                        Temukan buket dan hampers pilihan Bloomora
                        untuk menemani berbagai momen spesialmu.
                        Pilih, sesuaikan, dan pesan dengan mudah.
                    </p>

                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <a href="{{ route('customer.catalog.index') }}" class="hero-button">
                            <span class="fa fa-shopping-bag me-2"></span>
                            Lihat Koleksi
                        </a>

                        <div class="hero-note">
                            <span class="fa fa-heart"></span>
                            Dibuat dengan penuh perhatian
                        </div>
                    </div>

                    <div class="hero-mini-info">
                        <div>
                            <strong>4.9</strong>
                            <span class="fa fa-star"></span>
                            <small>Rating pelanggan</small>
                        </div>

                        <div class="hero-divider"></div>

                        <div>
                            <strong>Custom</strong>
                            <small>sesuai keinginanmu</small>
                        </div>
                    </div>

                </div>
            </div>

            {{-- IMG --}}
            <div class="col-lg-6">
                <div class="hero-image-area">

                    <div class="hero-circle"></div>

                    <div class="hero-image-stack" id="heroImageStack">

                        <div class="hero-image-card stack-card card-1">
                            <img src="{{ asset('img/buket.jpeg') }}" alt="Koleksi Buket Bloomora" class="hero-main-image">
                        </div>

                        <div class="hero-image-card stack-card card-2">
                            <img src="{{ asset('img/hampers.jpg') }}" alt="Koleksi Hampers Bloomora"
                                class="hero-main-image">
                        </div>

                        <div class="hero-image-card stack-card card-3">
                            <img src="{{ asset('img/buket2.jpg') }}" alt="Koleksi Buket Bloomora" class="hero-main-image">
                        </div>

                        <div class="hero-image-card stack-card card-4">
                            <img src="{{ asset('img/hampers2.jpg') }}" alt="Koleksi Hampers Bloomora"
                                class="hero-main-image">
                        </div>

                    </div>

                    <div class="hero-image-caption">
                        <span class="fa fa-gift"></span>

                        <div>
                            <strong>Bloomora Collection</strong>
                            <small>Special for you ♡</small>
                        </div>
                    </div>

                    <div class="hero-floating hero-floating-top">
                        <span class="fa fa-heart"></span>
                    </div>

                    <div class="hero-floating hero-floating-bottom">
                        <span class="fa fa-tag"></span>

                        <div>
                            <strong>Mulai dari</strong>
                            <small>Rp40rb</small>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <div class="rounded-4 shadow-sm p-4 mb-4 home-features-box">

        <div class="row g-4 text-center">

            <div class="col-6 col-md-3 d-flex flex-column align-items-center">
                <div class="d-flex align-items-center justify-content-center rounded-circle mb-2 home-feature-icon is-pink">
                    <span class="fa fa-truck"></span>
                </div>

                <small class="fw-semibold home-feature-label">
                    Pengiriman Cepat & Aman
                </small>
            </div>

            <div class="col-6 col-md-3 d-flex flex-column align-items-center">
                <div
                    class="d-flex align-items-center justify-content-center rounded-circle mb-2 home-feature-icon is-green">
                    <span class="fa fa-check-circle"></span>
                </div>

                <small class="fw-semibold home-feature-label">
                    Produk Berkualitas Pilihan Terbaik
                </small>
            </div>

            <div class="col-6 col-md-3 d-flex flex-column align-items-center">
                <div class="d-flex align-items-center justify-content-center rounded-circle mb-2 home-feature-icon is-pink">
                    <span class="fa fa-gift"></span>
                </div>

                <small class="fw-semibold home-feature-label">
                    Bisa Custom
                </small>
            </div>

            <div class="col-6 col-md-3 d-flex flex-column align-items-center">
                <div
                    class="d-flex align-items-center justify-content-center rounded-circle mb-2 home-feature-icon is-green">
                    <span class="fa fa-heart"></span>
                </div>

                <small class="fw-semibold home-feature-label">
                    Pelayanan Ramah
                </small>
            </div>

        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const stack = document.getElementById('heroImageStack');

            if (!stack) return;

            const cards = Array.from(
                stack.querySelectorAll('.stack-card')
            );

            let current = 0;
            let isAnimating = false;

            function changePhoto() {

                if (isAnimating) return;

                isAnimating = true;

                const currentCard = cards[current];

                currentCard.classList.add('card-moving');

                setTimeout(function() {

                    currentCard.classList.remove('card-moving');

                    current = (current + 1) % cards.length;

                    cards.forEach(function(card, index) {

                        card.classList.remove(
                            'card-1',
                            'card-2',
                            'card-3',
                            'card-4'
                        );

                        const position =
                            (index - current + cards.length) %
                            cards.length;

                        card.classList.add(
                            'card-' + (position + 1)
                        );

                    });

                    isAnimating = false;

                }, 550);
            }

            stack.addEventListener('click', changePhoto);
            setInterval(changePhoto, 4000);

        });
    </script>
@endpush
