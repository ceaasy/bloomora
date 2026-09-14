<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentManagementController extends Controller
{
    public function index()
    {
        $shipments=Shipment::with('order.customer')->latest()->get();
        return view('pages.shipmentmanagements.index', compact('shipments'));
    }

    public function show(Shipment $shipment)
    {
        $shipment->load( 'order');

        return view('pages.shipmentmanagements.show', compact('shipment'));
    }
    public function edit(Shipment $shipment)
    {
        $shipment->load('order.orderDetails.product', 'order.customer', 'order.payment');

        return view('pages.shipmentmanagements.edit', compact('shipment'));
    }

    public function update(Request $request, Shipment $shipment)
    {
        $shipment->load('order.payment');

        $request->validate([
            'tracking_number' => 'nullable|string',
            'status' => 'required|in:Menunggu,Dikirim,Siap Diambil,Selesai',
        ], [
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status yang dipilih tidak valid.',
        ]);

        if ($request->status !== 'Menunggu'
            && !in_array($shipment->order->status, ['Siap Diambil/Dikirim', 'Selesai'])) {
            return back()->with('error', 'Pesanan belum mencapai status "Siap Diambil/Dikirim", status pengiriman belum bisa diperbarui.');
        }

        if ($shipment->order->pickup_method === 'Dikirim'
            && in_array($request->status, ['Dikirim', 'Selesai'])
            && empty($request->tracking_number)) {
            return back()
                ->withErrors(['tracking_number' => 'Nomor resi wajib diisi untuk pesanan dengan metode pengiriman.'])
                ->withInput();
        }

        $shipment->update([
            'tracking_number' => $shipment->order->pickup_method === 'Dikirim' ? $request->tracking_number : null,
            'status' => $request->status,
        ]);

        if ($request->status === 'Selesai') {
            $shipment->order->update(['status' => 'Selesai']);
            $shipment->order->payment->update([
                'status' => 'Sudah Dibayar',
                'payment_date' => $shipment->order->payment->payment_date ?? now(),
            ]);
        }

        return redirect()->route('admin.shipmentmanagements.index')
            ->with('success', 'Status pesanan (Pengiriman) berhasil diperbarui');
    }
}
