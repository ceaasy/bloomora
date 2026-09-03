<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders= Order::with('orderDetails.product')->where('customer_id', auth('customer')->id())->get();

        return view('pages.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order=Order::findOrFail($id);
            if ($order->customer_id !== auth('customer')->id()) {
            abort(403);
        }
        $order->load('orderDetails.product','payment','shipment');
        return view('pages.orders.show', compact('order'));
    }
}
