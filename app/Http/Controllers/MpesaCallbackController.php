<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class MpesaCallbackController extends Controller
{
    public function handle(Request $request)
    {
        $data = $request->input('Body.stkCallback');

        if ($data['ResultCode'] == 0) {
            $orderRef = $data['CallbackMetadata']['Item'][0]['Value'] ?? null;

            $order = Order::where('id', $orderRef)->first();

            if ($order) {
                $order->status = 'paid';
                $order->save();
            }
        }
    }
}
