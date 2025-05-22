<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Category entry/edit page for SB Admin 2 dashboard">
    <meta name="author" content="SB Admin 2">
    <title>SB Admin 2 - Kategori</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/css/sb-admin-2.min.css"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fc;
        }

        .container-fluid {
            padding: 20px 30px;
            background: #f8f9fc;
        }

        .page-title {
            font-size: 1.5rem;
            color: #5a5c69;
            margin-bottom: 15px;
            font-weight: 700;
            display: flex;
            align-items: center;
        }

        .page-title i {
            margin-right: 8px;
            color: #5a5c69;
        }

        .card {
            background: white;
            border: 1px solid #e3e6f0;
            border-radius: 10px;
            box-shadow: none;
        }

        .card-header {
            background: #fff;
            border-bottom: 1px solid #e3e6f0;
            padding: 15px 20px;
        }

        .card-header h6 {
            font-size: 1.1rem;
            color: #5a5c69;
            margin: 0;
            font-weight: 700;
        }

        .card-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 0.9rem;
            color: #5a5c69;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .form-group label .text-danger {
            color: #e74a3b;
        }

        .form-control {
            border: 1px solid #d1d3e2;
            border-radius: 5px;
            font-size: 0.9rem;
            padding: 8px 12px;
            color: #5a5c69;
            height: 38px;
        }

        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .form-control::placeholder {
            color: #b7b9cc;
        }

        select.form-control {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background: white url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e") no-repeat right 0.75rem center/8px 10px;
        }

        .btn {
            font-size: 0.9rem;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 20px;
            border: none;
            transition: background 0.2s;
        }

        .btn-primary {
            background: #4e73df;
            color: white;
        }

        .btn-primary:hover {
            background: #3758c9;
        }

        .btn-cancel {
            background: #f28c38;
            color: white;
        }

        .btn-cancel:hover {
            background: #e07b30;
        }

        .form-actions {
            display: flex;
            gap: 10px;
        }

        .notification {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: #e6ffed;
            color: #28a745;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            z-index: 1050;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .notification.show {
            opacity: 1;
        }

        .notification.error {
            background: #ffe6e6;
            color: #dc3545;
        }

        .notification.error .icon,
        .notification .icon {
            margin-right: 0.75rem;
            font-size: 1.2rem;
        }

        .notification.error .close-btn {
            color: #dc3545;
        }

        .notification .close-btn {
            margin-left: auto;
            cursor: pointer;
            font-size: 1rem;
            color: #28a745;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        @include('layouts.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    @include('components.user-menu')
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="page-title"><i class="fas fa-clone fa-fw mr-2"></i>Kategori</h1>
                    </div>
                    @if (session('success'))
                        <div class="notification show" id="successNotification">
                            <span class="icon">✔</span>
                            <span>{{ session('success') }}</span>
                            <span class="close-btn" onclick="hideNotification('successNotification')">✖</span>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="notification error show" id="errorNotification">
                            <span class="icon">✖</span>
                            <span>{{ session('error') }}</span>
                            <span class="close-btn" onclick="hideNotification('errorNotification')">✖</span>
                        </div>
                    @endif
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">
                                {{ $category ? 'Ubah Data Kategori' : 'Entri Data Kategori' }}
                            </h6>
                        </div>
                        <div class="card-body">
                            <form
                                action="{{ $category ? route('kategori.update', $category->id) : route('kategori.store') }}"
                                method="POST" class="needs-validation" novalidate>
                                @csrf
                                @if ($category)
                                    @method('PUT')
                                @endif
                                <div class="form-group">
                                    <label>Nama Kategori <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_kategori" class="form-control" autocomplete="off"
                                        value="{{ $category ? $category->nama : old('nama_kategori') }}" required>
                                    <div class="invalid-feedback">Nama kategori tidak boleh kosong.</div>
                                    @error('nama_kategori')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tipe <span class="text-danger">*</span></label>
                                    <select name="tipe" class="form-control" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Pemasukan"
                                            {{ $category && $category->tipe == 'Pemasukan' ? 'selected' : '' }}>
                                            Pemasukan</option>
                                        <option value="Pengeluaran"
                                            {{ $category && $category->tipe == 'Pengeluaran' ? 'selected' : '' }}>
                                            Pengeluaran</option>
                                    </select>
                                    <div class="invalid-feedback">Tipe tidak boleh kosong.</div>
                                    @error('tipe')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-actions">
                                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('kategori') }}" class="btn btn-cancel">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/js/sb-admin-2.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        });

        function showNotification(notificationId, message) {
            const notification = $(`#${notificationId}`);
            const messageSpan = notification.find(
                `#${notificationId === 'successNotification' ? 'notificationMessage' : 'errorMessage'}`);
            if (message) {
                messageSpan.text(message);
            }
            notification.addClass('show');
            setTimeout(function() {
                notification.removeClass('show');
            }, 3000);
        }

        window.hideNotification = function(notificationId) {
            $(`#${notificationId}`).removeClass('show');
        };
    </script>
</body>

</html>
