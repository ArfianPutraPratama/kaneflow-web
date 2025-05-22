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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- Custom styles for this template (SB Admin 2) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/css/sb-admin-2.min.css"
        rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Custom CSS for additional styling -->
    <style>
        .dataTables_length {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .dataTables_length label {
            margin-bottom: 0;
            display: flex;
            align-items: center;
        }

        .dataTables_length select {
            margin: 0 5px;
            width: auto;
        }

        .table thead th {
            vertical-align: middle;
        }

        .table tbody td {
            vertical-align: middle;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 5px;
        }

        .action-btn {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: white;
        }

        .btn-edit {
            background-color: #4e73df;
        }

        .btn-delete {
            background-color: #e74a3b;
        }

        .dataTables_paginate .paginate_button {
            min-width: 35px;
            text-align: center;
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
                        <h1 class="h4 mb-sm-0 text-gray-800"><i class="fas fa-sign-in-alt fa-fw mr-2"></i>Kategori</h1>
                        <a href="{{ route('Referensi.entridata') }}" class="btn btn-primary btn-rounded">
                            <i class="fas fa-plus mr-2"></i> Entri Data
                        </a>
                    </div>
                    <!-- Success Notification -->
                    <div class="notification" id="successNotification">
                        <span class="icon">✔</span>
                        <span id="notificationMessage">Sukses! Kategori berhasil dihapus.</span>
                        <span class="close-btn" onclick="hideNotification('successNotification')">✖</span>
                    </div>
                    <!-- Error Notification -->
                    <div class="notification error" id="errorNotification">
                        <span class="icon">✖</span>
                        <span id="errorMessage">Gagal menghapus kategori.</span>
                        <span class="close-btn" onclick="hideNotification('errorNotification')">✖</span>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">Data Kategori</h6>
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
                                                        <option value="10">10</option>
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
                                            <table id="dataTable" class="table table-bordered" width="100%"
                                                cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 60px;">No.</th>
                                                        <th>Nama Kategori</th>
                                                        <th class="text-center" style="width: 150px;">Tipe</th>
                                                        <th class="text-center" style="width: 110px;">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($kategoriData as $kategori)
                                                        <tr data-id="{{ $kategori->id }}">
                                                            <td class="text-center sorting_1"></td>
                                                            <td>{{ $kategori->nama }}</td>
                                                            <td class="text-center">{{ $kategori->tipe }}</td>
                                                            <td class="text-center">
                                                                <div class="action-buttons">
                                                                    <a href="{{ route('Referensi.entridata', ['id' => $kategori->id]) }}"
                                                                        class="action-btn btn-edit"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Ubah">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                    <a href="#"
                                                                        class="action-btn btn-delete delete-btn"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Hapus" data-id="{{ $kategori->id }}"
                                                                        data-nama="{{ $kategori->nama }}"
                                                                        data-tipe="{{ $kategori->tipe }}">
                                                                        <i class="fas fa-trash"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4" class="text-center">Tidak ada data
                                                                kategori.</td>
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
                                                Menampilkan 1 sampai {{ count($kategoriData) }} dari
                                                {{ count($kategoriData) }} data
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
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            let currentPage = 1;
            let entriesPerPage = 10;
            let totalEntries = $('#dataTable tbody tr:not(.no-data)').length;
            let filteredEntries = totalEntries;

            renderPagination();
            updateTableDisplay();

            $('#dataTable_length select').on('change', function() {
                entriesPerPage = parseInt($(this).val());
                currentPage = 1;
                updateTableDisplay();
                renderPagination();
            });

            $('#searchInput').on('input', function() {
                const searchTerm = $(this).val().toLowerCase();
                const rows = $('#dataTable tbody tr:not(.no-data)');

                let visibleRows = 0;

                rows.each(function() {
                    const nama = $(this).find('td:eq(1)').text().toLowerCase();
                    const tipe = $(this).find('td:eq(2)').text().toLowerCase();

                    const matchesSearch = nama.includes(searchTerm) || tipe.includes(searchTerm);

                    if (matchesSearch) {
                        $(this).show();
                        visibleRows++;
                    } else {
                        $(this).hide();
                    }
                });

                filteredEntries = visibleRows;
                currentPage = 1;
                updateTableDisplay();
                renderPagination();

                const noDataRow = $('#dataTable tbody tr:last');
                if (visibleRows === 0 && !noDataRow.hasClass('no-data')) {
                    $('#dataTable tbody').append(
                        '<tr class="no-data"><td colspan="4" class="text-center">Tidak ada data yang cocok dengan pencarian.</td></tr>'
                    );
                } else if (visibleRows > 0) {
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
                const nama = $(this).data('nama');
                const tipe = $(this).data('tipe');
                const message = `Anda yakin ingin menghapus kategori ${nama} (${tipe})?`;

                $('#confirmDeleteMessage').text(message);
                $('#confirmDeleteModal').modal('show');

                $('#confirmDeleteBtn').off('click').on('click', function() {
                    $('#confirmDeleteModal').modal('hide');

                    $.ajax({
                        url: '{{ route('kategori.delete', ['id' => ':id']) }}'.replace(
                            ':id', id),
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            if (response.success) {
                                $(`tr[data-id="${id}"]`).remove();
                                totalEntries--;
                                filteredEntries--;
                                if (currentPage > Math.ceil(filteredEntries /
                                        entriesPerPage) && currentPage > 1) {
                                    currentPage--;
                                }
                                updateTableDisplay();
                                renderPagination();
                                showNotification('successNotification',
                                    'Sukses! Kategori berhasil dihapus.');
                            } else {
                                showNotification('errorNotification',
                                    'Gagal menghapus kategori: ' + (response
                                        .message || 'Unknown error'));
                            }
                        },
                        error: function(xhr) {
                            let errorMessage =
                                'Terjadi kesalahan saat menghapus kategori.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            } else if (xhr.status === 419) {
                                errorMessage =
                                    'Sesi telah kedaluwarsa. Silakan refresh halaman dan coba lagi.';
                            } else if (xhr.status === 404) {
                                errorMessage = 'Kategori tidak ditemukan.';
                            }
                            showNotification('errorNotification', errorMessage);
                        }
                    });
                });
            });

            function updateTableDisplay() {
                const rows = $('#dataTable tbody tr:not(.no-data)');
                const start = (currentPage - 1) * entriesPerPage;
                const end = start + entriesPerPage;

                rows.each(function(index) {
                    if (index >= start && index < end && $(this).is(':visible')) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });

                const visibleRows = $('#dataTable tbody tr:visible:not(.no-data)');
                visibleRows.each(function(index) {
                    $(this).find('td:first').text(index + 1);
                    $(this).removeClass('odd even').addClass(index % 2 === 0 ? 'odd' : 'even');
                });

                const displayedEntries = Math.min(entriesPerPage, filteredEntries - start);
                $('#dataTable_info').text(
                    `Menampilkan ${start + 1} sampai ${start + displayedEntries} dari ${filteredEntries} data`
                );
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
                    `#${notificationId === 'successNotification' ? 'notificationMessage' : 'errorMessage'}`
                );
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
