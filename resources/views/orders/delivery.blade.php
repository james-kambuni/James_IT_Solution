<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delivery Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS (CDN or local) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #f8f9fa;
    }

    .card {
        border-radius: 12px;
        border: none;
    }

    .form-label {
        font-weight: 500;
    }

    .form-control, .form-select {
        border-radius: 8px;
    }

    .form-check-input {
        margin-top: 6px;
    }

    .btn {
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
    }

    .order-summary .product-info {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
    }

    .order-summary img {
        border-radius: 8px;
    }

    .order-summary .table {
        margin-top: 20px;
    }

    .alert-info {
        background-color: #e9f7fd;
        border-left: 5px solid #0dcaf0;
    }

    .alert-info ul {
        margin-bottom: 0;
        padding-left: 20px;
    }
    .custom-location-check:hover {
        background-color: #f8f9fa;
        cursor: pointer;
    }

    .form-check-input {
        transform: scale(1.1); /* Enlarge checkbox */
        border-color: #198754;
    }

    .form-check-input:checked {
        background-color: #198754; /* Bootstrap success green */
        border-color: #198754;
    }
</style>

</head>
<body>
<div class="container my-5">
    <div class="row">
        <!-- Delivery Details (Left Column) -->
        <div class="col-md-7">
            <div class="card shadow-sm p-4">
                <h4 style="color: green;" class="mb-4">Delivery Details</h4>
                <form id="orderForm" action="{{ route('admin.place-order') }}" method="POST">
    @csrf

    @if ($errors->any())
        <div class="alert alert-danger mb-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-3">
        <div class="col-md-6">
            <label for="fullname" class="form-label">Full Name</label>
            <input type="text" class="form-control" name="fullname" placeholder="e.g John Doe" required>
        </div>

        <div class="col-md-6">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" name="phone" placeholder="e.g 0700 369 827" required>
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">Email (Optional)</label>
            <input type="email" class="form-control" name="email" placeholder="e.g johndoe@gmail.com">
        </div>

        <div class="col-md-6">
            <label for="county" class="form-label">County</label>
            <select id="county" name="county" class="form-select" required>
                <option value="">-- Select County --</option>
                @foreach($counties as $county)
                    <option value="{{ $county->id }}">{{ $county->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label for="region" class="form-label">Region</label>
            <select id="region" name="region" class="form-select">
                <option value="">-- Select Region --</option>
            </select>
        </div>

        <div class="col-12" id="location-container" style="display:none;">
    <div class="card border shadow-sm p-3 mt-3">
        <h6 class="text-primary mb-3">🗺️ Choose Delivery Location</h6>
        <div id="locations-list" class="ps-2">
            <!-- Checkboxes will be injected here -->
        </div>
    </div>
</div>

        <input type="hidden" name="location_id" id="selected_location_id">

        <div class="col-12">
            <label for="order_notes" class="form-label">Order Notes (Optional)</label>
            <textarea class="form-control" name="order_notes" rows="3" placeholder="Street name, Apartment, etc"></textarea>
        </div>

        <div class="col-12">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="agreed_to_terms" id="terms" required>
                <label class="form-check-label" for="terms">
                    I agree to the <a href="#">Terms and Conditions</a>
                </label>
            </div>
        </div>

        
    </div>
</form>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@push('scripts')
<script>
$(document).ready(function() {
  $('#county').on('change', function() {
    const countyId = $(this).val();
    $('#region').html('<option value="">-- Select Region --</option>');
    $('#location-container').hide();
    $('#locations-list').empty();

    if (!countyId) return;

    $('#region').html('<option value="">Loading regions...</option>');

    $.ajax({
      url: `/api/regions/${countyId}`,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        console.log('API Response:', response);
        if (response && response.length > 0) {
          let options = '<option value="">-- Select Region --</option>';
          response.forEach(region => {
            options += `<option value="${region.id}">${region.name}</option>`;
          });
          $('#region').html(options);
        } else {
          $('#region').html('<option value="">No regions available</option>');
        }
      },
      error: function(xhr, status, error) {
        console.error('AJAX Error:', { Status: xhr.status, Error: error, Response: xhr.responseText });
        $('#region').html('<option value="">Error loading regions</option>');
      }
    });
  });
});
</script>
@endpush
@push('scripts')
<script>
$(document).ready(function () {
    const subtotal = parseFloat($('#subtotal-value').text()); // Get initial subtotal

    $('#region').on('change', function () {
        const regionId = $(this).val();
        $('#locations-list').empty();
        $('#location-container').hide();
        $('#selected_location_id').val('');
        $('#shipping-fee').text('0');
        $('#total-value').text(subtotal.toFixed(2));

        if (!regionId) return;

        $.ajax({
            url: `/api/regions/${regionId}/locations`,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.length > 0) {
                    let checkboxes = '';

                    response.forEach(location => {
                        checkboxes += `
                            <div class="form-check">
                                <input class="form-check-input location-option" type="checkbox"
                                       value="${location.id}" data-fee="${location.shipping_fee}"
                                       id="location-${location.id}" name="location_option">
                                <label class="form-check-label" for="location-${location.id}">
                                    ${location.name} (KES ${location.shipping_fee})
                                </label>
                            </div>
                        `;
                    });

                    $('#locations-list').html(checkboxes);
                    $('#location-container').show();
                } else {
                    $('#locations-list').html('<p>No locations found in this region.</p>');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error loading locations:', error);
                $('#locations-list').html('<p>Error loading locations.</p>');
            }
        });
    });

    // On location checkbox change
    $(document).on('change', '.location-option', function () {
        $('.location-option').not(this).prop('checked', false); // Only one at a time

        const isChecked = $(this).is(':checked');

        if (isChecked) {
            const locationId = $(this).val();
            const shippingFee = parseFloat($(this).data('fee'));

            $('#selected_location_id').val(locationId);
            $('#shipping-fee').text(shippingFee.toFixed(2));

            const total = subtotal + shippingFee;
            $('#total-value').text(total.toFixed(2));
        } else {
            $('#selected_location_id').val('');
            $('#shipping-fee').text('0');
            $('#total-value').text(subtotal.toFixed(2));
        }
    });
    $(document).ready(function () {
    const subtotal = parseFloat("{{ $subtotal }}");

    $(document).on('change', '.location-option', function () {
        // Uncheck all other checkboxes
        $('.location-option').not(this).prop('checked', false);

        const isChecked = $(this).is(':checked');

        if (isChecked) {
            const locationId = $(this).val();
            const shippingFee = parseFloat($(this).data('fee'));

            // Update hidden input
            $('#selected_location_id').val(locationId);

            // Update totals
            $('#shipping-fee').text(shippingFee.toFixed(2));
            const total = subtotal + shippingFee;
            $('#total-value').text(total.toFixed(2));
        } else {
            $('#selected_location_id').val('');
            $('#shipping-fee').text('0.00');
            $('#total-value').text(subtotal.toFixed(2));
        }
    });
});
});
</script>
@endpush

