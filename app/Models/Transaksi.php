<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';

    protected $fillable = [
        'user_id',
        'nama_transaksi',
        'jumlah',
        'tipe',
        'tanggal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
