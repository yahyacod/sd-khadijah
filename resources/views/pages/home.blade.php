@extends('layouts.app')

@section('title', 'SD Khadijah Wonorejo - Sekolah Pemimpin yang Santun')

@section('content')

{{-- ============ HERO ============ --}}
<section class="hero hero-backdrop">
    @if($heroSlides->count())
    <div class="hero-slideshow" id="heroSlideshow">
        @foreach($heroSlides as $index => $img)
        <img src="{{ asset('storage/' . $img) }}" alt="Kegiatan Siswa SD Khadijah Wonorejo" loading="eager" fetchpriority="high" decoding="async" class="{{ $index === 0 ? 'is-active' : '' }}">
        @endforeach
    </div>
    <div class="hero-overlay"></div>
    @endif
    <div class="wrap hero-inner">
        <h1 class="display" style="font-size: clamp(2.2rem, 5vw, 3.4rem); color: #FFF;">
            SD Khadijah Wonorejo
        </h1>
        <div style="background: rgba(18, 51, 42, 0.78); border-left: 4px solid var(--gold); padding: 20px 24px; margin-top: 18px; max-width: 620px; border-radius: 0 12px 12px 0; backdrop-filter: blur(8px);">
            <p style="margin:0; color: #F3F0E6; font-size: 1.05rem; line-height: 1.65;">
                <strong>"Sekolah Pemimpin yang Santun"</strong>: Mendidik generasi muslim berakhlak mulia, percaya diri, dan berlandaskan nilai Ahlussunnah wal Jamaah An-Nahdliyah.
            </p>
        </div>

        <div style="margin-top: 28px; display:flex; gap: 14px; flex-wrap: wrap; align-items: center;">
            <a href="https://khareg.netlify.app" target="_blank" rel="noopener" class="btn btn-gold" style="box-shadow: 0 4px 14px rgba(185, 138, 42, 0.35);">
                Pendaftaran SPMB Online
            </a>
            <button type="button" class="btn" id="openVideoTourBtn" style="background: rgba(255,255,255,0.14); color:#fff; border:1px solid rgba(255,255,255,0.35); display: inline-flex; align-items: center; gap: 8px; cursor: pointer;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M8 5v14l11-7z" />
                </svg>
                Tonton Profil Sekolah
            </button>

        </div>

        {{-- Interactive Hero Slideshow Indicators --}}
        @if($heroSlides->count() > 1)
        <div class="hero-slide-nav" id="heroSlideNav" style="display: flex; gap: 8px; margin-top: 24px; align-items: center;">
            @foreach($heroSlides as $index => $img)
            <button type="button" class="hero-dot {{ $index === 0 ? 'is-active' : '' }}" data-slide="{{ $index }}" aria-label="Slide {{ $index + 1 }}" style="width: 28px; height: 6px; border-radius: 3px; border: none; background: rgba(255,255,255,0.3); cursor: pointer; transition: all .3s ease;"></button>
            @endforeach
        </div>
        @endif

        {{-- Interactive Highlight Cards --}}
        <div style="margin-top: 42px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; border-top: 1px solid rgba(255,255,255,0.18); padding-top: 24px;">
            <div class="interactive-highlight-card" style="display: flex; flex-direction: column; gap: 4px; padding: 12px; border-radius: 8px; transition: background .2s ease; cursor: default;">
                <span style="font-family: 'Fraunces', serif; color: var(--gold-light); font-size: 1.1rem; font-weight: 600;">Kepemimpinan Santun</span>
                <span style="color: #D9E6DC; font-size: 0.88rem;">Menumbuhkan keberanian &amp; tanggung jawab sejak dini.</span>
            </div>
            <div class="interactive-highlight-card" style="display: flex; flex-direction: column; gap: 4px; padding: 12px; border-radius: 8px; transition: background .2s ease; cursor: default;">
                <span style="font-family: 'Fraunces', serif; color: var(--gold-light); font-size: 1.1rem; font-weight: 600;">Amaliah An-Nahdliyah</span>
                <span style="color: #D9E6DC; font-size: 0.88rem;">Pembiasaan sholat berjamaah &amp; adab Islami sehari-hari.</span>
            </div>
            <div class="interactive-highlight-card" style="display: flex; flex-direction: column; gap: 4px; padding: 12px; border-radius: 8px; transition: background .2s ease; cursor: default;">
                <span style="font-family: 'Fraunces', serif; color: var(--gold-light); font-size: 1.1rem; font-weight: 600;">Pengembangan Potensi</span>
                <span style="color: #D9E6DC; font-size: 0.88rem;">Dukungan penuh bakat akademik, sains, &amp; seni budaya.</span>
            </div>
        </div>
    </div>
