@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2>All Orders</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('admin.counties.index') }}" class="btn btn-sm btn-outline-secondary">Manage Counties</a>
        <a href="{{ route('admin.regions.index') }}" class="btn btn-sm btn-outline-secondary">Manage Regions</a>
        <a href="{{ route('admin.locations.index') }}" class="btn btn-sm btn-outline-secondary">Manage Locations</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Order #</th>
                <th>User</th>
                <th>Items</th>
                <th>Total (Ksh)</th>
                <th>Status</th>
                <th>Status Update</th>
                <th>Full Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>County</th>
                <th>Region</th>
                <th>Notes</th>
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
                <td>
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-flex align-items-center gap-2">
                        @csrf
                        @method('PUT')
                        <select name="status" class="form-select form-select-sm">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    </form>
                </td>
                <td>{{ $order->fullname }}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ $order->email ?? '-' }}</td>
                <td>{{ $order->county }}</td>
                <td>{{ $order->region ?? '-' }}</td>
                <td>{{ $order->order_notes ?? '-' }}</td>
                <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="13" class="text-center">No orders found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
