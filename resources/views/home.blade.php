<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>OkaneFlow - Kelola Keuanganmu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
        }

        header {
            background-color: #88C07C;
            padding: 10px 20px;
            text-align: center;
        }

        .logo {
            height: 40px;
        }

        .hero {
            background-color: #A9F3E3;
            display: flex;
            align-items: center;
            padding: 30px 10%;
            gap: 30px;
            flex-wrap: wrap;
        }

        .hero img {
            max-width: 300px;
        }

        .hero-text {
            flex: 1;
            min-width: 300px;
        }

        .hero-text h2 {
            font-size: 1.4rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .hero-text p {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn {
            background-color: #31C22F;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .features {
            display: flex;
            justify-content: space-around;
            padding: 30px 10%;
            background-color: #fff;
            flex-wrap: wrap;
            gap: 30px;
        }

        .feature-item {
            text-align: center;
            max-width: 200px;
        }

        .feature-item img {
            height: 40px;
            margin-bottom: 10px;
        }

        .feature-item p {
            font-size: 0.9rem;
        }

        .fitur-detail-section {
            padding: 50px 10%;
            background-color: #ffffff;
        }

        .fitur-detail {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 40px;
            padding: 20px;
            border-radius: 10px;
            background-color: #f4f4f4;
            flex-wrap: wrap;
        }

        .fitur-detail.green {
            background-color: #ccf4eb;
        }

        .fitur-image img {
            max-width: 150px;
            height: auto;
        }

        .fitur-text {
            flex: 1;
            padding: 0 20px;
            min-width: 250px;
        }

        .fitur-text h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            font-weight: bold;
            color: #2c3e50;
        }

        .fitur-text p {
            font-size: 0.95rem;
            line-height: 1.5;
            color: #333;
        }

        .footer {
            background-color: #88C07C;
            color: white;
            text-align: center;
            padding: 15px 0;
            font-size: 0.9rem;
            margin-top: 50px;
        }


        @media (max-width: 768px) {
            .fitur-detail {
                flex-direction: column;
                text-align: center;
            }

            .fitur-text {
                padding: 20px 0 0;
            }
        }
    </style>
</head>

<body>
    <header>
        <img src="{{ asset('images/logo.png') }}" alt="OkaneFlow Logo" class="logo">
    </header>

    <section class="hero">
        <img src="{{ asset('images/hero-image.png') }}" alt="Keuangan Ilustrasi">
        <div class="hero-text">
            <h2>Kelola Keuanganmu Lebih Mudah dan Praktis!</h2>
            <p>
                Dengan OkaneFlow, kamu bisa mencatat pemasukan, pengeluaran, dan melacak semua transaksi keuangan hanya
                dalam satu platform.<br>
                Butuh laporan? Tinggal print laporan keuanganmu kapan saja!<br>
                Tak suka buka web? Tenang, tersedia juga aplikasi Android yang siap bantu atur keuanganmu di genggaman.
            </p>
            <div class="buttons">
                <a href="#" class="btn">Download</a>
                <a href="#" class="btn">Kelola Dengan Web</a>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="feature-item">
            <img src="{{ asset('images/icon-income.png') }}" alt="Pemasukan">
            <p>Catat Pemasukan Keuangan</p>
        </div>
        <div class="feature-item">
            <img src="{{ asset('images/icon-expense.png') }}" alt="Pengeluaran">
            <p>Catat Pengeluaran Keuangan</p>
        </div>
        <div class="feature-item">
            <img src="{{ asset('images/icon-report.png') }}" alt="Arus Kas">
            <p>Rekap Arus Kas Masuk & Keluar</p>
        </div>
        <div class="feature-item">
            <img src="{{ asset('images/icon-print.png') }}" alt="Cetak Laporan">
            <p>Cetak Laporan Keuangan</p>
        </div>
    </section>
    <section class="fitur-detail-section">
        <!-- Fitur 1 -->
        <div class="fitur-detail green">
            <div class="fitur-image">
                <img src="{{ asset('images/icon-income.png') }}" alt="Catat Pemasukan">
            </div>
            <div class="fitur-text">
                <h3>Catat Pemasukan Keuangan</h3>
                <p>
                    Mengelola keuangan dimulai dari memahami dari mana uangmu berasal. Di OkaneFlow, kamu bisa mencatat
                    semua jenis pendapatan seperti gaji, bonus, hadiah, transfer, dan lainnya. Semua data tercatat
                    otomatis dan dapat dilacak dengan rapi dan mudah.
                </p>
            </div>
        </div>

        <!-- Fitur 2 -->
        <div class="fitur-detail">
            <div class="fitur-text">
                <h3>Catat Pengeluaran Keuangan</h3>
                <p>
                    Fitur ini membantumu tahu ke mana saja uangmu pergi. Cocok untuk memantau pengeluaran harian,
                    cicilan, belanja, dan lainnya. Bantu kamu menciptakan kebiasaan finansial yang sehat dan mengontrol
                    budget dengan baik.
                </p>
            </div>
            <div class="fitur-image">
                <img src="{{ asset('images/icon-expense.png') }}" alt="Catat Pengeluaran">
            </div>
        </div>

        <!-- Fitur 3 -->
        <div class="fitur-detail green">
            <div class="fitur-image">
                <img src="{{ asset('images/icon-report.png') }}" alt="Rekap Kas">
            </div>
            <div class="fitur-text">
                <h3>Rekap Arus Kas Masuk & Keluar</h3>
                <p>
                    Fitur ini memberikanmu gambaran visual dari arus pemasukan dan pengeluaran. Cocok untuk mengevaluasi
                    kondisi keuangan secara cepat apakah kamu surplus atau defisit. Sangat berguna untuk menyusun
                    strategi keuangan jangka panjang.
                </p>
            </div>
        </div>

        <!-- Fitur 4 -->
        <div class="fitur-detail">
            <div class="fitur-text">
                <h3>Catat Pengeluaran Keuangan</h3>
                <p>
                    Fitur ini membantumu tahu ke mana saja uangmu pergi. Cocok untuk memantau pengeluaran harian,
                    cicilan, belanja, dan lainnya. Bantu kamu menciptakan kebiasaan finansial yang sehat dan mengontrol
                    budget dengan baik.
                </p>
            </div>
            <div class="fitur-image">
                <img src="{{ asset('images/icon-expense.png') }}" alt="Catat Pengeluaran">
            </div>
    </section>
    <footer class="footer">
        © 2025 Kelompok 3
    </footer>

</body>

</html>
