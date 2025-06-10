<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);

        $currentMonth = Carbon::createFromDate($year, $month, 1)->format('F Y');
        $userId = Auth::id();

        $saldoAwal = $this->calculateSaldoAwal($userId, $month, $year);

        $totalPemasukan = Pemasukan::where('user_id', $userId)
            ->whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
            ->sum('jumlah');

        $totalPengeluaran = Pengeluaran::where('user_id', $userId)
            ->whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
            ->sum('jumlah');

        $topPemasukan = Pemasukan::where('user_id', $userId)
            ->whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
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
            ->whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
            ->orderBy('jumlah', 'desc')
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'kategori' => $item->kategori,
                    'jumlah' => $item->jumlah,
                ];
            })->toArray();

        return view('Dashboard', compact(
            'saldoAwal',
            'totalPemasukan',
            'totalPengeluaran',
            'currentMonth',
            'topPemasukan',
            'topPengeluaran',
            'month',
            'year'
        ));
    }

    private function calculateSaldoAwal($userId, $currentMonth, $currentYear)
    {
        $currentDate = Carbon::createFromDate($currentYear, $currentMonth, 1);
        $currentMonthStart = $currentDate->copy()->startOfMonth();

        $earliestPemasukanDate = Pemasukan::where('user_id', $userId)
            ->orderBy('tanggal')
            ->value('tanggal');

        $earliestPengeluaranDate = Pengeluaran::where('user_id', $userId)
            ->orderBy('tanggal')
            ->value('tanggal');

        $earliestDateCandidates = array_filter([$earliestPemasukanDate, $earliestPengeluaranDate]);
        if (empty($earliestDateCandidates)) {
            return 0;
        }

        $earliestDate = min($earliestDateCandidates);
        $earliestDate = Carbon::parse($earliestDate)->startOfMonth();

        if ($earliestDate >= $currentMonthStart) {
            return 0;
        }

        $saldoAwal = 0;
        $calculationDate = $earliestDate->copy();

        while ($calculationDate < $currentMonthStart) {
            $monthStart = $calculationDate;
            $monthEnd = $calculationDate->copy()->endOfMonth();

            $monthPemasukan = Pemasukan::where('user_id', $userId)
                ->whereBetween('tanggal', [$monthStart, $monthEnd])
                ->sum('jumlah');

            $monthPengeluaran = Pengeluaran::where('user_id', $userId)
                ->whereBetween('tanggal', [$monthStart, $monthEnd])
                ->sum('jumlah');

            $saldoAwal += ($monthPemasukan - $monthPengeluaran);

            $calculationDate->addMonth();
        }

        return $saldoAwal;
    }

    public function apiIndex(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);

        $currentMonth = Carbon::createFromDate($year, $month, 1)->format('F Y');
        $userId = Auth::id();

        $saldoAwal = $this->calculateSaldoAwal($userId, $month, $year);

        $totalPemasukan = Pemasukan::where('user_id', $userId)
            ->whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
            ->sum('jumlah');

        $totalPengeluaran = Pengeluaran::where('user_id', $userId)
            ->whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
            ->sum('jumlah');

        $topPemasukan = Pemasukan::where('user_id', $userId)
            ->whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
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
            ->whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
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
                'month' => (int) $month,
                'year' => (int) $year,
            ],
        ], 200);
    }
}
