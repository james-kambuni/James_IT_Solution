<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\County;
use App\Models\Region;
use App\Services\CartService;
use App\Services\MpesaService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // 🧾 List all orders in admin panel
    public function index()
    {
        $orders = Order::with(['user', 'items.product'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // 🔄 Update order status
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,cancelled'
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    // 🚚 Delivery page (form for order)
    public function delivery(CartService $cartService)
    {
        $cart = $cartService->getCart();
        $cartItems = $cart->items()->with('product')->get();
        $subtotal = $cartItems->sum(fn($item) => $item->price * $item->quantity);
        $shipping = 0;
        $total = $subtotal + $shipping;

        $counties = County::with('regions')->get();

        return view('orders.delivery', compact('cartItems', 'subtotal', 'shipping', 'total', 'counties'));
    }

    // 🛒 Place an order
    public function placeOrder(Request $request, CartService $cartService)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'county' => 'required|string',
            'region' => 'nullable|string',
            'order_notes' => 'nullable|string',
            'agreed_to_terms' => 'accepted',
            'location_id' => 'required|exists:locations,id',
        ]);

        $user = auth()->user();
        $cart = $cartService->getCart();
        $cartItems = $cart->items()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Cart is empty.');
        }

        $location = \App\Models\Location::find($request->location_id);
        $shipping = $location->shipping_fee;
        $subtotal = $cartItems->sum(fn($item) => $item->price * $item->quantity);
        $total = $subtotal + $shipping;

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => $user->id,
                'location_id' => $location->id,
                'shipping' => $shipping,
                'total' => $total,
                'status' => 'pending',
                'fullname' => $request->fullname,
                'phone' => $request->phone,
                'email' => $request->email,
                'county' => $request->county,
                'region' => $request->region,
                'order_notes' => $request->order_notes,
                'agreed_to_terms' => $request->has('agreed_to_terms'),
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);
            }

            $cartService->clearCart();
            DB::commit();

         return redirect()->route('orders.thankyou', [
            'method' => 'M-Pesa',
            'total' => $total
        ])->with('success', 'Order placed successfully!');


        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    // 🧾 Show receipt in browser
    public function showReceipt($id)
    {
        $order = Order::with('items.product', 'location')->findOrFail($id);
        return view('orders.receipt', compact('order'));
    }

    // 📄 Download PDF receipt
    public function downloadReceipt(Order $order)
    {
        $order->load(['items.product', 'location']);

        $pdf = Pdf::loadView('orders.receipt', compact('order'));
        return $pdf->download("Order_Receipt_{$order->id}.pdf");
    }

    // 📲 MPESA payment handler
    public function payWithMpesa(Request $request, MpesaService $mpesa)
    {
        $order = Order::where('user_id', auth()->id())->latest()->first();

        if (!$order) {
            return redirect()->back()->with('error', 'No order found.');
        }

        $phone = $request->input('phone'); // Ensure format is 2547XXXXXXX

        $response = $mpesa->stkPush($phone, $order->total, $order->id);

        if (isset($response['ResponseCode']) && $response['ResponseCode'] == '0') {
            return redirect()->route('orders.thankyou', ['order_id' => $order->id])
                ->with('success', 'M-Pesa prompt sent. Complete payment on your phone.');
        } else {
            return redirect()->back()->with('error', 'M-Pesa request failed: ' . ($response['errorMessage'] ?? 'Unknown error'));
        }
    }
}
