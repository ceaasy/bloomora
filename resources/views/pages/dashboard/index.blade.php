@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'DASHBOARD')

@section('content')
    @php
        $jam = now()->format('H');
        if ($jam < 11) {
            $sapaan = 'Selamat Pagi';
        } elseif ($jam < 15) {
            $sapaan = 'Selamat Siang';
        } elseif ($jam < 19) {
            $sapaan = 'Selamat Sore';
        } else {
            $sapaan = 'Selamat Malam';
        }

        $namaBulan = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
    @endphp

    <div style="position: relative; padding: 14px 30px 26px 6px; margin-bottom: 28px;">

        <div
            style="position: absolute; top: 20px; left: 14px; right: 20px; bottom: 20px;
                    background: #FBE3EC; border-radius: 14px; transform: rotate(-1.2deg); z-index: 0;">
        </div>

        <div
            style="position: relative; z-index: 1; background: #FFFAF7; border-radius: 14px;
                    padding: 1.5rem 1.9rem 1.75rem 1.9rem; box-shadow: 0 12px 24px rgba(74,63,63,0.09);
                    display: flex; align-items: center; justify-content: space-between; gap: 20px; overflow: visible;">
            <div>
                <p
                    style="text-transform: uppercase; letter-spacing: 1.2px; font-size: 0.68rem; font-weight: 700;
                          color: #4C6B4F; margin-bottom: 0.5rem;">
                    {{ strtoupper(now()->translatedFormat('l — d F Y')) }}
                </p>
                <h2
                    style="font-family: 'Playfair Display', serif; font-style: italic; font-weight: 600;
                           font-size: 1.65rem; line-height: 1.15; color: #4A3F3F; margin: 0 0 0.35rem 0;">
                    {{ $sapaan }}, {{ auth()->user()->name }}
                </h2>
                <p style="font-size: 0.9rem; color: #4A3F3F; opacity: 0.62; margin: 0;">
                    Selamat bekerja, semoga hari ini lancar untuk Bloomora.
                </p>
            </div>

            <span
                style="position: absolute; z-index: 2; right: -6px; bottom: -14px;
                         font-family: 'Playfair Display', serif; font-style: italic; font-weight: 600;
                         font-size: 3.6rem; line-height: 1; color: #D6336C; opacity: 0.15;
                         pointer-events: none; user-select: none;">B</span>
        </div>
    </div>

    <div class="d-flex align-items-end justify-content-between mb-4">
        <div>
            <h1 class="mb-0"
                style="font-family: 'Playfair Display', serif; font-style: italic; font-weight: 600;
                font-size: 1.7rem; color: #4A3F3F;">
                Laporan Penjualan</h1>
            <div style="width: 34px; height: 2px; background: #D6336C; margin-top: 6px;"></div>
        </div>

        <form action="{{ route('admin.dashboard.index') }}" method="GET" class="d-flex gap-2">
            <select name="bulan" class="form-select" onchange="this.form.submit()">
                @foreach ($namaBulan as $index => $nama)
                    <option value="{{ $index + 1 }}" {{ $bulan == $index + 1 ? 'selected' : '' }}>{{ $nama }}
                    </option>
                @endforeach
            </select>
            <input type="hidden" name="tahun" value="{{ $tahun }}">
        </form>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="p-3 rounded-3" style="background-color: #FBE3EC;">
                <p class="small text-muted mb-1">Jumlah Pesanan</p>
                <p class="h4 fw-bold mb-0" style="color: #D6336C;">{{ $jumlahPesanan }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 rounded-3" style="background-color: #FBE3EC;">
                <p class="small text-muted mb-1">Produk Terjual</p>
                <p class="h4 fw-bold mb-0" style="color: #D6336C;">{{ $produkTerjual }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 rounded-3" style="background-color: #FBE3EC;">
                <p class="small text-muted mb-1">Total Penjualan</p>
                <p class="h4 fw-bold mb-0" style="color: #D6336C;">Rp{{ number_format($totalPenjualan, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-7">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="fw-semibold mb-3">Grafik Penjualan</p>
                    <canvas id="grafikPenjualan"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="fw-semibold mb-3">Produk Terlaris</p>
                    <canvas id="grafikTerlaris"></canvas>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        const grafikPenjualan = @json($grafikPenjualan);
        const produkTerlaris = @json($produkTerlaris);

        const labelTanggal = grafikPenjualan.map(item => 'Tgl ' + item.tanggal);
        const dataTotal = grafikPenjualan.map(item => item.total);

        new Chart(document.getElementById('grafikPenjualan'), {
            type: 'line',
            data: {
                labels: labelTanggal,
                datasets: [{
                    label: 'Total Penjualan',
                    data: dataTotal,
                    borderColor: '#D6336C',
                    backgroundColor: 'rgba(214, 51, 108, 0.1)',
                    tension: 0.3,
                    fill: true,
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        const labelProduk = produkTerlaris.map(item => item.category);
        const dataTerjual = produkTerlaris.map(item => item.total_terjual);

        new Chart(document.getElementById('grafikTerlaris'), {
            type: 'bar',
            data: {
                labels: labelProduk,
                datasets: [{
                    label: 'Jumlah Terjual',
                    data: dataTerjual,
                    backgroundColor: '#D6336C',
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
@endpush
