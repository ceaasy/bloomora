<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create($orderId, $productId)
    {
        $order = Order::findOrFail($orderId);
        $product = Product::findOrFail($productId);

        if ($order->customer_id !== auth('customer')->id()) {
            abort(403);
        }

        if ($order->status !== 'Selesai') {
            abort(403, 'Pesanan belum selesai, belum bisa memberi ulasan.');
        }

        $sudahDiulas = Review::where('order_id', $order->id)
            ->where('product_id', $product->id)
            ->where('customer_id', auth('customer')->id())
            ->exists();

        if ($sudahDiulas) {
            return redirect()->route('customer.orders.show', $order->id)
                ->with('error', 'Produk ini sudah pernah diulas.');
        }

        return view('pages.reviews.create', compact('order', 'product'));
    }

    public function store(Request $request, $orderId, $productId)
    {
        $order = Order::findOrFail($orderId);
        $product = Product::findOrFail($productId);

        if ($order->customer_id !== auth('customer')->id()) {
            abort(403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ], [
            'rating.required' => 'Rating wajib diisi.',
        ]);

        $fotoPath = null;
        if ($request->hasFile('photo')) {
            $fotoPath = $request->file('photo')->store('review_photos', 'public');
        }

        Review::create([
            'product_id' => $product->id,
            'customer_id' => auth('customer')->id(),
            'order_id' => $order->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'photo' => $fotoPath,
        ]);

        return redirect()->route('customer.orders.show', $order->id)
            ->with('success', 'Terima kasih, ulasan kamu berhasil dikirim');
    }
}
