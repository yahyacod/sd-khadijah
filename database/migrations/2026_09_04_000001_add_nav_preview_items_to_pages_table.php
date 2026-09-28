<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            // Daftar item pendek (JSON array of string) buat ditampilkan
            // sebagai sub-dropdown di menu navigasi, contoh: Bidang Olahraga
            // isinya ["Futsal","Basket","Sepatu Roda","Taekwondo"].
            // Kalau kosong, halaman ini tampil biasa di menu (nggak ada panah
            // sub-dropdown tambahan).
            $table->json('nav_preview_items')->nullable()->after('nav_group_id');
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('nav_preview_items');
        });
    }
};
