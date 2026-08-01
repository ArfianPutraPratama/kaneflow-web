<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Pemasukan table page for SB Admin 2 dashboard">
    <meta name="author" content="SB Admin 2">
    <title>SB Admin 2 - Pemasukan</title>
    <!-- Custom fonts for this template -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/css/sb-admin-2.min.css"
        rel="stylesheet">
    <!-- Custom CSS for additional styling -->
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
            overflow-x: hidden !important;
        }

        .table {
            width: 100% !important;
            table-layout: auto !important;
        }

        .table th,
        .table td {
            white-space: normal !important;
            word-wrap: break-word;
            max-width: 0;
            vertical-align: middle;
        }

        .table th:nth-child(1),
        .table td:nth-child(1) {
            width: 5% !important;
        }

        .table th:nth-child(2),
        .table td:nth-child(2) {
            width: 15% !important;
        }

        .table th:nth-child(3),
        .table td:nth-child(3) {
            width: 20% !important;
        }

        .table th:nth-child(4),
        .table td:nth-child(4) {
            width: 30% !important;
        }

        .table th:nth-child(5),
        .table td:nth-child(5) {
            width: 15% !important;
        }

        .table th:nth-child(6),
        .table td:nth-child(6) {
            width: 15% !important;
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

        .notification.error {
            background: #ffe6e6;
            color: #dc3545;
        }

        .notification.error .icon {
            margin-right: 0.75rem;
            font-size: 1.2rem;
        }

        .notification.error .close-btn {
            color: #dc3545;
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

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .card-header h6 {
            margin: 0;
        }

        .custom-search {
            display: flex;
            align-items: center;
        }

        .custom-search label {
            margin: 0 0.5rem 0 0;
            font-size: 0.85rem;
        }

        .custom-search input {
            width: 200px;
            font-size: 0.85rem;
        }

        .dataTables_paginate .pagination {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin: 0;
        }

        .dataTables_paginate .page-item {
            margin: 0;
        }

        .dataTables_paginate .page-link {
            padding: 0.2rem 0.6rem;
            font-size: 0.85rem;
            line-height: 1.5;
            border: 1px solid #d1d3e2;
            border-radius: 0;
            margin: 0;
            color: #4e73df;
            background-color: white;
            transition: background-color 0.2s, color 0.2s;
        }

        .dataTables_paginate .page-link:hover {
            background-color: #e9ecef;
            color: #224abe;
        }

        .dataTables_paginate .page-item.active .page-link {
            background-color: #4e73df;
            border-color: #4e73df;
            color: white;
        }

        .dataTables_paginate .page-item.disabled .page-link {
            cursor: not-allowed;
            color: #d1d3e2;
            background-color: white;
            border-color: #d1d3e2;
        }

        .dataTables_paginate .page-item:first-child .page-link {
            border-top-left-radius: 0.2rem;
            border-bottom-left-radius: 0.2rem;
        }

        .dataTables_paginate .page-item:last-child .page-link {
            border-top-right-radius: 0.2rem;
            border-bottom-right-radius: 0.2rem;
        }

        @media (max-width: 576px) {
            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .custom-search {
                margin-top: 0.5rem;
                width: 100%;
            }

            .custom-search input {
                width: 100%;
            }

            .dataTables_paginate .pagination {
                justify-content: center;
            }
        }

        .btn-entri-data {
            background-color: #166534;
            border-color: #166534;
            color: white !important;
            transition: all 0.3s ease;
        }

        .btn-entri-data:hover {
            background-color: #159245;
            border-color: #159245;
            color: white !important;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-entri-data:active {
            transform: translateY(0);
        }

        .btn-ubah {
            background-color: #159245 !important;
            border-color: #159245 !important;
            color: white !important;
            transition: all 0.3s ease;
        }

        .btn-ubah:hover {
            background-color: #166534 !important;
            border-color: #166534 !important;
        }

        .btn-ubah i {
            color: white !important;
        }

        /* Custom Pagination Styles */
        .pagination .page-item.active .page-link {
            background-color: #166534 !important;
            border-color: #166534 !important;
            color: white !important;
        }

        .pagination .page-link {
            color: #166534;
            margin: 0 3px;
            border-radius: 4px !important;
        }

        .pagination .page-link:hover {
            color: #166534;
            background-color: #f1f1f1;
        }

        .pagination .page-item.disabled .page-link {
            color: #6c757d;
        }

        .pagination .page-item:first-child .page-link,
        .pagination .page-item:last-child .page-link {
            border-radius: 4px !important;
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
                        <a href="{{ route('pemasukan') }}" class="btn btn-entri-data btn-rounded">
                            <i class="fas fa-plus mr-2" style="color: white !important;"></i>
                            <span style="color: white !important;">Entri Data</span>
                        </a>
                    </div>
                    <!-- Success Notification -->
                    @if (session('success'))
                        <div class="notification show" id="successNotification">
                            <span class="icon">✔</span>
                            <span>{{ session('success') }}</span>
                            <span class="close-btn" onclick="hideNotification('successNotification')">✖</span>
                        </div>
                    @else
                        <div class="notification" id="successNotification">
                            <span class="icon">✔</span>
                            <span id="notificationMessage">Sukses! Data pemasukan berhasil dihapus.</span>
                            <span class="close-btn" onclick="hideNotification('successNotification')">✖</span>
                        </div>
                    @endif
                    <!-- Error Notification -->
                    <div class="notification error" id="errorNotification">
                        <span class="icon">✖</span>
                        <span id="errorMessage">Gagal menghapus data.</span>
                        <span class="close-btn" onclick="hideNotification('errorNotification')">✖</span>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">Data Pemasukan</h6>
                            <div class="custom-search">
                                <label for="searchInput">Cari:</label>
                                <input type="search" class="form-control form-control-sm" placeholder=""
                                    id="searchInput">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="dataTables_length" id="dataTable_length">
                                                <label>Tampilkan
                                                    <select name="dataTable_length" aria-controls="dataTable"
                                                        class="custom-select custom-select-sm form-control form-control-sm">
                                                        <option value="10" selected>10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select> data
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered dataTable no-footer" id="dataTable"
                                                width="100%" cellspacing="0" role="grid"
                                                aria-describedby="dataTable_info" style="width: 100%;">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="text-center sorting sorting_asc" tabindex="0"
                                                            aria-controls="dataTable" rowspan="1" colspan="1"
                                                            aria-sort="ascending"
                                                            aria-label="No.: aktifkan untuk mengurutkan kolom secara descending"
                                                            style="width: 24.9333px;">No.</th>
                                                        <th class="text-center sorting" tabindex="0"
                                                            aria-controls="dataTable" rowspan="1" colspan="1"
                                                            aria-label="Tanggal: aktifkan untuk mengurutkan kolom secara ascending"
                                                            style="width: 62.9333px;">Tanggal</th>
                                                        <th class="text-center sorting" tabindex="0"
                                                            aria-controls="dataTable" rowspan="1" colspan="1"
                                                            aria-label="Kategori Pemasukan: aktifkan untuk mengurutkan kolom secara ascending"
                                                            style="width: 150.933px;">Kategori Pemasukan</th>
                                                        <th class="text-center sorting" tabindex="0"
                                                            aria-controls="dataTable" rowspan="1" colspan="1"
                                                            aria-label="Deskripsi Transaksi: aktifkan untuk mengurutkan kolom secara ascending"
                                                            style="width: 227.933px;">Deskripsi Transaksi</th>
                                                        <th class="text-center sorting" tabindex="0"
                                                            aria-controls="dataTable" rowspan="1" colspan="1"
                                                            aria-label="Jumlah: aktifkan untuk mengurutkan kolom secara ascending"
                                                            style="width: 101.933px;">Jumlah</th>
                                                        <th class="text-center sorting" tabindex="0"
                                                            aria-controls="dataTable" rowspan="1" colspan="1"
                                                            aria-label="Aksi: aktifkan untuk mengurutkan kolom secara ascending"
                                                            style="width: 81.9333px;">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($pemasukanData as $index => $pemasukan)
                                                        <tr class="{{ $index % 2 == 0 ? 'odd' : 'even' }}"
                                                            data-id="{{ $pemasukan['id'] }}">
                                                            <td width="30" class="text-center sorting_1">
                                                                {{ $index + 1 }}</td>
                                                            <td width="80" class="text-center">
                                                                {{ \Carbon\Carbon::parse($pemasukan['tanggal'])->format('d-m-Y') }}
                                                            </td>
                                                            <td width="170">{{ $pemasukan['kategori'] }}</td>
                                                            <td width="250">{{ $pemasukan['deskripsi'] }}</td>
                                                            <td width="120" class="text-right">
                                                                Rp.
                                                                {{ number_format($pemasukan['jumlah'], 0, ',', '.') }}
                                                            </td>
                                                            <td width="100" class="text-center">
                                                                <div>
                                                                    <a href="{{ route('pemasukan.detail', $pemasukan['id']) }}"
                                                                        class="btn btn-info btn-circle btn-sm mr-md-1"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Detail">
                                                                        <i class="fas fa-clone"></i>
                                                                    </a>
                                                                    <a href="{{ route('pemasukan.ubah', $pemasukan['id']) }}"
                                                                        class="btn btn-ubah btn-circle btn-sm mr-md-1"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Ubah">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                    <a href="#"
                                                                        class="btn btn-danger btn-circle btn-sm delete-btn"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Hapus"
                                                                        data-id="{{ $pemasukan['id'] }}"
                                                                        data-tanggal="{{ $pemasukan['tanggal'] }}"
                                                                        data-kategori="{{ $pemasukan['kategori'] }}">
                                                                        <i class="fas fa-trash"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="6" class="text-center">Tidak ada data
                                                                pemasukan.</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5">
                                            <div class="dataTables_info" id="dataTable_info" role="status"
                                                aria-live="polite">
                                                Menampilkan 1 sampai {{ min(count($pemasukanData), 10) }} dari
                                                {{ count($pemasukanData) }} data
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="dataTables_paginate paging_simple_numbers"
                                                id="dataTable_paginate">
                                                <ul class="pagination" id="paginationList">
                                                    <!-- Pagination will be dynamically generated by JavaScript -->
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    <!-- Custom Confirmation Modal -->
    <div class="modal fade modal-confirm" id="confirmDeleteModal" tabindex="-1" role="dialog"
        aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body text-center" id="confirmDeleteMessage">
                    <!-- Message will be set dynamically -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-ok" id="confirmDeleteBtn">OK</button>
                    <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
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
    <!-- Custom script for search, delete functionality, table update, and pagination -->
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            let currentPage = 1;
            let entriesPerPage = 10;
            let allRows = $('#dataTable tbody tr:not(.no-data)').toArray(); // Simpan semua baris
            let filteredRows = allRows; // Baris yang sudah difilter
            let totalEntries = allRows.length;
            let filteredEntries = totalEntries;

            // Inisialisasi tabel dan pagination
            updateTableDisplay();
            renderPagination();

            const updatedPemasukan = sessionStorage.getItem('updatedPemasukan');
            if (updatedPemasukan) {
                const data = JSON.parse(updatedPemasukan);
                updateTableRow(data);
                showNotification('successNotification', 'Sukses! Data pemasukan berhasil diperbarui.');
                sessionStorage.removeItem('updatedPemasukan');
            }

            $('#dataTable_length select').on('change', function() {
                entriesPerPage = parseInt($(this).val());
                currentPage = 1;
                updateTableDisplay();
                renderPagination();
            });

            $('#searchInput').on('input', function() {
                const searchTerm = $(this).val().toLowerCase().replace(/\./g, '');

                filteredRows = allRows.filter(function(row) {
                    const tanggal = $(row).find('td:eq(1)').text().toLowerCase();
                    const kategori = $(row).find('td:eq(2)').text().toLowerCase();
                    const deskripsi = $(row).find('td:eq(3)').text().toLowerCase();
                    const jumlah = $(row).find('td:eq(4)').text().toLowerCase().replace('rp. ', '')
                        .replace(/\./g, '');

                    return tanggal.includes(searchTerm) ||
                        kategori.includes(searchTerm) ||
                        deskripsi.includes(searchTerm) ||
                        jumlah.includes(searchTerm);
                });

                filteredEntries = filteredRows.length;
                currentPage = 1;
                updateTableDisplay();
                renderPagination();

                const noDataRow = $('#dataTable tbody tr:last');
                if (filteredEntries === 0 && !noDataRow.hasClass('no-data')) {
                    $('#dataTable tbody').append(
                        '<tr class="no-data"><td colspan="6" class="text-center">Tidak ada data yang cocok dengan pencarian.</td></tr>'
                    );
                } else if (filteredEntries > 0) {
                    $('.no-data').remove();
                }
            });

            $(document).on('click', '.page-link', function(e) {
                e.preventDefault();
                if ($(this).parent().hasClass('disabled')) return;

                const page = $(this).data('page');
                if (page === 'prev') {
                    currentPage--;
                } else if (page === 'next') {
                    currentPage++;
                } else {
                    currentPage = page;
                }

                updateTableDisplay();
                renderPagination();
            });

            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                const tanggal = $(this).data('tanggal');
                const kategori = $(this).data('kategori');
                const message =
                    `Anda yakin ingin menghapus data pemasukan ${kategori} tanggal ${tanggal} ?`;

                $('#confirmDeleteMessage').text(message);
                $('#confirmDeleteModal').modal('show');

                $('#confirmDeleteBtn').off('click').on('click', function() {
                    $('#confirmDeleteModal').modal('hide');

                    $.ajax({
                        url: '{{ route('pemasukan.delete', ['id' => ':id']) }}'.replace(
                            ':id', id),
                        type: 'POST',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            if (response.success) {
                                $(`tr[data-id="${id}"]`).remove();
                                allRows = $('#dataTable tbody tr:not(.no-data)')
                                    .toArray();
                                filteredRows = allRows;
                                totalEntries = allRows.length;
                                filteredEntries = totalEntries;
                                if (currentPage > Math.ceil(filteredEntries /
                                        entriesPerPage) && currentPage > 1) {
                                    currentPage--;
                                }
                                updateTableDisplay();
                                renderPagination();
                                showNotification('successNotification',
                                    'Sukses! Data pemasukan berhasil dihapus.');
                            } else {
                                showNotification('errorNotification',
                                    'Gagal menghapus data: ' + (response.message ||
                                        'Unknown error'));
                            }
                        },
                        error: function(xhr) {
                            let errorMessage = 'Terjadi kesalahan saat menghapus data.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            } else if (xhr.status === 419) {
                                errorMessage =
                                    'Sesi telah kedaluwarsa. Silakan refresh halaman dan coba lagi.';
                            } else if (xhr.status === 404) {
                                errorMessage = 'Data tidak ditemukan.';
                            }
                            showNotification('errorNotification', errorMessage);
                        }
                    });
                });
            });

            function updateTableRow(data) {
                const row = $(`tr[data-id="${data.id}"]`);
                if (row.length) {
                    row.find('td:eq(1)').text(data.tanggal);
                    row.find('td:eq(2)').text(data.kategori);
                    row.find('td:eq(3)').text(data.deskripsi);
                    row.find('td:eq(4)').text('Rp. ' + formatNumber(data.jumlah));
                    const deleteBtn = row.find('.delete-btn');
                    deleteBtn.data('tanggal', data.tanggal);
                    deleteBtn.data('kategori', data.kategori);
                    allRows = $('#dataTable tbody tr:not(.no-data)').toArray();
                    $('#searchInput').trigger('input');
                }
            }

            function formatNumber(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            function updateTableDisplay() {
                const start = (currentPage - 1) * entriesPerPage;
                const end = start + entriesPerPage;

                // Sembunyikan semua baris terlebih dahulu
                $('#dataTable tbody tr:not(.no-data)').hide();

                // Tampilkan hanya baris yang sesuai dengan halaman saat ini
                let visibleCount = 0;
                filteredRows.forEach(function(row, index) {
                    if (index >= start && index < end) {
                        $(row).show();
                        visibleCount++;
                    }
                });

                // Perbarui nomor urut dan class odd/even
                const visibleRows = $('#dataTable tbody tr:visible:not(.no-data)');
                visibleRows.each(function(index) {
                    $(this).find('td:first').text(start + index + 1);
                    $(this).removeClass('odd even').addClass((start + index) % 2 === 0 ? 'odd' : 'even');
                });

                // Perbarui informasi tabel
                const displayedEntries = Math.min(entriesPerPage, filteredEntries - start);
                $('#dataTable_info').text(
                    `Menampilkan ${start + 1} sampai ${start + displayedEntries} dari ${filteredEntries} data`);
            }

            function renderPagination() {
                const totalPages = Math.ceil(filteredEntries / entriesPerPage);
                const paginationList = $('#paginationList');
                paginationList.empty();

                const prevDisabled = currentPage === 1 ? 'disabled' : '';
                paginationList.append(`
                    <li class="paginate_button page-item ${prevDisabled}">
                        <a href="#" class="page-link" data-page="prev"><</a>
                    </li>
                `);

                const maxPagesToShow = 4;
                let startPage = Math.max(1, currentPage - Math.floor(maxPagesToShow / 2));
                let endPage = Math.min(totalPages, startPage + maxPagesToShow - 1);

                if (endPage === totalPages) {
                    startPage = Math.max(1, endPage - maxPagesToShow + 1);
                }

                for (let i = startPage; i <= endPage; i++) {
                    const activeClass = i === currentPage ? 'active' : '';
                    paginationList.append(`
                        <li class="paginate_button page-item ${activeClass}">
                            <a href="#" class="page-link" data-page="${i}">${i}</a>
                        </li>
                    `);
                }

                const nextDisabled = currentPage === totalPages || totalPages === 0 ? 'disabled' : '';
                paginationList.append(`
                    <li class="paginate_button page-item ${nextDisabled}">
                        <a href="#" class="page-link" data-page="next">></a>
                    </li>
                `);

                if (filteredEntries === 0) {
                    $('#dataTable_paginate').hide();
                } else {
                    $('#dataTable_paginate').show();
                }
            }

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
        });
    </script>
</body>

</html>
