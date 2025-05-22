<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\Log;

class ReferensiController extends Controller
{
    public function kategori()
    {
        // Ambil kategori unik dari tabel pemasukans
        $kategoriPemasukan = Pemasukan::select('kategori')
            ->distinct()
            ->pluck('kategori')
            ->toArray();

        // Ambil kategori unik dari tabel pengeluarans
        $kategoriPengeluaran = Pengeluaran::select('kategori')
            ->distinct()
            ->pluck('kategori')
            ->toArray();

        // Gabungkan kategori dari kedua tabel
        $allKategori = array_unique(array_merge($kategoriPemasukan, $kategoriPengeluaran));

        // Pastikan semua kategori ada di tabel kategoris
        foreach ($allKategori as $kategoriNama) {
            $exists = Kategori::where('nama', $kategoriNama)->exists();
            if (!$exists) {
                $tipe = in_array($kategoriNama, $kategoriPemasukan) ? 'Pemasukan' : 'Pengeluaran';
                Kategori::create([
                    'nama' => $kategoriNama,
                    'tipe' => $tipe,
                ]);
            }
        }

        // Ambil semua kategori dari tabel kategoris
        $kategoriData = Kategori::all();
        return view('referensi.kategori', compact('kategoriData'));
    }

    public function entridata($id = null)
    {
        $category = $id ? Kategori::findOrFail($id) : null;
        return view('referensi.entridata', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'tipe' => 'required|in:Pemasukan,Pengeluaran',
        ]);

        Kategori::create([
            'nama' => $request->nama_kategori,
            'tipe' => $request->tipe,
        ]);

        return redirect()->route('kategori')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'tipe' => 'required|in:Pemasukan,Pengeluaran',
        ]);

        $category = Kategori::findOrFail($id);
        $category->update([
            'nama' => $request->nama_kategori,
            'tipe' => $request->tipe,
        ]);

        return redirect()->route('kategori')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function kategoriDelete($id)
    {
        try {
            if (!is_numeric($id) || $id <= 0) {
                Log::error('Invalid ID provided for kategori deletion', ['id' => $id]);
                return response()->json([
                    'success' => false,
                    'message' => 'ID tidak valid.',
                ], 400);
            }

            $kategori = Kategori::findOrFail($id);

            // Check if the category is used in Pemasukan or Pengeluaran
            $usedInPemasukan = Pemasukan::where('kategori', $kategori->nama)->exists();
            $usedInPengeluaran = Pengeluaran::where('kategori', $kategori->nama)->exists();

            if ($usedInPemasukan || $usedInPengeluaran) {
                Log::warning('Attempted to delete kategori that is still in use', ['id' => $id]);
                return response()->json([
                    'success' => false,
                    'message' => 'Kategori ini masih digunakan di data Pemasukan atau Pengeluaran.',
                ], 400);
            }

            $kategori->delete();

            Log::info('Kategori deleted successfully', ['id' => $id]);

            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil dihapus.',
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to delete kategori', [
                'error' => $e->getMessage(),
                'id' => $id,
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus kategori: ' . $e->getMessage(),
            ], 500);
        }
    }
}
