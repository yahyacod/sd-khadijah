<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('subtitle')->nullable();       // teks pendek di bawah judul (hero)
            $table->string('featured_image')->nullable();  // path gambar utama halaman
            $table->longText('body')->nullable();           // isi halaman, ditulis via RichEditor
            $table->string('status')->default('draft');     // draft / publish
            $table->unsignedInteger('sort_order')->default(0); // urutan di menu, kalau dibutuhkan nanti
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
