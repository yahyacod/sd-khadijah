<?php

namespace App\Console\Commands;

use App\Models\Page;
use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SeedFromWordpressXml extends Command
{
    /**
     * php artisan seed:from-wordpress storage/app/wordpress-export.xml
     *
     * Beda dengan `import:wordpress` (yang lama): command ini mengisi
     * skema BARU (pages/posts dengan field title, slug, subtitle, body,
     * featured_image) sebagai DRAFT. Tujuannya cuma kasih titik awal biar
     * kamu tinggal poles & publish satu-satu lewat panel admin Filament,
     * bukan ngetik ulang dari nol.
     *
     * Gambar TIDAK otomatis dipasang sebagai featured_image (path upload
     * Filament beda dengan hasil download lama) - upload manual saat
     * mengedit di admin. File gambar hasil download sebelumnya ada di
     * storage/app/public/wp-import/ sebagai referensi.
     */
    protected $signature = 'seed:from-wordpress {path : Path ke file XML export WordPress}';

    protected $description = 'Isi awal tabel pages & posts (skema baru) dari XML sebagai draft, untuk dipoles manual di admin';

    public function handle(): int
    {
        $path = $this->argument('path');

        if (! file_exists($path)) {
            $this->error("File tidak ditemukan: {$path}");
            return self::FAILURE;
        }

        libxml_use_internal_errors(true);
        $xml = simplexml_load_file($path);

        if ($xml === false) {
            $this->error('Gagal parsing XML.');
            return self::FAILURE;
        }

        $namespaces = $xml->getNamespaces(true);
        $wpNs = $namespaces['wp'] ?? 'http://wordpress.org/export/1.2/';
        $contentNs = $namespaces['content'] ?? 'http://purl.org/rss/1.0/modules/content/';
        $excerptNs = $namespaces['excerpt'] ?? 'http://wordpress.org/export/1.2/excerpt/';

        $counts = ['page' => 0, 'post' => 0];

        foreach ($xml->channel->item as $item) {
            $wpMeta = $item->children($wpNs);
            $postType = (string) $wpMeta->post_type;
            $wpStatus = (string) $wpMeta->status;

            if (! in_array($postType, ['page', 'post'], true)) {
                continue;
            }

            if (! in_array($wpStatus, ['publish', 'draft'], true)) {
                continue;
            }

            $title = trim((string) $item->title);
            if ($title === '') {
                continue;
            }

            $slug = (string) $wpMeta->post_name ?: Str::slug($title);
            $rawBody = (string) $item->children($contentNs)->encoded;
            $body = $this->cleanGutenbergMarkup($rawBody);
            $excerpt = trim((string) $item->children($excerptNs)->encoded);
            $subtitle = $excerpt ? Str::limit(strip_tags($excerpt), 150) : null;

            if ($postType === 'page') {
                Page::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'title' => $title,
                        'subtitle' => $subtitle,
                        'body' => $body,
                        'status' => 'draft', // sengaja tetap draft walau di WP publish, review dulu sebelum tayang
                    ]
                );
                $counts['page']++;
                $this->line("  [page draft] {$title}");
            } else {
                $pubDate = (string) $item->pubDate;
                Post::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'title' => $title,
                        'subtitle' => $subtitle,
                        'body' => $body,
                        'status' => 'draft',
                        'published_at' => $pubDate ? date('Y-m-d H:i:s', strtotime($pubDate)) : now(),
                    ]
                );
                $counts['post']++;
                $this->line("  [post draft] {$title}");
            }
        }

        $this->newLine();
        $this->info("Selesai. {$counts['page']} halaman & {$counts['post']} post masuk sebagai DRAFT.");
        $this->info('Buka /admin untuk cek, lengkapi gambar utama, rapikan isi, lalu ubah status ke Publish satu-satu.');

        return self::SUCCESS;
    }

    /**
     * Bersihkan komentar block Gutenberg (<!-- wp:paragraph -->, dst) supaya
     * body lebih rapi saat dibuka di RichEditor. HTML isinya tetap dipakai.
     */
    private function cleanGutenbergMarkup(string $html): string
    {
        return trim(preg_replace('/<!--\s*\/?wp:.*?-->/s', '', $html));
    }
}
