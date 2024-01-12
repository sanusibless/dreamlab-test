<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
    <style>
         .container {
            border-radius: 10px;
            padding: 30px;
            margin-top: 50px;
            width: 75% !important;
        }

        .btn-primary {
            background-color: #218838;
            border-color: #218838;
        }

        .btn-primary:hover {
            background-color: #1e7e34;
            border-color: #1e7e34;
        }
    </style>
</head>
<body>

<div class="container text-center">
	<div>
		<img src="{{ url('assets/img/success_icon.png') }}" width="100" height="100">
	</div>
	<img src="">
    <h2>Your Order Was Successful!</h2>
    <p>Thank you for shopping with us. Your order has been successfully processed.</p>
    <h4> Order Details:</h4>
    <div>
    	    <p>Order Id: {{ $orderinfo['id'] }}<p>
            <p>Payment Reference: {{ $orderinfo['reference'] }}</p>
            <p>Amount: N{{ number_format($orderinfo['amount']) }}</p>
            <p>Transaction Date: {{ $orderinfo['time'] }}</p>
    </div>
</div>
</body>
</html>
