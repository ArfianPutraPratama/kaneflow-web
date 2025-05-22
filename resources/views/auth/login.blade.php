<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kaneflow</title>
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

        .login-container {
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

        .btn-login {
            background-image: linear-gradient(to right, #7ABE65, #9ecb90);
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 10px;
            border: none;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
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

        .register-link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .register-link a {
            color: #7ABE65;
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .alert-success,
        .alert-danger {
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .invalid-feedback {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center">
        <div class="login-container">
            <div class="welcome-section">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
            </div>

            <!-- Menampilkan pesan sukses -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Menampilkan pesan error -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
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
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" required>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-login w-100">LOGIN</button>
            </form>

            <div class="register-link">
                Belum Memiliki Akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
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

    <!-- Include Firebase SDK and custom script -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="{{ asset('build/assets/firebase.js') }}"></script>
    <script type="module">
        import {
            auth,
            provider,
            signInWithPopup
        } from '{{ asset('build/assets/firebase.js') }}';

        document.getElementById('google-signin').addEventListener('click', async (e) => {
            e.preventDefault();
            try {
                const result = await signInWithPopup(auth, provider);
                const idToken = await result.user.getIdToken();

                // Send ID token to Laravel backend
                const response = await fetch('{{ route('firebase.callback') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        idToken
                    })
                });

                if (response.ok) {
                    window.location.href = '{{ route('Dashboard') }}';
                } else {
                    const errorData = await response.json();
                    const errorMessage = errorData.error || 'Google login failed.';
                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-danger alert-dismissible fade show';
                    alertDiv.innerHTML = `
                        ${errorMessage}<br>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    `;
                    document.querySelector('.login-container').prepend(alertDiv);
                }
            } catch (error) {
                console.error('Firebase error:', error);
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-danger alert-dismissible fade show';
                alertDiv.innerHTML = `
                    Google login failed.<br>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `;
                document.querySelector('.login-container').prepend(alertDiv);
            }
        });
    </script>
</body>

</html>