</section>

{{-- ============ TENTANG SEKOLAH ============ --}}
<section class="section">
    <div class="wrap">
        @if($home && trim(strip_tags($home->body ?? '')) !== '')
        <div style="display:grid; grid-template-columns: {{ $home->featured_image ? '1.2fr 0.8fr' : '1fr' }}; gap: 48px; align-items:center;">
            <article class="content-body reveal">
                <h2 style="font-size: 2rem; color: var(--green-deep); margin-bottom: 20px;">
                    Mendidik dengan Hati, Membentuk Karakter Pemimpin
                </h2>
                {!! $home->body !!}
            </article>
            @if($home->featured_image)
            <div class="reveal" style="position: relative; overflow: hidden; border-radius: var(--radius); box-shadow: var(--shadow-lift);">
                <img src="{{ asset('storage/' . $home->featured_image) }}" alt="{{ $home->title }}"
                    style="width: 100%; object-fit: cover; transition: transform .5s ease;" loading="lazy" decoding="async" class="zoomable-about-img">
            </div>
            @endif
        </div>
        @else
        <div class="empty-state">
            Halaman Beranda belum diisi dari panel admin. Kelola konten utama melalui <strong>Admin &rarr; Halaman &rarr; Beranda</strong>.
        </div>
        @endif
    </div>
</section>

