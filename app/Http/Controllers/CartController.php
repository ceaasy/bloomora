<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::with('product')->where('customer_id', auth('customer')->id())->get();

        return view('pages.carts.index', compact('carts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $productId)
    {
        $this->simpanKeCart($request, $productId);

        return redirect()->route('customer.carts.index')->with('success', 'Produk ditambahkan ke keranjang');
    }

    public function buyNow(Request $request, $productId)
    {
        $cart = $this->simpanKeCart($request, $productId);

        return redirect()->route('customer.checkout.index', ['selected_carts' => [$cart->id]]);
    }

     private function simpanKeCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $request->validate([
            'size' => 'required|in:Small,Medium,Large',
            'quantity' => 'required|integer|min:1',
            'customizations' => 'nullable|array',
        ], [
            'size.required' => 'Pilih ukuran produk terlebih dahulu.',
            'size.in' => 'Ukuran yang dipilih tidak valid.',
            'quantity.required' => 'Jumlah produk harus diisi.',
            'quantity.min' => 'Jumlah produk minimal 1.',
        ]);

        $selectedCustomizations = [];
        if ($request->filled('customizations')) {
            foreach ($request->customizations as $index) {
                if (isset($product->customization_options[$index])) {
                    $selectedCustomizations[] = $product->customization_options[$index];
                }
            }
        }

        return Cart::create([
            'customer_id' => auth('customer')->id(),
            'product_id' => $product->id,
            'size' => $request->size,
            'quantity' => $request->quantity,
            'customization_selected' => $selectedCustomizations,
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ], [
            'quantity.min' => 'Jumlah produk minimal 1.',
        ]);

        $cart->update(['quantity' => $request->quantity]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();

        return back()->with('success', 'Produk dihapus dari keranjang');
    }
}