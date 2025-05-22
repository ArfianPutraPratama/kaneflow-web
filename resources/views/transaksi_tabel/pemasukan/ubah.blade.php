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
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css">
    <!-- Custom CSS -->
    <style>
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

        .is-invalid .dropdown-header {
            border-color: #e74a3b;
        }

        .is-invalid .dropdown-header.focused {
            box-shadow: 0 0 0 0.2rem rgba(231, 74, 59, 0.25);
        }

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

        .foto-preview {
            max-width: 100%;
            height: 200px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        .date-picker-container {
            position: relative;
            width: 100%;
        }

        .date-picker-container .form-control {
            border-right: none;
        }

        .date-picker-container .input-group-text {
            background-color: #f8f9fc;
            border: 1px solid #d1d3e2;
            border-left: none;
            cursor: pointer;
            color: #6e707e;
        }

        .date-picker-container .form-control:focus+.input-group-append .input-group-text {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
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
                    <!-- Success Notification -->
                    <div class="notification" id="successNotification">
                        <span class="icon">✔</span>
                        <span id="notificationMessage">Sukses! Data pemasukan berhasil diperbarui.</span>
                        <span class="close-btn" onclick="hideNotification()">✖</span>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Ubah Data Pemasukan</h6>
                        </div>
                        <div class="card-body">
                            <form id="updatePemasukanForm" action="{{ route('pemasukan.update', $pemasukan->id) }}"
                                method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                @csrf
                                @method('POST')
                                <div class="form-group col-lg-6 pl-0">
                                    <label>Tanggal <span class="text-danger">*</span></label>
                                    <div class="date-picker-container input-group">
                                        <input type="text" name="tanggal" class="form-control date-picker"
                                            data-date-format="dd-mm-yyyy" autocomplete="off"
                                            value="{{ \Carbon\Carbon::parse($pemasukan->tanggal)->format('d-m-Y') }}"
                                            required>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        </div>
                                        <div class="invalid-feedback">Tanggal tidak boleh kosong.</div>
                                        @error('tanggal')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 pl-0">
                                    <label>Kategori Pemasukan <span class="text-danger">*</span></label>
                                    <div class="custom-dropdown" id="dropdownContainer">
                                        <div class="dropdown-header" id="dropdownHeader">
                                            <input type="text" class="dropdown-input" id="dropdownInput"
                                                value="{{ $pemasukan->kategori }}" placeholder="-- Pilih --" readonly>
                                            <input type="hidden" id="selectedValue" name="kategori"
                                                value="{{ $pemasukan->kategori_id }}">
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
                                                <li class="option-item {{ $pemasukan->kategori_id == 1 ? 'selected' : '' }}"
                                                    data-value="1">Gaji</li>
                                                <li class="option-item {{ $pemasukan->kategori_id == 2 ? 'selected' : '' }}"
                                                    data-value="2">Hadiah</li>
                                                <li class="option-item {{ $pemasukan->kategori_id == 3 ? 'selected' : '' }}"
                                                    data-value="3">Jasa Web Development</li>
                                                <li class="option-item {{ $pemasukan->kategori_id == 4 ? 'selected' : '' }}"
                                                    data-value="4">Jasa Web Desain</li>
                                                <li class="option-item {{ $pemasukan->kategori_id == 5 ? 'selected' : '' }}"
                                                    data-value="5">Jasa Digital Marketing</li>
                                                <li class="option-item {{ $pemasukan->kategori_id == 6 ? 'selected' : '' }}"
                                                    data-value="6">Jasa Kursus dan Pelatihan</li>
                                                <li class="option-item {{ $pemasukan->kategori_id == 7 ? 'selected' : '' }}"
                                                    data-value="7">Penjualan E-Book</li>
                                                <li class="option-item {{ $pemasukan->kategori_id == 8 ? 'selected' : '' }}"
                                                    data-value="8">Penjualan Video Tutorial</li>
                                                <li class="option-item {{ $pemasukan->kategori_id == 9 ? 'selected' : '' }}"
                                                    data-value="9">Penjualan Sourcecode</li>
                                                <li class="option-item {{ $pemasukan->kategori_id == 10 ? 'selected' : '' }}"
                                                    data-value="10">Pemasukan Lainnya</li>
                                            </ul>
                                        </div>
                                        <div class="invalid-feedback">Kategori pemasukan tidak boleh kosong.</div>
                                        @error('kategori')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 pl-0">
                                    <label>Deskripsi Transaksi <span class="text-danger">*</span></label>
                                    <textarea name="deskripsi" rows="3" class="form-control" autocomplete="off" required>{{ $pemasukan->deskripsi }}</textarea>
                                    <div class="invalid-feedback">Deskripsi transaksi tidak boleh kosong.</div>
                                    @error('deskripsi')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6 pl-0">
                                    <label>Jumlah <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text" name="jumlah" class="form-control mask-money"
                                            autocomplete="off" required maxlength="17"
                                            value="{{ number_format($pemasukan->jumlah, 0, ',', '.') }}">
                                        <div class="invalid-feedback">Jumlah pemasukan tidak boleh kosong atau tidak
                                            valid.</div>
                                        @error('jumlah')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 pt-3 pl-0">
                                    <label>Bukti Transaksi</label>
                                    <input type="file" accept=".jpg, .jpeg, .png" id="bukti_transaksi"
                                        name="bukti_transaksi" class="form-control form-control-file"
                                        autocomplete="off">
                                    <div class="col-lg-6 border rounded my-4">
                                        <img id="preview-file"
                                            src="{{ $pemasukan->bukti_transaksi ? asset('storage/' . $pemasukan->bukti_transaksi) : asset('images/no_image.png') }}"
                                            class="col foto-preview py-3" alt="Bukti Transaksi"
                                            style="{{ $pemasukan->bukti_transaksi ? '' : 'display: none;' }}">
                                    </div>
                                    <small class="form-text text-secondary">
                                        Keterangan: <br>
                                        - Tipe file yang bisa diunggah adalah *.jpg atau *.png. <br>
                                        - Ukuran file yang bisa diunggah maksimal 1 MB.
                                    </small>
                                    @error('bukti_transaksi')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <hr class="mt-5">
                                <div class="form-group pt-3">
                                    <input type="submit" name="simpan" value="Simpan"
                                        class="btn btn-simpan btn-rounded mr-2">
                                    <a href="{{ route('pemasukan.tabel') }}"
                                        class="btn btn-secondary btn-rounded">Batal</a>
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
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
    <!-- jQuery MaskMoney Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <!-- Custom Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Flatpickr
            flatpickr('.date-picker', {
                dateFormat: 'd-m-Y',
                allowInput: true,
                maxDate: 'today',
                onOpen: function(selectedDates, dateStr, instance) {
                    instance.input.closest('.date-picker-container').querySelector('.form-control')
                        .classList.add('focused');
                },
                onClose: function(selectedDates, dateStr, instance) {
                    instance.input.closest('.date-picker-container').querySelector('.form-control')
                        .classList.remove('focused');
                },
                onReady: function(selectedDates, dateStr, instance) {
                    const calendarIcon = instance.element.closest('.date-picker-container')
                        .querySelector('.input-group-text');
                    calendarIcon.addEventListener('click', function() {
                        instance.open();
                    });
                }
            });

            // Initialize MaskMoney for jumlah input
            $('.mask-money').maskMoney({
                prefix: '',
                allowNegative: false,
                thousands: '.',
                decimal: '',
                precision: 0,
                affixesStay: false
            });

            // Handle Jumlah input formatting
            const jumlahInput = document.querySelector('input[name="jumlah"]');
            jumlahInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/[^0-9]/g, '');
                if (value) {
                    e.target.value = formatNumber(value);
                } else {
                    e.target.value = '';
                }
            });

            // Restrict input to numbers and allowed keys
            jumlahInput.addEventListener('keydown', function(e) {
                const allowedKeys = ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab', 'Home',
                    'End'
                ];
                if (allowedKeys.includes(e.key) || (e.key >= '0' && e.key <= '9')) {
                    return;
                }
                e.preventDefault();
            });

            // Dropdown functionality
            const dropdownHeader = document.getElementById('dropdownHeader');
            const dropdownInput = document.getElementById('dropdownInput');
            const dropdownArrow = document.getElementById('dropdownArrow');
            const dropdownOptions = document.getElementById('dropdownOptions');
            const searchInput = document.getElementById('searchInput');
            const optionsList = document.getElementById('optionsList');
            const optionItems = document.querySelectorAll('.option-item');
            const selectedValue = document.getElementById('selectedValue');
            const dropdownContainer = document.getElementById('dropdownContainer');

            function toggleDropdown() {
                dropdownOptions.classList.toggle('show');
                dropdownArrow.classList.toggle('up');
                dropdownHeader.classList.toggle('focused');
                if (dropdownOptions.classList.contains('show')) {
                    searchInput.focus();
                }
            }

            function closeDropdown() {
                if (dropdownOptions.classList.contains('show')) {
                    dropdownOptions.classList.remove('show');
                    dropdownArrow.classList.remove('up');
                    dropdownHeader.classList.remove('focused');
                }
            }

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
                const noResults = document.getElementById('noResults');
                if (!hasVisibleItems && !noResults) {
                    const noResultsDiv = document.createElement('div');
                    noResultsDiv.className = 'no-results';
                    noResultsDiv.id = 'noResults';
                    noResultsDiv.textContent = 'Tidak ditemukan';
                    optionsList.appendChild(noResultsDiv);
                } else if (hasVisibleItems && noResults) {
                    optionsList.removeChild(noResults);
                }
            }

            function selectOption(item) {
                const value = item.getAttribute('data-value');
                const text = item.textContent;
                dropdownInput.value = text;
                selectedValue.value = value;
                optionItems.forEach(opt => opt.classList.remove('selected'));
                item.classList.add('selected');
                dropdownContainer.classList.remove('is-invalid');
                closeDropdown();
            }

            dropdownHeader.addEventListener('click', function(e) {
                e.stopPropagation();
                toggleDropdown();
            });

            searchInput.addEventListener('input', filterOptions);

            optionsList.addEventListener('click', function(e) {
                const item = e.target.closest('.option-item');
                if (item) {
                    selectOption(item);
                }
            });

            document.addEventListener('click', function(e) {
                if (!dropdownHeader.contains(e.target) && !dropdownOptions.contains(e.target)) {
                    closeDropdown();
                }
            });

            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
                    e.preventDefault();
                    const visibleItems = Array.from(optionItems).filter(item => item.style.display !==
                        'none');
                    if (visibleItems.length === 0) return;
                    let currentIndex = visibleItems.findIndex(item => item.classList.contains('selected'));
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
                    }
                }
            });

            // Form submission
            const form = document.getElementById('updatePemasukanForm');
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Validate dropdown
                if (selectedValue.value === '') {
                    dropdownContainer.classList.add('is-invalid');
                    return;
                }

                // Validate jumlah
                const jumlahValue = jumlahInput.value.replace(/\./g, '');
                if (isNaN(jumlahValue) || jumlahValue <= 0) {
                    jumlahInput.classList.add('is-invalid');
                    jumlahInput.nextElementSibling.textContent =
                        'Jumlah harus berupa angka valid lebih dari 0.';
                    return;
                }

                // Validate other fields
                if (!form.checkValidity()) {
                    form.classList.add('was-validated');
                    return;
                }

                const formData = new FormData(form);
                formData.set('jumlah', jumlahValue);

                $.ajax({
                    url: form.action,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            updateFormFields(response.data);
                            showNotification('Sukses! Data pemasukan berhasil diperbarui.');
                            sessionStorage.setItem('updatedPemasukan', JSON.stringify(response
                                .data));
                        } else {
                            alert('Gagal memperbarui data: ' + (response.message ||
                                'Unknown error'));
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'Terjadi kesalahan saat memperbarui data.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        alert(errorMessage);
                    }
                });
            });

            // Update form fields after successful submission
            function updateFormFields(data) {
                document.querySelector('input[name="tanggal"]').value = data.tanggal;
                document.getElementById('dropdownInput').value = data.kategori;
                document.getElementById('selectedValue').value = data.kategori_id;
                document.querySelector('textarea[name="deskripsi"]').value = data.deskripsi;
                document.querySelector('input[name="jumlah"]').value = formatNumber(data.jumlah);
                const previewFile = document.getElementById('preview-file');
                if (data.bukti_transaksi) {
                    previewFile.src = '{{ asset('storage') }}/' + data.bukti_transaksi;
                    previewFile.style.display = 'block';
                } else {
                    previewFile.src = '{{ asset('images/no_image.png') }}';
                    previewFile.style.display = 'none';
                }
                optionItems.forEach(item => {
                    item.classList.remove('selected');
                    if (item.getAttribute('data-value') === data.kategori_id.toString()) {
                        item.classList.add('selected');
                    }
                });
            }

            // Image preview for bukti transaksi
            const buktiTransaksiInput = document.getElementById('bukti_transaksi');
            const previewFile = document.getElementById('preview-file');

            buktiTransaksiInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                    if (!allowedTypes.includes(file.type)) {
                        alert('Hanya file *.jpg atau *.png yang diperbolehkan.');
                        buktiTransaksiInput.value = '';
                        previewFile.src = '{{ asset('images/no_image.png') }}';
                        previewFile.style.display = 'none';
                        return;
                    }
                    if (file.size > 1 * 1024 * 1024) {
                        alert('Ukuran file maksimal 1 MB.');
                        buktiTransaksiInput.value = '';
                        previewFile.src = '{{ asset('images/no_image.png') }}';
                        previewFile.style.display = 'none';
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewFile.src = e.target.result;
                        previewFile.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewFile.src =
                        '{{ $pemasukan->bukti_transaksi ? asset('storage/' . $pemasukan->bukti_transaksi) : asset('images/no_image.png') }}';
                    previewFile.style.display = '{{ $pemasukan->bukti_transaksi ? 'block' : 'none' }}';
                }
            });

            // Format number with thousand separator
            function formatNumber(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            // Show success notification
            function showNotification(message) {
                const notification = document.getElementById('successNotification');
                const messageSpan = document.getElementById('notificationMessage');
                messageSpan.textContent = message;
                notification.classList.add('show');
                setTimeout(function() {
                    notification.classList.remove('show');
                }, 3000);
            }

            // Hide notification
            window.hideNotification = function() {
                document.getElementById('successNotification').classList.remove('show');
            };
        });
    </script>
</body>

</html>
