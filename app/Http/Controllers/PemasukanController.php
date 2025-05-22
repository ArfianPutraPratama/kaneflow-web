<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use Illuminate\Support\Facades\Storage;

class PemasukanController extends Controller
{
    // Display the form
    public function create()
    {
        return view('pemasukan'); // Loads pemasukan.blade.php
    }

    // Store the form data
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'tanggal' => 'required|date_format:d-m-Y',
            'kategori' => 'required|string',
            'deskripsi' => 'required|string',
            'jumlah' => 'required|numeric|min:0',
            'bukti_transaksi' => 'nullable|image|mimes:jpg,jpeg,png|max:1024', // Max 1MB
        ]);

        // Handle file upload
        $filePath = null;
        if ($request->hasFile('bukti_transaksi')) {
            $filePath = $request->file('bukti_transaksi')->store('bukti_transaksi', 'public');
        }

        // Create new Pemasukan record
        Pemasukan::create([
            'tanggal' => \Carbon\Carbon::createFromFormat('d-m-Y', $request->tanggal)->format('Y-m-d'),
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'bukti_transaksi' => $filePath,
        ]);

        // Redirect to the table view with a success message
        return redirect()->route('pemasukan.index')->with('success', 'Data pemasukan berhasil disimpan.');
    }

    // Display the table
    public function index()
    {
        $pemasukan = Pemasukan::all(); // Fetch all records
        return view('pemasukan-tabel', compact('pemasukan')); // Loads pemasukan-tabel.blade.php
    }
}
