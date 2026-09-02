<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $selectedIds = $request->selected_carts;

        if (empty($selectedIds)) {
            return redirect()->route('customer.carts.index')
                ->with('error', 'Pilih minimal 1 produk untuk checkout.');
        }

        $carts = Cart::with('product')
            ->where('customer_id', auth('customer')->id())
            ->whereIn('id', $selectedIds)
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('customer.carts.index')
                ->with('error', 'Keranjang kamu masih kosong.');
        }

        $subtotal = 0;
        foreach ($carts as $cart) {
            $hargaSatuan = match ($cart->size) {
                'Small' => $cart->product->price_small,
                'Medium' => $cart->product->price_medium,
                'Large' => $cart->product->price_large,
            };
            $hargaKustomisasi = collect($cart->customization_selected)->sum('price');
            $subtotal += ($hargaSatuan + $hargaKustomisasi) * $cart->quantity;
        }

        return view('pages.checkout.index', compact('carts', 'subtotal', 'selectedIds'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'recipient_name' => 'required|string|max:64',
            'recipient_phone' => 'required|string|max:25',
            'pickup_method' => 'required|in:Ambil di Toko,Dikirim',
            'shipping_address' => 'required_if:pickup_method,Dikirim|nullable|string',
            'delivery_date' => 'required|date',
            'order_notes' => 'nullable|string',
            'greeting_card' => 'nullable|string',
            'reference_photo' => 'nullable|image|max:2048',
        ], [
            'recipient_name.required' => 'Nama penerima wajib diisi.',
            'recipient_phone.required' => 'Nomor telepon wajib diisi.',
            'pickup_method.required' => 'Pilih metode pengambilan.',
            'shipping_address.required_if' => 'Alamat pengiriman wajib diisi kalau metode dikirim.',
            'delivery_date.required' => 'Tanggal pengiriman/pengambilan wajib diisi.',
            'delivery_date.date' => 'Format tanggal tidak valid.',
            'reference_photo.image' => 'File yang diupload harus berupa gambar.',
            'reference_photo.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        $selectedIds = $request->selected_carts;

        $carts = Cart::with('product')
            ->where('customer_id', auth('customer')->id())
            ->whereIn('id', $selectedIds)
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('customer.carts.index')->with('error', 'Keranjang kamu masih kosong.');
        }

        $fotoPath = null;
        if ($request->hasFile('reference_photo')) {
            $fotoPath = $request->file('reference_photo')->store('reference_photos', 'public');
        }

        $subtotal = 0;
        foreach ($carts as $cart) {
            $hargaSatuan = match ($cart->size) {
                'Small' => $cart->product->price_small,
                'Medium' => $cart->product->price_medium,
                'Large' => $cart->product->price_large,
            };
            $hargaKustomisasi = collect($cart->customization_selected)->sum('price');
            $subtotal += ($hargaSatuan + $hargaKustomisasi) * $cart->quantity;
        }

        $shippingCost = $request->pickup_method === 'Dikirim' ? 15000 : 0;
        $total = $subtotal + $shippingCost;

        $order = DB::transaction(function () use ($request, $carts, $subtotal, $shippingCost, $total, $fotoPath, $selectedIds) {

            $order = Order::create([
                'customer_id' => auth('customer')->id(),
                'recipient_name' => $request->recipient_name,
                'recipient_phone' => $request->recipient_phone,
                'pickup_method' => $request->pickup_method,
                'shipping_address' => $request->shipping_address,
                'delivery_date' => $request->delivery_date,
                'order_notes' => $request->order_notes,
                'reference_photo' => $fotoPath,
                'greeting_card' => $request->greeting_card,
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'total_price' => $total,
                'status' => 'Diproses',
            ]);

            foreach ($carts as $cart) {
                $hargaSatuan = match ($cart->size) {
                    'Small' => $cart->product->price_small,
                    'Medium' => $cart->product->price_medium,
                    'Large' => $cart->product->price_large,
                };
                $hargaKustomisasi = collect($cart->customization_selected)->sum('price');
                $subtotalItem = ($hargaSatuan + $hargaKustomisasi) * $cart->quantity;

                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'size' => $cart->size,
                    'quantity' => $cart->quantity,
                    'customization_selected' => $cart->customization_selected,
                    'unit_price' => $hargaSatuan + $hargaKustomisasi,
                    'subtotal' => $subtotalItem,
                ]);
            }

            Payment::create([
                'order_id' => $order->id,
                'payment_method' => 'Cash',
                'amount' => $order->total_price,
                'payment_date' => null,
                'status' => 'Belum Dibayar',
            ]);

            Shipment::create([
                'order_id' => $order->id,
                'tracking_number' => null,
                'status' => $request->pickup_method === 'Dikirim' ? 'Belum Dikirim' : 'Siap Diambil',
            ]);

            Cart::whereIn('id', $selectedIds)->delete();

            return $order;
        });

        return redirect()->route('customer.checkout.success', $order->id);
    }

    public function success($orderId)
    {
        $order = Order::findOrFail($orderId);

        return view('pages.checkout.success', compact('order'));
    }
}