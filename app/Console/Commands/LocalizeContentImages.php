<?php

namespace App\Console\Commands;

use App\Models\Page;
use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class LocalizeContentImages extends Command
{
    /**
     * php artisan localize:images
     *
     * PENTING: situs WordPress lama (sdkhadijah-wonorejo.sch.id) terindikasi
     * disusupi spam (link judi online muncul di halaman). Command ini
     * mendownload semua gambar yang masih direferensikan di kolom `body`
     * (pages & posts) dan mengganti URL-nya ke file lokal di
     * storage/app/public/wp-import/ - supaya web baru TIDAK lagi
     * bergantung/nyambung ke domain lama itu sama sekali.
     */
    protected $signature = 'localize:images {--dry-run : Cuma tampilkan apa yang akan diubah, tanpa menyimpan}';

    protected $description = 'Download gambar yang direferensikan di isi halaman/post, lalu ganti URL-nya ke lokal';

    private array $cache = [];

    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');

        foreach ([Page::class, Post::class] as $modelClass) {
            $label = class_basename($modelClass);
            $this->info("Memproses {$label}...");

            foreach ($modelClass::all() as $record) {
                if (blank($record->body)) {
                    continue;
                }

                $newBody = $this->localize($record->body, $dryRun);

                if ($newBody !== $record->body) {
                    $this->line("  [{$label}] {$record->title} — " . ($dryRun ? 'ada gambar yang bisa dilokalkan' : 'diperbarui'));
                    if (! $dryRun) {
                        $record->update(['body' => $newBody]);
                    }
                }
            }
        }

        $this->newLine();
        $this->info($dryRun ? 'Selesai cek (dry-run, tidak ada yang disimpan).' : 'Selesai. Semua gambar yang berhasil didownload sudah diganti ke path lokal.');

        return self::SUCCESS;
    }

    private function localize(string $html, bool $dryRun): string
    {
        // Tangkap semua src="https://domain-lama/wp-content/uploads/..."
        return preg_replace_callback(
            '/(https?:\/\/[^\s"\']+\/wp-content\/uploads\/[^\s"\']+\.(?:jpg|jpeg|png|gif|webp))/i',
            function (array $m) use ($dryRun) {
                $url = $m[1];

                if (isset($this->cache[$url])) {
                    return $this->cache[$url];
                }

                $filename = 'wp-import/' . md5($url) . '.' . pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);

                if (Storage::disk('public')->exists($filename)) {
                    $local = asset('storage/' . $filename);
                    $this->cache[$url] = $local;
                    return $local;
                }

                if ($dryRun) {
                    // Di dry-run nggak perlu benar-benar download
                    return $url;
                }

                try {
                    $response = Http::timeout(20)->get($url);
                    if ($response->successful()) {
                        Storage::disk('public')->put($filename, $response->body());
                        $local = asset('storage/' . $filename);
                        $this->cache[$url] = $local;
                        return $local;
                    }
                } catch (\Throwable $e) {
                    $this->warn("    Gagal download: {$url}");
                }

                return $url; // biarkan URL lama kalau gagal download
            },
            $html
        );
    }
}
