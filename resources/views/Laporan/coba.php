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
    <!-- Custom CSS for dropdown -->
    <style>
        /* Enhanced Dropdown Styles (preserving original design) */
        .custom-dropdown {
            position: relative;
            width: 100%;
        }

        .dropdown-header {
            display: flex;
            align-items: center;
            border: 1px solid #ced4da;
            border-radius: 0.35rem;
            background: white;
            cursor: pointer;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .dropdown-header:hover {
            border-color: #bac8f3;
        }

        .dropdown-header.focused {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .dropdown-input {
            flex: 1;
            padding: 0.375rem 0.75rem;
            border: none;
            outline: none;
            background: transparent;
            font-size: 1rem;
            line-height: 1.5;
            color: #6e707e;
            cursor: pointer;
            height: calc(1.5em + 0.75rem + 2px);
        }

        .dropdown-arrow {
            padding: 0 0.75rem;
            color: #b7b9cc;
            transition: transform 0.2s ease;
        }

        .dropdown-arrow.up {
            transform: rotate(180deg);
        }

        .dropdown-options {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #d1d3e2;
            border-top: none;
            border-radius: 0 0 0.35rem 0.35rem;
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: max-height 0.3s ease, opacity 0.2s ease;
            z-index: 1000;
            box-shadow: 0 0.15rem 0.75rem 0.15rem rgba(58, 59, 69, 0.15);
        }

        .dropdown-options.show {
            max-height: 250px;
            opacity: 1;
            overflow-y: auto;
        }

        .search-container {
            padding: 0.5rem;
            border-bottom: 1px solid #e3e6f0;
            position: sticky;
            top: 0;
            background: white;
            z-index: 1;
        }

        .search-input {
            width: 100%;
            padding: 0.375rem 0.75rem 0.375rem 2.25rem;
            border: 1px solid #d1d3e2;
            border-radius: 0.35rem;
            font-size: 0.85rem;
            color: #6e707e;
        }

        .search-icon {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: #b7b9cc;
            font-size: 0.875rem;
        }

        .options-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .option-item {
            padding: 0.5rem 1rem;
            cursor: pointer;
            transition: background-color 0.2s;
            font-size: 0.85rem;
            color: #6e707e;
        }

        .option-item:hover {
            background-color: #f8f9fc;
            color: #4e73df;
        }

        .option-item.selected {
            background-color: #eaecf4;
            color: #4e73df;
            font-weight: 600;
        }

        .no-results {
            padding: 0.75rem;
            text-align: center;
            color: #858796;
            font-style: italic;
            font-size: 0.85rem;
        }

        /* Validation styles matching SB Admin */
        .is-invalid .dropdown-header {
            border-color: #e74a3b;
        }

        .is-invalid .dropdown-header.focused {
            box-shadow: 0 0 0 0.2rem rgba(231, 74, 59, 0.25);
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
                <div class="container-fluid">
                    <!-- Page Title -->
                    <h1 class="h4 mb-4 text-gray-800"><i class="fas fa-sign-in-alt fa-fw mr-2"></i>Pemasukan</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <!-- Form Title -->
                            <h6 class="m-0 font-weight-bold">Entri Data Pemasukan</h6>
                        </div>
                        <div class="card-body">
                            <!-- Form -->
                            <form action="?module=pemasukan&amp;pesan=1" method="post" enctype="multipart/form-data"
                                class="needs-validation" novalidate="">
                                <div class="form-group col-lg-6 pl-0">
                                    <label>Tanggal <span class="text-danger">*</span></label>
                                    <input type="text" name="tanggal" class="form-control date-picker"
                                        data-date-format="dd-mm-yyyy" autocomplete="off" value="15-04-2025" required="">
                                    <div class="invalid-feedback">Tanggal tidak boleh kosong.</div>
                                </div>
                                <div class="form-group col-lg-6 pl-0">
                                    <label>Kategori Pemasukan <span class="text-danger">*</span></label>
                                    <div class="custom-dropdown" id="dropdownContainer">
                                        <div class="dropdown-header" id="dropdownHeader">
                                            <input type="text" class="dropdown-input" id="dropdownInput"
                                                placeholder="-- Pilih --" readonly>
                                            <input type="hidden" id="selectedValue" name="kategori">
                                            <i class="fas fa-chevron-down dropdown-arrow" id="dropdownArrow"></i>
                                        </div>
                                        <div class="dropdown-options" id="dropdownOptions">
                                            <div class="search-container">
                                                <i class="fas fa-search search-icon"></i>
                                                <input type="text" class="search-input" id="searchInput"
                                                    placeholder="Cari kategori...">
                                            </div>
                                            <ul class="options-list" id="optionsList">
                                                <li class="option-item" data-value="">-- Pilih --</li>
                                                <li class="option-item" data-value="1">Gaji</li>
                                                <li class="option-item" data-value="2">Hadiah</li>
                                                <li class="option-item" data-value="3">Jasa Web Development</li>
                                                <li class="option-item" data-value="4">Jasa Web Desain</li>
                                                <li class="option-item" data-value="5">Jasa Digital Marketing</li>
                                                <li class="option-item" data-value="6">Jasa Kursus dan Pelatihan</li>
                                                <li class="option-item" data-value="7">Penjualan E-Book</li>
                                                <li class="option-item" data-value="8">Penjualan Video Tutorial</li>
                                                <li class="option-item" data-value="9">Penjualan Sourcecode</li>
                                                <li class="option-item" data-value="10">Pemasukan Lainnya</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">Kategori pemasukan tidak boleh kosong.</div>
                                </div>
                                <div class="form-group col-lg-6 pl-0">
                                    <label>Deskripsi Transaksi <span class="text-danger">*</span></label>
                                    <textarea name="deskripsi" rows="3" class="form-control" autocomplete="off"
                                        required=""></textarea>
                                    <div class="invalid-feedback">Deskripsi transaksi tidak boleh kosong.</div>
                                </div>
                                <div class="form-group col-lg-6 pl-0">
                                    <label>Jumlah <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text" name="jumlah" class="form-control mask-money"
                                            autocomplete="off" required="" maxlength="17">
                                        <div class="invalid-feedback">Jumlah pemasukan tidak boleh kosong.</div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 pt-3 pl-0">
                                    <label>Bukti Transaksi</label>
                                    <input type="file" accept=".jpg, .jpeg, .png" id="bukti_transaksi"
                                        name="bukti_transaksi" class="form-control form-control-file"
                                        autocomplete="off">
                                    <div class="col-lg-6 border rounded my-4">
                                        <img id="preview-file" src="images/no_image.png" class="col foto-preview py-3"
                                            alt="Bukti Transaksi">
                                    </div>
                                    <small class="form-text text-secondary">
                                        Keterangan : <br>
                                        - Tipe file yang bisa diunggah adalah *.jpg atau *.png. <br>
                                        - Ukuran file yang bisa diunggah maksimal 1 Mb.
                                    </small>
                                </div>
                                <hr class="mt-5">
                                <div class="form-group pt-3">
                                    <!-- Submit Button -->
                                    <input type="submit" name="simpan" value="Simpan"
                                        class="btn btn-primary btn-rounded mr-2">
                                    <!-- Cancel Button -->
                                    <a href="?module=pemasukan" class="btn btn-secondary btn-rounded">Batal</a>
                                </div>
                            </form>
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
    <!-- Enhanced Dropdown Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // DOM Elements
            const dropdownHeader = document.getElementById('dropdownHeader');
            const dropdownInput = document.getElementById('dropdownInput');
            const dropdownArrow = document.getElementById('dropdownArrow');
            const dropdownOptions = document.getElementById('dropdownOptions');
            const searchInput = document.getElementById('searchInput');
            const optionsList = document.getElementById('optionsList');
            const optionItems = document.querySelectorAll('.option-item');
            const selectedValue = document.getElementById('selectedValue');
            const dropdownContainer = document.getElementById('dropdownContainer');
            const form = document.querySelector('form');

            // Original options for reset
            const originalOptions = optionsList.innerHTML;

            // Toggle dropdown visibility
            function toggleDropdown() {
                dropdownOptions.classList.toggle('show');
                dropdownArrow.classList.toggle('up');
                dropdownHeader.classList.toggle('focused');

                if (dropdownOptions.classList.contains('show')) {
                    searchInput.focus();
                }
            }

            // Close dropdown
            function closeDropdown() {
                if (dropdownOptions.classList.contains('show')) {
                    dropdownOptions.classList.remove('show');
                    dropdownArrow.classList.remove('up');
                    dropdownHeader.classList.remove('focused');
                }
            }

            // Filter options based on search input
            function filterOptions() {
                const searchTerm = searchInput.value.toLowerCase();
                let hasVisibleItems = false;

                optionItems.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        item.style.display = 'block';
                        hasVisibleItems = true;
                    } else {
                        item.style.display = 'none';
                    }
                });

                // Show no results message if needed
                const noResults = document.getElementById('noResults');
                if (!hasVisibleItems) {
                    if (!noResults) {
                        const noResultsDiv = document.createElement('div');
                        noResultsDiv.className = 'no-results';
                        noResultsDiv.id = 'noResults';
                        noResultsDiv.textContent = 'Tidak ditemukan';
                        optionsList.appendChild(noResultsDiv);
                    }
                } else if (noResults) {
                    optionsList.removeChild(noResults);
                }
            }

            // Select an option
            function selectOption(item) {
                const value = item.getAttribute('data-value');
                const text = item.textContent;

                dropdownInput.value = text;
                selectedValue.value = value;

                // Update selected state
                optionItems.forEach(opt => opt.classList.remove('selected'));
                item.classList.add('selected');

                // Validate
                if (value === '') {
                    dropdownContainer.classList.add('is-invalid');
                } else {
                    dropdownContainer.classList.remove('is-invalid');
                }
            }

            // Event Listeners
            dropdownHeader.addEventListener('click', function (e) {
                e.stopPropagation();
                toggleDropdown();
            });

            searchInput.addEventListener('input', filterOptions);

            optionsList.addEventListener('click', function (e) {
                const item = e.target.closest('.option-item');
                if (item) {
                    selectOption(item);
                    closeDropdown();
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function (e) {
                if (!dropdownHeader.contains(e.target) && !dropdownOptions.contains(e.target)) {
                    closeDropdown();
                }
            });

            // Keyboard navigation
            searchInput.addEventListener('keydown', function (e) {
                if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
                    e.preventDefault();
                    const visibleItems = Array.from(optionItems).filter(
                        item => item.style.display !== 'none'
                    );

                    if (visibleItems.length === 0) return;

                    let currentIndex = visibleItems.findIndex(
                        item => item.classList.contains('selected')
                    );

                    if (e.key === 'ArrowDown') {
                        currentIndex = (currentIndex + 1) % visibleItems.length;
                    } else {
                        currentIndex = (currentIndex - 1 + visibleItems.length) % visibleItems.length;
                    }

                    visibleItems.forEach(item => item.classList.remove('selected'));
                    visibleItems[currentIndex].classList.add('selected');
                    visibleItems[currentIndex].scrollIntoView({
                        block: 'nearest'
                    });
                } else if (e.key === 'Enter') {
                    e.preventDefault();
                    const selectedItem = optionsList.querySelector('.option-item.selected');
                    if (selectedItem) {
                        selectOption(selectedItem);
                        closeDropdown();
                    }
                }
            });

            // Form validation
            form.addEventListener('submit', function (e) {
                // Validate dropdown
                if (selectedValue.value === '') {
                    e.preventDefault();
                    dropdownContainer.classList.add('is-invalid');
                    return;
                }

                // Other validations would happen here
            });
        });
    </script>
</body>

</html>