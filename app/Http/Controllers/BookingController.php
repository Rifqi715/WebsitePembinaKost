<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Support\Facades\Auth; // Untuk mengambil data user yang sedang login

class BookingController extends Controller
{
    // Fungsi 1: Menampilkan Halaman Formulir Booking
    public function create($id)
    {
        // Cari data kamar berdasarkan ID yang diklik
        $kamar = Room::findOrFail($id); 
        
        // Tampilkan halaman form (nanti kita buat file-nya) dan bawa data kamarnya
        return view('booking', compact('kamar'));
    }

    // Fungsi 2: Menyimpan Data Formulir ke Database
    public function store(Request $request, $id)
    {
        // Pastikan user ngisi tanggal dengan benar (tidak boleh tanggal kemarin)
        $request->validate([
            'tanggal_masuk' => 'required|date|after_or_equal:today',
        ]);

        // Simpan data ke tabel bookings
        Booking::create([
            'user_id' => Auth::id(), // Otomatis mengambil ID user yang lagi login
            'room_id' => $id,        // Mengambil ID kamar
            'tanggal_masuk' => $request->tanggal_masuk,
            'status' => 'pending',   // Status awal selalu pending
        ]);
        // Otomatis ubah status kamar jadi 'terisi' biar nggak di-booking orang lain
        $kamarUbahStatus = Room::findOrFail($id);
        $kamarUbahStatus->update([
            'status' => 'terisi'
        ]);

        // Setelah sukses, lempar user ke halaman dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Booking berhasil! Menunggu persetujuan Admin.');
    }
}