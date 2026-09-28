<x-filament-widgets::widget>
    <div class="sd-admin-dashboard">
        <section class="sd-admin-dashboard__welcome">
            <div>
                <span class="sd-admin-dashboard__eyebrow">Panel pengelolaan sekolah</span>
                <h2>Selamat datang{{ $administratorName ? ', ' . $administratorName : '' }}</h2>
                <p>Kelola halaman, berita, dan foto beranda SD Khadijah Wonorejo dari satu tempat.</p>
            </div>
            <a href="{{ $publicSiteUrl }}" target="_blank" rel="noopener" class="sd-admin-dashboard__site-link">
                Lihat website <span aria-hidden="true">↗</span>
            </a>
        </section>

        <section class="sd-admin-dashboard__summary" aria-label="Ringkasan konten">
            <a href="{{ $pagesUrl }}" class="sd-admin-dashboard__stat">
                <span>Halaman terbit</span>
                <strong>{{ $publishedPagesCount }}</strong>
            </a>
            <a href="{{ $pagesUrl }}?tableFilters[status][value]=draft" class="sd-admin-dashboard__stat">
                <span>Halaman draft</span>
                <strong>{{ $draftPagesCount }}</strong>
            </a>
            <a href="{{ $postsUrl }}" class="sd-admin-dashboard__stat">
                <span>Berita terbit</span>
                <strong>{{ $publishedPostsCount }}</strong>
            </a>
        </section>

        <section class="sd-admin-dashboard__actions" aria-label="Pintasan pengelolaan">
            <a href="{{ $createPageUrl }}" class="sd-admin-dashboard__action">
                <span class="sd-admin-dashboard__action-icon" aria-hidden="true">＋</span>
                <span><strong>Buat halaman</strong><small>Tambah halaman informasi sekolah</small></span>
            </a>
            <a href="{{ $createPostUrl }}" class="sd-admin-dashboard__action">
                <span class="sd-admin-dashboard__action-icon" aria-hidden="true">＋</span>
                <span><strong>Tulis berita</strong><small>Bagikan kabar dan kegiatan terbaru</small></span>
            </a>
            <a href="{{ $heroSlidesUrl }}" class="sd-admin-dashboard__action">
                <span class="sd-admin-dashboard__action-icon" aria-hidden="true">▧</span>
                <span><strong>Atur foto beranda</strong><small>Pilih foto yang tampil di slideshow</small></span>
            </a>
        </section>

        <p class="sd-admin-dashboard__note">Konten berstatus draft tidak terlihat oleh pengunjung. Periksa pratinjau sebelum menerbitkan perubahan.</p>
    </div>
</x-filament-widgets::widget>