{{-- ============ INTERACTIVE PROGRAM EXPLORER (TABBED VIEW) ============ --}}
<section class="section" style="background: var(--green-tint); padding: 72px 0;">
    <div class="wrap">
        <div class="reveal" style="max-width: 680px; margin-bottom: 36px;">
            <h2 style="font-size: 2.1rem; color: var(--green-deep);">Pilar &amp; Program Keunggulan Sekolah</h2>
            <p style="color: var(--muted); font-size: 1.05rem; margin-top: 6px;">
                Klik pilar di bawah untuk menjelajahi kurikulum dan pembiasaan siswa secara interaktif.
            </p>
        </div>

        {{-- Tab Controls --}}
        <div class="program-tabs-nav reveal" style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 28px; border-bottom: 2px solid var(--line); padding-bottom: 12px;">
            <button type="button" class="program-tab-btn is-active" data-tab="kepemimpinan" style="padding: 10px 20px; border-radius: 999px; border: 1px solid var(--green); background: var(--green); color: #fff; font-weight: 600; font-size: 0.92rem; cursor: pointer; transition: all .25s ease;">
                Kepemimpinan Santun
            </button>
            <button type="button" class="program-tab-btn" data-tab="aswaja" style="padding: 10px 20px; border-radius: 999px; border: 1px solid var(--line); background: var(--card); color: var(--ink); font-weight: 600; font-size: 0.92rem; cursor: pointer; transition: all .25s ease;">
                Akhlak &amp; Aswaja
            </button>
            <button type="button" class="program-tab-btn" data-tab="prestasi" style="padding: 10px 20px; border-radius: 999px; border: 1px solid var(--line); background: var(--card); color: var(--ink); font-weight: 600; font-size: 0.92rem; cursor: pointer; transition: all .25s ease;">
                Pengembangan Prestasi
            </button>
            <button type="button" class="program-tab-btn" data-tab="lingkungan" style="padding: 10px 20px; border-radius: 999px; border: 1px solid var(--line); background: var(--card); color: var(--ink); font-weight: 600; font-size: 0.92rem; cursor: pointer; transition: all .25s ease;">
                Fasilitas &amp; Lingkungan
            </button>
        </div>

        {{-- Tab Panels --}}
        <div class="program-tabs-content reveal">
            {{-- Panel 1: Kepemimpinan --}}
            <div class="program-panel is-active" id="panel-kepemimpinan" style="display: block;">
                <div class="card" style="background: var(--green-deep); color: #FFF; padding: 36px 32px; border-radius: var(--radius); border-left: 6px solid var(--gold);">
                    <span style="display: inline-block; background: rgba(231, 200, 120, 0.2); color: var(--gold-light); font-size: 0.78rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; padding: 4px 12px; border-radius: 4px; margin-bottom: 16px;">Program Unggulan #1</span>
                    <h3 style="color: #FFF; font-size: 1.5rem; margin-bottom: 12px;">Pendidikan Kepemimpinan yang Santun</h3>
                    <p style="color: #D9E6DC; font-size: 1rem; line-height: 1.65; max-width: 780px; margin-bottom: 24px;">
                        Membentuk murid yang percaya diri berbicara di depan umum, mampu mengorganisir kegiatan siswa, serta memiliki keteladanan adab dalam berinteraksi dengan sesama teman dan guru.
                    </p>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; border-top: 1px solid rgba(255,255,255,0.15); padding-top: 20px;">
                        <div style="display: flex; align-items: center; gap: 10px; color: #E7EFE8; font-size: 0.94rem;">
                            <span style="color: var(--gold-light); font-weight: bold; font-size: 1.1rem;">✓</span> Pelatihan Leadership &amp; Organisasi Siswa
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px; color: #E7EFE8; font-size: 0.94rem;">
                            <span style="color: var(--gold-light); font-weight: bold; font-size: 1.1rem;">✓</span> Pembiasaan Public Speaking &amp; Diksi Santun
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px; color: #E7EFE8; font-size: 0.94rem;">
                            <span style="color: var(--gold-light); font-weight: bold; font-size: 1.1rem;">✓</span> Kegiatan Pramuka &amp; Bakti Sosial
                        </div>
                    </div>
                </div>
            </div>

            {{-- Panel 2: Aswaja --}}
            <div class="program-panel" id="panel-aswaja" style="display: none;">
                <div class="card" style="background: var(--card); padding: 36px 32px; border-radius: var(--radius); border-left: 6px solid var(--green);">
                    <span style="display: inline-block; background: var(--green-tint); color: var(--green-deep); font-size: 0.78rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; padding: 4px 12px; border-radius: 4px; margin-bottom: 16px;">Program Unggulan #2</span>
                    <h3 style="color: var(--green-deep); font-size: 1.5rem; margin-bottom: 12px;">Penanaman Akhlak Mulia &amp; Nilai Aswaja An-Nahdliyah</h3>
                    <p style="color: var(--muted); font-size: 1rem; line-height: 1.65; max-width: 780px; margin-bottom: 24px;">
                        Pembiasaan ibadah harian dan keteladanan adab Islami tertanam secara konsisten dalam rutinitas siswa sejak masuk pintu gerbang sekolah hingga selesai pembelajaran.
                    </p>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; border-top: 1px solid var(--line); padding-top: 20px;">
                        <div style="display: flex; align-items: center; gap: 10px; color: var(--ink); font-size: 0.94rem;">
                            <span style="color: var(--green); font-weight: bold; font-size: 1.1rem;">✓</span> Sholat Dhuha &amp; Dzuhur Berjamaah Rutin
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px; color: var(--ink); font-size: 0.94rem;">
                            <span style="color: var(--green); font-weight: bold; font-size: 1.1rem;">✓</span> Tadarus Al-Qur'an &amp; Hafalan Juz Amma
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px; color: var(--ink); font-size: 0.94rem;">
                            <span style="color: var(--green); font-weight: bold; font-size: 1.1rem;">✓</span> Penguatan Adab 5S (Senyum, Salam, Sapa, Sopan, Santun)
                        </div>
                    </div>
                </div>
            </div>

            {{-- Panel 3: Prestasi --}}
            <div class="program-panel" id="panel-prestasi" style="display: none;">
                <div class="card" style="background: var(--card); padding: 36px 32px; border-radius: var(--radius); border-left: 6px solid var(--gold);">
                    <span style="display: inline-block; background: rgba(231, 200, 120, 0.25); color: var(--gold); font-size: 0.78rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; padding: 4px 12px; border-radius: 4px; margin-bottom: 16px;">Program Unggulan #3</span>
                    <h3 style="color: var(--green-deep); font-size: 1.5rem; margin-bottom: 12px;">Pengembangan Bakat &amp; Pembinaan Prestasi</h3>
                    <p style="color: var(--muted); font-size: 1rem; line-height: 1.65; max-width: 780px; margin-bottom: 24px;">
                        Setiap anak unik dan memiliki potensi unggul. Sekolah menyediakan pendampingan intensif baik untuk olimpiade akademikm maupun minat seni, olah raga, dan teknologi.
                    </p>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; border-top: 1px solid var(--line); padding-top: 20px;">
                        <div style="display: flex; align-items: center; gap: 10px; color: var(--ink); font-size: 0.94rem;">
                            <span style="color: var(--gold); font-weight: bold; font-size: 1.1rem;">✓</span> Coaching Olimipade Sains &amp; Matematika
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px; color: var(--ink); font-size: 0.94rem;">
                            <span style="color: var(--gold); font-weight: bold; font-size: 1.1rem;">✓</span> Ekstrakurikuler Seni Budaya &amp; Olahraga
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px; color: var(--ink); font-size: 0.94rem;">
                            <span style="color: var(--gold); font-weight: bold; font-size: 1.1rem;">✓</span> Apresiasi &amp; Pentas Unjuk Karya Siswa
                        </div>
                    </div>
                </div>
            </div>

            {{-- Panel 4: Lingkungan --}}
            <div class="program-panel" id="panel-lingkungan" style="display: none;">
                <div class="card" style="background: var(--card); padding: 36px 32px; border-radius: var(--radius); border-left: 6px solid var(--green-light);">
                    <span style="display: inline-block; background: var(--green-tint); color: var(--green-deep); font-size: 0.78rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; padding: 4px 12px; border-radius: 4px; margin-bottom: 16px;">Program Unggulan #4</span>
                    <h3 style="color: var(--green-deep); font-size: 1.5rem; margin-bottom: 12px;">Fasilitas Pembelajaran yang Kondusif &amp; Aman</h3>
                    <p style="color: var(--muted); font-size: 1rem; line-height: 1.65; max-width: 780px; margin-bottom: 24px;">
                        Ruang kelas yang nyaman, tempat ibadah yang luas, dan lingkungan sekolah yang bersih serta aman mendukung konsentrasi belajar siswa secara maksimal.
                    </p>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; border-top: 1px solid var(--line); padding-top: 20px;">
                        <div style="display: flex; align-items: center; gap: 10px; color: var(--ink); font-size: 0.94rem;">
                            <span style="color: var(--green-light); font-weight: bold; font-size: 1.1rem;">✓</span> Ruang Kelas Ber-AC &amp; Media Interaktif
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px; color: var(--ink); font-size: 0.94rem;">
                            <span style="color: var(--green-light); font-weight: bold; font-size: 1.1rem;">✓</span> Masjid / Musholla Pembiasaan Ibadah
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px; color: var(--ink); font-size: 0.94rem;">
                            <span style="color: var(--green-light); font-weight: bold; font-size: 1.1rem;">✓</span> Perpustakaan &amp; Area Bermain Ramah Anak
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ============ GALERI SEKOLAH ============ --}}
@if($galleryImages->count())
<section class="section" style="padding-bottom: 32px;">
    <div class="wrap">
        <div style="display:flex; align-items:flex-end; justify-content:space-between; margin-bottom: 28px;" class="reveal">
            <div>
                <h2 style="font-size: 2rem; color: var(--green-deep); margin: 0;">Dokumentasi Momen &amp; Kegiatan</h2>
                <p style="color: var(--muted); font-size: 0.98rem; margin: 4px 0 0;">Klik foto untuk melihat dalam ukuran penuh.</p>
            </div>
            <span style="font-size: 0.88rem; color: var(--muted); font-style: italic;">Geser untuk melihat foto lainnya &rarr;</span>
        </div>
    </div>

    <div class="swiper gallery-swiper wrap">
        <div class="swiper-wrapper">
            @foreach($galleryImages as $image)
            <div class="swiper-slide">
                <img src="{{ asset('storage/' . $image) }}" alt="Dokumentasi SD Khadijah Wonorejo" loading="lazy" decoding="async">
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>
@endif

