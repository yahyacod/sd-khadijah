<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('video_url')->nullable()->after('cta_url');  // link YouTube/Vimeo
            $table->string('video_file')->nullable()->after('video_url'); // atau upload file sendiri
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['video_url', 'video_file']);
        });
    }
};
