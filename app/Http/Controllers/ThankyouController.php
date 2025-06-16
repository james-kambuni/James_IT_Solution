<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ThankyouController extends Controller
{
    public function index(Request $request)
    {
        $total = $request->get('total') ?? 0;
        $order = Order::with('items.product', 'location')->findOrFail($request->order_id);
        return view('thankyou', compact('order','total'));
    }
}

