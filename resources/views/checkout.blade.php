<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="{{ url('assets/img/apple-icon.png') }} ">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('assets/img/favicon.ico') }}">

    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/templatemo.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/zay.css') }}">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="{{ url('assets/css/fontawesome.min.css') }}">
</head>
<body>

<div class="container mt-5">
    <form class="w-75 mx-auto border py-4" id="paymentForm">
        <div class="text-center">
            <img src="{{ url('assets/img/apple-icon.png') }}" style="width: 75px;">
        </div>
        <div class="d-flex justify-content-around">
            @if(session()->has('error'))
                <div id="alert" class="error" role="alert">
                    <p>{{ session()->get('error') }}</p>
                </div>
            @endif
            <div class="col-6">
                    <h4 class="mb-4">Checkout</h4>
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email"  class="form-control" id="email"  name="email" value="{{ Request::user()->email }}" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="address">Billing Address</label>
                        <input type="text" class="form-control" id="address" placeholder="Enter your address" >
                    </div>
                    <div class="form-row mb-3">
                        <div class="form-group col-md-6 mb-3">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" >
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="zip">ZIP Code</label>
                            <input type="text" class="form-control" id="zip" >
                        </div>
                    </div>
            </div>
            <div class="col-4">
                <h4 class="mb-4">Cart Total</h4>
                <div class="card">
                    <div class="card-body">
                        <div>
                            <span>Subtotal: </span> <span>${{ $total }}</span>
                        </div>
                        <hr>
                        <div>
                            <span>Total: </span> <span>${{ $total }}</span>
                            <input type="hidden" name="amount" id="amount" value="{{ $total }}">
                        </div>
                         <div class="w-50 text-center mx-auto mt-3">
                        <button type="submit" class="btn btn-success">Place Order</button>
        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </form>
</div>
<script src="https://js.paystack.co/v1/inline.js"></script>
 <script>
        let alert = document.getElementById('alert');
        if (alert) {
            setTimeout(() => alert.style.display = 'none', 5000);
        }

    var paymentForm = document.getElementById('paymentForm');

    paymentForm.addEventListener('submit', payWithPaystack, false);

    function payWithPaystack(e) {

    e.preventDefault();

    console.log('yes')

    var handler = PaystackPop.setup({

    key: "{{ env('PAYSTACK_PUBLIC_KEY') }}", // Replace with your public key

    email: document.getElementById('email').value,

    amount: document.getElementById('amount').value * 100, // the amount value is multiplied by 100 to convert to the lowest currency unit

    currency: 'NGN', // Use GHS for Ghana Cedis or USD for US Dollars

    ref: Number(Math.floor(Math.random() * 1000000000000000)).toPrecision(), // Replace with a reference you generated

    callback: function(response) {

        if(response.status === 'success') {
            window.location = '/order/confirmation/' + response.reference 
        } else {
            alert('An error occured');
        }
    },

    onClose: function() {

      alert('Transaction was not completed, window closed.');

    },

  });

  handler.openIframe();

}
    </script>
</body>
</html>