{{-- ============ BERITA TERBARU ============ --}}
@if($latestPosts->count())
<section class="section">
    <div class="wrap">
        <div style="display:flex; align-items:flex-end; justify-content:space-between; margin-bottom: 32px;" class="reveal">
            <div>
                <h2 style="font-size: 2rem; color: var(--green-deep); margin:0;">Berita &amp; Informasi Terbaru</h2>
                <p style="color: var(--muted); font-size: 0.96rem; margin: 4px 0 0;">Kabar kegiatan sekolah, pengumuman, dan artikel edukasi.</p>
            </div>
            <a href="{{ route('posts.index') }}" style="color: var(--green); font-weight: 600; font-size: 0.92rem; border-bottom: 2px solid var(--gold); padding-bottom: 2px; transition: color .2s ease;">
                Lihat Semua Berita
            </a>
        </div>

        <div class="grid-cards">
            @foreach($latestPosts as $post)
            @include('partials.post-card', ['post' => $post])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ============ INTERACTIVE SPMB ENROLLMENT STEPS (ACCORDION WIDGET) ============ --}}
<section class="section" style="background: var(--card); border-top: 1px solid var(--line); padding: 72px 0;">
    <div class="wrap" style="max-width: 900px;">
        <div class="reveal" style="text-align: center; margin-bottom: 40px;">
            <h2 style="font-size: 2.1rem; color: var(--green-deep); margin-bottom: 8px;">Alur Pendaftaran Murid Baru (SPMB)</h2>
            <p style="color: var(--muted); font-size: 1.02rem;">Tahapan mudah bergabung menjadi bagian dari keluarga besar SD Khadijah Wonorejo.</p>
        </div>

        <div class="spmb-accordion-list reveal" style="display: flex; flex-direction: column; gap: 14px;">
            {{-- Step 1 --}}
            <div class="spmb-accordion-item is-open" style="border: 1px solid var(--line); border-radius: var(--radius); overflow: hidden; transition: all .25s ease;">
                <button type="button" class="spmb-accordion-trigger" style="width: 100%; padding: 18px 24px; background: var(--green-tint); border: none; text-align: left; font-size: 1.08rem; font-weight: 600; color: var(--green-deep); display: flex; align-items: center; justify-content: space-between; cursor: pointer;">
                    <span style="display: flex; align-items: center; gap: 14px;">
                        <span style="display: inline-flex; width: 32px; height: 32px; border-radius: 50%; background: var(--green); color: #fff; align-items: center; justify-content: center; font-size: 0.9rem;">1</span>
                        Pengisian Formulir Online (SPMB)
                    </span>
                    <span class="spmb-accordion-icon" style="font-size: 1.2rem; transition: transform .3s ease;">−</span>
                </button>
                <div class="spmb-accordion-content" style="padding: 20px 24px; display: block; background: var(--card); color: var(--muted); font-size: 0.96rem; line-height: 1.6;">
                    Wali calon murid dapat mengisi formulir pendaftaran secara daring melalui portal resmi SPMB atau datang langsung ke ruang sekretariat pendaftaran SD Khadijah Wonorejo.
                    <div style="margin-top: 14px;">
                        <a href="https://khareg.netlify.app" target="_blank" rel="noopener" class="btn btn-gold" style="padding: 8px 18px; font-size: 0.88rem;">Buka Formulir SPMB Online</a>
                    </div>
                </div>
            </div>

            {{-- Step 2 --}}
            <div class="spmb-accordion-item" style="border: 1px solid var(--line); border-radius: var(--radius); overflow: hidden; transition: all .25s ease;">
                <button type="button" class="spmb-accordion-trigger" style="width: 100%; padding: 18px 24px; background: var(--bg); border: none; text-align: left; font-size: 1.08rem; font-weight: 600; color: var(--green-deep); display: flex; align-items: center; justify-content: space-between; cursor: pointer;">
                    <span style="display: flex; align-items: center; gap: 14px;">
                        <span style="display: inline-flex; width: 32px; height: 32px; border-radius: 50%; background: var(--green-tint); color: var(--green-deep); align-items: center; justify-content: center; font-size: 0.9rem;">2</span>
                        Pemetaan Potensi &amp; Wawancara Orang Tua
                    </span>
                    <span class="spmb-accordion-icon" style="font-size: 1.2rem; transition: transform .3s ease;">+</span>
                </button>
                <div class="spmb-accordion-content" style="padding: 20px 24px; display: none; background: var(--card); color: var(--muted); font-size: 0.96rem; line-height: 1.6;">
                    Pelaksanaan pemetaan kesiapan belajar anak yang ramah dan menyenangkan, serta sesi wawancara silaturahmi bersama tim psikolog/pendidik sekolah dengan orang tua siswa.
                </div>
            </div>

            {{-- Step 3 --}}
            <div class="spmb-accordion-item" style="border: 1px solid var(--line); border-radius: var(--radius); overflow: hidden; transition: all .25s ease;">
                <button type="button" class="spmb-accordion-trigger" style="width: 100%; padding: 18px 24px; background: var(--bg); border: none; text-align: left; font-size: 1.08rem; font-weight: 600; color: var(--green-deep); display: flex; align-items: center; justify-content: space-between; cursor: pointer;">
                    <span style="display: flex; align-items: center; gap: 14px;">
                        <span style="display: inline-flex; width: 32px; height: 32px; border-radius: 50%; background: var(--green-tint); color: var(--green-deep); align-items: center; justify-content: center; font-size: 0.9rem;">3</span>
                        Pengumuman &amp; Daftar Ulang
                    </span>
                    <span class="spmb-accordion-icon" style="font-size: 1.2rem; transition: transform .3s ease;">+</span>
                </button>
                <div class="spmb-accordion-content" style="padding: 20px 24px; display: none; background: var(--card); color: var(--muted); font-size: 0.96rem; line-height: 1.6;">
                    Pengumuman penerimaan disampaikan secara transparan via website &amp; WhatsApp. Calon murid yang diterima melengkapi berkas administrasi dan seragam sekolah.
                </div>
            </div>

            {{-- Step 4 --}}
            <div class="spmb-accordion-item" style="border: 1px solid var(--line); border-radius: var(--radius); overflow: hidden; transition: all .25s ease;">
                <button type="button" class="spmb-accordion-trigger" style="width: 100%; padding: 18px 24px; background: var(--bg); border: none; text-align: left; font-size: 1.08rem; font-weight: 600; color: var(--green-deep); display: flex; align-items: center; justify-content: space-between; cursor: pointer;">
                    <span style="display: flex; align-items: center; gap: 14px;">
                        <span style="display: inline-flex; width: 32px; height: 32px; border-radius: 50%; background: var(--green-tint); color: var(--green-deep); align-items: center; justify-content: center; font-size: 0.9rem;">4</span>
                        Masa Pengenalan Lingkungan Sekolah (MPLS)
                    </span>
                    <span class="spmb-accordion-icon" style="font-size: 1.2rem; transition: transform .3s ease;">+</span>
                </button>
                <div class="spmb-accordion-content" style="padding: 20px 24px; display: none; background: var(--card); color: var(--muted); font-size: 0.96rem; line-height: 1.6;">
                    Siswa baru mengikuti kegiatan penyambutan hangat MPLS untuk mengenal lingkungan sekolah, teman seangkatan, dan para ustaz/ustazah.
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============ LOKASI ============ --}}
<section class="section" style="padding-top: 40px;">
    <div class="wrap">
        <div class="reveal" style="margin-bottom: 24px;">
            <h2 style="font-size: 2rem; color: var(--green-deep); margin-bottom: 6px;">Lokasi Sekolah</h2>
            <p style="color: var(--muted); font-size: 0.96rem; margin: 0;">Silakan kunjungi lokasi SD Khadijah Wonorejo Surabaya.</p>
        </div>
        <div class="map-frame reveal">
            <iframe src="https://www.google.com/maps?q=SD+Khadijah+Wonorejo+Surabaya&output=embed" loading="lazy" title="Peta Lokasi SD Khadijah Wonorejo"></iframe>
        </div>
    </div>
