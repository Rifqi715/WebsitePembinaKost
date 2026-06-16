<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'user_id',
        'jumlah_bayar',
        'bukti_transfer',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
