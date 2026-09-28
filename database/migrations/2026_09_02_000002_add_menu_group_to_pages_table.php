<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('menu_group')->nullable()->after('video_file');
            $table->unsignedInteger('menu_order')->default(0)->after('menu_group');
        });

        // Backfill halaman yang sudah ada supaya tetap muncul di menu
        // (kalau slug-nya nggak ada, update ini otomatis nggak ngefek, aman).
        $map = [
            'sambutan-kepala-sekolah' => ['tentang', 1],
            'visi-misi' => ['tentang', 2],
            'status-lembaga' => ['tentang', 3],
            'profile' => ['tentang', 4],
            'programs' => ['program', 1],
            'admissions' => ['spmb', 1],
        ];

        foreach ($map as $slug => [$group, $order]) {
            DB::table('pages')->where('slug', $slug)->update([
                'menu_group' => $group,
                'menu_order' => $order,
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['menu_group', 'menu_order']);
        });
    }
};