</section>

{{-- ============ CTA PENUTUP ============ --}}
<section class="hero-backdrop" style="text-align:center; padding: 80px 0;">
    <div class="wrap" style="max-width: 680px;">
        <h2 style="color:#FFF; font-size: 2.2rem; margin: 0 auto 16px;">
            Siapkan Masa Depan Buah Hati Bersama Kami
        </h2>
        <p style="color:#D9E6DC; font-size: 1.08rem; margin: 0 auto 32px; line-height: 1.6;">
            Pendaftaran Murid Baru (SPMB) SD Khadijah Wonorejo telah dibuka. Dapatkan informasi kuota, alur pendaftaran, dan konsultasi dengan tim pengajar.
        </p>
        <a href="https://khareg.netlify.app" target="_blank" rel="noopener" class="btn btn-gold" style="font-size: 1.05rem; padding: 14px 32px; box-shadow: 0 4px 18px rgba(185, 138, 42, 0.4);">
            Pendaftaran SPMB Online
        </a>
    </div>
</section>

{{-- Modal Video Tour --}}
<div id="videoTourModal" class="lightbox" style="display:none;">
    <button class="lightbox-close" id="closeVideoTourBtn" aria-label="Tutup Video">&times;</button>
    <div style="width: 100%; max-width: 860px; aspect-ratio: 16/9; background: #000; border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow-lift);">
        <iframe id="videoTourIframe" src="" data-video-src="{{ $videoEmbedUrl }}" title="Video Profil SD Khadijah Wonorejo" style="width:100%; height:100%; border:none;" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // --- 1. Program Tab Switcher ---
        const tabBtns = document.querySelectorAll('.program-tab-btn');
        const panels = document.querySelectorAll('.program-panel');

        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const targetTab = btn.dataset.tab;

                tabBtns.forEach(b => {
                    b.classList.remove('is-active');
                    b.style.background = 'var(--card)';
                    b.style.color = 'var(--ink)';
                    b.style.borderColor = 'var(--line)';
                });

                btn.classList.add('is-active');
                btn.style.background = 'var(--green)';
                btn.style.color = '#fff';
                btn.style.borderColor = 'var(--green)';

                panels.forEach(panel => {
                    if (panel.id === `panel-${targetTab}`) {
                        panel.style.display = 'block';
                    } else {
                        panel.style.display = 'none';
                    }
                });
            });
        });

        // --- 2. SPMB Accordion Switcher ---
        const accordionItems = document.querySelectorAll('.spmb-accordion-item');

        accordionItems.forEach(item => {
            const trigger = item.querySelector('.spmb-accordion-trigger');
            const content = item.querySelector('.spmb-accordion-content');
            const icon = item.querySelector('.spmb-accordion-icon');
            const numBadge = item.querySelector('span > span');

            trigger.addEventListener('click', () => {
                const isOpen = item.classList.contains('is-open');

                accordionItems.forEach(otherItem => {
                    otherItem.classList.remove('is-open');
                    otherItem.querySelector('.spmb-accordion-content').style.display = 'none';
                    otherItem.querySelector('.spmb-accordion-icon').textContent = '+';
                    otherItem.querySelector('.spmb-accordion-trigger').style.background = 'var(--bg)';
                    const otherBadge = otherItem.querySelector('span > span');
                    if (otherBadge) {
                        otherBadge.style.background = 'var(--green-tint)';
                        otherBadge.style.color = 'var(--green-deep)';
                    }
                });

                if (!isOpen) {
                    item.classList.add('is-open');
                    content.style.display = 'block';
                    icon.textContent = '−';
                    trigger.style.background = 'var(--green-tint)';
                    if (numBadge) {
                        numBadge.style.background = 'var(--green)';
                        numBadge.style.color = '#fff';
                    }
                }
            });
        });

        // --- 3. Interactive Hero Slideshow Dot Nav ---
        const heroDots = document.querySelectorAll('.hero-dot');
        const heroImgs = document.querySelectorAll('.hero-slideshow img');

        if (heroDots.length > 0 && heroImgs.length > 0) {
            heroDots.forEach((dot, idx) => {
                dot.addEventListener('click', () => {
                    heroDots.forEach(d => {
                        d.classList.remove('is-active');
                        d.style.background = 'rgba(255,255,255,0.3)';
                        d.style.width = '28px';
                    });
                    heroImgs.forEach(img => img.classList.remove('is-active'));

                    dot.classList.add('is-active');
                    dot.style.background = 'var(--gold)';
                    dot.style.width = '42px';
                    heroImgs[idx].classList.add('is-active');
                });
            });
        }

        // --- 4. Interactive Video Tour Modal ---
        const openVideoBtn = document.getElementById('openVideoTourBtn');
        const closeVideoBtn = document.getElementById('closeVideoTourBtn');
        const videoModal = document.getElementById('videoTourModal');
        const videoIframe = document.getElementById('videoTourIframe');

        if (openVideoBtn && videoModal && videoIframe) {
            openVideoBtn.addEventListener('click', () => {
                const targetUrl = videoIframe.dataset.videoSrc || "https://www.youtube.com/embed/Rn78qED3ir0?autoplay=1&rel=0";
                videoIframe.src = targetUrl;
                videoModal.style.display = 'flex';
                videoModal.classList.add('is-open');
            });

            const closeVideo = () => {
                videoIframe.src = "";
                videoModal.style.display = 'none';
                videoModal.classList.remove('is-open');
            };

            if (closeVideoBtn) closeVideoBtn.addEventListener('click', closeVideo);
            videoModal.addEventListener('click', (e) => {
                if (e.target === videoModal) closeVideo();
            });
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && videoModal.classList.contains('is-open')) closeVideo();
            });
        }
    });
</script>
@endpush