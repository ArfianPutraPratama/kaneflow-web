<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Transaksi</title>
    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/css/sb-admin-2.min.css"
        rel="stylesheet">
    <!-- Custom CSS for modal -->
    <style>
        .card {
            border: none;
            border-radius: 0.5rem;
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem 1.5rem;
        }

        .card-header h6 {
            font-size: 1rem;
            color: #4e73df;
        }

        .detail-table {
            margin-bottom: 0;
        }

        .detail-table td {
            padding: 0.4rem 0.5rem;
            border: none;
            font-size: 0.9rem;
        }

        .detail-table td:first-child {
            font-weight: 600;
            color: #5a5c69;
            width: 180px;
        }

        .divider {
            border-top: 1px solid #e3e6f0;
            margin: 1.5rem 0;
        }

        .receipt-table td {
            padding: 0.4rem 0.5rem;
            border: none;
            font-size: 0.9rem;
            vertical-align: top;
        }

        .receipt-table td:first-child {
            font-weight: 600;
            color: #5a5c69;
            width: 180px;
        }

        .receipt-box {
            border: 1px solid #e3e6f0;
            border-radius: 0.35rem;
            padding: 1rem;
            width: 50%;
            background-color: white;
            text-align: center;
        }

        .receipt-image {
            max-width: 100%;
            height: 200px;
            object-fit: contain;
        }

        .no-image {
            color: #858796;
            font-style: italic;
            font-size: 0.9rem;
            padding: 1rem;
        }

        .btn-sm {
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
        }

        .fas.fa-sign-in-alt,
        .fas.fa-arrow-left {
            margin-right: 0.5rem;
        }

        .btn-kembali {
            background-color: #166534;
            border-color: #166534;
            color: white !important;
            transition: all 0.3s ease;
        }

        .btn-kembali:hover {
            background-color: #22c55e;
            border-color: #22c55e;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-kembali:active {
            transform: translateY(0);
        }

        .btn-kembali i,
        .btn-kembali span {
            color: white !important;
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h4 mb-sm-0 text-gray-800"><i class="fas fa-sign-in-alt fa-fw mr-2"></i>Pemasukan</h1>
                        <a href="{{ route('pemasukan.tabel') }}" class="btn btn-kembali btn-sm">
                            <i class="fas fa-arrow-left"></i>
                            <span>Kembali</span>
                        </a>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Detail Data Pemasukan</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless detail-table">
                                <tbody>
                                    <tr>
                                        <td width="180">Tanggal</td>
                                        <td width="10">:</td>
                                        <td>{{ \Carbon\Carbon::parse($pemasukan->tanggal)->format('d-m-Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kategori Pemasukan</td>
                                        <td>:</td>
                                        <td>{{ $pemasukan->kategori }}</td>
                                    </tr>
                                    <tr>
                                        <td>Deskripsi Transaksi</td>
                                        <td>:</td>
                                        <td>{{ $pemasukan->deskripsi }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah</td>
                                        <td>:</td>
                                        <td>Rp. {{ number_format($pemasukan->jumlah, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr class="divider">
                            <table class="table table-borderless receipt-table">
                                <tbody>
                                    <tr>
                                        <td width="180">Bukti Transaksi</td>
                                        <td width="10">:</td>
                                        <td>
                                            <div class="receipt-box">
                                                @if ($pemasukan->bukti_transaksi && Storage::disk('public')->exists($pemasukan->bukti_transaksi))
                                                    <img src="{{ asset('storage/' . $pemasukan->bukti_transaksi) }}"
                                                        class="receipt-image" alt="Bukti Transaksi">
                                                @else
                                                    <div class="no-image">Tidak ada bukti transaksi.</div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
</body>

</html>
