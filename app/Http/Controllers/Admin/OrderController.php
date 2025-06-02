<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Services\MpesaService;


class OrderController extends Controller
{
    // View all orders in the admin panel
    public function index()
    {
        $orders = Order::with(['user', 'items.product'])->latest()->get();

        return view('admin.orders.index', compact('orders'));
    }

    // Handle order checkout
   public function checkout(Request $request, CartService $cartService)
{
    $user = auth()->user();
    $cart = $cartService->getCart();
    $cartItems = $cart->items()->with('product')->get();

    if ($cartItems->isEmpty()) {
        return redirect()->back()->with('error', 'Cart is empty.');
    }

    DB::beginTransaction();

    try {
        $total = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $order = Order::create([
            'user_id' => $user->id,
            'total' => $total,
            'status' => 'pending',
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);
        }

        $cartService->clearCart(); // ✅ Clear after placing order

        DB::commit();

        return redirect()->route('orders.thankyou')->with('success', 'Order placed successfully!');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
    }

}
public function payWithMpesa(Request $request, MpesaService $mpesa)
{
    $order = Order::where('user_id', auth()->id())->latest()->first();

    if (!$order) {
        return redirect()->back()->with('error', 'No order found.');
    }

    $phone = $request->input('phone'); // Ensure it's in 2547XXXXXXXX format

    $response = $mpesa->stkPush($phone, $order->total, $order->id);

    if (isset($response['ResponseCode']) && $response['ResponseCode'] == '0') {
        return redirect()->route('orders.thankyou')->with('success', 'M-Pesa prompt sent. Complete payment on your phone.');
    } else {
        return redirect()->back()->with('error', 'M-Pesa request failed: ' . ($response['errorMessage'] ?? 'Unknown error'));
    }
}
}
