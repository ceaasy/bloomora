@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'DASHBOARD')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0" style="color: #4A3F3F;">Laporan Penjualan</h1>

        <form action="{{ route('admin.dashboard.index') }}" method="GET" class="d-flex gap-2">
            <select name="bulan" class="form-select" onchange="this.form.submit()">
                @php
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
