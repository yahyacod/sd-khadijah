<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nav_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('sort_order')->default(0);
            // Link tambahan di ujung dropdown (opsional), buat kasus kayak
            // "Berita" (rute internal) atau "Daftar Online" (link eksternal)
            // yang bukan halaman biasa.
            $table->string('extra_link_label')->nullable();
            $table->string('extra_link_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nav_groups');
    }
};
