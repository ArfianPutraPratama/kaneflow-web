<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pemasukan extends Model
{
    use HasFactory;

    protected $table = 'pemasukan';

    protected $dates = ['tanggal'];

    protected $fillable = [
        'user_id',
        'tanggal',
        'kategori',
        'deskripsi',
        'jumlah',
        'bukti_transaksi',
    ];

    /**
     * Relasi ke User (Many to One)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
