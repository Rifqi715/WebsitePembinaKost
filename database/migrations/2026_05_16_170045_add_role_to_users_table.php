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
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan baris ini. 
            // Defaultnya 'penghuni', jadi setiap ada yang daftar otomatis jadi penghuni kos biasa.
            $table->string('role')->default('penghuni')->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ini untuk menghapus kolom kalau sewaktu-waktu kita batalkan
            $table->dropColumn('role');
        });
    }
};
