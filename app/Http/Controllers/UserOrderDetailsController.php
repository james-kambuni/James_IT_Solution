<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class UserOrderDetailsController extends Controller
{
    public function index()
    {
        $orders = Order::with('cartItems.product')
                       ->where('user_id', Auth::id())
                       ->latest()
                       ->get();

        return view('user.dashboard', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('cartItems.product')->findOrFail($id);

        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('user.orders.show', compact('order'));
    }
}
