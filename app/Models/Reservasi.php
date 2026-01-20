<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tamu_id',
        'kamar_id',
        'check_in',
        'check_out',
        'total_harga',
        'metode_pembayaran',
        'status_pembayaran'
    ];

    // RELASI KAMAR
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    // RELASI TAMU
    public function tamu()
    {
        return $this->belongsTo(Tamu::class);
    }

    // ACCESSOR TOTAL HARGA (AUTO HITUNG)
    public function getTotalHargaAttribute($value)
    {
        if (!empty($value) && $value > 0) {
            return $value;
        }

        if (!$this->kamar) {
            return 0;
        }

        $checkIn  = Carbon::parse($this->check_in);
        $checkOut = Carbon::parse($this->check_out);

        $malam = max(1, $checkIn->diffInDays($checkOut));

        return $malam * $this->kamar->harga;
    }
}
