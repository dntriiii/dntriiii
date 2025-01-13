<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denshop | Register</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap">
    <link rel="stylesheet" href="{{ asset('/bs/css/bootstrap.min.css') }}">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .background-blur {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('/loginn/img/login.jpg') no-repeat center center/cover;
            filter: blur(8px);
            z-index: -1;
        }

        .register-container {
            width: 100%;
            max-width: 400px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .register-container h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #333;
            font-size: 2rem;
        }

        .form-control {
            border-radius: 25px;
            padding: 0.5rem 1rem;
        }

        .btn-register {
            background-color: #4C585B;
            color: #fff;
            border: none;
            border-radius: 25px;
            width: 100%;
            padding: 0.5rem;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-login:hover {
            background-color: #d9d9d9;
        }

        .form-footer {
            text-align: center;
            margin-top: 1rem;
        }

        .form-footer a {
            color: #38d39f;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .form-footer a:hover {
            color: #32be8f;
        }
    </style>
</head>

<body>
    <!-- Background dengan efek blur -->
    <div class="background-blur"></div>

    <!-- Form register -->
    <div class="register-container">
        @if (session()->has('registerError'))
            <div class="alert alert-danger">{{ session('registerError') }}</div>
        @endif

        <h2>Register</h2>
        <form action="/register" method="post">
            @csrf
            <div class="mb-3">
                <input type="text" name="name" id="name" class="form-control" placeholder="Full Name" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="{{ old('username') }}" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="mb-3">
                <input type="password" name="confirmation_password" id="confirmation_password" class="form-control" placeholder="Confirm Password" required>
            </div>
            <button type="submit" class="btn btn-register">Register</button>
        </form>
        <div class="form-footer">
            <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
        </div>
    </div>
</body>

</html>