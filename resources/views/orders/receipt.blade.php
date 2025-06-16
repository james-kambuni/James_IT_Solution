<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Receipt - #{{ $order->id }}</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            font-size: 13px;
            color: #333;
            margin: 20px;
        }

        .header, .footer {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            font-size: 22px;
            color: #2c3e50;
        }

        .header p {
            margin: 2px 0;
            font-size: 12px;
        }

        h3 {
            margin-top: 0;
            color: #444;
        }

        .order-info, .totals {
            margin-top: 20px;
        }

        .order-info p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table thead {
            background-color: #f5f5f5;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px 10px;
            text-align: left;
        }

        th {
            font-weight: bold;
            font-size: 13px;
        }

        .totals {
            margin-top: 10px;
            float: right;
            width: 40%;
        }

        .totals p {
            margin: 5px 0;
            font-weight: bold;
            text-align: right;
        }

        .footer p {
            font-size: 11px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>James-IT Solutions</h2>
        <p>The best place to shop</p>
        <p>Nairobi, Zimmermann</p>
        <p>Call: 0700369827</p>
        <p>WhatsApp: 0700 369827 | Email: info@james.co.ke</p>
    </div>

    <h3>Order Receipt - #{{ $order->id }}</h3>

    <div class="order-info">
        <p><strong>Order Date:</strong> {{ $order->created_at->format('F j, Y g:i A') }}</p>
        <p><strong>Customer:</strong> {{ $order->fullname }} | <strong>Phone:</strong> {{ $order->phone }}</p>
        <p><strong>Email:</strong> {{ $order->email ?? 'N/A' }}</p>
        <p>
            <strong>Shipping Address:</strong>
            {{ $order->location->region->name ?? 'N/A' }},
            {{ $order->location->name ?? 'N/A' }}
            (Shipping Fee: Ksh {{ number_format($order->shipping ?? $order->location->shipping_fee ?? 0) }})
        </p>

    </div>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Unit Price (Ksh)</th>
                <th>Quantity</th>
                <th>Total (Ksh)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ number_format($item->price) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price * $item->quantity) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <p>Subtotal: Ksh {{ number_format($order->total - $order->shipping) }}</p>
        <p>Shipping: Ksh {{ number_format($order->shipping) }}</p>
        <p><strong>Grand Total: Ksh {{ number_format($order->total) }}</strong></p>
    </div>

    <div class="footer" style="clear: both; margin-top: 60px;">
        <p>Thank you for shopping with James-IT Solution!</p>
        <p><em>Terms & Conditions apply.</em></p>
    </div>
</body>
</html>
