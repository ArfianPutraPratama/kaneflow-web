<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Dashboard</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom CSS for modal -->
    <style>
        #card-img-top {
            height: 200px;
        }

        #bg-gradient-primary {
            background-color: #4e73df;
            background-image: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
            background-size: cover;
        }

        @media (min-width: 992px) {
            .d-lg-block {
                display: block !important;
            }
        }

        .profile-image {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .profile-image img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
        }

        .btn-ubah-profil {
            background-color: #166534;
            /* Warna dasar */
            border-color: #166534;
            color: white !important;
            /* Pastikan teks selalu putih */
            transition: all 0.3s ease;
            /* Animasi transisi halus */
        }

        .btn-ubah-profil:hover {
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

        .btn-ubah-profil:active {
            transform: translateY(0);
            /* Efek tekan saat diklik */
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar etc... -->
                @yield('content')
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    @include('components.user-menu')
                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid" bis_skin_checked="1">
                    <!-- judul halaman -->
                    <h1 class="h4 mb-4 text-gray-800"><i class="fas fa-user fa-fw mr-2"></i>Profil</h1>

                    <div class="card shadow mb-4" bis_skin_checked="1">
                        <!-- background image -->
                        <div class="card-img-top bg-gradient-primary d-none d-sm-none d-md-none d-lg-block"
                            alt="Profil" bis_skin_checked="1"></div>
                        <!-- data profil user -->
                        <div class="card-body" bis_skin_checked="1">
                            <div class="text-center mt-n6">
                                <div class="profile-image flex justify-center items-center">
                                    <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('images/default-profile.png') }}"
                                        alt="Profile Photo" class="rounded-full object-cover w-32 h-32">
                                </div>
                                <h1 class="h4 pt-4 text-gray-800">{{ Auth::user()->username }}</h1>
                            </div>

                            <div class="text-center pt-3 pb-5" bis_skin_checked="1">
                                <a href="https://facebook.com/" target="_blank" class="btn btn-primary btn-circle mr-1">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/" target="_blank" class="btn btn-info btn-circle mr-1">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://www.instagram.com/" target="_blank"
                                    class="btn btn-danger btn-circle mr-1">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>

                            <div class="row" bis_skin_checked="1">
                                <div class="col-lg-6 col-md-12" bis_skin_checked="1">
                                    <div class="card mb-3" bis_skin_checked="1">
                                        <div class="card-body d-flex align-items-center" bis_skin_checked="1">
                                            <i class="fas fa-map-marker-alt text-warning mr-3"></i>
                                            <div>
                                                <strong>Alamat:</strong>
                                                <p class="mb-0">{{ Auth::user()->address ?? 'Belum diatur' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-3" bis_skin_checked="1">
                                        <div class="card-body d-flex align-items-center" bis_skin_checked="1">
                                            <i class="fab fa-whatsapp text-success mr-3"></i>
                                            <div class="mask_phone">
                                                <strong>WhatsApp:</strong>
                                                <p class="mb-0">{{ Auth::user()->whatsapp ?? 'Belum diatur' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12" bis_skin_checked="1">
                                    <div class="card mb-3" bis_skin_checked="1">
                                        <div class="card-body d-flex align-items-center" bis_skin_checked="1">
                                            <i class="far fa-envelope text-danger mr-3"></i>
                                            <div>
                                                <strong>Email:</strong>
                                                <p class="mb-0">{{ Auth::user()->email }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-3" bis_skin_checked="1">
                                        <div class="card-body d-flex align-items-center" bis_skin_checked="1">
                                            <i class="fas fa-link text-primary mr-3"></i>
                                            <div>
                                                <strong>Website:</strong>
                                                <p class="mb-0">
                                                    <a href="{{ Auth::user()->website ?? '#' }}" target="_blank">
                                                        {{ Auth::user()->website ?? 'Belum diatur' }}
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="mt-4">

                            <div class="form-group pt-3" bis_skin_checked="1">
                                <!-- tombol ubah data -->
                                <a href="{{ route('profil.ubah') }}" class="btn btn-ubah-profil btn-rounded">Ubah
                                    Profil</a>
                            </div>
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
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
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
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <!-- Script to show modal on page load -->
</body>

</html>
