<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // 1. Kasih tau Laravel kolom mana aja yang boleh diisi data dari form
    protected $fillable = [
        'user_id',
        'room_id',
        'tanggal_masuk',
        'status',
    ];

    // 2. Bikin jembatan relasi ke tabel User (Siapa yang booking)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 3. Bikin jembatan relasi ke tabel Room (Kamar mana yang dibooking)
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}