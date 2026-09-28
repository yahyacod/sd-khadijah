<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class DownloadWordpressMedia extends Command
{
    /**
     * php artisan download:wordpress-media storage/app/wordpress-export.xml
     *
     * Download semua gambar (attachment_url) dari XML ke
     * storage/app/public/wp-import/ sebagai referensi. Nanti tinggal
     * dipilih manual saat upload "Gambar Utama" di form admin.
     */
    protected $signature = 'download:wordpress-media {path : Path ke file XML export WordPress}';

    protected $description = 'Download semua gambar dari XML export WordPress ke storage/app/public/wp-import/';

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

        $ok = 0;
        $fail = 0;

        foreach ($xml->channel->item as $item) {
            $wpMeta = $item->children($wpNs);

            if ((string) $wpMeta->post_type !== 'attachment') {
                continue;
            }

            $url = (string) $wpMeta->attachment_url;
            if (! $url) {
                continue;
            }

            $wpId = (int) $wpMeta->post_id;
            $extension = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'jpg';
            $filename = "wp-import/{$wpId}." . $extension;

            if (Storage::disk('public')->exists($filename)) {
                continue; // sudah pernah didownload
            }

            try {
                $response = Http::timeout(20)->get($url);
                if ($response->successful()) {
                    Storage::disk('public')->put($filename, $response->body());
                    $ok++;
                    $this->line("  [OK] {$filename}");
                } else {
                    $fail++;
                    $this->warn("  [GAGAL {$response->status()}] {$url}");
                }
            } catch (\Throwable $e) {
                $fail++;
                $this->warn("  [ERROR] {$url} - {$e->getMessage()}");
            }
        }

        $this->newLine();
        $this->info("Selesai. Berhasil: {$ok}, Gagal: {$fail}. Tersimpan di storage/app/public/wp-import/");

        return self::SUCCESS;
    }
}
