<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasis';

    protected $fillable = [
        'tamu_id',
        'kamar_id',
        'check_in',
        'check_out',
        'total_bayar',
        'metode_pembayaran',
        'status_pembayaran',
        'status',
    ];

    public function tamu()
    {
        return $this->belongsTo(Tamu::class);
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    public function pembayaran()
{
    return $this->hasOne(Pembayaran::class);
}
}
