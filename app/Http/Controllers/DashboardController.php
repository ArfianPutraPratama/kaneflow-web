<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $currentMonth = Carbon::now()->format('F Y');
        $userId = Auth::id();

        $saldoAwal = $this->calculateSaldoAwal($userId);

        $totalPemasukan = Pemasukan::where('user_id', $userId)
            ->whereMonth('tanggal', Carbon::now()->month)
            ->whereYear('tanggal', Carbon::now()->year)
            ->sum('jumlah');

        $totalPengeluaran = Pengeluaran::where('user_id', $userId)
            ->whereMonth('tanggal', Carbon::now()->month)
            ->whereYear('tanggal', Carbon::now()->year)
            ->sum('jumlah');

        $topPemasukan = Pemasukan::where('user_id', $userId)
            ->whereMonth('tanggal', Carbon::now()->month)
            ->whereYear('tanggal', Carbon::now()->year)
            ->orderBy('jumlah', 'desc')
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'kategori' => $item->kategori,
                    'jumlah' => $item->jumlah,
                ];
            })->toArray();

        $topPengeluaran = Pengeluaran::where('user_id', $userId)
            ->whereMonth('tanggal', Carbon::now()->month)
            ->whereYear('tanggal', Carbon::now()->year)
            ->orderBy('jumlah', 'desc')
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'kategori' => $item->kategori,
                    'jumlah' => $item->jumlah,
                ];
            })->toArray();

        return view('Dashboard', compact('saldoAwal', 'totalPemasukan', 'totalPengeluaran', 'currentMonth', 'topPemasukan', 'topPengeluaran'));
    }

    private function calculateSaldoAwal($userId)
    {
        $earliestPemasukanDate = Pemasukan::where('user_id', $userId)->orderBy('tanggal')->value('tanggal');
        $earliestPengeluaranDate = Pengeluaran::where('user_id', $userId)->orderBy('tanggal')->value('tanggal');

        $earliestDateCandidates = array_filter([$earliestPemasukanDate, $earliestPengeluaranDate]);
        if (empty($earliestDateCandidates)) {
            return 0;
        }

        $earliestDate = min($earliestDateCandidates);
        $currentMonthStart = Carbon::now()->startOfMonth();

        if ($earliestDate >= $currentMonthStart) {
            return 0;
        }

        $saldoAwal = 0;
        $currentDate = Carbon::parse($earliestDate)->startOfMonth();

        while ($currentDate < $currentMonthStart) {
            $monthStart = $currentDate;
            $monthEnd = $currentDate->copy()->endOfMonth();

            $monthPemasukan = Pemasukan::where('user_id', $userId)
                ->whereBetween('tanggal', [$monthStart, $monthEnd])
                ->sum('jumlah');

            $monthPengeluaran = Pengeluaran::where('user_id', $userId)
                ->whereBetween('tanggal', [$monthStart, $monthEnd])
                ->sum('jumlah');

            $saldoAkhir = $saldoAwal + $monthPemasukan - $monthPengeluaran;

            $saldoAwal = $saldoAkhir;

            $currentDate->addMonth();
        }

        return $saldoAwal;
    }

    public function apiIndex(Request $request)
    {
        $currentMonth = Carbon::now()->format('F Y');
        $userId = Auth::id();

        $saldoAwal = $this->calculateSaldoAwal($userId);

        $totalPemasukan = Pemasukan::where('user_id', $userId)
            ->whereMonth('tanggal', Carbon::now()->month)
            ->whereYear('tanggal', Carbon::now()->year)
            ->sum('jumlah');

        $totalPengeluaran = Pengeluaran::where('user_id', $userId)
            ->whereMonth('tanggal', Carbon::now()->month)
            ->whereYear('tanggal', Carbon::now()->year)
            ->sum('jumlah');

        $topPemasukan = Pemasukan::where('user_id', $userId)
            ->whereMonth('tanggal', Carbon::now()->month)
            ->whereYear('tanggal', Carbon::now()->year)
            ->orderBy('jumlah', 'desc')
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'kategori' => $item->kategori,
                    'jumlah' => $item->jumlah,
                ];
            })->toArray();

        $topPengeluaran = Pengeluaran::where('user_id', $userId)
            ->whereMonth('tanggal', Carbon::now()->month)
            ->whereYear('tanggal', Carbon::now()->year)
            ->orderBy('jumlah', 'desc')
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'kategori' => $item->kategori,
                    'jumlah' => $item->jumlah,
                ];
            })->toArray();

        return response()->json([
            'status' => 'success',
            'data' => [
                'totalPemasukan' => $totalPemasukan,
                'totalPengeluaran' => $totalPengeluaran,
                'saldoAwal' => $saldoAwal,
                'saldoAkhir' => $saldoAwal + $totalPemasukan - $totalPengeluaran,
                'currentMonth' => $currentMonth,
                'topPemasukan' => $topPemasukan,
                'topPengeluaran' => $topPengeluaran,
            ],
        ], 200);
    }
}
