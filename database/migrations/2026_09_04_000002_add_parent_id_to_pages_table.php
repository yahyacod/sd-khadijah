<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            // Halaman induk — kalau diisi, halaman ini jadi "anak" yang
            // muncul sebagai sub-dropdown (level ke-3) di menu, di bawah
            // halaman induknya. Bisa diatur lewat admin di field
            // "Halaman Induk" pada form Halaman.
            $table->foreignId('parent_id')->nullable()->after('nav_group_id')
                ->constrained('pages')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropConstrainedForeignId('parent_id');
        });
    }
};
