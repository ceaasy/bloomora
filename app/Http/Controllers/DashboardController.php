<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        $orders = Order::whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->get();

        $jumlahPesanan = $orders->count();
        $totalPenjualan = $orders->sum('total_price');

        $produkTerjual = OrderDetail::whereHas('order', function ($query) use ($bulan, $tahun) {
            $query->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun);
        })->sum('quantity');


        $grafikPenjualan = Order::whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->selectRaw('DAY(created_at) as tanggal, SUM(total_price) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $produkTerlaris = OrderDetail::whereHas('order', function ($query) use ($bulan, $tahun) {
                $query->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun);
            })
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->selectRaw('products.category, SUM(order_details.quantity) as total_terjual')
            ->groupBy('products.category')
            ->orderByDesc('total_terjual')
            ->get();

        return view('pages.dashboard.index', compact(
            'jumlahPesanan', 'totalPenjualan', 'produkTerjual',
            'grafikPenjualan', 'produkTerlaris', 'bulan', 'tahun'
        ));
    }
}
