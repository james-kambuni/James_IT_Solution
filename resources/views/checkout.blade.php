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
<title>It.Next - Checkout</title>
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
<!-- checkout page css -->
<style>
  .checkout-container {
    max-width: 800px;
    margin: 30px auto;
    background: white;
    padding: 30px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
  }
  
  .payment-methods {
    margin-top: 30px;
  }
  
  .payment-tabs {
    display: flex;
    border-bottom: 1px solid #ddd;
    margin-bottom: 20px;
  }
  
  .payment-tab {
    padding: 10px 20px;
    cursor: pointer;
    border: 1px solid transparent;
    border-bottom: none;
    border-radius: 5px 5px 0 0;
    margin-right: 5px;
  }
  
  .payment-tab.active {
    border-color: #ddd;
    border-bottom-color: white;
    background: white;
    font-weight: bold;
  }
  
  .payment-content {
    display: none;
  }
  
  .payment-content.active {
    display: block;
  }
  
  .form-group {
    margin-bottom: 15px;
  }
  
  .form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
  }
  
  .form-control {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
  }
  
  .btn-pay {
    background: #4CAF50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
  }
  
  .btn-pay:hover {
    background: #45a049;
  }
  
  #paypal-button-container {
    margin-top: 20px;
  }
  
  .order-summary {
    background: #f9f9f9;
    padding: 20px;
    border-radius: 5px;
    margin-bottom: 20px;
  }
  
  .order-summary h4 {
    margin-top: 0;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
  }
  
  .order-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
  }
  
  .order-total {
    font-weight: bold;
    border-top: 1px solid #ddd;
    padding-top: 10px;
    margin-top: 10px;
  }
  
  /* Modal Styles */
  .modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0; top: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.5);
    justify-content: center;
    align-items: center;
  }

  .modal-content {
    background: white;
    padding: 2rem;
    border-radius: 10px;
    max-width: 400px;
    width: 90%;
  }

  .close-btn {
    float: right;
    cursor: pointer;
    font-weight: bold;
    font-size: 18px;
  }
</style>
</head>
<body id="default_theme" class="it_checkout">
<!-- loader -->
<div class="bg_load"> <img class="loader_animation" src="images/loaders/loader_1.png" alt="#" /> </div>
<!-- end loader -->
<!-- header -->
<header id="default_header" class="header_style_1">
  <!-- header top -->
  <div class="header_top">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="full">
            <div class="topbar-left">
              <ul class="list-inline">
                <li> <span class="topbar-label"><i class="fa  fa-home"></i></span> <span class="topbar-hightlight">540 Lorem Ipsum New York, AB 90218</span> </li>
                <li> <span class="topbar-label"><i class="fa fa-envelope-o"></i></span> <span class="topbar-hightlight"><a href="mailto:info@yourdomain.com">info@yourdomain.com</a></span> </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-4 right_section_header_top">
          <div class="float-left">
            <div class="social_icon">
              <ul class="list-inline">
                <li><a class="fa fa-facebook" href="https://www.facebook.com/" title="Facebook" target="_blank"></a></li>
                <li><a class="fa fa-google-plus" href="https://plus.google.com/" title="Google+" target="_blank"></a></li>
                <li><a class="fa fa-twitter" href="https://twitter.com" title="Twitter" target="_blank"></a></li>
                <li><a class="fa fa-linkedin" href="https://www.linkedin.com" title="LinkedIn" target="_blank"></a></li>
                <li><a class="fa fa-instagram" href="https://www.instagram.com" title="Instagram" target="_blank"></a></li>
              </ul>
            </div>
          </div>
          <div class="float-right">
            <div class="make_appo"> <a class="btn white_btn" href="make_appointment.html">Make Appointment</a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end header top -->
  <!-- header bottom -->
  @include('header')
  <!-- header bottom end -->
</header>
<!-- end header -->
<!-- inner page banner -->
<div id="inner_banner" class="section inner_banner_section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="full">
          <div class="title-holder">
            <div class="title-holder-cell text-left">
              <h1 class="page-title">Checkout</h1>
              <ol class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li class="active">Checkout</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end inner page banner -->

<div class="section padding_layout_1">
  <div class="container">
    <div class="checkout-container">
      <h2>Checkout</h2>
      
      <div class="order-summary">
        <h4>Order Summary</h4>
        <div id="order-items">
          <!-- Order items will be dynamically inserted here -->
        </div>
        <div class="order-total">
          <span>Total:</span>
          <span id="order-total-amount">$0.00</span>
        </div>
      </div>
      
      <form id="checkout-form" method="POST" action="{{ route('checkout.mpesa') }}">
  @csrf
  <input type="hidden" name="payment_method" value="mpesa">

  <div class="form-group" id="mpesa-phone-group">
    <label for="mpesa-phone">Enter M-Pesa Phone Number</label>
    <input type="tel" name="phone" id="mpesa-phone" class="form-control" placeholder="e.g. 2547XXXXXXXX" required>
  </div>

  <button type="submit" class="btn btn-success">Pay with M-Pesa</button>
