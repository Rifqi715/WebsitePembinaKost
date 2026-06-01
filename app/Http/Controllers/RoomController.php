<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room; // Ini wajib dipanggil biar controllernya kenal sama tabel kamar

class RoomController extends Controller
{
    // Fungsi untuk menampilkan daftar kamar
    public function index()
    {
        $kamar = Room::where('status', 'tersedia')->get();
        return view('kamar', compact('kamar')); // Mengirim datanya ke file tampilan bernama 'kamar.blade.php'
    }
    // Fungsi untuk menampilkan halaman formulir tambah kamar
    public function create()
    {
        return view('tambah-kamar');
    }
    public function store(Request $request)
    {
        // 1. Cek apakah isiannya sudah benar
        $request->validate([
            'nomor_kamar' => 'required|string|max:255',
            'harga' => 'required|integer',
            'fasilitas' => 'nullable|string',
        ]);

        // 2. Masukkan data ke database
        Room::create([
            'nomor_kamar' => $request->nomor_kamar,
            'harga' => $request->harga,
            'fasilitas' => $request->fasilitas,
            'status' => 'tersedia', 
        ]);

        // 3. Kembalikan ke halaman daftar kamar
        return redirect()->route('kamar.index');
    }
    // Fungsi untuk menampilkan form edit
    public function edit($id)
    {
        $kamar = Room::findOrFail($id); // Cari data kamar berdasarkan ID
        return view('edit-kamar', compact('kamar'));
    }

    // Fungsi untuk menyimpan perubahan data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_kamar' => 'required|string|max:255',
            'harga' => 'required|integer',
            'fasilitas' => 'nullable|string',
            'status' => 'required|string', // Admin wajib memilih status
        ]);

        $kamar = Room::findOrFail($id);
        $kamar->update([
            'nomor_kamar' => $request->nomor_kamar,
            'harga' => $request->harga,
            'fasilitas' => $request->fasilitas,
            'status' => $request->status,
        ]);

        return redirect()->route('kamar.index');
    }
}