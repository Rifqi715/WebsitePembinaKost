<?php

use App\Models\Booking;
use App\Http\Controllers\BookingController;
use App\Models\Room;
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

// Route::get('/admin', function () {
//     if (auth()->user()->role !== 'admin') {
//         return redirect('/dashboard'); 
//     }
//     return view('admin'); 
// })->middleware(['auth', 'verified'])->name('admin');

Route::get('/admin/kamar', [App\Http\Controllers\RoomController::class, 'index'])->middleware(['auth', 'verified'])->name('kamar.index');

Route::get('/admin/kamar/tambah', [App\Http\Controllers\RoomController::class, 'create'])->middleware(['auth', 'verified'])->name('kamar.create');

Route::post('/admin/kamar', [App\Http\Controllers\RoomController::class, 'store'])->middleware(['auth', 'verified'])->name('kamar.store');

// Rute untuk menampilkan halaman form edit
Route::get('/admin/kamar/{id}/edit', [App\Http\Controllers\RoomController::class, 'edit'])->middleware(['auth', 'verified'])->name('kamar.edit');

// Rute untuk memproses update data ke database
Route::put('/admin/kamar/{id}', [App\Http\Controllers\RoomController::class, 'update'])->middleware(['auth', 'verified'])->name('kamar.update');

Route::middleware('auth')->group(function () {
    Route::get('/booking/{id}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/{id}', [BookingController::class, 'store'])->name('booking.store');
});

require __DIR__.'/auth.php';