@stack('scripts')

            </div>
        </div>

        <!-- Order Summary (Right Column) -->
        <div class="col-md-5">
    <div class="card shadow-sm p-4 rounded-4 border-0">
        <h5 class="mb-4 text-primary fw-semibold">🧾 Order Summary</h5>

        @foreach($cartItems as $item)
            <div class="d-flex align-items-center mb-3 border-bottom pb-2">
                <img src="{{ asset('storage/' . $item->product->image) }}" alt="Product Image" width="70" class="rounded me-3" style="object-fit: cover;">
                <div class="flex-grow-1">
                    <div class="fw-semibold">{{ $item->product->name }}</div>
                    <small class="text-muted">
                        {{ $item->quantity }} × KSH {{ number_format($item->price, 2) }}<br>
                        <span class="fst-italic">(VAT Excl)</span>
                    </small>
                </div>
            </div>
        @endforeach

        <table class="table table-borderless mt-4">
            <tr>
                <td class="text-muted">Subtotal</td>
                <td class="text-end">KSH <span id="subtotal-value">{{ number_format($subtotal, 2) }}</span></td>
            </tr>
            <tr>
                <td class="text-muted">Shipping Cost</td>
                <td class="text-end">KSH <span id="shipping-fee">{{ number_format($shipping, 2) }}</span></td>
            </tr>
            <tr class="fw-bold border-top pt-2">
                <td class="pt-2">Grand Total</td>
                <td class="text-end pt-2">KSH <span id="total-value">{{ number_format($total, 2) }}</span></td>
            </tr>
        </table>

       <div class="d-flex justify-content-between gap-3 mt-4">
    <a href="{{ route('cart') }}" class="btn btn-outline-secondary rounded-pill flex-fill">← Back to Cart</a>
    <button type="button" id="submitOrder" class="btn btn-success rounded-pill fw-semibold flex-fill">
        ✅ Place Order
    </button>
</div>



        <div class="alert alert-info mt-4 rounded-3 small">
            <h6 class="fw-bold">🚚 Delivery Notes & Schedules</h6>
            <ul class="mb-0 ps-3">
                <li>Pay upfront if outside Nairobi & nearby towns</li>
                <li>Pay on delivery only in Nairobi & nearby</li>
                <li>Same-day delivery for Nairobi (before 3:00PM)</li>
                <li>Next-day delivery countrywide</li>
            </ul>
        </div>
    </div>
</div>


    </div>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('submitOrder').addEventListener('click', function () {
        document.getElementById('orderForm').submit();
    });
</script>
</body>
</html>
