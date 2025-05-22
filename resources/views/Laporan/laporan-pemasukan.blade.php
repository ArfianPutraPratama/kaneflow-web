<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Laporan Pemasukan</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- Custom styles for this template (SB Admin 2) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/css/sb-admin-2.min.css"
        rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        .btn {
            font-size: 0.9rem;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 20px;
            border: none;
            transition: background 0.2s;
            white-space: nowrap;
        }

        .btn-primary {
            background: #159245;
            color: white;
        }

        .btn-primary:hover {
            background: #166534;
        }

        .btn-primary:active,
        .btn-primary:focus {
            background: #166534 !important;
            outline: none;
            box-shadow: none;
        }

        .btn-warning {
            background: #f0ad4e;
            color: white;
        }

        .btn-warning:hover {
            background: #ec971f;
        }

        .filter-form .row {
            align-items: flex-end;
        }

        .filter-form .form-group {
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .filter-form .row {
                flex-direction: column;
                align-items: stretch;
            }
        }

        .report-table {
            margin-top: 20px;
        }

        .report-table th,
        .report-table td {
            text-align: center;
            vertical-align: middle;
        }

        .report-header {
            background-color: #e9ecef;
            font-weight: bold;
        }

        .nav-tabs .nav-link {
            color: #4e73df;
            font-weight: 600;
        }

        .nav-tabs .nav-link.active {
            background-color: #e9ecef;
            color: #1a3c34;
        }

        .card-header h6 {
            color: #159245;
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
                    <h1 class="h4 mb-4 text-gray-800"><i class="fas fa-file-import fa-fw mr-2"></i>Laporan Pemasukan
                    </h1>

                    <div class="card">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">Filter Data Pemasukan</h6>
                        </div>
                        <div class="card-body">
                            <!-- Form -->
                            <form action="{{ route('laporan.pemasukan') }}" method="post"
                                class="needs-validation filter-form" novalidate>
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Bulan <span class="text-danger">*</span></label>
                                            <select name="bulan" class="form-control">
                                                <option value=""
                                                    {{ !isset($bulan) || $bulan === '' ? 'selected' : '' }}>-- Semua --
                                                </option>
                                                <option value="01"
                                                    {{ isset($bulan) && $bulan === '01' ? 'selected' : '' }}>Januari
                                                </option>
                                                <option value="02"
                                                    {{ isset($bulan) && $bulan === '02' ? 'selected' : '' }}>Februari
                                                </option>
                                                <option value="03"
                                                    {{ isset($bulan) && $bulan === '03' ? 'selected' : '' }}>Maret
                                                </option>
                                                <option value="04"
                                                    {{ isset($bulan) && $bulan === '04' ? 'selected' : '' }}>April
                                                </option>
                                                <option value="05"
                                                    {{ isset($bulan) && $bulan === '05' ? 'selected' : '' }}>Mei
                                                </option>
                                                <option value="06"
                                                    {{ isset($bulan) && $bulan === '06' ? 'selected' : '' }}>Juni
                                                </option>
                                                <option value="07"
                                                    {{ isset($bulan) && $bulan === '07' ? 'selected' : '' }}>Juli
                                                </option>
                                                <option value="08"
                                                    {{ isset($bulan) && $bulan === '08' ? 'selected' : '' }}>Agustus
                                                </option>
                                                <option value="09"
                                                    {{ isset($bulan) && $bulan === '09' ? 'selected' : '' }}>September
                                                </option>
                                                <option value="10"
                                                    {{ isset($bulan) && $bulan === '10' ? 'selected' : '' }}>Oktober
                                                </option>
                                                <option value="11"
                                                    {{ isset($bulan) && $bulan === '11' ? 'selected' : '' }}>November
                                                </option>
                                                <option value="12"
                                                    {{ isset($bulan) && $bulan === '12' ? 'selected' : '' }}>Desember
                                                </option>
                                            </select>
                                            <div class="invalid-feedback">Bulan harus dipilih.</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Tahun <span class="text-danger">*</span></label>
                                            <select name="tahun" class="form-control" required>
                                                <option value=""
                                                    {{ !isset($tahun) || $tahun === '' ? 'selected' : '' }}>-- Semua --
                                                </option>
                                                <option value="2022"
                                                    {{ isset($tahun) && $tahun == '2022' ? 'selected' : '' }}>2022
                                                </option>
                                                <option value="2023"
                                                    {{ isset($tahun) && $tahun == '2023' ? 'selected' : '' }}>2023
                                                </option>
                                                <option value="2024"
                                                    {{ isset($tahun) && $tahun == '2024' ? 'selected' : '' }}>2024
                                                </option>
                                                <option value="2025"
                                                    {{ isset($tahun) && $tahun == '2025' ? 'selected' : '' }}>2025
                                                </option>
                                            </select>
                                            <div class="invalid-feedback">Tahun harus dipilih.</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Kategori <span class="text-danger">*</span></label>
                                            <select name="kategori" class="form-control">
                                                <option value=""
                                                    {{ !isset($kategori) || $kategori === '' ? 'selected' : '' }}>--
                                                    Semua --</option>
                                                <option value="1"
                                                    {{ isset($kategori) && $kategori == '1' ? 'selected' : '' }}>Gaji
                                                </option>
                                                <option value="2"
                                                    {{ isset($kategori) && $kategori == '2' ? 'selected' : '' }}>Hadiah
                                                </option>
                                                <option value="3"
                                                    {{ isset($kategori) && $kategori == '3' ? 'selected' : '' }}>Jasa
                                                    Web Development</option>
                                                <option value="4"
                                                    {{ isset($kategori) && $kategori == '4' ? 'selected' : '' }}>Jasa
                                                    Web Desain</option>
                                                <option value="5"
                                                    {{ isset($kategori) && $kategori == '5' ? 'selected' : '' }}>Jasa
                                                    Digital Marketing</option>
                                                <option value="6"
                                                    {{ isset($kategori) && $kategori == '6' ? 'selected' : '' }}>Jasa
                                                    Kursus dan Pelatihan</option>
                                                <option value="7"
                                                    {{ isset($kategori) && $kategori == '7' ? 'selected' : '' }}>
                                                    Penjualan E-Book</option>
                                                <option value="8"
                                                    {{ isset($kategori) && $kategori == '8' ? 'selected' : '' }}>
                                                    Penjualan Video Tutorial</option>
                                                <option value="9"
                                                    {{ isset($kategori) && $kategori == '9' ? 'selected' : '' }}>
                                                    Penjualan Sourcecode</option>
                                                <option value="10"
                                                    {{ isset($kategori) && $kategori == '10' ? 'selected' : '' }}>
                                                    Pemasukan Lainnya</option>
                                            </select>
                                            <div class="invalid-feedback">Kategori harus dipilih.</div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button type="submit" name="tampilkan"
                                                class="btn btn-primary w-100">Tampilkan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <!-- Report Section -->
                            @if (request()->isMethod('post'))
                                @php
                                    $bulanText = [
                                        '01' => 'Januari',
                                        '02' => 'Februari',
                                        '03' => 'Maret',
                                        '04' => 'April',
                                        '05' => 'Mei',
                                        '06' => 'Juni',
                                        '07' => 'Juli',
                                        '08' => 'Agustus',
                                        '09' => 'September',
                                        '10' => 'Oktober',
                                        '11' => 'November',
                                        '12' => 'Desember',
                                    ];
                                    $kategoriText = [
                                        '1' => 'Gaji',
                                        '2' => 'Hadiah',
                                        '3' => 'Jasa Web Development',
                                        '4' => 'Jasa Web Desain',
                                        '5' => 'Jasa Digital Marketing',
                                        '6' => 'Jasa Kursus dan Pelatihan',
                                        '7' => 'Penjualan E-Book',
                                        '8' => 'Penjualan Video Tutorial',
                                        '9' => 'Penjualan Sourcecode',
                                        '10' => 'Pemasukan Lainnya',
                                    ];
                                    $bulanDisplay = isset($bulan) && $bulan ? $bulanText[$bulan] : 'Semua';
                                    $tahunDisplay = isset($tahun) && $tahun ? $tahun : 'Semua';
                                    $kategoriDisplay =
                                        isset($kategori) && $kategori ? $kategoriText[$kategori] : 'Semua';
                                @endphp

                                @if (empty($bulan) && empty($kategori) && !empty($tahun))
                                    <!-- Summary Table for Bulan=Semua, Kategori=Semua, Tahun=Selected -->
                                    <div class="card mt-4">
                                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                            <h6 class="m-0 font-weight-bold text-primary">Laporan Pemasukan Tahun
                                                {{ $tahunDisplay }}</h6>
                                            <button class="btn btn-warning">Cetak</button>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered report-table">
                                                <thead class="report-header">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Bulan</th>
                                                        <th>Transaksi</th>
                                                        <th>Pemasukan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (isset($data) && !empty($data))
                                                        @foreach ($data as $index => $row)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $row['bulan'] }}</td>
                                                                <td>{{ $row['total_transaksi'] }}</td>
                                                                <td>Rp.
                                                                    {{ number_format($row['total_pemasukan'], 0, ',', '.') }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="4" class="text-center">Tidak ada data
                                                                pemasukan untuk tahun ini.</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="2" style="text-align: center;">TOTAL</th>
                                                        <th>{{ $totalTransaksi }}</th>
                                                        <th>Rp. {{ number_format($totalPemasukan, 0, ',', '.') }}</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                @elseif (empty($bulan) && empty($tahun) && empty($kategori))
                                    <!-- Placeholder for all fields empty -->
                                    <div class="alert alert-warning mt-4">Data tidak tersedia untuk kombinasi filter
                                        ini. Silakan pilih setidaknya satu filter.</div>
                                @elseif (!empty($bulan) && empty($tahun) && empty($kategori))
                                    <!-- Detailed Table for Bulan=Selected, Tahun=Semua, Kategori=Semua -->
                                    @php
                                        // Fetch pemasukanData from session with user-specific key
                                        $pemasukanData = session('pemasukanData_' . Auth::id(), []);
                                        $filteredData = [];
                                        $totalPemasukanDetail = 0;

                                        // Filter data by selected month
                                        foreach ($pemasukanData as $item) {
                                            $itemDate = \Carbon\Carbon::createFromFormat('d-m-Y', $item['tanggal']);
                                            $itemMonth = $itemDate->format('m');

                                            if ($itemMonth == $bulan) {
                                                $filteredData[] = $item;
                                                $totalPemasukanDetail += $item['jumlah'];
                                            }
                                        }
                                    @endphp

                                    <ul class="nav nav-tabs mt-4" id="reportTabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="laporan-tab" data-toggle="tab"
                                                href="#laporan" role="tab" aria-controls="laporan"
                                                aria-selected="true">Laporan Pemasukan</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="detail-tab" data-toggle="tab" href="#detail"
                                                role="tab" aria-controls="detail" aria-selected="false">Detail
                                                Laporan Pemasukan</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="reportTabsContent">
                                        <!-- Laporan Pemasukan Tab (Summary) -->
                                        <div class="tab-pane fade show active" id="laporan" role="tabpanel"
                                            aria-labelledby="laporan-tab">
                                            <div class="card mt-2">
                                                <div
                                                    class="card-header py-3 d-flex justify-content-between align-items-center">
                                                    <h6 class="m-0 font-weight-bold text-primary">
                                                        Laporan Pemasukan Bulan {{ $bulanDisplay }}, Tahun Semua,
                                                        Kategori {{ $kategoriDisplay }}
                                                    </h6>
                                                    <button class="btn btn-warning">Cetak</button>
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-bordered report-table">
                                                        <thead class="report-header">
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Tanggal</th>
                                                                <th>Transaksi</th>
                                                                <th>Pemasukan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if (count($filteredData) > 0)
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>{{ $bulanDisplay }}</td>
                                                                    <td>{{ count($filteredData) }}</td>
                                                                    <td>Rp.
                                                                        {{ number_format($totalPemasukanDetail, 0, ',', '.') }}
                                                                    </td>
                                                                </tr>
                                                            @else
                                                                <tr>
                                                                    <td colspan="4" class="text-center">Tidak ada
                                                                        data untuk ditampilkan.</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th colspan="2">Total</th>
                                                                <th>{{ count($filteredData) }}</th>
                                                                <th>Rp.
                                                                    {{ number_format($totalPemasukanDetail, 0, ',', '.') }}
                                                                </th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Detail Laporan Pemasukan Tab -->
                                        <div class="tab-pane fade" id="detail" role="tabpanel"
                                            aria-labelledby="detail-tab">
                                            <div class="card mt-2">
                                                <div
                                                    class="card-header py-3 d-flex justify-content-between align-items-center">
                                                    <h6 class="m-0 font-weight-bold text-primary">
                                                        Detail Laporan Pemasukan Bulan {{ $bulanDisplay }}, Tahun
                                                        Semua, Kategori {{ $kategoriDisplay }}
                                                    </h6>
                                                    <button class="btn btn-warning">Cetak</button>
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-bordered report-table">
                                                        <thead class="report-header">
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Tanggal</th>
                                                                <th>Kategori Pemasukan</th>
                                                                <th>Deskripsi Transaksi</th>
                                                                <th>Jumlah</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if (count($filteredData) > 0)
                                                                @foreach ($filteredData as $index => $item)
                                                                    <tr>
                                                                        <td>{{ $index + 1 }}</td>
                                                                        <td>{{ $item['tanggal'] }}</td>
                                                                        <td>{{ $item['kategori'] }}</td>
                                                                        <td>{{ $item['deskripsi'] }}</td>
                                                                        <td>Rp.
                                                                            {{ number_format($item['jumlah'], 0, ',', '.') }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td colspan="5" class="text-center">Tidak ada
                                                                        data untuk ditampilkan.</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th colspan="4">Total Pemasukan</th>
                                                                <th>Rp.
                                                                    {{ number_format($totalPemasukanDetail, 0, ',', '.') }}
                                                                </th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif (!empty($bulan) && !empty($tahun) && empty($kategori))
                                    <!-- Detailed Table for Bulan=Selected, Tahun=Selected, Kategori=Semua -->
                                    @php
                                        // Fetch pemasukanData from session with user-specific key
                                        $pemasukanData = session('pemasukanData_' . Auth::id(), []);
                                        $filteredData = [];
                                        $totalPemasukanDetail = 0;

                                        // Filter data by selected month and year
                                        foreach ($pemasukanData as $item) {
                                            $itemDate = \Carbon\Carbon::createFromFormat('d-m-Y', $item['tanggal']);
                                            $itemMonth = $itemDate->format('m');
                                            $itemYear = $itemDate->format('Y');

                                            if ($itemMonth == $bulan && $itemYear == $tahun) {
                                                $filteredData[] = $item;
                                                $totalPemasukanDetail += $item['jumlah'];
                                            }
                                        }
                                    @endphp

                                    <ul class="nav nav-tabs mt-4" id="reportTabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="laporan-tab" data-toggle="tab"
                                                href="#laporan" role="tab" aria-controls="laporan"
                                                aria-selected="true">Laporan Pemasukan</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="detail-tab" data-toggle="tab" href="#detail"
                                                role="tab" aria-controls="detail" aria-selected="false">Detail
                                                Laporan Pemasukan</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="reportTabsContent">
                                        <!-- Laporan Pemasukan Tab (Summary) -->
                                        <div class="tab-pane fade show active" id="laporan" role="tabpanel"
                                            aria-labelledby="laporan-tab">
                                            <div class="card mt-2">
                                                <div
                                                    class="card-header py-3 d-flex justify-content-between align-items-center">
                                                    <h6 class="m-0 font-weight-bold text-primary">
                                                        Laporan Pemasukan Bulan {{ $bulanDisplay }} Tahun
                                                        {{ $tahunDisplay }}, Kategori {{ $kategoriDisplay }}
                                                    </h6>
                                                    <button class="btn btn-warning">Cetak</button>
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-bordered report-table">
                                                        <thead class="report-header">
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Tanggal</th>
                                                                <th>Transaksi</th>
                                                                <th>Pemasukan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if (count($filteredData) > 0)
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>{{ $bulanDisplay }} {{ $tahunDisplay }}</td>
                                                                    <td>{{ count($filteredData) }}</td>
                                                                    <td>Rp.
                                                                        {{ number_format($totalPemasukanDetail, 0, ',', '.') }}
                                                                    </td>
                                                                </tr>
                                                            @else
                                                                <tr>
                                                                    <td colspan="4" class="text-center">Tidak ada
                                                                        data untuk ditampilkan.</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th colspan="2">Total</th>
                                                                <th>{{ count($filteredData) }}</th>
                                                                <th>Rp.
                                                                    {{ number_format($totalPemasukanDetail, 0, ',', '.') }}
                                                                </th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Detail Laporan Pemasukan Tab -->
                                        <div class="tab-pane fade" id="detail" role="tabpanel"
                                            aria-labelledby="detail-tab">
                                            <div class="card mt-2">
                                                <div
                                                    class="card-header py-3 d-flex justify-content-between align-items-center">
                                                    <h6 class="m-0 font-weight-bold text-primary">
                                                        Detail Laporan Pemasukan Bulan {{ $bulanDisplay }} Tahun
                                                        {{ $tahunDisplay }}, Kategori {{ $kategoriDisplay }}
                                                    </h6>
                                                    <button class="btn btn-warning">Cetak</button>
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-bordered report-table">
                                                        <thead class="report-header">
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Tanggal</th>
                                                                <th>Kategori Pemasukan</th>
                                                                <th>Deskripsi Transaksi</th>
                                                                <th>Jumlah</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if (count($filteredData) > 0)
                                                                @foreach ($filteredData as $index => $item)
                                                                    <tr>
                                                                        <td>{{ $index + 1 }}</td>
                                                                        <td>{{ $item['tanggal'] }}</td>
                                                                        <td>{{ $item['kategori'] }}</td>
                                                                        <td>{{ $item['deskripsi'] }}</td>
                                                                        <td>Rp.
                                                                            {{ number_format($item['jumlah'], 0, ',', '.') }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td colspan="5" class="text-center">Tidak ada
                                                                        data untuk ditampilkan.</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th colspan="4">Total Pemasukan</th>
                                                                <th>Rp.
                                                                    {{ number_format($totalPemasukanDetail, 0, ',', '.') }}
                                                                </th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif (!empty($bulan) && !empty($tahun) && !empty($kategori))
                                    <!-- Detailed Table for Bulan=Selected, Tahun=Selected, Kategori=Selected -->
                                    @php
                                        // Fetch pemasukanData from session with user-specific key
                                        $pemasukanData = session('pemasukanData_' . Auth::id(), []);
                                        $filteredData = [];
                                        $totalPemasukanDetail = 0;

                                        // Filter data by selected month, year, and category
                                        foreach ($pemasukanData as $item) {
                                            $itemDate = \Carbon\Carbon::createFromFormat('d-m-Y', $item['tanggal']);
                                            $itemMonth = $itemDate->format('m');
                                            $itemYear = $itemDate->format('Y');
                                            $itemKategori = $item['kategori'];

                                            // Match category (using kategoriText to map the value)
                                            $kategoriValue = $kategoriText[$kategori] ?? null;
                                            if (
                                                $itemMonth == $bulan &&
                                                $itemYear == $tahun &&
                                                $itemKategori == $kategoriValue
                                            ) {
                                                $filteredData[] = $item;
                                                $totalPemasukanDetail += $item['jumlah'];
                                            }
                                        }
                                    @endphp

                                    <ul class="nav nav-tabs mt-4" id="reportTabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="laporan-tab" data-toggle="tab"
                                                href="#laporan" role="tab" aria-controls="laporan"
                                                aria-selected="true">Laporan Pemasukan</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="detail-tab" data-toggle="tab" href="#detail"
                                                role="tab" aria-controls="detail" aria-selected="false">Detail
                                                Laporan Pemasukan</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="reportTabsContent">
                                        <!-- Laporan Pemasukan Tab (Summary) -->
                                        <div class="tab-pane fade show active" id="laporan" role="tabpanel"
                                            aria-labelledby="laporan-tab">
                                            <div class="card mt-2">
                                                <div
                                                    class="card-header py-3 d-flex justify-content-between align-items-center">
                                                    <h6 class="m-0 font-weight-bold text-primary">
                                                        Laporan Pemasukan Bulan {{ $bulanDisplay }} Tahun
                                                        {{ $tahunDisplay }}, Kategori {{ $kategoriDisplay }}
                                                    </h6>
                                                    <button class="btn btn-warning">Cetak</button>
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-bordered report-table">
                                                        <thead class="report-header">
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Tanggal</th>
                                                                <th>Transaksi</th>
                                                                <th>Pemasukan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if (count($filteredData) > 0)
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>{{ $bulanDisplay }} {{ $tahunDisplay }}</td>
                                                                    <td>{{ count($filteredData) }}</td>
                                                                    <td>Rp.
                                                                        {{ number_format($totalPemasukanDetail, 0, ',', '.') }}
                                                                    </td>
                                                                </tr>
                                                            @else
                                                                <tr>
                                                                    <td colspan="4" class="text-center">Tidak ada
                                                                        data untuk ditampilkan.</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th colspan="2">Total</th>
                                                                <th>{{ count($filteredData) }}</th>
                                                                <th>Rp.
                                                                    {{ number_format($totalPemasukanDetail, 0, ',', '.') }}
                                                                </th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Detail Laporan Pemasukan Tab -->
                                        <div class="tab-pane fade" id="detail" role="tabpanel"
                                            aria-labelledby="detail-tab">
                                            <div class="card mt-2">
                                                <div
                                                    class="card-header py-3 d-flex justify-content-between align-items-center">
                                                    <h6 class="m-0 font-weight-bold text-primary">
                                                        Detail Laporan Pemasukan Bulan {{ $bulanDisplay }} Tahun
                                                        {{ $tahunDisplay }}, Kategori {{ $kategoriDisplay }}
                                                    </h6>
                                                    <button class="btn btn-warning">Cetak</button>
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-bordered report-table">
                                                        <thead class="report-header">
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Tanggal</th>
                                                                <th>Kategori Pemasukan</th>
                                                                <th>Deskripsi Transaksi</th>
                                                                <th>Jumlah</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if (count($filteredData) > 0)
                                                                @foreach ($filteredData as $index => $item)
                                                                    <tr>
                                                                        <td>{{ $index + 1 }}</td>
                                                                        <td>{{ $item['tanggal'] }}</td>
                                                                        <td>{{ $item['kategori'] }}</td>
                                                                        <td>{{ $item['deskripsi'] }}</td>
                                                                        <td>Rp.
                                                                            {{ number_format($item['jumlah'], 0, ',', '.') }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td colspan="5" class="text-center">Tidak ada
                                                                        data untuk ditampilkan.</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th colspan="4">Total Pemasukan</th>
                                                                <th>Rp.
                                                                    {{ number_format($totalPemasukanDetail, 0, ',', '.') }}
                                                                </th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <!-- Placeholder for other combinations -->
                                    <div class="alert alert-warning mt-4">Data tidak tersedia untuk kombinasi filter
                                        ini.</div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <!-- End of Main Content -->
            </div>
            <!-- End of Content Wrapper -->

            <!-- Footer -->
            @include('layouts.footer')
            <!-- End of Footer -->
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Form Validation Script -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const forms = document.querySelectorAll('.needs-validation');
                Array.prototype.slice.call(forms).forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        const bulan = form.querySelector('[name="bulan"]').value;
                        const kategori = form.querySelector('[name="kategori"]').value;
                        const tahun = form.querySelector('[name="tahun"]').value;

                        // Allow submission if at least one filter is selected or all are "Semua"
                        if (bulan === '' && kategori === '' && tahun === '') {
                            event.preventDefault();
                            event.stopPropagation();
                            alert('Setidaknya pilih satu filter (Bulan, Tahun, atau Kategori).');
                            return;
                        }

                        // Allow submission for any valid combination
                        form.classList.add('was-validated');
                    }, false);
                });
            });
        </script>
    </div>
</body>

</html>
