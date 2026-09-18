@extends('layouts.customer')

@section('title', 'Katalog Produk')

@section('content')
    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <p class="mb-1 text-uppercase"
                    style="font-size: 0.7rem; letter-spacing: 2.5px; color: #B96F84; font-weight: 600;">
                    Bloomora
                </p>

                <h3 class="mb-1"
                    style="
                color: #4A3F3F;
                font-family: 'Playfair Display', serif;
                font-size: 2rem;
                font-weight: 500;
                letter-spacing: -0.3px;
            ">
                    Koleksi untuk <em style="color: #B96F84;">Momen Spesial</em>
                </h3>

                <p class="mb-0"
                    style="
                color: #8C7A7A;
                font-size: 0.88rem;
                font-weight: 400;
            ">
                    Buket dan hampers yang bisa kamu pilih sesuai momen.
                </p>
            </div>

            <span class="d-none d-md-block"
                style="
            font-family: 'Playfair Display', serif;
            font-style: italic;
            color: #B96F84;
            font-size: 0.95rem;
        ">
                Find something special ♡
            </span>
        </div>

        <form action="{{ route('customer.catalog.index') }}" method="GET"
            class="d-flex flex-wrap gap-2 mb-4 align-items-center">

            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif

            <div class="position-relative" style="max-width: 320px;">
                <input type="text" name="keyword" value="{{ request('keyword') }}"
                    class="form-control ps-4 pe-5 rounded-pill" placeholder="Cari Produk"
                    style="background-color: #FBE3EC; border: none;">
                <button type="submit"
                    class="btn position-absolute top-50 end-0 translate-middle-y p-0 me-3 border-0 bg-transparent">
                    <span class="fa fa-search" style="color: #D6336C;"></span>
                </button>
            </div>

            <a href="{{ route('customer.catalog.index', array_merge(request()->except('category'), [])) }}"
                class="btn rounded-pill px-4 {{ !request('category') ? 'text-white' : '' }}"
                style="{{ !request('category') ? 'background-color: #D6336C;' : 'background-color: transparent; border: 1px solid #D6336C; color: #D6336C;' }}">
                Semua
            </a>
            <a href="{{ route('customer.catalog.index', array_merge(request()->except('category'), ['category' => 'Buket'])) }}"
                class="btn rounded-pill px-4 {{ request('category') == 'Buket' ? 'text-white' : '' }}"
                style="{{ request('category') == 'Buket' ? 'background-color: #D6336C;' : 'background-color: transparent; border: 1px solid #D6336C; color: #D6336C;' }}">
                Buket
            </a>
            <a href="{{ route('customer.catalog.index', array_merge(request()->except('category'), ['category' => 'Hampers'])) }}"
                class="btn rounded-pill px-4 {{ request('category') == 'Hampers' ? 'text-white' : '' }}"
                style="{{ request('category') == 'Hampers' ? 'background-color: #D6336C;' : 'background-color: transparent; border: 1px solid #D6336C; color: #D6336C;' }}">
                Hampers
            </a>
        </form>


        <div class="row g-4">
            @forelse ($products as $product)
                <div class="col-6 col-md-3">
                    <div class="card h-100 border-0 shadow-sm rounded-4">
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $product->photo) }}" class="card-img-top rounded-top-4"
                                alt="{{ $product->name }}" style="height: 260px; width: 100%; object-fit: cover;">
                            <span class="position-absolute rounded-pill px-3 py-1"
                                style="top: 10px; left: 10px; background-color: #fff; color: #D6336C;
                                       font-size: 0.7rem; font-weight: 700;">
                                {{ $product->category }}
                            </span>
                        </div>
                        <div class="card-body">
                            <p class="mb-1 small fw-semibold" style="color: #4A3F3F;">{{ $product->name }}</p>
                            <p class="mb-3 small text-muted">
                                Mulai dari Rp{{ number_format($product->price_small, 0, ',', '.') }}
                            </p>
                            <a href="{{ route('customer.catalog.show', $product->id) }}"
                                class="btn btn-sm rounded-pill w-100 btn-detail-lift"
                                style="background-color: #D6336C; color: white;">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Produk tidak ditemukan.</p>
                </div>
            @endforelse
        </div>
        <div class="mt-4">
            {{ $products->appends(request()->query())->links() }}
        </div>

        <div class="rounded-pill d-flex align-items-center justify-content-between px-4 py-3 mt-4"
            style="background-color: #FBE3EC; border: 1px solid #F7D3E1; flex-wrap: wrap; gap: 12px;">
            <p class="mb-0" style="color: #4A3F3F; font-size: 0.95rem;">
                <span
                    style="font-family: 'Playfair Display', serif; font-style: italic; color: #B96F84; font-weight: 600;">Punya
                    ide sendiri?</span>
                Chat kami untuk pesan custom sesuai keinginanmu.
            </p>
            <a href="https://wa.me/{{ config('services.whatsapp.number') }}?text={{ urlencode('Halo Bloomora, saya ingin memesan produk custom. Bisa dibantu?') }}"
                target="_blank" rel="noopener" class="btn text-white px-4 py-2 d-inline-flex align-items-center gap-2"
                style="background-color: #25D366; border-radius: 50px; font-size: 0.88rem; white-space: nowrap;">
                <span class="fa fa-whatsapp"></span> Custom via WhatsApp
            </a>
        </div>

    </div>

    <style>
        .btn-detail-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-detail-lift:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(214, 51, 108, 0.35);
        }
    </style>
@endsection
