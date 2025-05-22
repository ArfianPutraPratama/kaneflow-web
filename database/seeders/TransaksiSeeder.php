<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    public function run()
    {
        DB::table('transaksi')->insert([
            [
                'tanggal' => '2023-04-01',
                'jumlah' => 10360000,
                'kategori' => 1,
                'deskripsi' => 'Gaji April',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => '2023-05-01',
                'jumlah' => 12850000,
                'kategori' => 1,
                'deskripsi' => 'Gaji Mei',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => '2023-06-01',
                'jumlah' => 18950000,
                'kategori' => 1,
                'deskripsi' => 'Gaji Juni',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
