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
        return view('pages.shipmentmanagements.edit', compact('shipment'));
    }

    public function update(Request $request, Shipment $shipment)
    {
        $request->validate([
            'tracking_number' => 'nullable|string',
            'status' => 'required|in:Menunggu,Dikirim,Siap Diambil,Selesai',
        ], [
            'tracking_number.string' => 'Nomor resi harus berupa teks.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status yang dipilih tidak valid.',
        ]);

        $shipment->update([
            'tracking_number'=> $request->tracking_number,
            'status' => $request->status
        ]);

        return redirect()->route('admin.shipmentmanagements.index')
            ->with('success', 'Status pesanan(Pengiriman) berhasil diperbarui');
    }
}
