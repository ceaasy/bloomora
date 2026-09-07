<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentManagementController extends Controller
{
     public function index()
    {
        $payments=Payment::with('order.customer')->latest()->get();
        return view('pages.paymentmanagements.index', compact('payments'));
    }

   public function show(Payment $payment)
    {
        $payment->load( 'order');

        return view('pages.paymentmanagements.show', compact('payment'));
    }
    public function edit(Payment $payment)
    {
        return view('pages.paymentmanagements.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'status' => 'required|in:Belum Dibayar,Sudah Dibayar',
            'payment_date' => 'nullable|date',
        ], [
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status yang dipilih tidak valid.',
            'payment_date.date'=>'Format tanggal tidak valid'
        ]);

        $payment->update([
            'status' => $request->status,
            'payment_date' => $request->status === 'Sudah Dibayar' ? $request->payment_date ?? now() : null,
        ]);

        return redirect()->route('admin.paymentmanagements.index')
            ->with('success', 'Status pesanan(Pembayaran) berhasil diperbarui');
    }
}
