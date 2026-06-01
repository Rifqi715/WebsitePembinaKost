<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            // Menyambungkan data penyewa (dari tabel users)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Menyambungkan data kamar (dari tabel rooms)
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            
            // Informasi tambahan saat booking
            $table->date('tanggal_masuk'); // Rencana tanggal mulai ngekos
            $table->string('status')->default('pending'); // Status awal: pending (menunggu persetujuan admin)
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
