<!DOCTYPE html>
<html lang="en">
<head>
<!-- basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- mobile metas -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<!-- site metas -->
<title>It.Next - Thank You</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">
<!-- site icons -->
<link rel="icon" href="images/fevicon/fevicon.png" type="image/gif" />
<!-- bootstrap css -->
<link rel="stylesheet" href="css/bootstrap.min.css" />
<!-- Site css -->
<link rel="stylesheet" href="css/style.css" />
<!-- responsive css -->
<link rel="stylesheet" href="css/responsive.css" />
<!-- colors css -->
<link rel="stylesheet" href="css/colors1.css" />
<!-- custom css -->
<link rel="stylesheet" href="css/custom.css" />
<!-- thank you page css -->
<style>
  .thank-you-container {
    max-width: 800px;
    margin: 30px auto;
    background: white;
    padding: 40px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    text-align: center;
  }
  
  .thank-you-icon {
    font-size: 80px;
    color: #4CAF50;
    margin-bottom: 20px;
  }
  
  .thank-you-message {
    margin-bottom: 30px;
  }
  
  .order-details {
    background: #f9f9f9;
    padding: 20px;
    border-radius: 5px;
    margin: 20px 0;
    text-align: left;
  }
  
  .order-number {
    font-weight: bold;
    margin-bottom: 10px;
  }
  
  .btn-continue {
    background: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    display: inline-block;
    margin-top: 20px;
  }
  .btn-home {
    background: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    display: inline-block;
    margin-top: 20px;
  }
  
  .btn-continue:hover {
    background: #0056b3;
    color: white;
  }
</style>
</head>
<body id="default_theme" class="it_thankyou">
<!-- loader -->
<div class="bg_load"> <img class="loader_animation" src="images/loaders/loader_1.png" alt="#" /> </div>
<!-- end loader -->
<!-- header -->

<div class="section padding_layout_1">
  <div class="container">
    <div class="thank-you-container">
      <div class="thank-you-icon">
        <i class="fa fa-check-circle"></i>
      </div>
      <h2>Thank You For Your Order!</h2>
      <div class="thank-you-message">
        <p>Your payment was successful and your order has been received.</p>
        <p>We've sent a confirmation email with your order details.</p>
      </div>
      
      <div class="order-details">
        <div class="order-number">
          Order #: <span id="order-id">ORD-${Math.floor(Math.random() * 1000000)}</span>
        </div>
        <p>Date: <span id="order-date">${new Date().toLocaleDateString()}</span></p>
        <p>Payment Method: <span id="payment-method">M-Pesa</span></p>
        <p>Total Amount: <span id="order-amount">$0.00</span></p>
      </div>
      
      <p>We'll send you a shipping confirmation when your order is on its way.</p>
      <p>If you have any questions, please <a href="it_contact.html">contact us</a>.</p>
      
      <div class="button-row">
  <a href="{{ url('/shop') }}" class="btn-continue">Continue Shopping</a>
  <a href="{{ url('/') }}" class="btn-home">home page</a>
</div>
    </div>
  </div>
</div>

<!-- section -->

<!-- end footer -->
<!-- js section -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- menu js -->
<script src="js/menumaker.js"></script>
<!-- wow animation -->
<script src="js/wow.js"></script>
<!-- custom js -->
<script src="js/custom.js"></script>

<!-- google map js -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8eaHt9Dh5H57Zh0xVTqxVdBFCvFMqFjQ&callback=initMap"></script>
<!-- end google map js -->
<script>
  // Get order details from URL or localStorage
  document.addEventListener('DOMContentLoaded', function() {
    // In a real application, you would get these from your backend or URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const paymentMethod = urlParams.get('method') || 'M-Pesa';
    const orderTotal = localStorage.getItem('orderTotal') || '0.00';
    
    // Update the page with order details
    document.getElementById('payment-method').textContent = paymentMethod;
    document.getElementById('order-amount').textContent = `Ksh${orderTotal}`;
    
    // Clear the cart (if not already cleared)
    localStorage.removeItem('shoppingCart');
  });
</script>
</body>
</html>