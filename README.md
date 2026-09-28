# SD Khadijah Wonorejo

Website resmi SD Khadijah Wonorejo, dibangun menggunakan Laravel dan Filament. Website menyediakan halaman publik sekolah serta panel admin untuk mengelola halaman, berita, navigasi, dan hero slideshow.

## Teknologi

- PHP 8.3+
- Laravel 13
- Filament 5
- SQLite secara default (dapat dikonfigurasi menggunakan database lain yang didukung Laravel)
- Node.js dan npm untuk membangun aset frontend

## Menjalankan secara lokal

Pastikan PHP, Composer, Node.js, dan npm sudah terpasang. Dari direktori hasil clone:

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Di Windows Command Prompt, gunakan `copy .env.example .env` sebagai pengganti perintah `cp`.

Konfigurasi bawaan `.env.example` memakai SQLite. Buat file database bila belum tersedia:

```bash
touch database/database.sqlite
```

Di Windows PowerShell, gunakan:

```powershell
New-Item database/database.sqlite -ItemType File
```

Bila memakai MySQL atau database lain, atur nilai `DB_*` di `.env` sebelum migrasi.

Jalankan migrasi, siapkan tautan file publik, lalu bangun aset frontend:

```bash
php artisan migrate
php artisan storage:link
npm install
npm run build
```

Buat akun admin Filament:

```bash
php artisan make:filament-user
```

> Jangan gunakan akun contoh atau kredensial lokal untuk deployment publik. Buat akun admin dengan email dan kata sandi yang aman.

Jalankan server pengembangan:

```bash
php artisan serve
```

Buka `http://127.0.0.1:8000` untuk website dan `http://127.0.0.1:8000/admin` untuk panel admin.

## Fitur

- Halaman beranda dengan informasi sekolah, program, galeri, berita, dan lokasi.
- Mode terang dan gelap.
- Panel admin untuk halaman, berita, grup navigasi, dan hero slideshow.
- Publikasi konten dengan status draft atau terbit.
- Sitemap di `/sitemap.xml`.
- Perintah Artisan untuk mengimpor konten WordPress dan mengelola konten program sekolah.

## Impor konten WordPress (opsional)

File XML export WordPress tidak disertakan di repository. Simpan file export secara lokal, misalnya di `storage/app/wordpress-export.xml`, lalu jalankan:

```bash
php artisan seed:from-wordpress storage/app/wordpress-export.xml
```

Konten hasil impor dibuat sebagai draft agar dapat diperiksa dan diperbarui dari panel admin sebelum diterbitkan.

Untuk mengunduh media yang tercantum dalam XML:

```bash
php artisan download:wordpress-media storage/app/wordpress-export.xml
```

Untuk memeriksa gambar eksternal yang dapat dilokalkan tanpa mengubah database:

```bash
php artisan localize:images --dry-run
```

Setelah memeriksa hasilnya, jalankan `php artisan localize:images` untuk mengunduh gambar dan memperbarui referensinya. Perintah ini memerlukan koneksi internet.

## Catatan untuk deployment

- Jangan unggah `.env`, kredensial, database SQLite lokal, atau file export WordPress.
- File upload dan media yang berada di `storage` tidak disertakan di GitHub. Pindahkan media yang dibutuhkan melalui proses deployment atau penyimpanan file terpisah.
- Atur `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL`, dan konfigurasi database serta storage produksi pada environment server.
- Pastikan server web mengarah ke direktori `public` dan akun admin produksi dibuat secara terpisah.
