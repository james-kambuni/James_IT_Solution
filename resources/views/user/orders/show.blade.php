@extends('admin.layouts.user')

@section('title', 'Order Details')
@section('page-title', 'Order #'.$order->id)

@section('content')
    <div class="card p-4">
        <h4 class="mb-3">Order Summary</h4>
        <p><strong>Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
        <p>
            <strong>Status:</strong>
            <span class="badge 
                @if($order->status == 'pending') bg-warning 
                @elseif($order->status == 'completed') bg-success 
                @elseif($order->status == 'cancelled') bg-danger 
                @else bg-secondary 
                @endif">
                {{ ucfirst($order->status) }}
            </span>
        </p>
        <p><strong>Shipment:</strong> {{ $order->shipment_info ?? 'Pending' }}</p>

        <h5 class="mt-4">Items:</h5>
        <table class="table table-bordered mt-2">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td><img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" width="60"></td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Ksh{{ number_format($item->price, 2) }}</td>
                        <td>Ksh{{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4 text-end">
            <p><strong>Subtotal:</strong> Ksh{{ number_format($order->total, 2) }}</p>
            <p><strong>Shipping:</strong> Ksh{{ number_format($order->shipping_fee ?? 0, 2) }}</p>
            <h5><strong>Grand Total:</strong> Ksh{{ number_format($order->total + ($order->shipping_fee ?? 0), 2) }}</h5>
        </div>
    </div>
@endsection
