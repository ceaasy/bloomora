@extends('layouts.customer')

@section('title', 'Checkout')

@section('content')
    <div class="container py-4">

        <h3 class="fw-bold mb-4" style="color: #D6336C;">Checkout</h3>

        <form action="{{ route('customer.checkout.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @foreach ($selectedIds as $id)
                <input type="hidden" name="selected_carts[]" value="{{ $id }}">
            @endforeach

            <div class="row g-4">
                <div class="col-md-7">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Penerima</label>
                            <input type="text" name="recipient_name" value="{{ old('recipient_name') }}"
                                class="form-control @error('recipient_name') is-invalid @enderror">
                            @error('recipient_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" name="recipient_phone" value="{{ old('recipient_phone') }}"
                                class="form-control @error('recipient_phone') is-invalid @enderror">
                            @error('recipient_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label d-block">Metode Pengambilan</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pickup_method" value="Ambil di Toko"
                                id="ambilToko" checked onclick="toggleAlamat()">
                            <label class="form-check-label" for="ambilToko">Ambil di Toko</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pickup_method" value="Dikirim"
                                id="dikirim" onclick="toggleAlamat()">
                            <label class="form-check-label" for="dikirim">Dikirim</label>
                        </div>
                    </div>

                    <div class="mb-3" id="alamatWrapper" style="display: none;">
                        <label class="form-label">Alamat Pengiriman</label>
                        <textarea name="shipping_address" class="form-control" rows="2">{{ old('shipping_address') }}</textarea>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Pengiriman/Pengambilan</label>
                            <input type="date" name="delivery_date" value="{{ old('delivery_date') }}"
                                class="form-control @error('delivery_date') is-invalid @enderror">
                            @error('delivery_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kartu Ucapan (opsional)</label>
                            <input type="text" name="greeting_card" value="{{ old('greeting_card') }}"
                                class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Catatan Pesanan</label>
                        <textarea name="order_notes" class="form-control" rows="2">{{ old('order_notes') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload Foto Referensi (opsional)</label>
                        <input type="file" name="reference_photo" class="form-control" accept="image/*">
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="p-4 rounded-4" style="background-color: #FFFAF7; border: 1px solid #FBE3EC;">
                        <h6 class="fw-bold mb-3" style="color: #D6336C;">Ringkasan Pesanan</h6>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal Produk</span>
                            <span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Ongkos Kirim</span>
                            <span id="ongkirDisplay">Rp0</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold mb-3" style="color: #D6336C;">
                            <span>TOTAL</span>
                            <span id="totalDisplay">Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <p class="small text-muted mb-4">Metode Pembayaran: Cash Saat Barang Dikirim/Diambil</p>

                        <button type="submit" class="btn w-100 rounded-pill py-2 mb-2"
                            style="background-color: #D6336C; color: white;">
                            Konfirmasi Pesanan
                        </button>
                        <a href="{{ route('customer.carts.index') }}" class="btn w-100 rounded-pill py-2"
                            style="border: 1px solid #B96F84; color: #B96F84;">
                            Batal
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3" style="color: #D6336C;">Rincian Item Pesanan</h6>

                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <table class="table table-bordered table-hover align-middle">
                            <thead>
                                <tr style="background-color: #FBE3EC;">
                                    <th>Produk</th>
                                    <th>Ukuran</th>
                                    <th>Qty</th>
                                    <th>Kustomisasi</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $cart)
                                    @php
                                        $hargaSatuan = match ($cart->size) {
                                            'Small' => $cart->product->price_small,
                                            'Medium' => $cart->product->price_medium,
                                            'Large' => $cart->product->price_large,
                                        };
                                        $hargaKustomisasi = collect($cart->customization_selected)->sum('price');
                                        $subtotalItem = ($hargaSatuan + $hargaKustomisasi) * $cart->quantity;
                                    @endphp
                                    <tr>
                                        <td>{{ $cart->product->name }}</td>
                                        <td>{{ $cart->size }}</td>
                                        <td>{{ $cart->quantity }}</td>
                                        <td>
                                            @foreach ($cart->customization_selected ?? [] as $opt)
                                                <div class="small">{{ $opt['name'] }}</div>
                                            @endforeach
                                        </td>
                                        <td>Rp{{ number_format($subtotalItem, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </form>
    </div>

    <script>
        const subtotal = {{ $subtotal }};

        function toggleAlamat() {
            const dikirim = document.getElementById('dikirim').checked;
            document.getElementById('alamatWrapper').style.display = dikirim ? 'block' : 'none';

            const ongkir = dikirim ? 15000 : 0;
            document.getElementById('ongkirDisplay').textContent = 'Rp' + ongkir.toLocaleString('id-ID');
            document.getElementById('totalDisplay').textContent = 'Rp' + (subtotal + ongkir).toLocaleString('id-ID');
        }
    </script>
@endsection
