<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LaporanController extends Controller
{
    public function pemasukan(Request $request)
    {
        $data = [];
        $totalTransaksi = 0;
        $totalPemasukan = 0;
        $userId = Auth::id(); // Get the authenticated user's ID

        if ($request->isMethod('post')) {
            $bulan = $request->input('bulan');
            $tahun = $request->input('tahun');
            $kategori = $request->input('kategori');

            $query = Pemasukan::where('user_id', $userId); // Filter by user_id

            // Filter berdasarkan tahun, bulan, dan kategori
            if (!empty($tahun)) {
                $query->whereYear('tanggal', $tahun);
            }
            if (!empty($bulan)) {
                $query->whereMonth('tanggal', $bulan);
            }
            if (!empty($kategori)) {
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
                $kategoriValue = $kategoriText[$kategori] ?? null;
                if ($kategoriValue) {
                    $query->where('kategori', $kategoriValue);
                }
            }

            $pemasukanData = $query->get()->toArray();

            // Case: Bulan = Semua, Kategori = Semua, Tahun = Selected Year
            if (empty($bulan) && empty($kategori) && !empty($tahun)) {
                $bulanText = [
                    1 => 'Januari',
                    2 => 'Februari',
                    3 => 'Maret',
                    4 => 'April',
                    5 => 'Mei',
                    6 => 'Juni',
                    7 => 'Juli',
                    8 => 'Agustus',
                    9 => 'September',
                    10 => 'Oktober',
                    11 => 'November',
                    12 => 'Desember'
                ];

                $monthlyData = [];
                foreach ($pemasukanData as $pemasukan) {
                    $pemasukanMonth = date('n', strtotime($pemasukan['tanggal']));
                    if (!isset($monthlyData[$pemasukanMonth])) {
                        $monthlyData[$pemasukanMonth] = [
                            'total_transaksi' => 0,
                            'total_pemasukan' => 0
                        ];
                    }
                    $monthlyData[$pemasukanMonth]['total_transaksi']++;
                    $monthlyData[$pemasukanMonth]['total_pemasukan'] += (float) $pemasukan['jumlah'];
                }

                foreach ($monthlyData as $month => $stats) {
                    $data[] = [
                        'bulan' => $bulanText[$month],
                        'total_transaksi' => $stats['total_transaksi'],
                        'total_pemasukan' => $stats['total_pemasukan']
                    ];
                    $totalTransaksi += $stats['total_transaksi'];
                    $totalPemasukan += $stats['total_pemasukan'];
                }

                usort($data, function ($a, $b) use ($bulanText) {
                    return array_search($a['bulan'], $bulanText) - array_search($b['bulan'], $bulanText);
                });
            }

            return view('Laporan.laporan-pemasukan', compact('bulan', 'tahun', 'kategori', 'data', 'totalTransaksi', 'totalPemasukan'));
        }

        return view('Laporan.laporan-pemasukan');
    }

    public function pengeluaran(Request $request)
    {
        $data = [];
        $totalTransaksi = 0;
        $totalPengeluaran = 0;
        $userId = Auth::id(); // Get the authenticated user's ID

        if ($request->isMethod('post')) {
            $bulan = $request->input('bulan');
            $tahun = $request->input('tahun');
            $kategori = $request->input('kategori');

            $query = Pengeluaran::where('user_id', $userId); // Filter by user_id

            if (!empty($tahun)) {
                $query->whereYear('tanggal', $tahun);
            }
            if (!empty($bulan)) {
                $query->whereMonth('tanggal', $bulan);
            }
            if (!empty($kategori)) {
                $kategoriText = [
                    '1' => 'Belanja Harian',
                    '2' => 'Tagihan Listrik',
                    '3' => 'Tagihan Air',
                    '4' => 'Biaya Transportasi',
                    '5' => 'Biaya Pendidikan',
                    '6' => 'Biaya Kesehatan',
                    '7' => 'Pengeluaran Hiburan',
                    '8' => 'Pengeluaran Donasi',
                    '9' => 'Pengeluaran Investasi',
                    '10' => 'Pengeluaran Lainnya',
                ];
                $kategoriValue = $kategoriText[$kategori] ?? null;
                if ($kategoriValue) {
                    $query->where('kategori', $kategoriValue);
                }
            }

            $pengeluaranData = $query->get()->toArray();

            if (empty($bulan) && empty($kategori) && !empty($tahun)) {
                $bulanText = [
                    1 => 'Januari',
                    2 => 'Februari',
                    3 => 'Maret',
                    4 => 'April',
                    5 => 'Mei',
                    6 => 'Juni',
                    7 => 'Juli',
                    8 => 'Agustus',
                    9 => 'September',
                    10 => 'Oktober',
                    11 => 'November',
                    12 => 'Desember'
                ];

                $monthlyData = [];
                foreach ($pengeluaranData as $pengeluaran) {
                    $pengeluaranMonth = date('n', strtotime($pengeluaran['tanggal']));
                    if (!isset($monthlyData[$pengeluaranMonth])) {
                        $monthlyData[$pengeluaranMonth] = [
                            'total_transaksi' => 0,
                            'total_pengeluaran' => 0
                        ];
                    }
                    $monthlyData[$pengeluaranMonth]['total_transaksi']++;
                    $monthlyData[$pengeluaranMonth]['total_pengeluaran'] += (float) $pengeluaran['jumlah'];
                }

                foreach ($monthlyData as $month => $stats) {
                    $data[] = [
                        'bulan' => $bulanText[$month],
                        'total_transaksi' => $stats['total_transaksi'],
                        'total_pengeluaran' => $stats['total_pengeluaran']
                    ];
                    $totalTransaksi += $stats['total_transaksi'];
                    $totalPengeluaran += $stats['total_pengeluaran'];
                }

                usort($data, function ($a, $b) use ($bulanText) {
                    return array_search($a['bulan'], $bulanText) - array_search($b['bulan'], $bulanText);
                });
            }

            return view('Laporan.laporan-pengeluaran', compact('bulan', 'tahun', 'kategori', 'data', 'totalTransaksi', 'totalPengeluaran'));
        }

        return view('Laporan.laporan-pengeluaran');
    }

    public function kas(Request $request)
    {
        $data = [];
        $totalPemasukan = 0;
        $totalPengeluaran = 0;
        $saldo = 0;
        $userId = Auth::id(); // Get the authenticated user's ID

        // Fetch pemasukanData and pengeluaranData from session, ensuring user-specific key
        $pemasukanData = session('pemasukanData_' . $userId, []);
        $pengeluaranData = session('pengeluaranData_' . $userId, []);

        // Log session data for debugging
        Log::info('pemasukanData in kas method', ['pemasukanData' => $pemasukanData]);
        Log::info('pengeluaranData in kas method', ['pengeluaranData' => $pengeluaranData]);

        if ($request->isMethod('post')) {
            $tahun = $request->input('tahun');

            if (!empty($tahun)) {
                $bulanText = [
                    1 => 'Januari',
                    2 => 'Februari',
                    3 => 'Maret',
                    4 => 'April',
                    5 => 'Mei',
                    6 => 'Juni',
                    7 => 'Juli',
                    8 => 'Agustus',
                    9 => 'September',
                    10 => 'Oktober',
                    11 => 'November',
                    12 => 'Desember'
                ];

                // Aggregate Pemasukan by month
                $monthlyPemasukan = [];
                foreach ($pemasukanData as $pemasukan) {
                    $pemasukanDate = \Carbon\Carbon::createFromFormat('d-m-Y', $pemasukan['tanggal']);
                    $pemasukanYear = $pemasukanDate->format('Y');
                    if ($pemasukanYear == $tahun) {
                        $pemasukanMonth = $pemasukanDate->format('n');
                        $monthlyPemasukan[$pemasukanMonth] = ($monthlyPemasukan[$pemasukanMonth] ?? 0) + $pemasukan['jumlah'];
                    }
                }

                // Aggregate Pengeluaran by month
                $monthlyPengeluaran = [];
                foreach ($pengeluaranData as $pengeluaran) {
                    $pengeluaranDate = \Carbon\Carbon::createFromFormat('d-m-Y', $pengeluaran['tanggal']);
                    $pengeluaranYear = $pengeluaranDate->format('Y');
                    if ($pengeluaranYear == $tahun) {
                        $pengeluaranMonth = $pengeluaranDate->format('n');
                        $monthlyPengeluaran[$pengeluaranMonth] = ($monthlyPengeluaran[$pengeluaranMonth] ?? 0) + $pengeluaran['jumlah'];
                    }
                }

                // Combine data for each month
                $monthsWithData = array_unique(array_merge(array_keys($monthlyPemasukan), array_keys($monthlyPengeluaran)));
                sort($monthsWithData);

                foreach ($monthsWithData as $month) {
                    $pemasukan = $monthlyPemasukan[$month] ?? 0;
                    $pengeluaran = $monthlyPengeluaran[$month] ?? 0;
                    $selisih = $pemasukan - $pengeluaran;
                    $saldo += $selisih;

                    $data[] = [
                        'bulan' => $bulanText[$month],
                        'pemasukan' => $pemasukan,
                        'pengeluaran' => $pengeluaran,
                        'selisih' => $selisih,
                        'saldo' => $saldo
                    ];

                    $totalPemasukan += $pemasukan;
                    $totalPengeluaran += $pengeluaran;
                }

                // Log the processed data for debugging
                Log::info('Processed kas data', [
                    'tahun' => $tahun,
                    'data' => $data,
                    'totalPemasukan' => $totalPemasukan,
                    'totalPengeluaran' => $totalPengeluaran,
                    'saldo' => $saldo
                ]);
            }

            return view('Laporan.kas', compact('tahun', 'data', 'totalPemasukan', 'totalPengeluaran', 'saldo'));
        }

        return view('Laporan.kas');
    }

    public function apiKas(Request $request)
    {
        $tahun = $request->query('tahun');
        $userId = Auth::id(); // Get the authenticated user's ID

        if (empty($tahun)) {
            return response()->json(['message' => 'Parameter tahun is required'], 400);
        }

        $data = [];
        $totalPemasukan = 0;
        $totalPengeluaran = 0;
        $saldo = 0;

        // Fetch all data from database, filtered by user_id
        $pemasukanData = Pemasukan::where('user_id', $userId)->get()->toArray();
        $pengeluaranData = Pengeluaran::where('user_id', $userId)->get()->toArray();

        // Log database data for debugging
        Log::info('pemasukanData from database in apiKas method', ['pemasukanData' => $pemasukanData]);
        Log::info('pengeluaranData from database in apiKas method', ['pengeluaranData' => $pengeluaranData]);

        $bulanText = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        // Aggregate Pemasukan by month and filter by year
        $monthlyPemasukan = [];
        foreach ($pemasukanData as $pemasukan) {
            $pemasukanYear = date('Y', strtotime($pemasukan['tanggal']));
            if ($pemasukanYear == $tahun) {
                $pemasukanMonth = date('n', strtotime($pemasukan['tanggal']));
                $monthlyPemasukan[$pemasukanMonth] = ($monthlyPemasukan[$pemasukanMonth] ?? 0) + $pemasukan['jumlah'];
            }
        }

        // Aggregate Pengeluaran by month and filter by year
        $monthlyPengeluaran = [];
        foreach ($pengeluaranData as $pengeluaran) {
            $pengeluaranYear = date('Y', strtotime($pengeluaran['tanggal']));
            if ($pengeluaranYear == $tahun) {
                $pengeluaranMonth = date('n', strtotime($pengeluaran['tanggal']));
                $monthlyPengeluaran[$pengeluaranMonth] = ($monthlyPengeluaran[$pengeluaranMonth] ?? 0) + $pengeluaran['jumlah'];
            }
        }

        // Combine data for each month
        $monthsWithData = array_unique(array_merge(array_keys($monthlyPemasukan), array_keys($monthlyPengeluaran)));
        sort($monthsWithData);

        foreach ($monthsWithData as $month) {
            $pemasukan = $monthlyPemasukan[$month] ?? 0;
            $pengeluaran = $monthlyPengeluaran[$month] ?? 0;
            $selisih = $pemasukan - $pengeluaran;
            $saldo += $selisih;

            $data[] = [
                'bulan' => $bulanText[$month],
                'pemasukan' => $pemasukan,
                'pengeluaran' => $pengeluaran,
                'selisih' => $selisih,
                'saldo' => $saldo
            ];

            $totalPemasukan += $pemasukan;
            $totalPengeluaran += $pengeluaran;
        }

        return response()->json([
            'message' => 'Kas report retrieved successfully',
            'tahun' => $tahun,
            'data' => $data,
            'total_pemasukan' => $totalPemasukan,
            'total_pengeluaran' => $totalPengeluaran,
            'saldo' => $saldo
        ]);
    }

    public function apiPemasukan(Request $request)
    {
        $tahun = $request->query('tahun');
        $bulan = $request->query('bulan');
        $kategori = $request->query('kategori');
        $userId = Auth::id(); // Get the authenticated user's ID

        if (empty($tahun)) {
            return response()->json(['message' => 'Parameter tahun is required'], 400);
        }

        $data = [];
        $totalTransaksi = 0;
        $totalPemasukan = 0;

        // Fetch data from database with filters, scoped to user_id
        $query = Pemasukan::where('user_id', $userId);
        $query->whereYear('tanggal', $tahun);
        if (!empty($bulan)) {
            $query->whereMonth('tanggal', $bulan);
        }
        if (!empty($kategori)) {
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
            $kategoriValue = $kategoriText[$kategori] ?? null;
            if ($kategoriValue) {
                $query->where('kategori', $kategoriValue);
            } else {
                return response()->json(['message' => 'Invalid kategori value'], 400);
            }
        }
        $pemasukanData = $query->get()->toArray();

        // Log database data for debugging
        Log::info('pemasukanData from database in apiPemasukan method', ['pemasukanData' => $pemasukanData]);

        $bulanText = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        // Group transactions by month
        $monthlyData = [];
        foreach ($pemasukanData as $pemasukan) {
            $pemasukanMonth = date('n', strtotime($pemasukan['tanggal']));
            if (!isset($monthlyData[$pemasukanMonth])) {
                $monthlyData[$pemasukanMonth] = [];
            }
            $monthlyData[$pemasukanMonth][] = [
                'tanggal' => $pemasukan['tanggal'],
                'kategori_pemasukan' => $pemasukan['kategori'],
                'deskripsi_transaksi' => $pemasukan['deskripsi'],
                'jumlah' => (float) $pemasukan['jumlah']
            ];
            $totalTransaksi++;
            $totalPemasukan += (float) $pemasukan['jumlah'];
        }

        // If bulan is specified but no transactions are found, return an empty transaction list for that month
        if (!empty($bulan) && empty($monthlyData)) {
            $monthlyData[$bulan] = [];
        }

        // Format the data for response, only include months with transactions or the specified month
        foreach ($monthlyData as $month => $transactions) {
            $data[] = [
                'bulan' => $bulanText[$month],
                'transaksi' => $transactions
            ];
        }

        // Sort data by month
        usort($data, function ($a, $b) use ($bulanText) {
            return array_search($a['bulan'], $bulanText) - array_search($b['bulan'], $bulanText);
        });

        return response()->json([
            'message' => 'Pemasukan report retrieved successfully',
            'tahun' => $tahun,
            'data' => $data,
            'total_transaksi' => $totalTransaksi,
            'total_pemasukan' => $totalPemasukan
        ]);
    }

    public function apiPengeluaran(Request $request)
    {
        $tahun = $request->query('tahun');
        $bulan = $request->query('bulan');
        $kategori = $request->query('kategori');
        $userId = Auth::id(); // Get the authenticated user's ID

        if (empty($tahun)) {
            return response()->json(['message' => 'Parameter tahun is required'], 400);
        }

        $data = [];
        $totalTransaksi = 0;
        $totalPengeluaran = 0;

        // Fetch data from database with filters, scoped to user_id
        $query = Pengeluaran::where('user_id', $userId);
        $query->whereYear('tanggal', $tahun);
        if (!empty($bulan)) {
            $query->whereMonth('tanggal', $bulan);
        }
        if (!empty($kategori)) {
            $kategoriText = [
                '1' => 'Belanja Harian',
                '2' => 'Tagihan Listrik',
                '3' => 'Tagihan Air',
                '4' => 'Biaya Transportasi',
                '5' => 'Biaya Pendidikan',
                '6' => 'Biaya Kesehatan',
                '7' => 'Pengeluaran Hiburan',
                '8' => 'Pengeluaran Donasi',
                '9' => 'Pengeluaran Investasi',
                '10' => 'Pengeluaran Lainnya',
            ];
            $kategoriValue = $kategoriText[$kategori] ?? null;
            if ($kategoriValue) {
                $query->where('kategori', $kategoriValue);
            } else {
                return response()->json(['message' => 'Invalid kategori value'], 400);
            }
        }
        $pengeluaranData = $query->get()->toArray();

        // Log database data for debugging
        Log::info('pengeluaranData from database in apiPengeluaran method', ['pengeluaranData' => $pengeluaranData]);

        $bulanText = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        // Group transactions by month
        $monthlyData = [];
        foreach ($pengeluaranData as $pengeluaran) {
            $pengeluaranMonth = date('n', strtotime($pengeluaran['tanggal']));
            if (!isset($monthlyData[$pengeluaranMonth])) {
                $monthlyData[$pengeluaranMonth] = [];
            }
            $monthlyData[$pengeluaranMonth][] = [
                'tanggal' => $pengeluaran['tanggal'],
                'kategori_pengeluaran' => $pengeluaran['kategori'],
                'deskripsi_transaksi' => $pengeluaran['deskripsi'],
                'jumlah' => (float) $pengeluaran['jumlah']
            ];
            $totalTransaksi++;
            $totalPengeluaran += (float) $pengeluaran['jumlah'];
        }

        // If bulan is specified but no transactions are found, return an empty transaction list for that month
        if (!empty($bulan) && empty($monthlyData)) {
            $monthlyData[$bulan] = [];
        }

        // Format the data for response, only include months with transactions or the specified month
        foreach ($monthlyData as $month => $transactions) {
            $data[] = [
                'bulan' => $bulanText[$month],
                'transaksi' => $transactions
            ];
        }

        // Sort data by month
        usort($data, function ($a, $b) use ($bulanText) {
            return array_search($a['bulan'], $bulanText) - array_search($b['bulan'], $bulanText);
        });

        return response()->json([
            'message' => 'Pengeluaran report retrieved successfully',
            'tahun' => $tahun,
            'data' => $data,
            'total_transaksi' => $totalTransaksi,
            'total_pengeluaran' => $totalPengeluaran
        ]);
    }
}
