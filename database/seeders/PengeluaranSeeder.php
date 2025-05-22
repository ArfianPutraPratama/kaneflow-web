<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengeluaranSeeder extends Seeder
{
    public function run()
    {
        DB::table('transaksi')->insert([
            [
                'tanggal' => '2023-04-01',
                'jumlah' => 10360000,
                'kategori' => 1, // Belanja Harian
                'deskripsi' => 'Belanja Harian April',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => '2023-05-01',
                'jumlah' => 12850000,
                'kategori' => 1, // Belanja Harian
                'deskripsi' => 'Belanja Harian Mei',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => '2023-06-01',
                'jumlah' => 18950000,
                'kategori' => 1, // Belanja Harian
                'deskripsi' => 'Belanja Harian Juni',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
