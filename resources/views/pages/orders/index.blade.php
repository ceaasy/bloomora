@extends('layouts.customer')

@section('title', 'Riwayat Pesanan')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0" style="color: #c57b7b;">Riwayat Pesanan anda</h1>
    </div>

    @if ($orders->isEmpty())
        <p class="text-muted">Kamu Belum Pernah Melakukan Pesanan.</p>
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <table class="table table-bordered table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Pesanan</th>
                            <th>Produk</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($orders as $order)
                            @php
                                $produkPertama = $order->orderDetails->first();
                                $sisaProduk = $order->orderDetails->count() - 1;
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>#BLM-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td>
                                    {{ $produkPertama->product->name }} ({{ $produkPertama->size }})
                                    x{{ $produkPertama->quantity }}
                                    @if ($sisaProduk > 0)
                                        <span class="text-muted">+{{ $sisaProduk }} lainnya</span>
                                    @endif
                                </td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                <td>Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge rounded-pill" style="background-color: #FBE3EC; color: #B96F84;">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('customer.orders.show', $order->id) }}" class="btn btn-link p-0"
                                        style="color: #000000;">
                                        <span class="fa fa-eye"></span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    @endif
@endsection
