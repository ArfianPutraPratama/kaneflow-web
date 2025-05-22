<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Profile editing page for SB Admin 2 dashboard">
    <meta name="author" content="SB Admin 2">
    <title>SB Admin 2 - Profile</title>

    <!-- Custom fonts for this template -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Custom styles for this template (SB Admin 2) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/css/sb-admin-2.min.css"
        rel="stylesheet">

    <!-- Custom CSS for additional styling -->
    <style>
        /* Ensure consistent image height */
        #preview-file {
            height: 170px;
            object-fit: cover;
        }

        /* Gradient background for potential use */
        #bg-gradient-primary {
            background-color: #4e73df;
            background-image: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
            background-size: cover;
        }

        /* Responsive adjustments */
        @media (min-width: 992px) {
            .d-lg-block {
                display: block !important;
            }
        }

        /* Custom styles for form elements */
        .form-control-file {
            padding: 0.375rem 0.75rem;
            border: 1px solid #d1d3e2;
            border-radius: 0.35rem;
        }

        .form-text {
            font-size: 0.8rem;
        }

        .btn-simpan {
            background-color: #166534;
            /* Warna dasar */
            border-color: #166534;
            color: white !important;
            /* Pastikan teks selalu putih */
            transition: all 0.3s ease;
            /* Animasi transisi halus */
        }

        .btn-simpan:hover {
            background-color: #159245;
            /* Warna hijau lebih terang saat hover */
            border-color: #159245;
            color: white !important;
            /* Teks tetap putih saat hover */
            transform: translateY(-2px);
            /* Efek sedikit naik */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Bayangan subtle */
        }

        .btn-simpan:active {
            transform: translateY(0);
            /* Efek tekan saat diklik */
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar (Placeholder - assuming it's included via a template) -->
        @include('layouts.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar (Placeholder for user menu) -->
                    @include('components.user-menu')
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h4 mb-4 text-gray-800">
                        <i class="fas fa-user fa-fw mr-2"></i>Profil
                    </h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Ubah Profil</h6>
                        </div>
                        <div class="card-body">
                            <!-- Profile Edit Form -->
                            <form action="{{ route('profil.update') }}" method="post" enctype="multipart/form-data"
                                class="needs-validation" novalidate>
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-lg-7">
                                        <input type="hidden" name="id_user" value="1">

                                        <div class="form-group">
                                            <label for="full_name">Nama Lengkap <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="full_name" name="full_name" class="form-control"
                                                value="{{ old('full_name', Auth::user()->full_name) }}"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('full_name') border-red-500 @enderror"
                                                autocomplete="off" required>
                                            <div class="invalid-feedback">Nama lengkap tidak boleh kosong.</div>
                                            @error('full_name')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="username">Username <span class="text-danger">*</span></label>
                                            <input type="text" id="username" name="username" class="form-control"
                                                value="{{ old('username', Auth::user()->username) }}"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('username') border-red-500 @enderror"
                                                autocomplete="off" required>
                                            <div class="invalid-feedback">Username tidak boleh kosong.</div>
                                            @error('username')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Alamat <span class="text-danger">*</span></label>
                                            <textarea id="address" name="address" rows="2"
                                                class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('address') border-red-500 @enderror"
                                                autocomplete="off" required>{{ old('address', Auth::user()->address) }}</textarea>
                                            <div class="invalid-feedback">Alamat tidak boleh kosong.</div>
                                            @error('address')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="whatsapp">WhatsApp <span class="text-danger">*</span></label>
                                            <input type="text" id="whatsapp" name="whatsapp"
                                                class="form-control mask-phone"
                                                value="{{ old('whatsapp', Auth::user()->whatsapp) }}"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('whatsapp') border-red-500 @enderror"
                                                autocomplete="off" required maxlength="15" pattern="\+?[0-9]{10,15}">
                                            <div class="invalid-feedback">WhatsApp tidak boleh kosong atau format
                                                salah.</div>
                                            @error('whatsapp')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email <span class="text-danger">*</span></label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                value="{{ old('email', Auth::user()->email) }}"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('email') border-red-500 @enderror"
                                                autocomplete="off" required>
                                            <div class="invalid-feedback">Email tidak boleh kosong atau format salah.
                                            </div>
                                            @error('email')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="website">Website <span class="text-danger">*</span></label>
                                            <input type="url" id="website" name="website" class="form-control"
                                                value="{{ old('website', Auth::user()->website) }}"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('website') border-red-500 @enderror"
                                                autocomplete="off" required>
                                            <div class="invalid-feedback">Website tidak boleh kosong atau format salah.
                                            </div>
                                            @error('email')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="facebook">Facebook <span class="text-danger">*</span></label>
                                            <input type="url" id="facebook" name="facebook"
                                                class="form-control"
                                                value="{{ old('facebook', Auth::user()->facebook) }}"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('facebook') border-red-500 @enderror"
                                                autocomplete="off" required>
                                            <div class="invalid-feedback">Facebook URL tidak boleh kosong atau format
                                                salah.</div>
                                            @error('whatsapp')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="twitter">Twitter <span class="text-danger">*</span></label>
                                            <input type="url" id="twitter" name="twitter" class="form-control"
                                                value="{{ old('twitter', Auth::user()->twitter) }}"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('twitter') border-red-500 @enderror"
                                                autocomplete="off" required>
                                            <div class="invalid-feedback">Twitter URL tidak boleh kosong atau format
                                                salah.</div>
                                            @error('whatsapp')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="instagram">Instagram <span
                                                    class="text-danger">*</span></label>
                                            <input type="url" id="instagram" name="instagram"
                                                class="form-control"
                                                value="{{ old('instagram', Auth::user()->instagram) }}"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('instagram') border-red-500 @enderror"
                                                autocomplete="off" required>
                                            <div class="invalid-feedback">Instagram URL tidak boleh kosong atau format
                                                salah.</div>
                                            @error('whatsapp')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 ml-auto">
                                        <div class="form-group">
                                            <label for="profile_photo">Foto Profil</label>
                                            <input type="file" accept=".jpg, .jpeg, .png" id="profile_photo"
                                                name="profile_photo"
                                                class="form-control-file @error('profile_photo') border-red-500 @enderror"
                                                autocomplete="off">
                                            <img id="preview-file"
                                                class="rounded-circle border border-2 shadow mt-4 mb-3"
                                                src="{{ Auth::user()->profile_photo ? Storage::url(Auth::user()->profile_photo) : 'images/avatar.png' }}"
                                                width="170px">
                                            <small class="form-text text-primary mt-3">
                                                Keterangan: <br>
                                                - Tipe file yang bisa diunggah adalah *.jpg atau *.png. <br>
                                                - Ukuran file yang bisa diunggah maksimal 1 Mb.
                                            </small>
                                            @error('profile_photo')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <hr class="mt-5">
                                <div class="form-group pt-3">
                                    <input type="submit" name="simpan" value="simpan"
                                        class="btn btn-simpan btn-rounded mr-2">
                                    <a href="{{ route('profil') }}" class="btn btn-secondary btn-rounded">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('layouts.footer')
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('logout') }}" method="POST">
                        <!-- Placeholder for CSRF token -->
                        <input type="hidden" name="_token" value="csrf-token-placeholder">
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <!-- Custom script for form validation and image preview -->
    <script>
        // Form validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                const forms = document.getElementsByClassName('needs-validation');
                Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // Image preview
        document.getElementById('foto').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-file').src = e.target.result;
                };
                reader.readAsDataURL(file);

                // Validate file size (1MB limit)
                if (file.size > 1024 * 1024) {
                    alert('Ukuran file melebihi 1 Mb. Silakan pilih file yang lebih kecil.');
                    event.target.value = '';
                    document.getElementById('preview-file').src = 'assets/img/avatar.png';
                }
            }
        });
    </script>
</body>

</html>
