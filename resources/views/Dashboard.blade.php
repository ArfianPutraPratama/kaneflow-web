<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Kaneflow - Personal Finance Management">
    <meta name="author" content="Kaneflow Team">
    <title>Kaneflow - Dashboard</title>
    <!-- Custom fonts for this template -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <!-- Custom CSS for modal and top transactions -->
    <style>
        #demoModal .modal-content {
            position: relative;
            display: flex;
            flex-direction: column;
            width: 100%;
            pointer-events: auto;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, .2);
            border-radius: .3rem;
            outline: 0;
        }

        #demoModal .modal-body {
            position: relative;
            flex: 1 1 auto;
            padding: 1rem;
        }

        #demoModal .modal-dialog {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0 auto;
            max-width: 600px;
            width: 100%;
        }

        .card-top-transactions {
            border: 1px solid #e3e6f0;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            background-color: #fff;
            min-height: 100px;
            display: flex;
            flex-direction: column;
        }

        .card-top-transactions .card-header {
            padding: 0.75rem 1.25rem;
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
        }

        .card-top-transactions .card-body {
            flex: 1;
            padding: 1rem;
            overflow-y: auto;
            max-height: 300px;
        }

        .transaction-data {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
        }

        .green-700 {
            color: #15803d;
        }

        .btn-pemasukan {
            background-color: #15803d;
            border-color: #15803d;
            color: white;
        }

        .btn-pemasukan:hover {
            background-color: #166534;
            border-color: #166534;
        }

        .btn-confirm {
            background-color: #15803d;
            color: white;
            border-color: #15803d;
        }

        .btn-confirm:hover {
            background-color: #166534;
            border-color: #166534;
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
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    @include('components.user-menu')
                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h4 mb-4 text-gray-800"><i class="fas fa-fw fa-tachometer-alt mr-2"></i>Dashboard</h1>
                    <div class="card card-waves shadow mb-5">
                        <div class="card-body p-5">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-lg-3 d-none d-lg-block mt-xxl-n4">
                                    <img class="img-fluid px-xl-4 mt-xxl-n5"
                                        src="{{ asset('images/bg-dashboard.jpg') }}" alt="Dashboard Image">
                                </div>
                                <div class="col-lg-9">
                                    <h4 class="green-700">
                                        Selamat datang di <strong>Kaneflow</strong>!
                                    </h4>
                                    <p class="text-gray-700 pb-3">Kaneflow merupakan aplikasi manajemen keuangan pribadi
                                        berbasis website yang akan membantu mengelola keuangan Anda.</p>
                                    <a href="{{ route('pemasukan') }}"
                                        class="btn btn-pemasukan btn-rounded-dashboard mr-3">
                                        <i class="fas fa-plus mr-2"></i> Pemasukan
                                    </a>
                                    <a href="{{ route('Pengeluaran') }}" class="btn btn-warning btn-rounded-dashboard">
                                        <i class="fas fa-plus mr-2"></i> Pengeluaran
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h5 class="text-primary pt-2"><i class="fas fa-fw fa-minus mr-2"></i>Keuangan Bulan
                        {{ $currentMonth }}</h5>
                    <hr>
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Saldo Awal -->
                        <div class="col-lg-3 col-md-12 mb-2">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="font-weight-bold text-primary mb-2">Saldo Awal</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                Rp. {{ number_format($saldoAwal, 0, ',', '.') }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Pemasukan -->
                        <div class="col-lg-3 col-md-12 mb-2">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="font-weight-bold text-info mb-2">Pemasukan</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                Rp. {{ number_format($totalPemasukan, 0, ',', '.') }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-sign-in-alt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Pengeluaran -->
                        <div class="col-lg-3 col-md-12 mb-2">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="font-weight-bold text-warning mb-2">Pengeluaran</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                Rp. {{ number_format($totalPengeluaran, 0, ',', '.') }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-sign-out-alt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Saldo Akhir -->
                        <div class="col-lg-3 col-md-12 mb-2">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="font-weight-bold text-success mb-2">Saldo Akhir</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                Rp.
                                                {{ number_format($saldoAwal + $totalPemasukan - $totalPengeluaran, 0, ',', '.') }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-donate fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row pt-2 mb-4">
                        <div class="col-lg-6 col-md-12">
                            <div class="card card-top-transactions shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 text-gray-800"><i class="fas fa-sign-in-alt mr-2"></i>Pemasukan
                                        Terbanyak</h6>
                                </div>
                                <div class="card-body">
                                    @if (count($topPemasukan) > 0)
                                        @php
                                            $highestPemasukan = $topPemasukan[0];
                                        @endphp
                                        <div class="transaction-data">
                                            <span>{{ $highestPemasukan['kategori'] }}</span>
                                            <span>Rp.
                                                {{ number_format($highestPemasukan['jumlah'], 0, ',', '.') }}</span>
                                        </div>
                                    @else
                                        <p class="text-center text-gray-600">Tidak ada data pemasukan untuk bulan ini.
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="card card-top-transactions shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 text-gray-800"><i class="fas fa-sign-out-alt mr-2"></i>Pengeluaran
                                        Terbanyak</h6>
                                </div>
                                <div class="card-body">
                                    @if (count($topPengeluaran) > 0)
                                        @php
                                            $highestPengeluaran = $topPengeluaran[0];
                                        @endphp
                                        <div class="transaction-data">
                                            <span>{{ $highestPengeluaran['kategori'] }}</span>
                                            <span>Rp.
                                                {{ number_format($highestPengeluaran['jumlah'], 0, ',', '.') }}</span>
                                        </div>
                                    @else
                                        <p class="text-center text-gray-600">Tidak ada data pengeluaran untuk bulan
                                            ini.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
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
        <!-- Demo Modal -->
        <div class="modal fade" id="demoModal" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row align-items-center p-2 p-sm-4">
                            <div class="col-lg-4 mb-4 mb-lg-0">
                                <img class="img-fluid" src="{{ asset('images/helpdesk-hero.svg') }}"
                                    alt="Illustration">
                            </div>
                            <div class="col-lg-8">
                                <h4 class="mb-2">Kaneflow - Aplikasi Manajemen Keuangan Pribadi</h4>
                                <p class="text-muted mb-4">Aplikasi ini membantu Anda mengelola keuangan pribadi dengan
                                    mudah dan efisien.</p>
                                <div class="d-grid gap-2 d-lg-flex justify-content-lg-start">
                                    <button type="button" class="btn btn-confirm" data-bs-dismiss="modal">
                                        Ya, Saya Mengerti
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript -->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Custom scripts for all pages -->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
    <!-- Script to show modal on page load -->
    <script>
        $(document).ready(function() {
            $('#demoModal').modal('show');
        });
    </script>
</body>

</html>
