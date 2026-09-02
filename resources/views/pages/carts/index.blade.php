@extends('layouts.customer')

@section('title', 'Keranjang Saya')

@section('content')
    <div class="container py-4">

        <h3 class="fw-bold mb-4" style="color: #D6336C;">Keranjang Saya</h3>

        @if ($carts->isEmpty())
            <p class="text-muted">Keranjang kamu masih kosong.</p>
        @else
            <form action="{{ route('customer.checkout.index') }}" method="GET" id="checkoutForm">
            </form>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered table-hover align-middle">
                        <thead>
                            <tr style="background-color: #FBE3EC;">
                                <th>
                                    <input type="checkbox" id="checkAll" onchange="toggleAll(this)">
                                </th>
                                <th>Produk</th>
                                <th>Ukuran</th>
                                <th>Qty</th>
                                <th>Kustomisasi</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
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

                                    $hargaKustomisasi = collect($cart->customization_selected ?? [])->sum('price');

                                    $subtotal = ($hargaSatuan + $hargaKustomisasi) * $cart->quantity;
                                @endphp

                                <tr>
                                    <td>
                                        <input type="checkbox" class="cart-checkbox" name="selected_carts[]"
                                            value="{{ $cart->id }}" data-subtotal="{{ $subtotal }}"
                                            form="checkoutForm" onchange="hitungTotal()">
                                    </td>

                                    <td>
                                        {{ $cart->product->name }}
                                    </td>

                                    <td>
                                        {{ $cart->size }}
                                    </td>

                                    <td>
                                        <form action="{{ route('customer.carts.update', $cart->id) }}" method="POST"
                                            class="d-flex align-items-center gap-1">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit" name="quantity" value="{{ max(1, $cart->quantity - 1) }}"
                                                class="btn btn-sm" style="border: 1px solid #D6336C;">
                                                -
                                            </button>

                                            <span class="mx-1">
                                                {{ $cart->quantity }}
                                            </span>

                                            <button type="submit" name="quantity" value="{{ $cart->quantity + 1 }}"
                                                class="btn btn-sm" style="border: 1px solid #D6336C;">
                                                +
                                            </button>
                                        </form>
                                    </td>

                                    <td>
                                        @foreach ($cart->customization_selected ?? [] as $opt)
                                            <div class="small">
                                                {{ $opt['name'] }}
                                            </div>
                                        @endforeach
                                    </td>

                                    <td>
                                        Rp{{ number_format($subtotal, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        <form action="{{ route('customer.carts.destroy', $cart->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus produk ini dari keranjang?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-link text-danger p-0">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex flex-column align-items-end gap-2 mt-4">

                <div class="px-4 py-2 rounded-3" style="border: 1px solid #D6336C; color: #D6336C;">
                    Total:
                    <span id="totalKeranjang">Rp0</span>
                </div>

                <button type="submit" form="checkoutForm" class="btn rounded-pill px-4"
                    style="background-color: #D6336C; color: white;">
                    Checkout
                </button>

            </div>

        @endif

    </div>

    <script>
        function hitungTotal() {
            let total = 0;

            document.querySelectorAll('.cart-checkbox:checked').forEach(cb => {
                total += parseFloat(cb.dataset.subtotal);
            });

            document.getElementById('totalKeranjang').textContent =
                'Rp' + total.toLocaleString('id-ID');
        }

        function toggleAll(source) {
            document.querySelectorAll('.cart-checkbox').forEach(cb => {
                cb.checked = source.checked;
            });

            hitungTotal();
        }
    </script>
@endsection
