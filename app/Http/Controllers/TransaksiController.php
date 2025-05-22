<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class TransaksiController extends Controller
{
    public function pemasukan()
    {
        return view('transaksi.Pemasukan');
    }

    public function pengeluaran()
    {
        return view('transaksi.Pengeluaran');
    }

    public function pemasukanTabel(Request $request)
    {
        $pemasukanData = Pemasukan::where('user_id', Auth::id())->get()->map(function ($item) {
            $item->tanggal = Carbon::parse($item->tanggal)->format('d-m-Y');
            $kategoriMap = [
                'Gaji' => '1',
                'Hadiah' => '2',
                'Jasa Web Development' => '3',
                'Jasa Web Desain' => '4',
                'Jasa Digital Marketing' => '5',
                'Jasa Kursus dan Pelatihan' => '6',
                'Penjualan E-Book' => '7',
                'Penjualan Video Tutorial' => '8',
                'Penjualan Sourcecode' => '9',
                'Pemasukan Lainnya' => '10',
            ];
            $item->kategori_id = $kategoriMap[$item->kategori] ?? '';
            $item->jumlah_formatted = number_format($item->jumlah, 0, ',', '.');
            return $item;
        })->toArray();

        // Store user-specific data in session with unique key
        session(['pemasukanData_' . Auth::id() => $pemasukanData]);

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'data' => $pemasukanData,
            ], 200);
        }

        return view('transaksi_tabel.Pemasukan-tabel', compact('pemasukanData'));
    }

    public function pengeluaranTabel(Request $request)
    {
        $pengeluaranData = Pengeluaran::where('user_id', Auth::id())->get()->map(function ($item) {
            $item->tanggal = Carbon::parse($item->tanggal)->format('d-m-Y');
            $kategoriMap = [
                'Belanja Harian' => '1',
                'Tagihan Listrik' => '2',
                'Tagihan Air' => '3',
                'Biaya Transportasi' => '4',
                'Biaya Pendidikan' => '5',
                'Biaya Kesehatan' => '6',
                'Pengeluaran Hiburan' => '7',
                'Pengeluaran Donasi' => '8',
                'Pengeluaran Investasi' => '9',
                'Pengeluaran Lainnya' => '10',
            ];
            $item->kategori_id = $kategoriMap[$item->kategori] ?? '';
            $item->jumlah_formatted = number_format($item->jumlah, 0, ',', '.');
            return $item;
        })->toArray();

        // Store user-specific data in session with unique key
        session(['pengeluaranData_' . Auth::id() => $pengeluaranData]);

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'data' => $pengeluaranData,
            ], 200);
        }

        return view('transaksi_tabel.pengeluaran-tabel', compact('pengeluaranData'));
    }

    public function detailPemasukan($id)
    {
        $pemasukan = Pemasukan::where('user_id', Auth::id())->findOrFail($id);
        $pemasukan->tanggal = Carbon::parse($pemasukan->tanggal)->format('d-m-Y');
        $pemasukan->jumlah_formatted = number_format($pemasukan->jumlah, 0, ',', '.');
        return view('transaksi_tabel.pemasukan.detail', compact('pemasukan'));
    }

    public function ubahPemasukan($id)
    {
        $pemasukan = Pemasukan::where('user_id', Auth::id())->findOrFail($id);
        $pemasukan->tanggal = Carbon::parse($pemasukan->tanggal)->format('d-m-Y');
        $kategoriMap = [
            'Gaji' => '1',
            'Hadiah' => '2',
            'Jasa Web Development' => '3',
            'Jasa Web Desain' => '4',
            'Jasa Digital Marketing' => '5',
            'Jasa Kursus dan Pelatihan' => '6',
            'Penjualan E-Book' => '7',
            'Penjualan Video Tutorial' => '8',
            'Penjualan Sourcecode' => '9',
            'Pemasukan Lainnya' => '10',
        ];
        $pemasukan->kategori_id = $kategoriMap[$pemasukan->kategori] ?? '';
        $pemasukan->jumlah_formatted = number_format($pemasukan->jumlah, 0, ',', '.');
        return view('transaksi_tabel.pemasukan.ubah', compact('pemasukan'));
    }

    public function updatePemasukan(Request $request, $id)
    {
        $pemasukan = Pemasukan::where('user_id', Auth::id())->findOrFail($id);

        Log::info('Received data for updatePemasukan', [
            'request_data' => $request->all(),
            'tanggal_raw' => $request->tanggal,
        ]);

        $validated = $request->validate([
            'tanggal' => [
                'required',
                'regex:/^\d{2}-\d{2}-\d{4}$/',
                function ($attribute, $value, $fail) {
                    $parts = explode('-', $value);
                    if (count($parts) !== 3) {
                        $fail('Format tanggal harus DD-MM-YYYY (contoh: 31-12-2024).');
                        return;
                    }
                    $day = (int) $parts[0];
                    $month = (int) $parts[1];
                    $year = (int) $parts[2];
                    if (!checkdate($month, $day, $year)) {
                        $fail('Tanggal tidak valid (contoh: 31-12-2024).');
                    }
                },
            ],
            'kategori' => 'required',
            'deskripsi' => 'required|string',
            'jumlah' => 'required|numeric|min:1',
            'bukti_transaksi' => 'nullable|image|mimes:jpeg,png|max:1024',
        ]);

        $kategoriMap = [
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

        $kategoriText = $kategoriMap[$request->kategori] ?? 'Unknown';
        $buktiPath = $pemasukan->bukti_transaksi;

        if ($request->hasFile('bukti_transaksi')) {
            try {
                if ($pemasukan->bukti_transaksi && Storage::disk('public')->exists($pemasukan->bukti_transaksi)) {
                    Storage::disk('public')->delete($pemasukan->bukti_transaksi);
                    Log::info('Old file deleted during update', ['path' => $pemasukan->bukti_transaksi]);
                }
                $buktiPath = $request->file('bukti_transaksi')->store('bukti_transaksi', 'public');
                Log::info('New file uploaded successfully', ['path' => $buktiPath]);
            } catch (\Exception $e) {
                Log::error('Failed to upload file during update', [
                    'error' => $e->getMessage(),
                    'file' => $request->file('bukti_transaksi')->getClientOriginalName(),
                ]);
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Gagal mengunggah file: ' . $e->getMessage(),
                    ], 500);
                }
                return redirect()->back()->withErrors(['bukti_transaksi' => 'Gagal mengunggah file: ' . $e->getMessage()]);
            }
        }

        try {
            $tanggal = Carbon::createFromFormat('d-m-Y', $request->tanggal)->format('Y-m-d');
            Log::info('Tanggal parsed successfully for updatePemasukan', ['tanggal' => $tanggal]);
        } catch (\Exception $e) {
            Log::error('Failed to parse date during updatePemasukan', [
                'error' => $e->getMessage(),
                'tanggal' => $request->tanggal,
            ]);
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tanggal tidak valid atau format tidak sesuai (harus DD-MM-YYYY).',
                ], 422);
            }
            return redirect()->back()->withErrors(['tanggal' => 'Tanggal tidak valid atau format tidak sesuai (harus DD-MM-YYYY).']);
        }

        $pemasukan->update([
            'tanggal' => $tanggal,
            'kategori' => $kategoriText,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'bukti_transaksi' => $buktiPath,
        ]);

        $updatedPemasukanData = Pemasukan::where('user_id', Auth::id())->get()->map(function ($item) {
            $item->tanggal = Carbon::parse($item->tanggal)->format('d-m-Y');
            $kategoriMap = [
                'Gaji' => '1',
                'Hadiah' => '2',
                'Jasa Web Development' => '3',
                'Jasa Web Desain' => '4',
                'Jasa Digital Marketing' => '5',
                'Jasa Kursus dan Pelatihan' => '6',
                'Penjualan E-Book' => '7',
                'Penjualan Video Tutorial' => '8',
                'Penjualan Sourcecode' => '9',
                'Pemasukan Lainnya' => '10',
            ];
            $item->kategori_id = $kategoriMap[$item->kategori] ?? '';
            $item->jumlah_formatted = number_format($item->jumlah, 0, ',', '.');
            return $item;
        })->toArray();
        session(['pemasukanData_' . Auth::id() => $updatedPemasukanData]);

        $responseData = [
            'id' => $pemasukan->id,
            'tanggal' => Carbon::parse($pemasukan->tanggal)->format('d-m-Y'),
            'kategori_id' => $request->kategori,
            'kategori' => $kategoriText,
            'deskripsi' => $pemasukan->deskripsi,
            'jumlah' => $pemasukan->jumlah,
            'jumlah_formatted' => number_format($pemasukan->jumlah, 0, ',', '.'),
            'bukti_transaksi' => $pemasukan->bukti_transaksi,
        ];

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Sukses! Data pemasukan berhasil diperbarui.',
                'data' => $responseData,
            ], 200);
        }

        return redirect()->route('pemasukan.tabel')->with('success', 'Data pemasukan berhasil diperbarui.')->with('updated_data', $responseData);
    }

    public function detailPengeluaran($id)
    {
        $pengeluaran = Pengeluaran::where('user_id', Auth::id())->findOrFail($id);
        $pengeluaran->tanggal = Carbon::parse($pengeluaran->tanggal)->format('d-m-Y');
        $pengeluaran->jumlah_formatted = number_format($pengeluaran->jumlah, 0, ',', '.');
        return view('transaksi_tabel.pengeluaran.detail', compact('pengeluaran'));
    }

    public function ubahPengeluaran($id)
    {
        $pengeluaran = Pengeluaran::where('user_id', Auth::id())->findOrFail($id);
        $pengeluaran->tanggal = Carbon::parse($pengeluaran->tanggal)->format('d-m-Y');
        $kategoriMap = [
            'Belanja Harian' => '1',
            'Tagihan Listrik' => '2',
            'Tagihan Air' => '3',
            'Biaya Transportasi' => '4',
            'Biaya Pendidikan' => '5',
            'Biaya Kesehatan' => '6',
            'Pengeluaran Hiburan' => '7',
            'Pengeluaran Donasi' => '8',
            'Pengeluaran Investasi' => '9',
            'Pengeluaran Lainnya' => '10',
        ];
        $pengeluaran->kategori_id = $kategoriMap[$pengeluaran->kategori] ?? '';
        $pengeluaran->jumlah_formatted = number_format($pengeluaran->jumlah, 0, ',', '.');
        return view('transaksi_tabel.pengeluaran.ubah', compact('pengeluaran'));
    }

    public function updatePengeluaran(Request $request, $id)
    {
        $pengeluaran = Pengeluaran::where('user_id', Auth::id())->findOrFail($id);

        Log::info('Received data for updatePengeluaran', [
            'request_data' => $request->all(),
            'tanggal_raw' => $request->tanggal,
        ]);

        $validated = $request->validate([
            'tanggal' => [
                'required',
                'regex:/^\d{2}-\d{2}-\d{4}$/',
                function ($attribute, $value, $fail) {
                    $parts = explode('-', $value);
                    if (count($parts) !== 3) {
                        $fail('Format tanggal harus DD-MM-YYYY (contoh: 31-12-2024).');
                        return;
                    }
                    $day = (int) $parts[0];
                    $month = (int) $parts[1];
                    $year = (int) $parts[2];
                    if (!checkdate($month, $day, $year)) {
                        $fail('Tanggal tidak valid (contoh: 31-12-2024).');
                    }
                },
            ],
            'kategori' => 'required',
            'deskripsi' => 'required|string',
            'jumlah' => 'required|numeric|min:1',
            'bukti_transaksi' => 'nullable|image|mimes:jpeg,png|max:1024',
        ]);

        $kategoriMap = [
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

        $kategoriText = $kategoriMap[$request->kategori] ?? 'Unknown';
        $buktiPath = $pengeluaran->bukti_transaksi;

        if ($request->hasFile('bukti_transaksi')) {
            try {
                if ($pengeluaran->bukti_transaksi && Storage::disk('public')->exists($pengeluaran->bukti_transaksi)) {
                    Storage::disk('public')->delete($pengeluaran->bukti_transaksi);
                    Log::info('Old file deleted during update', ['path' => $pengeluaran->bukti_transaksi]);
                }
                $buktiPath = $request->file('bukti_transaksi')->store('bukti_transaksi', 'public');
                Log::info('New file uploaded successfully', ['path' => $buktiPath]);
            } catch (\Exception $e) {
                Log::error('Failed to upload file during update', [
                    'error' => $e->getMessage(),
                    'file' => $request->file('bukti_transaksi')->getClientOriginalName(),
                ]);
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Gagal mengunggah file: ' . $e->getMessage(),
                    ], 500);
                }
                return redirect()->back()->withErrors(['bukti_transaksi' => 'Gagal mengunggah file: ' . $e->getMessage()]);
            }
        }

        try {
            $tanggal = Carbon::createFromFormat('d-m-Y', $request->tanggal)->format('Y-m-d');
            Log::info('Tanggal parsed successfully for updatePengeluaran', ['tanggal' => $tanggal]);
        } catch (\Exception $e) {
            Log::error('Failed to parse date during updatePengeluaran', [
                'error' => $e->getMessage(),
                'tanggal' => $request->tanggal,
            ]);
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tanggal tidak valid atau format tidak sesuai (harus DD-MM-YYYY).',
                ], 422);
            }
            return redirect()->back()->withErrors(['tanggal' => 'Tanggal tidak valid atau format tidak sesuai (harus DD-MM-YYYY).']);
        }

        $pengeluaran->update([
            'tanggal' => $tanggal,
            'kategori' => $kategoriText,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'bukti_transaksi' => $buktiPath,
        ]);

        $updatedPengeluaranData = Pengeluaran::where('user_id', Auth::id())->get()->map(function ($item) {
            $item->tanggal = Carbon::parse($item->tanggal)->format('d-m-Y');
            $kategoriMap = [
                'Belanja Harian' => '1',
                'Tagihan Listrik' => '2',
                'Tagihan Air' => '3',
                'Biaya Transportasi' => '4',
                'Biaya Pendidikan' => '5',
                'Biaya Kesehatan' => '6',
                'Pengeluaran Hiburan' => '7',
                'Pengeluaran Donasi' => '8',
                'Pengeluaran Investasi' => '9',
                'Pengeluaran Lainnya' => '10',
            ];
            $item->kategori_id = $kategoriMap[$item->kategori] ?? '';
            $item->jumlah_formatted = number_format($item->jumlah, 0, ',', '.');
            return $item;
        })->toArray();
        session(['pengeluaranData_' . Auth::id() => $updatedPengeluaranData]);

        $responseData = [
            'id' => $pengeluaran->id,
            'tanggal' => Carbon::parse($pengeluaran->tanggal)->format('d-m-Y'),
            'kategori_id' => $request->kategori,
            'kategori' => $kategoriText,
            'deskripsi' => $pengeluaran->deskripsi,
            'jumlah' => $pengeluaran->jumlah,
            'jumlah_formatted' => number_format($pengeluaran->jumlah, 0, ',', '.'),
            'bukti_transaksi' => $pengeluaran->bukti_transaksi,
        ];

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Sukses! Data pengeluaran berhasil diperbarui.',
                'data' => $responseData,
            ], 200);
        }

        return redirect()->route('pengeluaran.tabel')->with('success', 'Data pengeluaran berhasil diperbarui.')->with('updated_data', $responseData);
    }

    public function pemasukanStore(Request $request)
    {
        Log::info('Received data for pemasukanStore', [
            'request_data' => $request->all(),
            'tanggal_raw' => $request->tanggal,
        ]);

        $validated = $request->validate([
            'tanggal' => [
                'required',
                'regex:/^\d{2}-\d{2}-\d{4}$/',
                function ($attribute, $value, $fail) {
                    $parts = explode('-', $value);
                    if (count($parts) !== 3) {
                        $fail('Format tanggal harus DD-MM-YYYY (contoh: 31-12-2024).');
                        return;
                    }
                    $day = (int) $parts[0];
                    $month = (int) $parts[1];
                    $year = (int) $parts[2];
                    if (!checkdate($month, $day, $year)) {
                        $fail('Tanggal tidak valid (contoh: 31-12-2024).');
                    }
                },
            ],
            'kategori' => 'required',
            'deskripsi' => 'required|string',
            'jumlah' => 'required|numeric|min:1',
            'bukti_transaksi' => 'nullable|image|mimes:jpeg,png|max:1024',
        ]);

        $kategoriMap = [
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

        $kategoriText = $kategoriMap[$request->kategori] ?? 'Unknown';
        $buktiPath = null;

        if ($request->hasFile('bukti_transaksi')) {
            try {
                $buktiPath = $request->file('bukti_transaksi')->store('bukti_transaksi', 'public');
                Log::info('File uploaded successfully', ['path' => $buktiPath]);
            } catch (\Exception $e) {
                Log::error('Failed to upload file', [
                    'error' => $e->getMessage(),
                    'file' => $request->file('bukti_transaksi')->getClientOriginalName(),
                ]);
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Gagal mengunggah file: ' . $e->getMessage(),
                    ], 500);
                }
                return redirect()->back()->withErrors(['bukti_transaksi' => 'Gagal mengunggah file: ' . $e->getMessage()]);
            }
        }

        try {
            $tanggal = Carbon::createFromFormat('d-m-Y', $request->tanggal)->format('Y-m-d');
            Log::info('Tanggal parsed successfully for pemasukanStore', ['tanggal' => $tanggal]);
        } catch (\Exception $e) {
            Log::error('Failed to parse date in pemasukanStore', [
                'error' => $e->getMessage(),
                'tanggal' => $request->tanggal,
            ]);
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tanggal tidak valid atau format tidak sesuai (harus DD-MM-YYYY).',
                ], 422);
            }
            return redirect()->back()->withErrors(['tanggal' => 'Tanggal tidak valid atau format tidak sesuai (harus DD-MM-YYYY).']);
        }

        $pemasukan = Pemasukan::create([
            'user_id' => Auth::id(),
            'tanggal' => $tanggal,
            'kategori' => $kategoriText,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'bukti_transaksi' => $buktiPath,
        ]);

        $updatedPemasukanData = Pemasukan::where('user_id', Auth::id())->get()->map(function ($item) {
            $item->tanggal = Carbon::parse($item->tanggal)->format('d-m-Y');
            $kategoriMap = [
                'Gaji' => '1',
                'Hadiah' => '2',
                'Jasa Web Development' => '3',
                'Jasa Web Desain' => '4',
                'Jasa Digital Marketing' => '5',
                'Jasa Kursus dan Pelatihan' => '6',
                'Penjualan E-Book' => '7',
                'Penjualan Video Tutorial' => '8',
                'Penjualan Sourcecode' => '9',
                'Pemasukan Lainnya' => '10',
            ];
            $item->kategori_id = $kategoriMap[$item->kategori] ?? '';
            $item->jumlah_formatted = number_format($item->jumlah, 0, ',', '.');
            return $item;
        })->toArray();
        session(['pemasukanData_' . Auth::id() => $updatedPemasukanData]);

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data pemasukan berhasil disimpan.',
                'data' => [
                    'id' => $pemasukan->id,
                    'tanggal' => Carbon::parse($pemasukan->tanggal)->format('d-m-Y'),
                    'kategori_id' => $request->kategori,
                    'kategori' => $kategoriText,
                    'deskripsi' => $pemasukan->deskripsi,
                    'jumlah' => $pemasukan->jumlah,
                    'jumlah_formatted' => number_format($pemasukan->jumlah, 0, ',', '.'),
                    'bukti_transaksi' => $pemasukan->bukti_transaksi,
                ],
            ], 201);
        }

        return redirect()->route('pemasukan.tabel')->with('success', 'Data pemasukan berhasil disimpan.');
    }

    public function pengeluaranStore(Request $request)
    {
        if (!Auth::check()) {
            Log::warning('Unauthenticated attempt to store pengeluaran');
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated.',
                ], 401);
            }
            return redirect()->route('login')->with('error', 'Please log in to continue.');
        }

        Log::info('Received data for pengeluaranStore', [
            'request_data' => $request->all(),
            'tanggal_raw' => $request->tanggal,
        ]);

        $validated = $request->validate([
            'tanggal' => [
                'required',
                'regex:/^\d{2}-\d{2}-\d{4}$/',
                function ($attribute, $value, $fail) {
                    $parts = explode('-', $value);
                    if (count($parts) !== 3) {
                        $fail('Format tanggal harus DD-MM-YYYY (contoh: 31-12-2024).');
                        return;
                    }
                    $day = (int) $parts[0];
                    $month = (int) $parts[1];
                    $year = (int) $parts[2];
                    if (!checkdate($month, $day, $year)) {
                        $fail('Tanggal tidak valid (contoh: 31-12-2024).');
                    }
                },
            ],
            'kategori' => 'required',
            'deskripsi' => 'required|string',
            'jumlah' => 'required|numeric|min:1',
            'bukti_transaksi' => 'nullable|image|mimes:jpeg,png|max:1024',
        ]);

        $kategoriMap = [
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

        $kategoriText = $kategoriMap[$request->kategori] ?? 'Unknown';
        $buktiPath = null;

        if ($request->hasFile('bukti_transaksi')) {
            try {
                $buktiPath = $request->file('bukti_transaksi')->store('bukti_transaksi', 'public');
                Log::info('File uploaded successfully', ['path' => $buktiPath]);
            } catch (\Exception $e) {
                Log::error('Failed to upload file', [
                    'error' => $e->getMessage(),
                    'file' => $request->file('bukti_transaksi')->getClientOriginalName(),
                ]);
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Gagal mengunggah file: ' . $e->getMessage(),
                    ], 500);
                }
                return redirect()->back()->withErrors(['bukti_transaksi' => 'Gagal mengunggah file: ' . $e->getMessage()]);
            }
        }

        try {
            $tanggal = Carbon::createFromFormat('d-m-Y', $request->tanggal)->format('Y-m-d');
            Log::info('Tanggal parsed successfully for pengeluaranStore', ['tanggal' => $tanggal]);
        } catch (\Exception $e) {
            Log::error('Failed to parse date in pengeluaranStore', [
                'error' => $e->getMessage(),
                'tanggal' => $request->tanggal,
            ]);
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tanggal tidak valid atau format tidak sesuai (harus DD-MM-YYYY).',
                ], 422);
            }
            return redirect()->back()->withErrors(['tanggal' => 'Tanggal tidak valid atau format tidak sesuai (harus DD-MM-YYYY).']);
        }

        Log::info('Data being inserted into pengeluaran', [
            'user_id' => Auth::id(),
            'tanggal' => $tanggal,
            'kategori' => $kategoriText,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'bukti_transaksi' => $buktiPath,
        ]);

        $pengeluaran = new Pengeluaran();
        $pengeluaran->user_id = Auth::id();
        $pengeluaran->tanggal = $tanggal;
        $pengeluaran->kategori = $kategoriText;
        $pengeluaran->deskripsi = $request->deskripsi;
        $pengeluaran->jumlah = $request->jumlah;
        $pengeluaran->bukti_transaksi = $buktiPath;
        $pengeluaran->save();

        $updatedPengeluaranData = Pengeluaran::where('user_id', Auth::id())->get()->map(function ($item) {
            $item->tanggal = Carbon::parse($item->tanggal)->format('d-m-Y');
            $kategoriMap = [
                'Belanja Harian' => '1',
                'Tagihan Listrik' => '2',
                'Tagihan Air' => '3',
                'Biaya Transportasi' => '4',
                'Biaya Pendidikan' => '5',
                'Biaya Kesehatan' => '6',
                'Pengeluaran Hiburan' => '7',
                'Pengeluaran Donasi' => '8',
                'Pengeluaran Investasi' => '9',
                'Pengeluaran Lainnya' => '10',
            ];
            $item->kategori_id = $kategoriMap[$item->kategori] ?? '';
            $item->jumlah_formatted = number_format($item->jumlah, 0, ',', '.');
            return $item;
        })->toArray();
        session(['pengeluaranData_' . Auth::id() => $updatedPengeluaranData]);

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data pengeluaran berhasil disimpan.',
                'data' => [
                    'id' => $pengeluaran->id,
                    'tanggal' => Carbon::parse($pengeluaran->tanggal)->format('d-m-Y'),
                    'kategori_id' => $request->kategori,
                    'kategori' => $kategoriText,
                    'deskripsi' => $pengeluaran->deskripsi,
                    'jumlah' => $pengeluaran->jumlah,
                    'jumlah_formatted' => number_format($pengeluaran->jumlah, 0, ',', '.'),
                    'bukti_transaksi' => $pengeluaran->bukti_transaksi,
                ],
            ], 201);
        }

        return redirect()->route('pengeluaran.tabel')->with('success', 'Data pengeluaran berhasil disimpan.');
    }

    public function deletePemasukan(Request $request, $id)
    {
        Log::info('Attempting to delete pemasukan', [
            'id' => $id,
            'user_id' => Auth::id(),
            'headers' => $request->headers->all(),
        ]);

        try {
            $pemasukan = Pemasukan::where('user_id', Auth::id())->findOrFail($id);

            if ($pemasukan->bukti_transaksi && Storage::disk('public')->exists($pemasukan->bukti_transaksi)) {
                Storage::disk('public')->delete($pemasukan->bukti_transaksi);
                Log::info('File deleted during deletePemasukan', ['path' => $pemasukan->bukti_transaksi]);
            }

            $pemasukan->delete();

            $updatedPemasukanData = Pemasukan::where('user_id', Auth::id())->get()->map(function ($item) {
                $item->tanggal = Carbon::parse($item->tanggal)->format('d-m-Y');
                $kategoriMap = [
                    'Gaji' => '1',
                    'Hadiah' => '2',
                    'Jasa Web Development' => '3',
                    'Jasa Web Desain' => '4',
                    'Jasa Digital Marketing' => '5',
                    'Jasa Kursus dan Pelatihan' => '6',
                    'Penjualan E-Book' => '7',
                    'Penjualan Video Tutorial' => '8',
                    'Penjualan Sourcecode' => '9',
                    'Pemasukan Lainnya' => '10',
                ];
                $item->kategori_id = $kategoriMap[$item->kategori] ?? '';
                $item->jumlah_formatted = number_format($item->jumlah, 0, ',', '.');
                return $item;
            })->toArray();
            session(['pemasukanData_' . Auth::id() => $updatedPemasukanData]);

            return response()->json([
                'success' => true,
                'message' => 'Data pemasukan berhasil dihapus.',
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Pemasukan not found for deletion', ['id' => $id, 'user_id' => Auth::id()]);
            return response()->json([
                'success' => false,
                'message' => 'Data pemasukan tidak ditemukan atau Anda tidak memiliki akses.',
            ], 404);
        }
    }

    public function deletePengeluaran(Request $request, $id)
    {
        Log::info('Attempting to delete pengeluaran', [
            'id' => $id,
            'user_id' => Auth::id(),
            'headers' => $request->headers->all(),
        ]);

        try {
            $pengeluaran = Pengeluaran::where('user_id', Auth::id())->findOrFail($id);

            if ($pengeluaran->bukti_transaksi && Storage::disk('public')->exists($pengeluaran->bukti_transaksi)) {
                Storage::disk('public')->delete($pengeluaran->bukti_transaksi);
                Log::info('File deleted during deletePengeluaran', ['path' => $pengeluaran->bukti_transaksi]);
            }

            $pengeluaran->delete();

            $updatedPengeluaranData = Pengeluaran::where('user_id', Auth::id())->get()->map(function ($item) {
                $item->tanggal = Carbon::parse($item->tanggal)->format('d-m-Y');
                $kategoriMap = [
                    'Belanja Harian' => '1',
                    'Tagihan Listrik' => '2',
                    'Tagihan Air' => '3',
                    'Biaya Transportasi' => '4',
                    'Biaya Pendidikan' => '5',
                    'Biaya Kesehatan' => '6',
                    'Pengeluaran Hiburan' => '7',
                    'Pengeluaran Donasi' => '8',
                    'Pengeluaran Investasi' => '9',
                    'Pengeluaran Lainnya' => '10',
                ];
                $item->kategori_id = $kategoriMap[$item->kategori] ?? '';
                $item->jumlah_formatted = number_format($item->jumlah, 0, ',', '.');
                return $item;
            })->toArray();
            session(['pengeluaranData_' . Auth::id() => $updatedPengeluaranData]);

            return response()->json([
                'success' => true,
                'message' => 'Data pengeluaran berhasil dihapus.',
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Pengeluaran not found for deletion', ['id' => $id, 'user_id' => Auth::id()]);
            return response()->json([
                'success' => false,
                'message' => 'Data pengeluaran tidak ditemukan atau Anda tidak memiliki akses.',
            ], 404);
        }
    }

}
