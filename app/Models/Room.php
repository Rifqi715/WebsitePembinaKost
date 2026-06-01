<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    // Mengizinkan kolom ini diisi data dari formulir
    protected $fillable = ['nomor_kamar', 'fasilitas', 'harga', 'status'];
}