</form>

    </div>
  </div>
</div>

<!-- Payment Processing Modal -->
<div class="modal" id="paymentModal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeModal()">×</span>
    <h3 id="modal-title">Processing Payment</h3>
    <p id="modal-message">Please wait while we process your payment...</p>
  </div>
</div>

<!-- js section -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- menu js -->
<script src="js/menumaker.js"></script>
<!-- wow animation -->
<script src="js/wow.js"></script>
<!-- custom js -->
<script src="js/custom.js"></script>

<!-- PayPal SDK -->
<script src="https://www.paypal.com/sdk/js?client-id=YOUR_PAYPAL_CLIENT_ID&currency=USD"></script>

<script>
  // Load cart from localStorage
  document.addEventListener('DOMContentLoaded', function() {
    const savedCart = localStorage.getItem('shoppingCart');
    let cart = [];
    let totalAmount = 0;
    
    if (savedCart) {
      cart = JSON.parse(savedCart);
      
      // Display order items
      const orderItemsContainer = document.getElementById('order-items');
      orderItemsContainer.innerHTML = '';
      
      cart.forEach(item => {
        const itemTotal = item.price * item.quantity;
        totalAmount += itemTotal;
        
        const itemElement = document.createElement('div');
        itemElement.className = 'order-item';
        itemElement.innerHTML = `
          <span>${item.name} (${item.quantity})</span>
          <span>$${itemTotal.toFixed(2)}</span>
        `;
        orderItemsContainer.appendChild(itemElement);
      });
      
      // Update total amount
      document.getElementById('order-total-amount').textContent = `$${totalAmount.toFixed(2)}`;
    } else {
      // Cart is empty, redirect to shop page
      window.location.href = "{{ url('/shop') }}";
    }
    
    // Setup payment tabs
    document.querySelectorAll('.payment-tab').forEach(tab => {
      tab.addEventListener('click', function() {
        // Remove active class from all tabs and content
        document.querySelectorAll('.payment-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.payment-content').forEach(c => c.classList.remove('active'));
        
        // Add active class to clicked tab and corresponding content
        this.classList.add('active');
        const tabId = this.getAttribute('data-tab');
        document.getElementById(`${tabId}-content`).classList.add('active');
      });
    });
    
    // Initialize PayPal button
    if (typeof paypal !== 'undefined') {
      paypal.Buttons({
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: (totalAmount / 150).toFixed(2) // Convert to USD (approximate)
              }
            }]
          });
        },
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
            showModal('Payment Complete', 'Thank you for your payment! Your order has been placed.');
            // Here you would typically send the order details to your server
            clearCart();
          });
        },
        onError: function(err) {
          showModal('Payment Error', 'There was an error processing your PayPal payment. Please try again.');
          console.error(err);
        }
      }).render('#paypal-button-container');
    }
    
    // M-Pesa payment handler
    document.getElementById('mpesa-pay-btn').addEventListener('click', function() {
      const phone = document.getElementById('mpesa-phone').value;
      const name = document.getElementById('full-name').value;
      const email = document.getElementById('email').value;
      
      if (!phone || !name || !email) {
        alert('Please fill in all required fields');
        return;
      }
      
      showModal('Processing M-Pesa Payment', 'Sending payment request to your phone...');
      
      // Simulate M-Pesa payment (in a real app, you would call your backend API)
      setTimeout(function() {
        showModal('Payment Request Sent', 'Please check your phone to complete the M-Pesa payment.');
        // In a real app, you would poll your server to check payment status
        setTimeout(function() {
          showModal('Payment Complete', 'Thank you for your payment! Your order has been placed.');
          clearCart();
        }, 3000);
      }, 2000);
    });
  });
  
  function showModal(title, message) {
    document.getElementById('modal-title').textContent = title;
    document.getElementById('modal-message').textContent = message;
    document.getElementById('paymentModal').style.display = 'flex';
  }
  
  function closeModal() {
    document.getElementById('paymentModal').style.display = 'none';
  }
  
  function clearCart() {
    localStorage.removeItem('shoppingCart');
    // Redirect to thank you page after a delay
    setTimeout(function() {
      window.location.href = "{{ url('/thankyou') }}"; // You would need to create this page
    }, 2000);
  }
</script>
</body>
</html>