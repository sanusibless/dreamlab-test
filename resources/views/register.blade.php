<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zay - Registration Page</title>
    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
</head>

<body>
    <div class="d-flex justify-content-center" style="height: 100px;">
        <img class="img-fluid" src="assets/img/apple-icon.png">
    </div>
    <div class="d-flex flex-column justify-content-center w-50 mx-auto">
        <div id="status" class="text-center">
        </div>
    </div>
    <p class="text-center">or</p>
    <section class="container d-flex justify-content-center" id="login-form">
        <form action="{{ route('user.store') }}" method="POST" class="d-flex flex-column justify-content-center">
            @csrf
            <div class="d-flex flex-row justify-content-between w-90 mb-3">
                <div class="d-flex flex-column">
                    <label for="firstName">First Name</label>
                    <input type="text" name="firstname" required class="form-control mr-1" id="firstName" value="{{ old('firstname') }}">
                    @error('firstname')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="d-flex flex-column">
                    <label for="lastName">Last Name</label>
                    <input type="text" name="lastname" required class="form-control" id="lastName" value="{{ old('lastname') }}">
                    @error('lastname')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <div class="d-flex flex-column">
                    <label for="email">Email</label>
                    <input type="email" name="email" required class="form-control" id="email" value="{{ old('email') }}">
                     @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <div class="d-flex flex-column">
                    <label for="password">Password</label>
                    <input type="password" name="password" required class="form-control" id="password">
                     @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <div class="d-flex flex-column">
                    <label for="password">Confirm Password</label>
                    <input type="password" name="password_confirmation" required class="form-control" id="password">
                </div>
            </div>

            <div class="mb-3 text-center">
                <button type="password" name="submit" required class="btn btn-primary px-5" id="submit">Register</button>
            </div>
            <p class="text-center">Already have an account? <a href="{{ route('user.login')}}">Sign in</a>
        </form>
    </section>

    <!-- The JS SDK Login Button -->

    <!-- Load the JS SDK asynchronously -->
    <script src="https://kit.fontawesome.com/7439c22f5d.js" crossorigin="anonymous"></script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
</body>

</html>

<!-- 
    
-->