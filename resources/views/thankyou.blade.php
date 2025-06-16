<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <title>It.Next - Thank You</title>

  <link rel="icon" href="{{ asset('images/fevicon/fevicon.png') }}" type="image/gif" />
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
  <link rel="stylesheet" href="{{ asset('css/colors1.css') }}">
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    body {
      background-color: #f4f4f4;
    }

    .thank-you-container {
      max-width: 700px;
      margin: 50px auto;
      background: #fff;
      padding: 40px 30px;
      border-radius: 10px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .thank-you-icon {
      font-size: 70px;
      color: #28a745;
      margin-bottom: 15px;
    }

    h2 {
      color: #333;
      margin-bottom: 10px;
      font-weight: 600;
    }

    .thank-you-message {
      color: #555;
      margin-bottom: 20px;
      font-size: 16px;
    }

    .order-details {
      background: #f7f9fc;
      padding: 20px;
      border-radius: 8px;
      margin: 25px 0;
      text-align: left;
      font-size: 15px;
      color: #444;
    }

    .order-details .order-number {
      font-weight: 600;
      margin-bottom: 10px;
    }

    .order-details .order-total {
      font-size: 16px;
    }

    .btn-container {
      display: flex;
      justify-content: center;
      gap: 15px;
      flex-wrap: wrap;
      margin-top: 25px;
    }

    .btn-home,
    .btn-download {
      padding: 10px 25px;
      font-size: 14px;
      font-weight: 500;
      text-decoration: none;
      border: none;
      border-radius: 5px;
      transition: 0.3s ease;
    }

    .btn-home {
      background-color: #007bff;
      color: #fff;
    }

    .btn-home:hover {
      background-color: #0056b3;
    }

    .btn-download {
      background-color: #28a745;
      color: #fff;
    }

    .btn-download:hover {
      background-color: #218838;
    }
  </style>
</head>
<body id="default_theme" class="it_thankyou">

<div class="bg_load">
  <img class="loader_animation" src="{{ asset('images/loaders/loader_1.png') }}" alt="loader" />
</div>

<div class="section padding_layout_1">
  <div class="container">
    <div class="thank-you-container">
      <div class="thank-you-icon">
        <i class="fa fa-check-circle"></i>
      </div>
      <h2>Thank You, {{ $order->fullname }}!</h2>
      <p class="thank-you-message">We appreciate your business. Below are your order details:</p>
      <p>Click the Receipt button to download your Order Receipt.</p>

      <div class="order-details">
        <div><strong>Customer Name:</strong> {{ $order->fullname }}</div>
        <div class="order-number"><strong>Payment Method:</strong> Only by <span style="color: green;" id="payment-method">-</span></div>
        <div class="order-total"><strong>Order Amount:</strong> <span id="order-amount">Ksh {{ number_format($total, 2) }}</span></div>
      </div>

      <div class="btn-container">
        <a href="{{ route('orders.receipt.download', $order->id) }}" class="btn-download">
          <i class="fa fa-download"></i> Download Receipt
        </a>
        <a href="{{ url('/shop') }}" class="btn-home">
          <i class="fa fa-store"></i> Continue Shopping
        </a>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/menumaker.js') }}"></script>
<script src="{{ asset('js/wow.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const method = urlParams.get('method') || 'M-Pesa';
    const total = urlParams.get('total') || '{{ $total ?? "0.00" }}';

    document.getElementById('payment-method').textContent = method;
    document.getElementById('order-amount').textContent = `Ksh ${parseFloat(total).toFixed(2)}`;

    localStorage.removeItem('shoppingCart');
  });
</script>

</body>
</html>
