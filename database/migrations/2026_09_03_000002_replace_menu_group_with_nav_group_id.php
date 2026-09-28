<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->foreignId('nav_group_id')->nullable()->after('menu_order')
                ->constrained('nav_groups')->nullOnDelete();
        });

        // Kolom lama (menu_group teks bebas) digantikan relasi di atas.
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('menu_group');
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropConstrainedForeignId('nav_group_id');
            $table->string('menu_group')->nullable();
        });
    }
};
