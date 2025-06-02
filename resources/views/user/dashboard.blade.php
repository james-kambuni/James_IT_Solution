@extends('admin.layouts.user')

@section('title', 'User Dashboard')
@section('page-title', 'My Orders')

@section('content')
    <h2 class="mb-4">Welcome, {{ auth()->user()->name }}</h2>

    @forelse ($orders as $order)
        <div class="card mb-4 p-3">
            <div class="d-flex justify-content-between">
                <div>
                    <h5><strong>Order #{{ $order->id }}</strong></h5>
                    <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
                    <p><strong>Shipment:</strong> {{ $order->shipment_info ?? 'Pending' }}</p>
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
                </div>
                <div>
                    <a href="{{ route('user.orders.show', $order->id) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
    @empty
        <p>No orders found.</p>
    @endforelse
@endsection
