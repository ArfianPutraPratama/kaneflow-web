<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Pengeluaran</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/css/sb-admin-2.min.css"
        rel="stylesheet">
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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

        .foto-preview {
            width: 100%;
            height: 200px;
            object-fit: contain;
        }

        .date-picker-container {
            position: relative;
        }

        .date-picker-container .input-group-text {
            background-color: #f8f9fc;
            border: 1px solid #d1d3e2;
            border-left: none;
            cursor: pointer;
            color: #6e707e;
        }

        .date-picker-container .form-control {
            border-right: none;
        }

        .date-picker-container .form-control:focus+.input-group-append .input-group-text {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
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

        .custom-file-input~.custom-file-label::after {
            content: "Browse";
            background-color: #e9ecef;
            color: #495057;
        }

        .custom-file-label {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Style untuk preview gambar */
        .img-fluid {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        @include('layouts.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    @include('components.user-menu')
                </nav>
                <div class="container-fluid">
                    <h1 class="h4 mb-4 text-gray-800"><i class="fas fa-sign-out-alt fa-fw mr-2"></i>Pengeluaran</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">Tambah Data Pengeluaran</h6>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('pengeluaran.store') }}" method="post" enctype="multipart/form-data"
                                class="needs-validation" novalidate="">
                                @csrf
                                <div class="form-group col-lg-6 pl-0">
                                    <label>Tanggal <span class="text-danger">*</span></label>
                                    <div class="date-picker-container input-group">
                                        <input type="text" name="tanggal" class="form-control date-picker"
                                            data-date-format="dd-mm-yyyy" autocomplete="off" required="">
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
                                    <label>Kategori Pengeluaran <span class="text-danger">*</span></label>
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
                                                <li class="option-item selected" data-value="">-- Pilih --</li>
                                                <li class="option-item" data-value="1">Belanja Harian</li>
                                                <li class="option-item" data-value="2">Tagihan Listrik</li>
                                                <li class="option-item" data-value="3">Tagihan Air</li>
                                                <li class="option-item" data-value="4">Biaya Transportasi</li>
                                                <li class="option-item" data-value="5">Biaya Pendidikan</li>
                                                <li class="option-item" data-value="6">Biaya Kesehatan</li>
                                                <li class="option-item" data-value="7">Pengeluaran Hiburan</li>
                                                <li class="option-item" data-value="8">Pengeluaran Donasi</li>
                                                <li class="option-item" data-value="9">Pengeluaran Investasi</li>
                                                <li class="option-item" data-value="10">Pengeluaran Lainnya</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">Kategori pengeluaran tidak boleh kosong.</div>
                                    @error('kategori')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6 pl-0">
                                    <label>Deskripsi Transaksi <span class="text-danger">*</span></label>
                                    <textarea name="deskripsi" rows="3" class="form-control" autocomplete="off" required=""></textarea>
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
                                            autocomplete="off" required="" maxlength="17">
                                        <div class="invalid-feedback">Jumlah pengeluaran tidak boleh kosong.</div>
                                        @error('jumlah')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 pt-3 pl-0">
                                    <label>Bukti Transaksi</label>
                                    <div class="custom-file">
                                        <input type="file" accept=".jpg, .jpeg, .png" id="bukti_transaksi"
                                            name="bukti_transaksi" class="custom-file-input" autocomplete="off">
                                        <label class="custom-file-label" for="bukti_transaksi">Pilih file...</label>
                                    </div>
                                    <div class="col-lg-6 border rounded my-4 p-2 text-center">
                                        <img id="preview-file" src="images/no_image.png" class="img-fluid py-3"
                                            alt="Bukti Transaksi" style="max-height: 200px;">
                                    </div>
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Keterangan : <br>
                                        - Tipe file yang bisa diunggah adalah *.jpg atau *.png. <br>
                                        - Ukuran file yang bisa diunggah maksimal 1 Mb.
                                    </small>
                                    @error('bukti_transaksi')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <hr class="mt-5">
                                <div class="form-group pt-3">
                                    <input type="submit" name="simpan" value="Simpan"
                                        class="btn btn-simpan btn-rounded mr-2">
                                    <a href="{{ route('pengeluaran.tabel') }}"
                                        class="btn btn-secondary btn-rounded">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
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
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- jQuery MaskMoney Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <!-- Enhanced Dropdown, Image Preview, Date Picker, and MaskMoney Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Flatpickr for the tanggal input
            const datePicker = flatpickr('.date-picker', {
                dateFormat: 'd-m-Y',
                defaultDate: new Date(),
                maxDate: 'today',
                disableMobile: true,
                onReady: function(selectedDates, dateStr, instance) {
                    const calendarIcon = instance.element.closest('.date-picker-container')
                        .querySelector('.input-group-text');
                    calendarIcon.addEventListener('click', function() {
                        instance.open();
                    });
                }
            });

            // Initialize MaskMoney for the jumlah input
            $('.mask-money').maskMoney({
                prefix: '',
                allowNegative: false,
                thousands: '.',
                decimal: '',
                precision: 0,
                affixesStay: false
            });

            // Handle input formatting for jumlah
            $('.mask-money').on('input', function(e) {
                let value = $(this).val().replace(/[^0-9]/g, '');
                if (value) {
                    $(this).val(formatNumber(value));
                } else {
                    $(this).val('');
                }
            });

            // Restrict input to numbers and allowed keys
            $('.mask-money').on('keydown', function(e) {
                const allowedKeys = ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab', 'Home',
                    'End'
                ];
                if (allowedKeys.includes(e.key) || (e.key >= '0' && e.key <= '9')) {
                    return;
                }
                e.preventDefault();
            });

            // Ensure the form submits the unformatted integer value
            $('form').on('submit', function(e) {
                const jumlahInput = $('.mask-money');
                const unformattedValue = parseInt(jumlahInput.val().replace(/\./g, ''), 10);
                if (isNaN(unformattedValue) || unformattedValue <= 0) {
                    e.preventDefault();
                    jumlahInput.addClass('is-invalid');
                    jumlahInput.next('.invalid-feedback').text(
                        'Jumlah harus berupa angka valid lebih dari 0.');
                    return;
                }
                jumlahInput.val(unformattedValue);
            });

            // Image Preview for Bukti Transaksi
            const fileInput = document.getElementById('bukti_transaksi');
            const previewImage = document.getElementById('preview-file');
            const defaultImageSrc = 'images/no_image.png';

            fileInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                    if (!validImageTypes.includes(file.type)) {
                        alert('File harus berupa gambar dengan format JPG atau PNG.');
                        fileInput.value = '';
                        previewImage.src = defaultImageSrc;
                        return;
                    }
                    const maxSize = 1 * 1024 * 1024;
                    if (file.size > maxSize) {
                        alert('Ukuran file maksimal 1 MB.');
                        fileInput.value = '';
                        previewImage.src = defaultImageSrc;
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewImage.src = defaultImageSrc;
                }
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
            const form = document.querySelector('form');

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

            function selectOption(item) {
                const value = item.getAttribute('data-value');
                const text = item.textContent;
                dropdownInput.value = text;
                selectedValue.value = value;
                optionItems.forEach(opt => opt.classList.remove('selected'));
                item.classList.add('selected');
                if (value === '') {
                    dropdownContainer.classList.add('is-invalid');
                } else {
                    dropdownContainer.classList.remove('is-invalid');
                }
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
                    closeDropdown();
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

            form.addEventListener('submit', function(e) {
                if (selectedValue.value === '') {
                    e.preventDefault();
                    dropdownContainer.classList.add('is-invalid');
                    return;
                }
            });

            // Function to format number with thousand separator
            function formatNumber(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
            document.querySelector('.custom-file-input').addEventListener('change', function(e) {
                var fileName = e.target.files[0] ? e.target.files[0].name : "Pilih file...";
                var nextSibling = e.target.nextElementSibling;
                nextSibling.innerText = fileName;
            });
        });
    </script>
</body>

</html>
