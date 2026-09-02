@extends('layouts.customer')

@section('title', $product->name)

@section('content')
    <div class="container py-4">
        <a href="{{ route('customer.catalog.index') }}" class="text-decoration-none mb-3 d-inline-block"
            style="color: #B96F84;">
            <span class="fa fa-arrow-left"></span> Kembali ke Katalog
        </a>


        <div class="row g-4">
            <div class="col-md-5">
                <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}"
                    class="img-fluid rounded-4 w-100" style="object-fit: cover; max-height: 500px;">
            </div>

            <div class="col-md-7">
                <h2 class="mb-4" style="color: #ea88b3; font-weight: 800; letter-spacing: -0.5px; font-size: 2.3rem;">
                    {{ $product->name }}
                </h2>
                <p class="text-muted mb-3">Kategori: {{ $product->category }}</p>

                <div class="p-3 rounded-3 mb-4" style="background-color: #FFFAF7; border: 1px solid #FBE3EC;">
                    {{ $product->description }}
                </div>

                <form action="{{ route('customer.cart.store', $product->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="size" id="selectedSize" value="Small">

                    <p class="fw-semibold mb-2" style="color: #4A3F3F;">Pilih Ukuran & Harga</p>
                    <div class="d-flex gap-2 mb-4">
                        <button type="button" class="btn size-option rounded-3 flex-fill" data-size="Small"
                            data-price="{{ $product->price_small }}" style="background-color: #D6336C; color: white;">
                            Small<br><small>Rp{{ number_format($product->price_small, 0, ',', '.') }}</small>
                        </button>
                        <button type="button" class="btn size-option rounded-3 flex-fill" data-size="Medium"
                            data-price="{{ $product->price_medium }}" style="border: 1px solid #D6336C; color: #4A3F3F;">
                            Medium<br><small>Rp{{ number_format($product->price_medium, 0, ',', '.') }}</small>
                        </button>
                        <button type="button" class="btn size-option rounded-3 flex-fill" data-size="Large"
                            data-price="{{ $product->price_large }}" style="border: 1px solid #D6336C; color: #4A3F3F;">
                            Large<br><small>Rp{{ number_format($product->price_large, 0, ',', '.') }}</small>
                        </button>
                    </div>

                    @if ($product->customization_options)
                        <p class="fw-semibold mb-2" style="color: #4A3F3F;">Custom:</p>
                        <div class="mb-4">
                            @foreach ($product->customization_options as $option)
                                <div class="form-check mb-1">
                                    <input class="form-check-input" type="checkbox" name="customizations[]"
                                        id="custom_{{ $loop->index }}" value="{{ $loop->index }}">
                                    <label class="form-check-label" for="custom_{{ $loop->index }}">
                                        {{ $option['name'] }}
                                        <span
                                            class="text-muted">+Rp{{ number_format($option['price'], 0, ',', '.') }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <p class="fw-semibold mb-2" style="color: #4A3F3F;">Jumlah:</p>
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <button type="button" class="btn btn-sm" style="border: 1px solid #D6336C;"
                            onclick="ubahJumlah(-1)">-</button>
                        <input type="text" name="quantity" id="jumlahProduk" value="1" readonly
                            class="text-center border-0" style="width: 30px;">
                        <button type="button" class="btn btn-sm" style="border: 1px solid #D6336C;"
                            onclick="ubahJumlah(1)">+</button>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn rounded-pill flex-fill py-2"
                            style="background-color: #D6336C; color: white;">
                            Checkout
                        </button>
                        <button type="submit" class="btn rounded-pill flex-fill py-2"
                            style="border: 1px solid #B96F84; color: #B96F84;">
                            + Keranjang
                        </button>
                    </div>
                </form>
            </div>
                <div class="mt-5 pt-4" style="border-top: 2px solid #FBE3EC;">

                    <span class="badge rounded-pill px-3 py-2 mb-3 d-inline-block"
                        style="background-color: #FBE3EC; color: #B96F84; font-size: 0.9rem;">
                        Ulasan
                    </span>

                    <div class="p-3 rounded-3" style="background-color: white; border: 1px solid #FBE3EC;">
                        <p class="mb-0 text-muted">Belum ada ulasan untuk produk ini.</p>
                    </div>
                </div>

                <script>
                    let jumlah = 1;

                    function ubahJumlah(delta) {
                        jumlah = Math.max(1, jumlah + delta);
                        document.getElementById('jumlahProduk').value = jumlah;
                    }

                    document.querySelectorAll('.size-option').forEach(btn => {
                        btn.addEventListener('click', function() {
                            document.querySelectorAll('.size-option').forEach(b => {
                                b.style.backgroundColor = 'transparent';
                                b.style.color = '#4A3F3F';
                            });
                            this.style.backgroundColor = '#D6336C';
                            this.style.color = 'white';
                            document.getElementById('selectedSize').value = this.dataset.size;
                        });
                    });
                </script>
            @endsection
