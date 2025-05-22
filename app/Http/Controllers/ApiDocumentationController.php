<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;

class ApiDocumentationController extends Controller
{
    public function index()
    {
        // Logika untuk mengambil data pemasukan terbanyak
        $topPemasukan = Pemasukan::select('kategori', 'jumlah')
            ->orderBy('jumlah', 'desc')
            ->take(1)
            ->get()
            ->toArray();

        // Logika untuk mengambil data pengeluaran terbanyak
        $topPengeluaran = Pengeluaran::select('kategori', 'jumlah')
            ->orderBy('jumlah', 'desc')
            ->take(1)
            ->get()
            ->toArray();

        return view('dokumentasi.api', compact('topPemasukan', 'topPengeluaran'));
    }
}
