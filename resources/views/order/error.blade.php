error.blade.php<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>

        .container {
            border-radius: 10px;
            padding: 30px;
            margin-top: 50px;
            width: 25% !important;
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

<div class="container text-center border rounded-2 shadow">
    <div class="mb-4">
        <img src="{{ url('assets/img/success_icon.png') }}" width="100" height="100">
    </div>
    <h4>Opps!</h3>
    <p>Your Payment was not successful</p>
    <p>Your order cannot be processed</p>
    <a href="{{ route('checkout') }}" class="btn btn-primary mt-3">Retry</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
