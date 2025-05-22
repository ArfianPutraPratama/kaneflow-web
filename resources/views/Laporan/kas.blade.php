<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Cash flow report page for SB Admin 2 dashboard">
    <meta name="author" content="SB Admin 2">
    <title>SB Admin 2 - Laporan Arus Kas</title>

    <!-- Custom fonts for this template -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Custom styles for this template (SB Admin 2) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/css/sb-admin-2.min.css"
        rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        #preview-file {
            height: 170px;
            object-fit: cover;
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

        .form-control-file {
            padding: 0.375rem 0.75rem;
            border: 1px solid #d1d3e2;
            border-radius: 0.35rem;
        }

        .form-text {
            font-size: 0.8rem;
        }

        .table-responsive {
            overflow-x: hidden;
        }

        .table-actions {
            white-space: nowrap;
        }

        .action-btn {
            display: inline-block;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            border-radius: 50%;
            margin: 0 2px;
            color: white;
            font-size: 14px;
        }

        .modal-confirm {
            background: rgba(0, 0, 0, 0.8);
        }

        .modal-confirm .modal-content {
            background: #1f2a44;
            color: white;
            border-radius: 10px;
        }

        .modal-confirm .modal-header {
            border-bottom: none;
        }

        .modal-confirm .modal-body {
            font-size: 1rem;
            padding: 1.5rem;
        }

        .modal-confirm .modal-footer {
            border-top: none;
            justify-content: center;
            padding-bottom: 1.5rem;
        }

        .modal-confirm .btn-ok {
            background: #e0f7fa;
            color: #1f2a44;
            border-radius: 20px;
            padding: 0.5rem 2rem;
            font-weight: 600;
        }

        .modal-confirm .btn-cancel {
            background: #2e3b55;
            color: white;
            border-radius: 20px;
            padding: 0.5rem 2rem;
            font-weight: 600;
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

        .notification .icon {
            margin-right: 0.75rem;
            font-size: 1.2rem;
        }

        .notification .close-btn {
            margin-left: auto;
            cursor: pointer;
            font-size: 1rem;
            color: #28a745;
        }

        .filter-form-container {
            padding: 20px;
        }

        .filter-form-row {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            gap: 15px;
        }

        .filter-form-group {
            flex: 1;
            min-width: 200px;
        }

        .filter-form-group label {
            display: block;
            font-size: 0.9rem;
            color: #5a5c69;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .filter-form-control {
            width: 100%;
            height: 38px;
            padding: 8px 12px;
            border: 1px solid #d1d3e2;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .filter-btn {
            height: 38px;
            padding: 8px 20px;
            background-color: #159245;
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            transition: background 0.2s;
        }

        .filter-btn:hover {
            background-color: #166534;
        }

        .filter-btn:active,
        .filter-btn:focus {
            background-color: #166534 !important;
            outline: none;
            box-shadow: none;
        }

        @media (max-width: 768px) {
            .filter-form-row {
                flex-direction: column;
            }

            .filter-form-group {
                width: 100%;
            }

            .filter-btn {
                width: 100%;
            }
        }

        /* Custom styling for the report */
        .report-header {
            background-color: #e3f2fd;
            padding: 10px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #dee2e6;
        }

        .report-header h6 {
            margin: 0;
            font-weight: 600;
            color: #159245;
            /* Match green theme */
        }

        .print-btn {
            background-color: #f1c40f;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background 0.2s;
        }

        .print-btn:hover {
            background-color: #d4ac0d;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th,
        .table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: center;
            vertical-align: middle;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        .table .total-row {
            background-color: #ecf0f1;
            font-weight: 600;
        }

        .no-data-message {
            text-align: center;
            padding: 20px;
            color: #5a5c69;
            font-style: italic;
        }

        /* Print-specific styles */
        @media print {
            body {
                margin: 0;
                padding: 0;
                background: #fff;
            }

            #wrapper,
            #content-wrapper,
            #content,
            .container-fluid {
                width: 100%;
                margin: 0;
                padding: 0;
                background: none;
                box-shadow: none;
            }

            /* Hide sidebar and other elements not needed in print */
            #sidebar,
            .navbar,
            .filter-form-container,
            .print-btn,
            .scroll-to-top,
            #sidebarToggleTop,
            #logoutModal {
                display: none !important;
            }

            /* Center the content for print */
            .card.shadow.mb-4 {
                margin: 0 auto;
                padding: 0;
                border: none;
                box-shadow: none;
                width: 100%;
                max-width: 800px;
            }

            .report-header {
                display: block;
                text-align: center;
                padding: 10px 0;
                margin-bottom: 20px;
                border: none;
                background: none;
            }

            .report-header::before {
                content: "CETAK LAPORAN ARUS KAS";
                display: block;
                font-size: 18px;
                font-weight: bold;
                color: #000;
                text-transform: uppercase;
                margin-bottom: 5px;
            }

            .report-header::after {
                content: "Dicetak pada: Selasa, 20 Mei 2025, 11:30 WIB";
                display: block;
                font-size: 12px;
                color: #666;
                margin-top: 5px;
            }

            .card-body {
                padding: 0;
            }

            .table-responsive {
                overflow-x: auto;
                margin: 0 auto;
            }

            .table {
                width: 100%;
                border-collapse: collapse;
                font-size: 12px;
                border: 1px solid #000;
            }

            .table th,
            .table td {
                border: 1px solid #000;
                padding: 6px;
                text-align: center;
                vertical-align: middle;
            }

            .table th {
                background-color: #f0f0f0;
                font-weight: bold;
            }

            .table .total-row {
                background-color: #f5f5f5;
                font-weight: bold;
            }

            /* Add footer note */
            .card-body::after {
                content: "Generated by SB Admin 2 Dashboard";
                display: block;
                text-align: center;
                font-size: 10px;
                color: #666;
                margin-top: 20px;
            }

            /* Ensure table fits on print page */
            @page {
                size: A4;
                margin: 15mm;
            }

            /* Responsive adjustments for print */
            @media print and (max-width: 768px) {

                .table th,
                .table td {
                    font-size: 10px;
                    padding: 4px;
                }

                .card.shadow.mb-4 {
                    max-width: 100%;
                }
            }
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
                    <!-- Page Title -->
                    <h1 class="h4 mb-4 text-gray-800"><i class="fas fa-file-contract fa-fw mr-2"></i>Laporan Arus Kas
                    </h1>

                    <!-- Filter Card -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">Filter Data</h6>
                        </div>
                        <div class="card-body filter-form-container">
                            <form action="{{ route('Laporan.Kas') }}" method="post" class="needs-validation"
                                novalidate>
                                @csrf
                                <div class="filter-form-row">
                                    <div class="filter-form-group">
                                        <label for="tahun">Tahun <span class="text-danger">*</span></label>
                                        <select name="tahun" id="tahun" class="filter-form-control" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="2022"
                                                {{ old('tahun', $tahun ?? '') == '2022' ? 'selected' : '' }}>2022
                                            </option>
                                            <option value="2023"
                                                {{ old('tahun', $tahun ?? '') == '2023' ? 'selected' : '' }}>2023
                                            </option>
                                            <option value="2024"
                                                {{ old('tahun', $tahun ?? '') == '2024' ? 'selected' : '' }}>2024
                                            </option>
                                            <option value="2025"
                                                {{ old('tahun', $tahun ?? '') == '2025' ? 'selected' : '' }}>2025
                                            </option>
                                        </select>
                                        <div class="invalid-feedback">Tahun tidak boleh kosong.</div>
                                    </div>
                                    <div class="filter-form-group">
                                        <button type="submit" name="tampil" class="filter-btn">Tampilkan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Cash Flow Report Table -->
                    @if (request()->isMethod('post'))
                        @if (isset($data) && !empty($data))
                            <div class="card shadow mb-4">
                                <div class="report-header">
                                    <h6>Laporan Arus Kas Tahun {{ $tahun }}</h6>
                                    <button class="print-btn" onclick="window.print()"><i class="fas fa-print"></i>
                                        Cetak</button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Bulan</th>
                                                    <th>Pemasukan</th>
                                                    <th>Pengeluaran</th>
                                                    <th>Selisih</th>
                                                    <th>Saldo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $index => $row)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $row['bulan'] }}</td>
                                                        <td>Rp. {{ number_format($row['pemasukan'], 0, ',', '.') }}</td>
                                                        <td>Rp. {{ number_format($row['pengeluaran'], 0, ',', '.') }}
                                                        </td>
                                                        <td>Rp. {{ number_format($row['selisih'], 0, ',', '.') }}</td>
                                                        <td>Rp. {{ number_format($row['saldo'], 0, ',', '.') }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr class="total-row">
                                                    <td colspan="2">Total Pemasukan</td>
                                                    <td>Rp. {{ number_format($totalPemasukan, 0, ',', '.') }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr class="total-row">
                                                    <td colspan="2">Total Pengeluaran</td>
                                                    <td></td>
                                                    <td>Rp. {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr class="total-row">
                                                    <td colspan="2">Saldo Akhir</td>
                                                    <td colspan="3"></td>
                                                    <td>Rp. {{ number_format($saldo, 0, ',', '.') }}</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="card shadow mb-4">
                                <div class="report-header">
                                    <h6>Laporan Arus Kas Tahun {{ $tahun ?? 'Tidak Dipilih' }}</h6>
                                </div>
                                <div class="card-body">
                                    <div class="no-data-message">
                                        Tidak ada data transaksi untuk tahun {{ $tahun ?? 'yang dipilih' }}.
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
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

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/js/sb-admin-2.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <!-- Custom script for form validation and DataTables -->
    <script>
        $(document).ready(function() {
                    // Bootstrap form validation
                    (function() {
                        'use strict';
                        window.addEventListener('load', function() {
                            var forms = document.getElementsByClassName('needs-validation');
                            Array.prototype.filter.call(forms, function(form) {
                                form.addEventListener('submit', function(event) {
                                    if (form.checkValidity() === false) {
                                        event.preventDefault();
                                        event.stopPropagation();
                                        alert('Silakan pilih tahun terlebih dahulu.');
                                    }
                                    form.classList.add('was-validated');
                                }, false);
                            });
                        }, false);
                    })();
    </script>
</body>

</html>
