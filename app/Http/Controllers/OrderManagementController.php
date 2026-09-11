<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use SebastianBergmann\Complexity\ComplexityCalculatingVisitor;

class OrderManagementController extends Controller
{
    public function index()
    {
        $orders=Order::with('customer')->latest()->get();
        return view('pages.ordermanagements.index', compact('orders'));
    }

   public function show(Order $order)
    {
        $order->load('orderDetails.product', 'payment', 'shipment', 'customer');

        return view('pages.ordermanagements.show', compact('order'));
    }
    public function edit(Order $order)
    {
        return view('pages.ordermanagements.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:Diproses,Disiapkan,Siap Diambil/Dikirim,Selesai',
        ], [
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status yang dipilih tidak valid.',
        ]);

        $order->update(['status' => $request->status]);

        if ($request->status === 'Selesai') {
            $order->payment->update(['status' => 'Sudah Dibayar', 'payment_date' => $order->payment->payment_date ?? now()]);
            $order->shipment->update(['status' => 'Selesai']);
        }

        return redirect()->route('admin.ordermanagements.index')
            ->with('success', 'Status pesanan berhasil diperbarui');
    }

}
