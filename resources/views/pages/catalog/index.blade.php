@extends('layouts.customer')

@section('title', 'Katalog Produk')

@section('content')
    <div class="container py-4">

        <div class="mb-4">
            <h4 class="fw-bold mb-1" style="color: #4A3F3F;">
                Catalog <span style="color: #D6336C;">Products</span>
            </h4>
            <p class="text-muted small mb-2">Temukan buket dan hampers terbaik untuk momen spesialmu</p>
            <div style="width: 60px; height: 4px; background-color: #D6336C; border-radius: 2px;"></div>
        </div>

        <form action="{{ route('customer.catalog.index') }}" method="GET"
            class="d-flex flex-wrap gap-2 mb-4 align-items-center">

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
                Bouquet
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
                        <img src="{{ asset('storage/' . $product->photo) }}" class="card-img-top rounded-top-4"
                            alt="{{ $product->name }}" style="height: 260px; width: 100%; object-fit: cover;">
                        <div class="card-body">
                            <p class="mb-1 small fw-semibold" style="color: #4A3F3F;">{{ $product->name }}</p>
                            <p class="mb-3 small text-muted">Rp{{ number_format($product->price_small, 0, ',', '.') }}</p>
                            <a href="#" class="btn btn-sm rounded-pill w-100"
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
            {{ $products->links() }}
        </div>

    </div>
@endsection
