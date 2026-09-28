<?php

namespace App\Console\Commands;

use App\Models\Page;
use Illuminate\Console\Command;

class FillProgramDanEkstra extends Command
{
    /**
     * php artisan fill:program-ekstra
     *
     * Isi konten halaman "Program Unggulan" (slug: programs) dan
     * "Ekstrakurikuler" (slug: ekstrakurikuler) dengan naskah dari
     * broadcast_web__ekstra_dan_program_unggulan_.docx.
     * Status tetap DRAFT — cek dulu di admin sebelum publish.
     * Aman dijalankan berkali-kali (menimpa isi dengan naskah yang sama).
     */
    protected $signature = 'fill:program-ekstra';

    protected $description = 'Isi konten halaman Program Unggulan & Ekstrakurikuler dari naskah broadcast sekolah';

    public function handle(): int
    {
        $ekstrakurikuler = <<<'HTML'
<p><strong>Bukan Sekadar Belajar, Saatnya Anak Menemukan Bakat dan Potensinya!</strong></p>
<p>Setiap anak memiliki keunikan, minat, dan potensi yang berbeda. Ada yang senang berolahraga, ada yang gemar berkesenian, ada yang memiliki jiwa kepemimpinan, bahkan ada pula yang tertarik dengan dunia teknologi.</p>
<p>Di SD Khadijah Wonorejo, kami percaya bahwa proses pendidikan tidak hanya berlangsung di dalam ruang kelas. Karena itu, ananda diberikan kesempatan untuk mengeksplorasi minat, mengasah keterampilan, membangun kepercayaan diri, serta belajar bekerja sama melalui berbagai kegiatan ekstrakurikuler.</p>
<p>Beragam pilihan ekstrakurikuler hadir untuk menemani perjalanan tumbuh dan berkembangnya ananda:</p>

<h3>Bidang Olahraga</h3>
<ul>
<li>Futsal</li>
<li>Basket</li>
<li>Sepatu Roda</li>
<li>Taekwondo</li>
</ul>

<h3>Bidang Seni dan Kreativitas</h3>
<ul>
<li>Seni Tari</li>
<li>Seni Kriya</li>
<li>Seni Teater</li>
<li>Menggambar</li>
<li>Paduan Suara</li>
</ul>

<h3>Bidang Literasi dan Keagamaan</h3>
<ul>
<li>Qiro'ah</li>
<li>Klub Penulis Khadijah</li>
</ul>

<h3>Bidang Teknologi dan Kepemimpinan</h3>
<ul>
<li>Robotik</li>
<li>Paskib</li>
<li>Pramuka</li>
<li>Banjar</li>
<li>Pagar Nusa</li>
</ul>

<p>Setiap kegiatan menjadi ruang bagi anak untuk belajar dengan cara yang menyenangkan. Bukan hanya tentang menjadi juara, tetapi juga tentang berani mencoba, berproses, bekerja sama, disiplin, bertanggung jawab, dan menemukan hal yang mereka sukai.</p>
<p>Karena bisa jadi, bakat besar seorang anak berawal dari satu kegiatan sederhana yang ia sukai.</p>
HTML;

        $programUnggulan = <<<'HTML'
<p>Tugas sekolah bukan hanya membantu anak memahami pelajaran, tetapi juga memberikan pengalaman yang dapat membentuk karakter, kemandirian, kecakapan, dan kepercayaan diri mereka.</p>
<p>Di SD Khadijah Wonorejo, proses pendidikan dirancang agar murid tidak hanya tumbuh menjadi anak yang berprestasi secara akademik, tetapi juga memiliki karakter Islami, berakhlak, mandiri, komunikatif, kreatif, dan siap menghadapi masa depan.</p>
<p>Berbagai program unggulan kami hadir untuk memberikan pengalaman belajar yang lebih bermakna, di antaranya:</p>

<h3>Tahfidz dan Pendidikan Keislaman</h3>
<ul>
<li>Ta'lim dan Tahfidz Al-Qur'an</li>
<li>Tabungan Hafalan</li>
<li>Nadhom Aqidatul Awwam</li>
<li>Adabul 'Alim wal Muta'allim</li>
<li>Pembiasaan Aswaja</li>
<li>Sholat Berjamaah</li>
</ul>
<p>Program-program tersebut menjadi bagian dari upaya sekolah dalam menanamkan nilai keislaman dan akhlak dalam kehidupan sehari-hari.</p>

<h3>Mengembangkan Kepercayaan Diri dan Potensi Anak</h3>
<ul>
<li>Speaking</li>
<li>Voice Arabic/English</li>
<li>Arabic or English Native Speaker</li>
<li>Kelas Inspirasi</li>
<li>Seni Komik (Semik)</li>
<li>Keputrian untuk kelas 4, 5, dan 6</li>
</ul>
<p>Ananda tidak hanya belajar, tetapi juga mendapatkan kesempatan untuk berkomunikasi, berekspresi, tampil, bertanya, dan mengenal berbagai pengalaman baru.</p>

<h3>Menumbuhkan Semangat Berprestasi dan Berwawasan Global</h3>
<ul>
<li>Kelas Persiapan Olimpiade Matematika</li>
<li>International Edu Quest</li>
<li>English Camp</li>
<li>Kegiatan Tengah Semester (KTS)</li>
<li>Kemah Inspirasi (KEMSI) dan Pesta Siaga</li>
</ul>
<p>Berbagai kegiatan tersebut dirancang untuk melatih kemampuan berpikir, keberanian, kerja sama, kreativitas, serta kesiapan anak menghadapi tantangan di luar lingkungan sekolah.</p>

<h3>Belajar melalui Pengalaman Nyata</h3>
<ul>
<li>Praktik Renang</li>
<li>D2D (Discovery to Deliver)</li>
</ul>
<p>Karena pengalaman langsung dapat membuat pembelajaran menjadi lebih menyenangkan, bermakna, dan dekat dengan kehidupan anak.</p>

<h3>Mengapa SD Khadijah Wonorejo?</h3>
<p>Karena kami percaya bahwa pendidikan yang baik bukan hanya tentang apa yang anak ketahui, tetapi juga tentang apa yang perlu ditumbuhkan dalam dirinya.</p>
<p><strong>Di SD Khadijah Wonorejo, ananda mendapatkan ruang untuk:</strong></p>
<p>Belajar dengan gembira<br>Beribadah dan berakhlak<br>Berani berkomunikasi<br>Mengembangkan bakat dan minat<br>Berpikir kritis dan kreatif<br>Bekerja sama dan mandiri<br>Berprestasi dan memiliki wawasan global</p>
<p>Semua dirangkai dalam lingkungan belajar yang mendorong murid untuk terus bertumbuh, mencoba, berkarya, dan menjadi versi terbaik dirinya. Kami ingin mendampingi lahirnya generasi yang cerdas, santun, berkarakter, berprestasi, dan siap menghadapi masa depan.</p>
HTML;

        $ekstraPage = Page::where('slug', 'ekstrakurikuler')->first();
        if ($ekstraPage) {
            $ekstraPage->update([
                'subtitle' => 'Bukan Sekadar Belajar, Saatnya Anak Menemukan Bakat dan Potensinya!',
                'body' => $ekstrakurikuler,
            ]);
            $this->info('Halaman Ekstrakurikuler terisi (masih draft, cek dulu di admin).');
        } else {
            $this->warn('Halaman dengan slug "ekstrakurikuler" belum ada. Jalankan `php artisan setup:nav-structure` dulu.');
        }

        $programPage = Page::where('slug', 'programs')->first();
        if ($programPage) {
            $programPage->update([
                'body' => $programUnggulan,
            ]);
            $this->info('Halaman Program Unggulan terisi (status tidak diubah).');
        } else {
            $this->warn('Halaman dengan slug "programs" tidak ditemukan.');
        }

        return self::SUCCESS;
    }
}
