<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('template')->default('default')->after('status'); // default | admissions
            $table->string('cta_label')->nullable()->after('template');       // teks tombol, misal "Daftar via WhatsApp"
            $table->string('cta_url')->nullable()->after('cta_label');        // link tombol
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['template', 'cta_label', 'cta_url']);
        });
    }
};
