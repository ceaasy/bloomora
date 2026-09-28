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

    <div class="dashboard-banner-wrap">

        <div class="dashboard-banner-bg"></div>

        <div class="dashboard-banner-card">
            <div>
                <p class="dashboard-banner-date">
                    {{ strtoupper(now()->translatedFormat('l — d F Y')) }}
                </p>
                <h2 class="dashboard-banner-greeting">
                    {{ $sapaan }}, {{ auth()->user()->name }}
                </h2>
                <p class="dashboard-banner-sub">
                    Selamat bekerja, semoga hari ini lancar untuk Bloomora.
                </p>
            </div>

            <span class="dashboard-banner-monogram">B</span>
        </div>
    </div>

    <div class="d-flex align-items-end justify-content-between mb-4">
        <div>
            <h1 class="mb-0 section-head-title">Laporan Penjualan</h1>
            <div class="section-head-rule"></div>
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
            <div class="p-3 rounded-3 dashboard-stat-card">
                <p class="small text-muted mb-1">Jumlah Pesanan</p>
                <p class="h4 fw-bold mb-0 dashboard-stat-value">{{ $jumlahPesanan }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 rounded-3 dashboard-stat-card">
                <p class="small text-muted mb-1">Produk Terjual</p>
                <p class="h4 fw-bold mb-0 dashboard-stat-value">{{ $produkTerjual }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 rounded-3 dashboard-stat-card">
                <p class="small text-muted mb-1">Total Penjualan</p>
                <p class="h4 fw-bold mb-0 dashboard-stat-value">Rp{{ number_format($totalPenjualan, 0, ',', '.') }}</p>
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
