<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemasukanTable extends Migration
{
    public function up()
    {
        Schema::create('pemasukan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal'); // To store the transaction date
            $table->string('kategori'); // To store the category (e.g., Gaji, Hadiah)
            $table->text('deskripsi'); // To store the transaction description
            $table->decimal('jumlah', 15, 2); // To store the amount (e.g., 350000.00)
            $table->string('bukti_transaksi')->nullable(); // To store the file path of the uploaded proof
            $table->timestamps(); // Created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('pemasukan');
    }

}
