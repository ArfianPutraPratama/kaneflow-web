<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Kaneflow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #7ABE65, #9ecb90);
            color: rgb(0, 0, 0);
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .welcome-section {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            width: 150px;
            height: auto;
            margin-right: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px;
            border: 1px solid #ddd;
        }

        .btn-register {
            background-image: linear-gradient(to right, #7ABE65, #9ecb90);
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 10px;
            border: none;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            background-image: linear-gradient(to right, #595959, #9fa0a0);
        }

        .social-icons {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .social-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin: 0 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: white;
            text-decoration: none;
        }

        .facebook {
            background-color: #3b5998;
        }

        .google {
            background-color: #b7b7b7;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .login-link a {
            color: #7ABE65;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .invalid-feedback {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center">
        <div class="register-container">
            <div class="welcome-section">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.submit') }}">
                @csrf
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                        name="username" value="{{ old('username') }}" required autofocus>
                    @error('username')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" required>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                        id="password_confirmation" name="password_confirmation" required>
                    @error('password_confirmation')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-register">DAFTAR</button>
            </form>

            <div class="login-link">
                Sudah Memiliki Akun? <a href="{{ route('login') }}">Login Sekarang</a>
            </div>

            <div class="text-center mt-3">
                <p>--- atau ---</p>
            </div>
            <div class="social-icons">
                <a href="{{ route('login.google') }}" class="social-icon google">
                    <img src="{{ asset('images/google.png') }}" alt="Google Logo" style="width: 20px; height: 20px;">
                </a>

                <a href="{{ route('login.facebook') }}" class="social-icon facebook" title="Login with Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
