<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Pembayaran; // Pastikan import model Pembayaran di bagian atas file

class BookingController extends Controller
{
    public function create($id)
    {
        $kamar = Room::findOrFail($id);
        return view('booking', compact('kamar'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'tanggal_masuk' => 'required|date',
        ]);

        $kamar = Room::findOrFail($id);

        Booking::create([
            'user_id' => auth()->id(),
            'room_id' => $kamar->id,
            'tanggal_masuk' => $request->tanggal_masuk,
            'status' => 'pending',
        ]);

        // Catatan: Jika ingin langsung mengubah status kamar, biarkan baris ini. 
        // Jika ingin diubah saat lunas saja, silakan hapus/komentari baris update di bawah ini.
        $kamar->update([
            'status' => 'terisi'
        ]);

        // Selesai booking, lempar ke rute 'riwayat' (bukan dashboard)
        return redirect()->route('riwayat')->with('success', 'Booking berhasil! Menunggu persetujuan Admin.');
    }

    public function uploadPembayaran(Request $request, $id)
    {
        // 1. Validasi file yang diunggah wajib gambar & maks 2MB
        // Menyesuaikan dengan name="bukti_transfer" dari file blade sebelumnya
        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Ambil data booking terkait
        $booking = Booking::findOrFail($id);

        // 3. Simpan file gambar ke folder storage/app/public/bukti_pembayaran
        $path = null;
        if ($request->hasFile('bukti_transfer')) {
            $file = $request->file('bukti_transfer');
            $path = $file->store('bukti_pembayaran', 'public');
        }

        // 4. Insert data baru ke tabel pembayarans
        Pembayaran::create([
            'user_id'      => auth()->id(),              // ID user yang sedang login
            'room_id'      => $booking->room_id,         // Diambil dari relasi booking
            'jumlah_bayar' => $booking->room->harga ?? 0, // Mengambil nominal harga kamar
            'status'       => 'pending',                 // Default awal status pembayaran
            'bukti_bayar'  => $path,                     // Path file foto yang disimpan
        ]);

        // 5. 🔥 FIX CRITICAL BUG: Update status booking agar tampilan di blade berubah
        $booking->update([
            'status' => 'menunggu_verifikasi'
        ]);

        // 6. Kembalikan ke halaman riwayat dengan pesan sukses
        return redirect()->back()->with('success', 'Bukti transfer berhasil dikirim! Menunggu konfirmasi Bapak Kos.');
    }
}