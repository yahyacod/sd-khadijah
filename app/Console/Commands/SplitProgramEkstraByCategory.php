<?php

namespace App\Console\Commands;

use App\Models\NavGroup;
use App\Models\Page;
use Illuminate\Console\Command;

class SplitProgramEkstraByCategory extends Command
{
    /**
     * php artisan split:program-ekstra
     *
     * Pecah halaman "Ekstrakurikuler" dan "Program Unggulan" jadi:
     * Grup (level 1) → Bidang/Kategori (level 2) → tiap item (level 3).
     * Level 3 dibuat sebagai HALAMAN ASLI (bisa diklik & diedit sendiri
     * di admin), bukan cuma teks di menu.
     * Halaman lama yang panjang di-nonaktifkan (draft, dilepas dari menu)
     * supaya nggak dobel.
     *
     * Aman dijalankan berkali-kali.
     */
    protected $signature = 'split:program-ekstra';

    protected $description = 'Pecah Ekstrakurikuler & Program Unggulan jadi Grup > Bidang > Item (3 level, semua bisa diklik & diedit)';

    public function handle(): int
    {
        $ekstraGroup = NavGroup::where('name', 'Ekstrakurikuler')->first();
        $programGroup = NavGroup::where('name', 'Program Unggulan')->first();

        if (! $ekstraGroup || ! $programGroup) {
            $this->error('Grup "Ekstrakurikuler" atau "Program Unggulan" belum ada. Jalankan `php artisan setup:nav-structure` dulu.');
            return self::FAILURE;
        }

        $ekstraPages = [
            [
                'slug' => 'ekstrakurikuler-olahraga',
                'title' => 'Bidang Olahraga',
                'items' => ['Futsal', 'Basket', 'Sepatu Roda', 'Taekwondo'],
            ],
            [
                'slug' => 'ekstrakurikuler-seni',
                'title' => 'Bidang Seni dan Kreativitas',
                'items' => ['Seni Tari', 'Seni Kriya', 'Seni Teater', 'Menggambar', 'Paduan Suara'],
            ],
            [
                'slug' => 'ekstrakurikuler-literasi',
                'title' => 'Bidang Literasi dan Keagamaan',
                'items' => ["Qiro'ah", 'Klub Penulis Khadijah'],
            ],
            [
                'slug' => 'ekstrakurikuler-teknologi',
                'title' => 'Bidang Teknologi dan Kepemimpinan',
                'items' => ['Robotik', 'Paskib', 'Pramuka', 'Banjar', 'Pagar Nusa'],
            ],
        ];

        $programPages = [
            [
                'slug' => 'program-tahfidz',
                'title' => 'Tahfidz dan Pendidikan Keislaman',
                'items' => ["Ta'lim dan Tahfidz Al-Qur'an", 'Tabungan Hafalan', 'Nadhom Aqidatul Awwam', "Adabul 'Alim wal Muta'allim", 'Pembiasaan Aswaja', 'Sholat Berjamaah'],
                'closing' => 'Program-program tersebut menjadi bagian dari upaya sekolah dalam menanamkan nilai keislaman dan akhlak dalam kehidupan sehari-hari.',
            ],
            [
                'slug' => 'program-kepercayaan-diri',
                'title' => 'Mengembangkan Kepercayaan Diri dan Potensi Anak',
                'items' => ['Speaking', 'Voice Arabic/English', 'Arabic or English Native Speaker', 'Kelas Inspirasi', 'Seni Komik (Semik)', 'Keputrian untuk kelas 4, 5, dan 6'],
                'closing' => 'Ananda tidak hanya belajar, tetapi juga mendapatkan kesempatan untuk berkomunikasi, berekspresi, tampil, bertanya, dan mengenal berbagai pengalaman baru.',
            ],
            [
                'slug' => 'program-prestasi-global',
                'title' => 'Menumbuhkan Semangat Berprestasi dan Berwawasan Global',
                'items' => ['Kelas Persiapan Olimpiade Matematika', 'International Edu Quest', 'English Camp', 'Kegiatan Tengah Semester (KTS)', 'Kemah Inspirasi (KEMSI) dan Pesta Siaga'],
                'closing' => 'Berbagai kegiatan tersebut dirancang untuk melatih kemampuan berpikir, keberanian, kerja sama, kreativitas, serta kesiapan anak menghadapi tantangan di luar lingkungan sekolah.',
            ],
            [
                'slug' => 'program-pengalaman-nyata',
                'title' => 'Belajar melalui Pengalaman Nyata',
                'items' => ['Praktik Renang', 'D2D (Discovery to Deliver)'],
                'closing' => 'Karena pengalaman langsung dapat membuat pembelajaran menjadi lebih menyenangkan, bermakna, dan dekat dengan kehidupan anak.',
            ],
        ];

        $this->info('Ekstrakurikuler:');
        $this->createCategoryPages($ekstraPages, $ekstraGroup->id);

        $this->newLine();
        $this->info('Program Unggulan:');
        $this->createCategoryPages($programPages, $programGroup->id);

        // Nonaktifkan halaman lama yang panjang (kalau ada), lepas dari menu
        // supaya nggak dobel sama sub-halaman kategori yang baru.
        $this->newLine();
        foreach (['ekstrakurikuler', 'programs'] as $oldSlug) {
            $old = Page::where('slug', $oldSlug)->first();
            if ($old) {
                $old->update(['status' => 'draft', 'nav_group_id' => null]);
                $this->comment("Halaman lama \"{$oldSlug}\" di-draft & dilepas dari menu (isinya masih ada, cuma disembunyikan).");
            }
        }

        $this->newLine();
        $this->info('Selesai. Cek menu di web — Ekstrakurikuler & Program Unggulan sekarang dropdown per kategori.');

        return self::SUCCESS;
    }

    private function createCategoryPages(array $pages, int $groupId): void
    {
        foreach ($pages as $i => $p) {
            $body = '<ul>';
            foreach ($p['items'] as $item) {
                $body .= '<li>' . e($item) . '</li>';
            }
            $body .= '</ul>';

            if (! empty($p['closing'])) {
                $body .= '<p>' . e($p['closing']) . '</p>';
            }

            $categoryPage = Page::updateOrCreate(
                ['slug' => $p['slug']],
                [
                    'title' => $p['title'],
                    'body' => $body,
                    'status' => 'publish',
                    'template' => 'default',
                    'nav_group_id' => $groupId,
                    'menu_order' => $i,
                    'nav_preview_items' => null, // sudah pakai sub-halaman asli, bukan teks preview lagi
                ]
            );

            $this->line("  [{$p['title']}]");

            // Bikin sub-halaman asli untuk tiap item — bisa diklik & diedit
            // sendiri-sendiri di admin (bukan cuma teks di menu).
            foreach ($p['items'] as $j => $itemName) {
                $slug = \Illuminate\Support\Str::slug($itemName);

                // Kalau slug ini sudah dipakai halaman lain yang BUKAN anak
                // dari kategori ini, kasih akhiran biar nggak bentrok.
                $clash = Page::where('slug', $slug)->first();
                if ($clash && $clash->parent_id !== $categoryPage->id) {
                    $slug .= '-' . \Illuminate\Support\Str::slug($p['title']);
                }

                Page::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'title' => $itemName,
                        'body' => '<p><em>Konten belum diisi.</em></p>',
                        'status' => 'publish',
                        'template' => 'default',
                        'parent_id' => $categoryPage->id,
                        'menu_order' => $j,
                    ]
                );

                $this->line("      → {$itemName}");
            }
        }
    }
}
