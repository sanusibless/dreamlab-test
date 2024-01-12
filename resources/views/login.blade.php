<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zay - Log in</title>
    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <script src="https://kit.fontawesome.com/7439c22f5d.js" crossorigin="anonymous"></script>
</head>

<body>
    <div>
        <div class="d-flex justify-content-center" style="height: 100px;">
            <img class="img-fluid" src="assets/img/apple-icon.png">
        </div>
        <section class="container d-flex justify-content-center" id="login-form">
            <form action="{{ route('user.authenticate') }}" method="POST" class="d-flex flex-column justify-content-center">
            	@csrf
                <div class="mb-3">
                    <div class="d-flex flex-column">
                        <label for="email">Email</label>
                        <input type="email" name="email" required class="form-control" id="email">
                    </div>
                </div>
                @error('email')
                	<p class="text-danger"> {{ $message }}</p>
                @enderror
                <div class="mb-3">
                    <div class="d-flex flex-column">
                        <label for="password">Password</label>
                        <input type="password" name="password" required class="form-control" id="password">
                    </div>
                </div>
                 @error('password')
                	<p>{{ $message }}</p>
                @enderror
                <div class="mb-3 text-center">
                    <button type="password" name="submit" required class="btn btn-primary px-5" id="submit">Sign in</button>
                </div>
                <p class="text-center">Don't have an account? <a href="{{ route('user.register') }}">Sign up</a>
            </form>
        </section>
    </div>


</body>

</html>