@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2>All Orders</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Order #</th>
                <th>User</th>
                <th>Items</th>
                <th>Total (Ksh)</th>
                <th>Status</th>
                <th>Ordered At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>
                    <ul class="mb-0">
                        @foreach($order->items as $item)
                            <li>{{ $item->product->name }} x {{ $item->quantity }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>Ksh {{ number_format($order->total, 2) }}</td>
                <td><span class="badge bg-info">{{ ucfirst($order->status) }}</span></td>
                <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No orders found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
