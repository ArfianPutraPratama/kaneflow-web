<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluaran';

    protected $dates = ['tanggal'];
    protected $fillable = [
        'tanggal',
        'kategori',
        'deskripsi',
        'jumlah',
        'bukti_transaksi',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
