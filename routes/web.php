<?php

use App\Models\Booking;
use App\Models\Room;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $kamar = Room::all();
    return view('welcome', compact('kamar')); // Kirim datanya ke halaman depan
});

Route::get('/riwayat', function () {
    $bookings = Booking::with('room')->where('user_id', auth()->id())->get();
    return view('dashboard', compact('bookings'));
})->middleware(['auth', 'verified'])->name('riwayat');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route Manajemen Kamar oleh Admin
Route::get('/admin/kamar', [RoomController::class, 'index'])->middleware(['auth', 'verified'])->name('kamar.index');
Route::get('/admin/kamar/tambah', [RoomController::class, 'create'])->middleware(['auth', 'verified'])->name('kamar.create');
Route::post('/admin/kamar', [RoomController::class, 'store'])->middleware(['auth', 'verified'])->name('kamar.store');
Route::get('/admin/kamar/{id}/edit', [RoomController::class, 'edit'])->middleware(['auth', 'verified'])->name('kamar.edit');
Route::put('/admin/kamar/{id}', [RoomController::class, 'update'])->middleware(['auth', 'verified'])->name('kamar.update');

// Route khusus untuk user yang sudah login berkaitan dengan booking & pembayaran
Route::middleware('auth')->group(function () {
    Route::get('/booking/{id}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/{id}', [BookingController::class, 'store'])->name('booking.store');
    
    // Keamanan Terjamin: Berada di dalam middleware auth
    Route::post('/booking/{id}/bayar', [BookingController::class, 'uploadPembayaran'])->name('booking.bayar');
});

require __DIR__.'/auth.php';