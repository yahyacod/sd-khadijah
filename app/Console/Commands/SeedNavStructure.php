<?php

namespace App\Console\Commands;

use App\Models\NavGroup;
use App\Models\Page;
use Illuminate\Console\Command;

class SeedNavStructure extends Command
{
    /**
     * php artisan setup:nav-structure
     *
     * Bikin 9 grup navigasi + halaman-halaman di dalamnya sesuai struktur
     * yang diminta. AMAN dijalankan berkali-kali:
     * - Grup: updateOrCreate by name (nggak dobel).
     * - Halaman yang SUDAH ADA (sambutan-kepala-sekolah, visi-misi, dst):
     *   cuma di-assign ke grup barunya, isi/status TIDAK disentuh.
     * - Halaman BARU: dibuat sebagai draft kosong, siap diisi di admin.
     */
    protected $signature = 'setup:nav-structure';

    protected $description = 'Buat 9 grup navigasi + halaman draft sesuai struktur menu sekolah';

    public function handle(): int
    {
        $groups = [
            ['name' => 'Info', 'sort_order' => 1, 'extra_link_label' => 'Berita', 'extra_link_url' => '/berita'],
            ['name' => 'Profil Sekolah', 'sort_order' => 2],
            ['name' => 'Kurikulum', 'sort_order' => 3],
            ['name' => 'Budaya Sekolah', 'sort_order' => 4],
            ['name' => 'Ekstrakurikuler', 'sort_order' => 5],
            ['name' => 'Program Unggulan', 'sort_order' => 6],
            ['name' => 'Daftar Prestasi Siswa', 'sort_order' => 7],
            ['name' => 'Fasilitas', 'sort_order' => 8],
            ['name' => 'SPMB', 'sort_order' => 9, 'extra_link_label' => 'Registrasi', 'extra_link_url' => 'https://khareg.netlify.app'],
        ];

        $groupModels = [];
        foreach ($groups as $g) {
            $groupModels[$g['name']] = NavGroup::updateOrCreate(['name' => $g['name']], $g);
            $this->line("Grup: {$g['name']}");
        }

        // slug => [title, urutan] — halaman yang SUDAH ADA (isi/status tidak disentuh)
        $existing = [
            'Profil Sekolah' => [
                'sambutan-kepala-sekolah' => 1,
                'status-lembaga' => 2,
                'visi-misi' => 3,
                'profile' => 4, // Video Profil
            ],
            'Kurikulum' => [
                // Program Unggulan sekarang di grup sendiri, lihat di bawah
            ],
            'Program Unggulan' => [
                'programs' => 1,
            ],
            'SPMB' => [
                'admissions' => 1,
            ],
        ];

        foreach ($existing as $groupName => $slugs) {
            foreach ($slugs as $slug => $order) {
                $updated = Page::where('slug', $slug)->update([
                    'nav_group_id' => $groupModels[$groupName]->id,
                    'menu_order' => $order,
                ]);
                if ($updated) {
                    $this->line("  [assign] {$slug} -> {$groupName}");
                } else {
                    $this->warn("  [lewat, belum ada] {$slug} — buat manual dulu di admin kalau perlu");
                }
            }
        }

        // title => slug — halaman BARU (draft kosong, aman dibuat kalau belum ada)
        $newPages = [
            'Profil Sekolah' => [
                'Sejarah Singkat' => 'sejarah-singkat',
                'Kepala Sekolah' => 'kepala-sekolah',
                'Susunan Personalia' => 'susunan-personalia',
                'Wali Kelas' => 'wali-kelas',
                'Komite Sekolah' => 'komite-sekolah',
            ],
            'Kurikulum' => [
                'Kurikulum Nasional' => 'kurikulum-nasional',
                'Kurikulum Cambridge' => 'kurikulum-cambridge',
                'Kurikulum Agama (Yayasan Khadijah)' => 'kurikulum-agama',
                'Kalender Pendidikan Sekolah' => 'kalender-pendidikan-sekolah',
                'Kalender Pendidikan' => 'kalender-pendidikan',
            ],
            'Budaya Sekolah' => [
                'Pedoman Murid, Tatib Guru & Tenaga Kependidikan' => 'pedoman-murid-tatib-guru',
                'Pedoman Norma' => 'pedoman-norma',
            ],
            'Ekstrakurikuler' => [
                'Ekstrakurikuler' => 'ekstrakurikuler',
            ],
            'Daftar Prestasi Siswa' => [
                'Daftar Prestasi Siswa' => 'daftar-prestasi-siswa',
            ],
            'Fasilitas' => [
                'Fasilitas Sekolah' => 'fasilitas-sekolah',
            ],
            'Info' => [
                'Pengumuman' => 'pengumuman',
                'Prestasi' => 'prestasi',
            ],
        ];

        foreach ($newPages as $groupName => $pages) {
            $order = 1;
            foreach ($pages as $title => $slug) {
                $page = Page::firstOrCreate(
                    ['slug' => $slug],
                    [
                        'title' => $title,
                        'body' => '<p>Konten belum diisi.</p>',
                        'status' => 'draft',
                        'nav_group_id' => $groupModels[$groupName]->id,
                        'menu_order' => $order,
                    ]
                );
                $this->line("  [draft] {$title} ({$slug}) -> {$groupName}");
                $order++;
            }
        }

        $this->newLine();
        $this->info('Selesai. Buka /admin > Grup Navigasi dan Halaman untuk cek & mulai isi konten.');
        $this->info('Catatan: "Program Unggulan" saya taruh di grup Kurikulum — pindahkan lewat admin kalau kurang pas.');
        $this->info('Catatan: "Kalender Pendidikan Sekolah" dan "Kalender Pendidikan" sengaja dibuat 2 halaman terpisah sesuai permintaan — hapus salah satu di admin kalau ternyata maksudnya cuma 1.');

        return self::SUCCESS;
    }
}
