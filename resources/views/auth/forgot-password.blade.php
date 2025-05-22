<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Change Password - Kaneflow</title>
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

        .password-container {
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

        .btn-update {
            background-image: linear-gradient(to right, #7ABE65, #9ecb90);
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 10px;
            border: none;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-update:hover {
            background-image: linear-gradient(to right, #595959, #9fa0a0);
        }

        .btn-back {
            background-image: linear-gradient(to right, #6c757d, #adb5bd);
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 10px;
            border: none;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background-image: linear-gradient(to right, #5a6268, #90969d);
        }

        .button-group {
            margin-top: 10px;
        }

        .button-group .btn {
            margin-bottom: 15px;
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
        <div class="password-container">
            <div class="welcome-section">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('password.update') }}" method="POST" class="mt-6 space-y-6">
                @csrf
                <div class="form-group">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                        id="current_password" name="current_password" required autofocus>
                    @error('current_password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                        id="new_password" name="new_password" required>
                    @error('new_password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror"
                        id="new_password_confirmation" name="new_password_confirmation" required>
                    @error('new_password_confirmation')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="button-group">
                    <button type="submit" class="btn btn-update w-100">Update Password</button>
                    <button type="button" class="btn btn-back w-100"
                        onclick="window.location.href='{{ route('Dashboard') }}'">
                        Back to Dashboard
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
