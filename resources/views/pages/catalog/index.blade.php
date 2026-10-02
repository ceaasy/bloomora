@extends('layouts.customer')

@section('title', 'Katalog Produk')

@section('content')
    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <p class="mb-1 text-uppercase catalog-eyebrow">Bloomora</p>
                <h3 class="mb-1 catalog-title">
                    Koleksi untuk <em>Momen Spesial</em>
                </h3>
                <p class="mb-0 catalog-subtitle">Buket dan hampers yang bisa kamu pilih sesuai momen.</p>
            </div>

            <span class="d-none d-md-block catalog-tagline">Find something special ♡</span>
        </div>

        <form action="{{ route('customer.catalog.index') }}" method="GET"
            class="d-flex flex-wrap gap-2 mb-4 align-items-center">

            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif

            <div class="search-box">
                <input type="text" name="keyword" value="{{ request('keyword') }}"
                    class="form-control ps-4 pe-5 rounded-pill" placeholder="Cari Produk">
                <div class="search-actions">
                    @if (request('keyword'))
                        <a href="{{ route('customer.catalog.index', request()->except('keyword')) }}" class="search-clear"
                            title="Hapus pencarian">
                            <span class="fa fa-times"></span>
                        </a>
                    @else
                        <button type="submit" class="search-submit" title="Cari">
                            <span class="fa fa-search"></span>
                        </button>
                    @endif
                </div>
            </div>

            <a href="{{ route('customer.catalog.index', array_merge(request()->except('category'), [])) }}"
                class="btn rounded-pill px-4 filter-pill {{ !request('category') ? 'is-active' : '' }}">
                Semua
            </a>
            <a href="{{ route('customer.catalog.index', array_merge(request()->except('category'), ['category' => 'Buket'])) }}"
                class="btn rounded-pill px-4 filter-pill {{ request('category') == 'Buket' ? 'is-active' : '' }}">
                Buket
            </a>
            <a href="{{ route('customer.catalog.index', array_merge(request()->except('category'), ['category' => 'Hampers'])) }}"
                class="btn rounded-pill px-4 filter-pill {{ request('category') == 'Hampers' ? 'is-active' : '' }}">
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
                            <span class="position-absolute rounded-pill px-3 py-1 product-card-badge">
                                {{ $product->category }}
                            </span>
                        </div>
                        <div class="card-body">
                            <p class="mb-1 small fw-semibold product-card-name">{{ $product->name }}</p>
                            <p class="mb-3 small text-muted">
                                Mulai dari Rp{{ number_format($product->price_small, 0, ',', '.') }}
                            </p>
                            <a href="{{ route('customer.catalog.show', $product->id) }}"
                                class="btn btn-sm rounded-pill w-100 btn-detail-lift">
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

        <div class="rounded-pill d-flex align-items-center justify-content-between px-4 py-3 mt-4 whatsapp-cta"
            style="flex-wrap: wrap; gap: 12px;">
            <p class="mb-0" style="color: #4A3F3F; font-size: 0.95rem;">
                <span class="label">Punya ide sendiri?</span>
                Chat kami untuk pesan custom sesuai keinginanmu.
            </p>
            <a href="https://wa.me/{{ config('services.whatsapp.number') }}?text={{ urlencode('Halo Bloomora, saya ingin memesan produk custom. Bisa dibantu?') }}"
                target="_blank" rel="noopener" class="btn px-4 py-2 d-inline-flex align-items-center gap-2 btn-whatsapp"
                style="font-size: 0.88rem; white-space: nowrap;">
                <span class="fa fa-whatsapp"></span> Custom via WhatsApp
            </a>
        </div>

    </div>
@endsection
