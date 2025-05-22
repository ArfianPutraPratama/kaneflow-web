<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumentasi API Kaneflow</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <!-- Tambahkan Prism.js untuk syntax highlighting (opsional) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(90deg, #449A51 0%, #66BB6A 100%);
            color: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 2.5rem;
            font-weight: 600;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .section {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .section h2 {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 15px;
            border-bottom: 2px solid #449A51;
            padding-bottom: 5px;
            display: inline-block;
        }

        .section p {
            color: #555;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .api-key {
            background-color: #e8f5e9;
            padding: 15px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1rem;
            color: #2e7d32;
            margin-bottom: 15px;
        }

        .endpoint {
            margin-bottom: 15px;
        }

        .endpoint-btn {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            color: white;
            font-weight: 500;
        }

        .endpoint-btn:hover {
            opacity: 0.9;
        }

        .endpoint-btn .method {
            margin-right: 10px;
        }

        .endpoint-btn .url {
            font-family: 'Courier New', Courier, monospace;
            color: #ffebee;
        }

        .endpoint-btn.post {
            background-color: #9e7c16;
        }

        .endpoint-btn.get {
            background-color: #30803c;
        }

        .endpoint-btn.delete {
            background-color: #c12828;
        }

        .endpoint-details {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-in-out, opacity 0.5s ease-in-out, padding 0.5s ease-in-out;
            opacity: 0;
            padding: 0 15px;
            margin-top: 5px;
        }

        .endpoint-details.active {
            max-height: 2000px;
            opacity: 1;
            padding: 15px;
            transition: max-height 0.5s ease-in-out, opacity 0.5s ease-in-out, padding 0.5s ease-in-out;
        }

        .endpoint-details table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .endpoint-details table th,
        .endpoint-details table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .endpoint-details table th {
            background-color: #f5f5f5;
            color: #333;
        }

        .code-block {
            background-color: #f5f5f5;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            overflow-x: auto;
        }

        .code-block pre {
            margin: 0;
            font-family: 'Courier New', Courier, monospace;
            color: #333;
            white-space: pre-wrap;
            /* Memastikan baris baru dan indentasi dipertahankan */
            word-wrap: break-word;
            /* Memastikan teks panjang tidak meluap */
        }

        .code-block-header {
            font-weight: bold;
            margin-bottom: 5px;
            color: #2e7d32;
        }

        .tutorial {
            background-color: #fff3e0;
            padding: 15px;
            border-left: 4px solid #ff9800;
            margin-top: 10px;
            font-style: italic;
            color: #444;
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
                    <div class="header">
                        <h1>Dokumentasi API Kaneflow</h1>
                        <p>Gunakan API Kaneflow untuk mengelola keuangan Anda secara otomatis. Terakhir diperbarui: 22
                            Mei 2025, 09:17 WIB.</p>
                    </div>
                    <div class="section">
                        <h2>Autentikasi (Cara Login ke API)</h2>
                        <p>
                            Untuk menggunakan API Kaneflow, Anda perlu token khusus. Token ini didapat setelah Anda
                            mendaftar dan login. Ikuti langkah-langkah berikut untuk memulai.
                        </p>
                        <div class="api-key">
                            <i class="fas fa-key"></i>
                            <span>Contoh Token: <strong>2|c1KELWgLln0HBczIfQ6mrBXID5oba7JeQBg0xaRF06e02865</strong>
                                (Dapatkan token Anda sendiri dari endpoint login.)</span>
                        </div>
                        <p>
                            Masukkan token Anda di header setiap kali mengirim permintaan seperti ini:
                        </p>
                        <div class="code-block">
                            <pre>Authorization: Bearer TOKEN_ANDA</pre>
                        </div>
                        <p>
                            Pastikan juga Anda menambahkan header <code>Accept: application/json</code> agar API
                            mengerti format data yang Anda inginkan.
                        </p>
                    </div>
                    <div class="section">
                        <h2>Daftar Endpoint API</h2>
                        <div class="endpoint">
                            <div class="endpoint-btn post" onclick="toggleDetails(this)">
                                <span class="method">POST</span>
                                <span class="url">http://localhost:8000/api/register</span>
                            </div>
                            <div class="endpoint-details">
                                <p>Mendaftarkan pengguna baru untuk bisa menggunakan aplikasi Kaneflow.</p>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Parameter</th>
                                            <th>Penjelasan</th>
                                            <th>Wajib</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>username</td>
                                            <td>Nama pengguna (harus unik)</td>
                                            <td>Ya</td>
                                        </tr>
                                        <tr>
                                            <td>email</td>
                                            <td>Alamat email Anda</td>
                                            <td>Ya</td>
                                        </tr>
                                        <tr>
                                            <td>password</td>
                                            <td>Kata sandi</td>
                                            <td>Ya</td>
                                        </tr>
                                        <tr>
                                            <td>password_confirmation</td>
                                            <td>Konfirmasi kata sandi (harus sama dengan password)</td>
                                            <td>Ya</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p><strong>Contoh Permintaan:</strong></p>
                                <div class="code-block">
                                    <div class="code-block-header">Headers:</div>
                                    <pre>Accept: application/json
Content-Type: application/json</pre>
                                    <div class="code-block-header">Body:</div>
                                    <pre>{
    "username": "newuser6",
    "email": "newuser6@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}</pre>
                                </div>
                                <p><strong>Contoh Respon:</strong></p>
                                <div class="code-block">
                                    <pre>{
    "message": "Registration successful",
    "user": {
        "username": "newuser6",
        "email": "newuser6@example.com",
        "updated_at": "2025-05-22T02:10:21.000000Z",
        "created_at": "2025-05-22T02:10:21.000000Z",
        "id": 4
    },
    "token": "1|fqmQdjvz1eGeZtF9qX3ovXtZCZC7dX4KqS8Ebkec8d9500db"
}</pre>
                                </div>
                                <div class="tutorial">
                                    <strong>Cara Pakai:</strong> Kirimkan data seperti username, email, dan kata sandi
                                    dalam format JSON menggunakan Postman. Pastikan kata sandi sama dengan
                                    konfirmasinya. Setelah berhasil, simpan token yang diberikan untuk digunakan di
                                    langkah berikutnya.
                                </div>
                            </div>
                        </div>
                        <div class="endpoint">
                            <div class="endpoint-btn post" onclick="toggleDetails(this)">
                                <span class="method">POST</span>
                                <span class="url">http://localhost:8000/api/login</span>
                            </div>
                            <div class="endpoint-details">
                                <p>Login untuk mendapatkan token agar bisa mengakses fitur lainnya.</p>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Parameter</th>
                                            <th>Penjelasan</th>
                                            <th>Wajib</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>username</td>
                                            <td>Nama pengguna</td>
                                            <td>Ya</td>
                                        </tr>
                                        <tr>
                                            <td>password</td>
                                            <td>Kata sandi</td>
                                            <td>Ya</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p><strong>Contoh Permintaan:</strong></p>
                                <div class="code-block">
                                    <div class="code-block-header">Headers:</div>
                                    <pre>Accept: application/json
Content-Type: application/json</pre>
                                    <div class="code-block-header">Body:</div>
                                    <pre>{
    "username": "newuser6",
    "password": "password123"
}</pre>
                                </div>
                                <p><strong>Contoh Respon:</strong></p>
                                <div class="code-block">
                                    <pre>{
    "message": "Login berhasil",
    "user": {
        "id": 4,
        "username": "newuser6",
        "email": "newuser6@example.com",
        "created_at": "2025-05-22T02:10:21.000000Z",
        "updated_at": "2025-05-22T02:10:21.000000Z"
    },
    "token": "2|0vOEg8EZI04OYa48xpaGUbUJ3Iits008B24s2113a22dae4e"
}</pre>
                                </div>
                                <div class="tutorial">
                                    <strong>Cara Pakai:</strong> Masukkan username dan kata sandi Anda di Postman, lalu
                                    kirimkan dalam format JSON. Jika berhasil, Anda akan mendapatkan token baru. Simpan
                                    token ini untuk digunakan di endpoint lain.
                                </div>
                            </div>
                        </div>
                        <div class="endpoint">
                            <div class="endpoint-btn get" onclick="toggleDetails(this)">
                                <span class="method">GET</span>
                                <span class="url">http://localhost:8000/api/register</span>
                            </div>
                            <div class="endpoint-details">
                                <p>Melihat daftar semua pengguna yang sudah terdaftar (perlu token).</p>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Header</th>
                                            <th>Penjelasan</th>
                                            <th>Wajib</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Authorization</td>
                                            <td>Token Bearer</td>
                                            <td>Ya</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p><strong>Contoh Permintaan:</strong></p>
                                <div class="code-block">
                                    <div class="code-block-header">Headers:</div>
                                    <pre>Accept: application/json
Authorization: Bearer 1|fqmQdjvz1eGeZtF9qX3ovXtZCZC7dX4KqS8Ebkec8d9500db</pre>
                                </div>
                                <p><strong>Contoh Respon:</strong></p>
                                <div class="code-block">
                                    <pre>{
    "message": "Berhasil mengambil daftar pengguna",
    "users": [
        {
            "id": 1,
            "username": "arfian Pratama",
            "email": "parfian823@gmail.com",
            "created_at": "2025-05-22T02:10:21.000000Z",
            "updated_at": "2025-05-22T02:10:21.000000Z"
        },
        {
            "id": 2,
            "username": "A_001_Arfian Putra Pratama",
            "email": "arfian.23001@mhs.unesa.ac.id",
            "created_at": "2025-05-22T02:10:21.000000Z",
            "updated_at": "2025-05-22T02:10:21.000000Z"
        },
        {
            "id": 3,
            "username": "Ferdynata Rafi",
            "email": "ferdynata190505@gmail.com",
            "created_at": "2025-05-22T02:10:21.000000Z",
            "updated_at": "2025-05-22T02:10:21.000000Z"
        },
        {
            "id": 4,
            "username": "newuser6",
            "email": "newuser6@example.com",
            "created_at": "2025-05-22T02:10:21.000000Z",
            "updated_at": "2025-05-22T02:10:21.000000Z"
        }
    ]
}</pre>
                                </div>
                                <div class="tutorial">
                                    <strong>Cara Pakai:</strong> Kirimkan permintaan GET di Postman dan masukkan token
                                    Anda di header Authorization. Anda akan melihat daftar semua pengguna yang sudah
                                    terdaftar.
                                </div>
                            </div>
                        </div>
                        <div class="endpoint">
                            <div class="endpoint-btn get" onclick="toggleDetails(this)">
                                <span class="method">GET</span>
                                <span class="url">http://localhost:8000/api/login</span>
                            </div>
                            <div class="endpoint-details">
                                <p>Melihat informasi lengkap pengguna yang sedang login.</p>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Header</th>
                                            <th>Penjelasan</th>
                                            <th>Wajib</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Authorization</td>
                                            <td>Token Bearer</td>
                                            <td>Ya</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p><strong>Contoh Permintaan:</strong></p>
                                <div class="code-block">
                                    <div class="code-block-header">Headers:</div>
                                    <pre>Accept: application/json
Authorization: Bearer 2|0vOEg8EZI04OYa48xpaGUbUJ3Iits008B24s2113a22dae4e</pre>
                                </div>
                                <p><strong>Contoh Respon:</strong></p>
                                <div class="code-block">
                                    <pre>{
    "message": "Berhasil mengambil data pengguna",
    "user": {
        "id": 4,
        "username": "newuser6",
        "email": "newuser6@example.com",
        "google_id": null,
        "facebook_id": null,
        "full_name": null,
        "address": null,
        "whatsapp": null,
        "website": null,
        "facebook": null,
        "twitter": null,
        "instagram": null,
        "profile_photo": null,
        "created_at": "2025-05-22T02:10:21.000000Z",
        "updated_at": "2025-05-22T02:10:21.000000Z"
    }
}</pre>
                                </div>
                                <div class="tutorial">
                                    <strong>Cara Pakai:</strong> Kirimkan permintaan GET dengan token Anda. Ini akan
                                    menunjukkan data Anda, termasuk informasi yang belum diisi (seperti alamat atau
                                    media sosial).
                                </div>
                            </div>
                        </div>
                        <div class="endpoint">
                            <div class="endpoint-btn get" onclick="toggleDetails(this)">
                                <span class="method">GET</span>
                                <span class="url">http://localhost:8000/api/dashboard</span>
                            </div>
                            <div class="endpoint-details">
                                <p>Melihat ringkasan keuangan seperti total pemasukan, pengeluaran, dan saldo.</p>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Header</th>
                                            <th>Penjelasan</th>
                                            <th>Wajib</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Authorization</td>
                                            <td>Token Bearer</td>
                                            <td>Ya</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p><strong>Contoh Permintaan:</strong></p>
                                <div class="code-block">
                                    <div class="code-block-header">Headers:</div>
                                    <pre>Accept: application/json
Authorization: Bearer 2|0vOEg8EZI04OYa48xpaGUbUJ3Iits008B24s2113a22dae4e</pre>
                                </div>
                                <p><strong>Contoh Respon:</strong></p>
                                <div class="code-block">
                                    <pre>{
    "status": "sukses",
    "data": {
        "totalPemasukan": 0,
        "totalPengeluaran": 0,
        "saldoAwal": 0,
        "saldoAkhir": 0,
        "currentMonth": "Mei 2025",
        "topPemasukan": [],
        "topPengeluaran": []
    }
}</pre>
                                </div>
                                <div class="tutorial">
                                    <strong>Cara Pakai:</strong> Kirimkan permintaan GET dengan token Anda. Anda akan
                                    melihat ringkasan keuangan. Jika belum ada transaksi, datanya akan nol.
                                </div>
                            </div>
                        </div>
                        <div class="endpoint">
                            <div class="endpoint-btn post" onclick="toggleDetails(this)">
                                <span class="method">POST</span>
                                <span class="url">http://localhost:8000/api/pemasukan</span>
                            </div>
                            <div class="endpoint-details">
                                <p>Menambahkan data pemasukan baru, seperti gaji atau bonus.</p>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Parameter</th>
                                            <th>Penjelasan</th>
                                            <th>Wajib</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>tanggal</td>
                                            <td>Tanggal transaksi (format: DD-MM-YYYY, misal 15-04-2024)</td>
                                            <td>Ya</td>
                                        </tr>
                                        <tr>
                                            <td>kategori</td>
                                            <td>ID kategori (misal 1 = Gaji, 2 = Hadiah)</td>
                                            <td>Ya</td>
                                        </tr>
                                        <tr>
                                            <td>deskripsi</td>
                                            <td>Keterangan transaksi</td>
                                            <td>Ya</td>
                                        </tr>
                                        <tr>
                                            <td>jumlah</td>
                                            <td>Jumlah uang (minimal 1)</td>
                                            <td>Ya</td>
                                        </tr>
                                        <tr>
                                            <td>bukti_transaksi</td>
                                            <td>File gambar bukti (JPEG/PNG, maks 1MB, opsional)</td>
                                            <td>Tidak</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Header</th>
                                            <th>Penjelasan</th>
                                            <th>Wajib</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Authorization</td>
                                            <td>Token Bearer</td>
                                            <td>Ya</td>
                                        </tr>
                                        <tr>
                                            <td>Content-Type</td>
                                            <td>multipart/form-data</td>
                                            <td>Ya</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p><strong>Contoh Permintaan:</strong></p>
                                <div class="code-block">
                                    <div class="code-block-header">Headers:</div>
                                    <pre>Accept: application/json
Authorization: Bearer 2|0vOEg8EZI04OYa48xpaGUbUJ3Iits008B24s2113a22dae4e
Content-Type: multipart/form-data</pre>
                                    <div class="code-block-header">Body:</div>
                                    <pre>tanggal: 15-04-2024
kategori: 1
deskripsi: Gaji bulan Mei 2024
jumlah: 6000000
bukti_transaksi: (unggah file gambar)</pre>
                                </div>
                                <p><strong>Contoh Respon:</strong></p>
                                <div class="code-block">
                                    <pre>{
    "status": "sukses",
    "message": "Data pemasukan berhasil disimpan.",
    "data": {
        "id": 2,
        "tanggal": "15-04-2024",
        "kategori_id": "1",
        "kategori": "Gaji",
        "deskripsi": "Gaji bulan Mei 2024",
        "jumlah": "6000000",
        "jumlah_formatted": "6.000.000",
        "bukti_transaksi": null
    }
}</pre>
                                </div>
                                <div class="tutorial">
                                    <strong>Cara Pakai:</strong> Gunakan Postman untuk mengirim data dalam format
                                    form-data. Isi semua kolom seperti tanggal, kategori, dll. Jika ada bukti transaksi,
                                    unggah file gambar (opsional).
                                </div>
                            </div>
                        </div>
                        <div class="endpoint">
                            <div class="endpoint-btn post" onclick="toggleDetails(this)">
                                <span class="method">POST</span>
                                <span class="url">http://localhost:8000/api/pengeluaran</span>
                            </div>
                            <div class="endpoint-details">
                                <p>Menambahkan data pengeluaran baru, seperti belanja atau tagihan.</p>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Parameter</th>
                                            <th>Penjelasan</th>
                                            <th>Wajib</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>tanggal</td>
                                            <td>Tanggal transaksi (format: DD-MM-YYYY, misal 15-05-2025)</td>
                                            <td>Ya</td>
                                        </tr>
                                        <tr>
                                            <td>kategori</td>
                                            <td>ID kategori (misal 1 = Belanja Harian)</td>
                                            <td>Ya</td>
                                        </tr>
                                        <tr>
                                            <td>deskripsi</td>
                                            <td>Keterangan transaksi</td>
                                            <td>Ya</td>
                                        </tr>
                                        <tr>
                                            <td>jumlah</td>
                                            <td>Jumlah uang (minimal 1)</td>
                                            <td>Ya</td>
                                        </tr>
                                        <tr>
                                            <td>bukti_transaksi</td>
                                            <td>File gambar bukti (JPEG/PNG, maks 1MB, opsional)</td>
                                            <td>Tidak</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Header</th>
                                            <th>Penjelasan</th>
                                            <th>Wajib</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Authorization</td>
                                            <td>Token Bearer</td>
                                            <td>Ya</td>
                                        </tr>
                                        <tr>
                                            <td>Content-Type</td>
                                            <td>multipart/form-data</td>
                                            <td>Ya</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p><strong>Contoh Permintaan:</strong></p>
                                <div class="code-block">
                                    <div class="code-block-header">Headers:</div>
                                    <pre>Accept: application/json
Authorization: Bearer 2|0vOEg8EZI04OYa48xpaGUbUJ3Iits008B24s2113a22dae4e
Content-Type: multipart/form-data</pre>
                                    <div class="code-block-header">Body:</div>
                                    <pre>tanggal: 15-05-2025
kategori: 1
deskripsi: Gaji bulan Mei 2025
jumlah: 5000000
bukti_transaksi: (unggah file gambar)</pre>
                                </div>
                                <p><strong>Contoh Respon:</strong></p>
                                <div class="code-block">
                                    <pre>{
    "status": "sukses",
    "message": "Data pengeluaran berhasil disimpan.",
    "data": {
        "id": 2,
        "tanggal": "15-05-2025",
        "kategori_id": "1",
        "kategori": "Belanja Harian",
        "deskripsi": "Gaji bulan Mei 2025",
        "jumlah": "5000000",
        "jumlah_formatted": "5.000.000",
        "bukti_transaksi": null
    }
}</pre>
                                </div>
                                <div class="tutorial">
                                    <strong>Cara Pakai:</strong> Kirim data menggunakan Postman dalam format form-data.
                                    Isi semua kolom, dan unggah gambar bukti jika ada (opsional). Pastikan kategori
                                    sesuai.
                                </div>
                            </div>
                        </div>
                        <div class="endpoint">
                            <div class="endpoint-btn get" onclick="toggleDetails(this)">
                                <span class="method">GET</span>
                                <span class="url">http://localhost:8000/api/pemasukan</span>
                            </div>
                            <div class="endpoint-details">
                                <p>Melihat semua data pemasukan yang sudah Anda tambahkan.</p>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Header</th>
                                            <th>Penjelasan</th>
                                            <th>Wajib</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Authorization</td>
                                            <td>Token Bearer</td>
                                            <td>Ya</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p><strong>Contoh Permintaan:</strong></p>
                                <div class="code-block">
                                    <div class="code-block-header">Headers:</div>
                                    <pre>Accept: application/json
Authorization: Bearer 2|0vOEg8EZI04OYa48xpaGUbUJ3Iits008B24s2113a22dae4e</pre>
                                </div>
                                <p><strong>Contoh Respon:</strong></p>
                                <div class="code-block">
                                    <pre>{
    "status": "sukses",
    "data": [
        {
            "id": 2,
            "tanggal": "15-04-2024",
            "kategori": "Gaji",
            "deskripsi": "Gaji bulan Mei 2024",
            "jumlah": "6000000.00",
            "bukti_transaksi": null,
            "created_at": "2025-05-22T02:10:21.000000Z",
            "updated_at": "2025-05-22T02:10:21.000000Z",
            "user_id": 4,
            "kategori_id": "1",
            "jumlah_formatted": "6.000.000"
        }
    ]
}</pre>
                                </div>
                                <div class="tutorial">
                                    <strong>Cara Pakai:</strong> Kirimkan permintaan GET dengan token Anda di Postman.
                                    Anda akan melihat semua data pemasukan yang sudah Anda masukkan.
                                </div>
                            </div>
                        </div>
                        <div class="endpoint">
                            <div class="endpoint-btn get" onclick="toggleDetails(this)">
                                <span class="method">GET</span>
                                <span class="url">http://localhost:8000/api/pengeluaran</span>
                            </div>
                            <div class="endpoint-details">
                                <p>Melihat semua data pengeluaran yang sudah Anda tambahkan.</p>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Header</th>
                                            <th>Penjelasan</th>
                                            <th>Wajib</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Authorization</td>
                                            <td>Token Bearer</td>
                                            <td>Ya</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p><strong>Contoh Permintaan:</strong></p>
                                <div class="code-block">
                                    <div class="code-block-header">Headers:</div>
                                    <pre>Accept: application/json
Authorization: Bearer 2|0vOEg8EZI04OYa48xpaGUbUJ3Iits008B24s2113a22dae4e</pre>
                                </div>
                                <p><strong>Contoh Respon:</strong></p>
                                <div class="code-block">
                                    <pre>{
    "status": "sukses",
    "data": [
        {
            "id": 2,
            "tanggal": "15-05-2025",
            "kategori": "Belanja Harian",
            "deskripsi": "Gaji bulan Mei 2025",
            "jumlah": "5000000.00",
            "bukti_transaksi": null,
            "created_at": "2025-05-22T02:10:21.000000Z",
            "updated_at": "2025-05-22T02:10:21.000000Z",
            "user_id": 4,
            "kategori_id": "1",
            "jumlah_formatted": "5.000.000"
        }
    ]
}</pre>
                                </div>
                                <div class="tutorial">
                                    <strong>Cara Pakai:</strong> Kirimkan permintaan GET dengan token Anda. Ini akan
                                    menampilkan semua data pengeluaran yang sudah Anda masukkan.
                                </div>
                            </div>
                        </div>
                        <div class="endpoint">
                            <div class="endpoint-btn delete" onclick="toggleDetails(this)">
                                <span class="method">DELETE</span>
                                <span class="url">http://localhost:8000/api/pemasukan/{id}</span>
                            </div>
                            <div class="endpoint-details">
                                <p>Menghapus data pemasukan berdasarkan ID-nya.</p>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Parameter</th>
                                            <th>Penjelasan</th>
                                            <th>Wajib</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>id</td>
                                            <td>ID dari data pemasukan yang ingin dihapus</td>
                                            <td>Ya</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Header</th>
                                            <th>Penjelasan</th>
                                            <th>Wajib</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Authorization</td>
                                            <td>Token Bearer</td>
                                            <td>Ya</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p><strong>Contoh Permintaan:</strong></p>
                                <div class="code-block">
                                    <div class="code-block-header">Headers:</div>
                                    <pre>Accept: application/json
Authorization: Bearer 2|0vOEg8EZI04OYa48xpaGUbUJ3Iits008B24s2113a22dae4e</pre>
                                </div>
                                <p><strong>Contoh Respon:</strong></p>
                                <div class="code-block">
                                    <pre>{
    "success": true,
    "message": "Data pemasukan berhasil dihapus."
}</pre>
                                </div>
                                <div class="tutorial">
                                    <strong>Cara Pakai:</strong> Kirimkan permintaan DELETE dengan ID data pemasukan di
                                    URL. Pastikan Anda memasukkan token yang benar di header.
                                </div>
                            </div>
                        </div>
                        <div class="endpoint">
                            <div class="endpoint-btn delete" onclick="toggleDetails(this)">
                                <span class="method">DELETE</span>
                                <span class="url">http://localhost:8000/api/pengeluaran/{id}</span>
                            </div>
                            <div class="endpoint-details">
                                <p>Menghapus data pengeluaran berdasarkan ID-nya.</p>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Parameter</th>
                                            <th>Penjelasan</th>
                                            <th>Wajib</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>id</td>
                                            <td>ID dari data pengeluaran yang ingin dihapus</td>
                                            <td>Ya</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Header</th>
                                            <th>Penjelasan</th>
                                            <th>Wajib</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Authorization</td>
                                            <td>Token Bearer</td>
                                            <td>Ya</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p><strong>Contoh Permintaan:</strong></p>
                                <div class="code-block">
                                    <div class="code-block-header">Headers:</div>
                                    <pre>Accept: application/json
Authorization: Bearer 2|0vOEg8EZI04OYa48xpaGUbUJ3Iits008B24s2113a22dae4e</pre>
                                </div>
                                <p><strong>Contoh Respon:</strong></p>
                                <div class="code-block">
                                    <pre>{
    "success": true,
    "message": "Data pengeluaran berhasil dihapus."
}</pre>
                                </div>
                                <div class="tutorial">
                                    <strong>Cara Pakai:</strong> Kirimkan permintaan DELETE dengan ID data pengeluaran
                                    di URL. Verifikasi token Anda sebelum mengirim.
                                </div>
                            </div>
                        </div>
                        <div class="endpoint">
                            <div class="endpoint-btn get" onclick="toggleDetails(this)">
                                <span class="method">GET</span>
                                <span class="url">http://localhost:8000/api/laporan/pemasukan</span>
                            </div>
                            <div class="endpoint-details">
                                <p>Melihat laporan pemasukan berdasarkan tahun dan bulan tertentu.</p>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Parameter</th>
                                            <th>Penjelasan</th>
                                            <th>Wajib</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>tahun</td>
                                            <td>Tahun (misal 2024)</td>
                                            <td>Ya</td>
                                        </tr>
                                        <tr>
                                            <td>bulan</td>
                                            <td>Bulan (misal 4 untuk April)</td>
                                            <td>Ya</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Header</th>
                                            <th>Penjelasan</th>
                                            <th>Wajib</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Authorization</td>
                                            <td>Token Bearer</td>
                                            <td>Ya</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p><strong>Contoh Permintaan:</strong></p>
                                <div class="code-block">
                                    <div class="code-block-header">Headers:</div>
                                    <pre>Accept: application/json
Authorization: Bearer 2|c1KELWgLln0HBczIfQ6mrBXID5oba7JeQBg0xaRF06e02865</pre>
                                    <div class="code-block-header">Query Parameters:</div>
                                    <pre>tahun=2024&bulan=4</pre>
                                </div>
                                <p><strong>Contoh Respon:</strong></p>
                                <div class="code-block">
                                    <pre>{
    "message": "Laporan pemasukan berhasil diambil",
    "tahun": "2024",
    "data": [
        {
            "bulan": "April",
            "transaksi": [
                {
                    "tanggal": "2024-04-15",
                    "kategori_pemasukan": "Gaji",
                    "deskripsi_transaksi": "Gaji bulan Mei 2024",
                    "jumlah": 6000000
                }
            ]
        }
    ],
    "total_transaksi": 1,
    "total_pemasukan": 6000000
}</pre>
                                </div>
                                <div class="tutorial">
                                    <strong>Cara Pakai:</strong> Kirimkan permintaan GET dengan menambahkan tahun dan
                                    bulan di URL (contoh: ?tahun=2024&bulan=4). Jangan lupa masukkan token Anda.
                                </div>
                            </div>
                        </div>
                        <div class="endpoint">
                            <div class="endpoint-btn get" onclick="toggleDetails(this)">
                                <span class="method">GET</span>
                                <span class="url">http://localhost:8000/api/laporan/pengeluaran</span>
                            </div>
                            <div class="endpoint-details">
                                <p>Melihat laporan pengeluaran berdasarkan tahun dan bulan tertentu.</p>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Parameter</th>
                                            <th>Penjelasan</th>
                                            <th>Wajib</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>tahun</td>
                                            <td>Tahun (misal 2025)</td>
                                            <td>Ya</td>
                                        </tr>
                                        <tr>
                                            <td>bulan</td>
                                            <td>Bulan (misal 5 untuk Mei)</td>
                                            <td>Ya</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Header</th>
                                            <th>Penjelasan</th>
                                            <th>Wajib</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Authorization</td>
                                            <td>Token Bearer</td>
                                            <td>Ya</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p><strong>Contoh Permintaan:</strong></p>
                                <div class="code-block">
                                    <div class="code-block-header">Headers:</div>
                                    <pre>Accept: application/json
Authorization: Bearer 2|c1KELWgLln0HBczIfQ6mrBXID5oba7JeQBg0xaRF06e02865</pre>
                                    <div class="code-block-header">Query Parameters:</div>
                                    <pre>tahun=2025&bulan=5</pre>
                                </div>
                                <p><strong>Contoh Respon:</strong></p>
                                <div class="code-block">
                                    <pre>{
    "message": "Laporan pengeluaran berhasil diambil",
    "tahun": "2025",
    "data": [
        {
            "bulan": "Mei",
            "transaksi": [
                {
                    "tanggal": "2025-05-15",
                    "kategori_pengeluaran": "Belanja Harian",
                    "deskripsi_transaksi": "Gaji bulan Mei 2025",
                    "jumlah": 5000000
                }
            ]
        }
    ],
    "total_transaksi": 1,
    "total_pengeluaran": 5000000
}</pre>
                                </div>
                                <div class="tutorial">
                                    <strong>Cara Pakai:</strong> Kirimkan permintaan GET dengan menambahkan tahun dan
                                    bulan di URL (contoh: ?tahun=2025&bulan=5). Pastikan token Anda benar.
                                </div>
                            </div>
                        </div>
                        <div class="endpoint">
                            <div class="endpoint-btn get" onclick="toggleDetails(this)">
                                <span class="method">GET</span>
                                <span class="url">http://localhost:8000/api/profil/{id}</span>
                            </div>
                            <div class="endpoint-details">
                                <p>Melihat detail profil pengguna berdasarkan ID.</p>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Parameter</th>
                                            <th>Penjelasan</th>
                                            <th>Wajib</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>id</td>
                                            <td>ID pengguna</td>
                                            <td>Ya</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Header</th>
                                            <th>Penjelasan</th>
                                            <th>Wajib</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Authorization</td>
                                            <td>Token Bearer</td>
                                            <td>Ya</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p><strong>Contoh Permintaan:</strong></p>
                                <div class="code-block">
                                    <div class="code-block-header">Headers:</div>
                                    <pre>Accept: application/json
Authorization: Bearer 2|c1KELWgLln0HBczIfQ6mrBXID5oba7JeQBg0xaRF06e02865</pre>
                                </div>
                                <p><strong>Contoh Respon:</strong></p>
                                <div class="code-block">
                                    <pre>{
    "message": "Profil berhasil diambil",
    "user": {
        "id": 1,
        "username": "newuser6",
        "full_name": null,
        "email": "newuser6@example.com",
        "address": "Belum diatur",
        "whatsapp": "Belum diatur",
        "website": "Belum diatur",
        "facebook": "Belum diatur",
        "twitter": "Belum diatur",
        "instagram": "Belum diatur",
        "profile_photo": "http://localhost:8000/images/default-profile.png"
    }
}</pre>
                                </div>
                                <div class="tutorial">
                                    <strong>Cara Pakai:</strong> Kirimkan permintaan GET dengan ID pengguna di URL
                                    (misal /profil/1). Masukkan token Anda di header untuk melihat detail profil.
                                </div>
                            </div>
                        </div>
                        <div class="endpoint">
                            <div class="endpoint-btn post" onclick="toggleDetails(this)">
                                <span class="method">POST</span>
                                <span class="url">http://localhost:8000/api/profil/update/{id}</span>
                            </div>
                            <div class="endpoint-details">
                                <p>Memperbarui informasi profil pengguna berdasarkan ID.</p>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Parameter</th>
                                            <th>Penjelasan</th>
                                            <th>Wajib</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>id</td>
                                            <td>ID pengguna</td>
                                            <td>Ya</td>
                                        </tr>
                                        <tr>
                                            <td>username</td>
                                            <td>Nama pengguna baru</td>
                                            <td>Tidak</td>
                                        </tr>
                                        <tr>
                                            <td>full_name</td>
                                            <td>Nama lengkap baru</td>
                                            <td>Tidak</td>
                                        </tr>
                                        <tr>
                                            <td>email</td>
                                            <td>Email baru</td>
                                            <td>Tidak</td>
                                        </tr>
                                        <tr>
                                            <td>address</td>
                                            <td>Alamat baru</td>
                                            <td>Tidak</td>
                                        </tr>
                                        <tr>
                                            <td>whatsapp</td>
                                            <td>Nomor WhatsApp baru</td>
                                            <td>Tidak</td>
                                        </tr>
                                        <tr>
                                            <td>website</td>
                                            <td>Link website baru</td>
                                            <td>Tidak</td>
                                        </tr>
                                        <tr>
                                            <td>facebook</td>
                                            <td>Link Facebook baru</td>
                                            <td>Tidak</td>
                                        </tr>
                                        <tr>
                                            <td>twitter</td>
                                            <td>Link Twitter baru</td>
                                            <td>Tidak</td>
                                        </tr>
                                        <tr>
                                            <td>instagram</td>
                                            <td>Link Instagram baru</td>
                                            <td>Tidak</td>
                                        </tr>
                                        <tr>
                                            <td>profile_photo</td>
                                            <td>Foto profil baru (file gambar)</td>
                                            <td>Tidak</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Header</th>
                                            <th>Penjelasan</th>
                                            <th>Wajib</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Authorization</td>
                                            <td>Token Bearer</td>
                                            <td>Ya</td>
                                        </tr>
                                        <tr>
                                            <td>Content-Type</td>
                                            <td>multipart/form-data</td>
                                            <td>Ya</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p><strong>Contoh Permintaan:</strong></p>
                                <div class="code-block">
                                    <div class="code-block-header">Headers:</div>
                                    <pre>Accept: application/json
Authorization: Bearer 2|c1KELWgLln0HBczIfQ6mrBXID5oba7JeQBg0xaRF06e02865
Content-Type: multipart/form-data</pre>
                                    <div class="code-block-header">Body:</div>
                                    <pre>username: pian
full_name: pian
email: pian.updated@example.com
address: surabaya
whatsapp: +6281234567890
website: https://indrasite.com
facebook: https://facebook.com/indrasatya
twitter: https://twitter.com/indrasatya
instagram: https://instagram.com/indrasatya
profile_photo: (unggah file gambar)</pre>
                                </div>
                                <p><strong>Contoh Respon:</strong></p>
                                <div class="code-block">
                                    <pre>{
    "message": "Profil berhasil diperbarui",
    "user": {
        "id": 1,
        "username": "pian",
        "full_name": "pian",
        "email": "pian.updated@example.com",
        "address": "surabaya",
        "whatsapp": "+6281234567890",
        "website": "https://indrasite.com",
        "facebook": "https://facebook.com/indrasatya",
        "twitter": "https://twitter.com/indrasatya",
        "instagram": "https://instagram.com/indrasatya",
        "profile_photo": "http://localhost:8000/storage/profile_photos/bsbIcdLwp6mcRnKjbhRjIFNgGi5IV6dJ6oPl7T9w.png"
    }
}</pre>
                                </div>
                                <div class="tutorial">
                                    <strong>Cara Pakai:</strong> Kirimkan data yang ingin diperbarui dalam format
                                    form-data menggunakan Postman. Isi hanya kolom yang ingin diubah, misalnya nama atau
                                    email. Jika ingin ganti foto profil, unggah file gambar.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.footer')
            </div>
        </div>
    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
    <!-- Tambahkan Prism.js untuk syntax highlighting (opsional) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    <script>
        function toggleDetails(button) {
            const details = button.nextElementSibling;
            if (details.classList.contains('active')) {
                details.classList.remove('active');
            } else {
                details.classList.add('active');
            }
        }
        $(document).ready(function() {
            $('#demoModal').modal('show');
        });
    </script>
</body>

</html>
