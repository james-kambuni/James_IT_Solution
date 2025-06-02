<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MpesaController extends Controller
{
    public function handleCallback(Request $request)
    {
        \Log::info('M-Pesa Callback:', $request->all());

        // You can verify and update order status here based on $request->input('Body.stkCallback')
    }
}
