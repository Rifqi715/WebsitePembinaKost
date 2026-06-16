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
        Schema::table('bookings', function (Blueprint $table) {
            // Menambahkan kolom baru bertipe string (karena isinya nama file gambar)
            // nullable() artinya boleh kosong saat awal booking belum dibayar
            $table->string('bukti_pembayaran')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Menghapus kolom jika kita melakukan rollback
            $table->dropColumn('bukti_pembayaran');
        });
    }
};
