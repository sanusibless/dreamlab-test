<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="apple-touch-icon" href="http://localhost:8000/assets/img/apple-icon.png" />
    <link rel="shortcut icon" type="image/x-icon" href="http://localhost:8000/assets/img/favicon.ico" />

    <link rel="stylesheet" href="http://localhost:8000/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="http://localhost:8000/assets/css/templatemo.css" />
    <link rel="stylesheet" href="http://localhost:8000/assets/css/custom.css" />
    <link rel="stylesheet" href="http://localhost:8000/assets/css/order.scss" />
    <link rel="stylesheet" href="http://localhost:8000/assets/css/zay.css" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&amp;display=swap" />
    <link rel="stylesheet" href="http://localhost:8000/assets/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    @viteReactRefresh
    @vite('resources/js/app.jsx')
    @inertiaHead
    @routes
  </head>
  <body style="position: relative;">
    @inertia
  </body>

  <script src="{{ url('assets/js/jquery-1.11.0.min.js') }}"></script>  <script src="assets/js/jquery-1.11.0.min.js"></script>
  <script src="{{ url('assets/js/jquery-migrate-1.2.1.min.js') }}"></script>  <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
  <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="{{ url('assets/js/templatemo.js') }}"></script>  <script src="assets/js/templatemo.js"></script>
  <script src="{{ url('assets/js/custom.js') }}"></script>  <script src="assets/js/custom.js"></script>
</html>


