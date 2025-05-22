<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategorisTable extends Migration
{
    public function up()
    {
        Schema::create('kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('tipe', ['Pemasukan', 'Pengeluaran']);
            $table->timestamps();
        });

        // Seed initial data
        $kategoriPemasukan = [
            'Gaji',
            'Hadiah',
            'Jasa Web Development',
            'Jasa Web Desain',
            'Jasa Digital Marketing',
            'Jasa Kursus dan Pelatihan',
            'Penjualan E-Book',
            'Penjualan Video Tutorial',
            'Penjualan Sourcecode',
            'Pemasukan Lainnya'
        ];

        $kategoriPengeluaran = [
            'Belanja Harian',
            'Tagihan Listrik',
            'Tagihan Air',
            'Biaya Transportasi',
            'Biaya Pendidikan',
            'Biaya Kesehatan',
            'Pengeluaran Hiburan',
            'Pengeluaran Donasi',
            'Pengeluaran Investasi',
            'Pengeluaran Lainnya'
        ];

        foreach ($kategoriPemasukan as $nama) {
            \App\Models\Kategori::create([
                'nama' => $nama,
                'tipe' => 'Pemasukan',
            ]);
        }

        foreach ($kategoriPengeluaran as $nama) {
            \App\Models\Kategori::create([
                'nama' => $nama,
                'tipe' => 'Pengeluaran',
            ]);
        }
    }

    public function down()
    {
        Schema::dropIfExists('kategoris');
    }
}
