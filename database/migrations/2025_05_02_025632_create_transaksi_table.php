<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal'); // Date of the transaction
            $table->decimal('jumlah', 15, 2); // Amount of the transaction
            $table->integer('kategori')->nullable(); // Category ID (optional, based on your form)
            $table->string('deskripsi')->nullable(); // Description of the transaction (optional)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
