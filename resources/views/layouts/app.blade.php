<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SD Khadijah Wonorejo')</title>
    <meta name="description" content="@yield('meta_description', 'SD Khadijah Wonorejo Sekolah Pemimpin yang Santun.')">

    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="SD Khadijah Wonorejo">
    <meta property="og:title" content="@yield('title', 'SD Khadijah Wonorejo')">
    <meta property="og:description" content="@yield('meta_description', 'SD Khadijah Wonorejo — Sekolah Pemimpin yang Santun.')">
    <meta property="og:url" content="{{ url()->current() }}">
    @hasSection('og_image')
    <meta property="og:image" content="@yield('og_image')">
    @endif

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'SD Khadijah Wonorejo')">
    <meta name="twitter:description" content="@yield('meta_description', 'SD Khadijah Wonorejo — Sekolah Pemimpin yang Santun.')">
    @hasSection('og_image')
    <meta name="twitter:image" content="@yield('og_image')">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Open Props: design tokens (shadow, gradient, animasi) tanpa build step -->
    <link rel="stylesheet" href="https://unpkg.com/open-props">
    <link rel="stylesheet" href="https://unpkg.com/open-props/normalize.min.css">

    <!-- AOS: animasi scroll siap pakai (fade, zoom, slide) -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">

    <!-- Swiper: untuk slideshow/carousel galeri foto -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@11/swiper-bundle.min.css">

    <style>
        :root {
            --bg: #FAF7F0;
            --ink: #24261F;
            --muted: #6E7061;
            --line: #E6E1D3;
            --card: #FFFFFF;
            --green-deep: #12332A;
            --green: #1F4D3A;
            --green-action: #1F4D3A;
            --green-light: #2E6B51;
            --green-tint: #E7EFE8;
            --gold: #B98A2A;
            --gold-light: #E7C878;
            --glass: rgba(255, 255, 255, 0.6);
            --glass-border: rgba(255, 255, 255, 0.4);
            --radius: var(--radius-3);
            --shadow-soft: var(--shadow-3);
            --shadow-lift: var(--shadow-5);
        }

        html.dark {
            color-scheme: dark;
            --bg: #101B17;
            --ink: #EDF3EC;
            --muted: #AEBFB3;
            --line: #30483B;
            --card: #172720;
            --green-deep: #0A2118;
            --green: #A5D3B8;
            --green-action: #1F4D3A;
            --green-light: #5AA47D;
            --green-tint: #203D30;
            --gold: #E7C568;
            --gold-light: #F0D98F;
            --glass: rgba(23, 39, 32, 0.78);
            --glass-border: rgba(221, 239, 226, 0.18);
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--ink);
            font-family: 'Plus Jakarta Sans', sans-serif;
            line-height: 1.6;
            overflow-x: hidden;
            animation: page-fade .4s ease;
            transition: background-color .25s ease, color .25s ease;
        }

        button,
        input,
        select,
        textarea {
            font: inherit;
        }

        input,
        select,
        textarea {
            color: var(--ink);
            background-color: var(--card);
            border-color: var(--line);
        }

        input::placeholder,
        textarea::placeholder {
            color: var(--muted);
            opacity: 1;
        }

        :focus-visible {
            outline: 3px solid var(--gold);
            outline-offset: 3px;
        }

        @keyframes page-fade {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        h1,
        h2,
        h3,
        .display {
            font-family: 'Fraunces', serif;
            font-weight: 600;
            line-height: 1.12;
            color: var(--green);
            margin: 0 0 0.5em;
            letter-spacing: -0.01em;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        img {
            max-width: 100%;
            display: block;
        }

        .wrap {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .eyebrow {
            display: inline-block;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 10px;
        }

        /* --- Signature: garis motif geometris tipis --- */
        .motif-line {
            height: 5px;
            background-image: linear-gradient(45deg, var(--gold) 25%, transparent 25%),
                linear-gradient(-45deg, var(--gold) 25%, transparent 25%);
            background-size: 10px 10px;
            opacity: 0.5;
            position: relative;
            z-index: 2;
        }

        /* --- Header: liquid glass (transparan + saturate, gaya iOS) --- */
        header.site {
            position: sticky;
            top: 0;
            z-index: 50;
            padding: 14px 20px 0;
        }

        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            max-width: 1280px;
            margin: 0 auto;
            padding: 12px 22px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.55);
            border: 1px solid rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(22px) saturate(180%);
            -webkit-backdrop-filter: blur(22px) saturate(180%);
            box-shadow: 0 8px 32px rgba(18, 51, 42, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.5);
            transition: border-radius .25s ease, padding .25s ease;
        }

        html.dark .header-inner {
            background: rgba(16, 27, 23, 0.78);
            border-color: rgba(231, 213, 143, 0.22);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.24), inset 0 1px 0 rgba(255, 255, 255, 0.08);
        }

        html:not(.dark) .header-inner {
            background: var(--glass);
            border-color: var(--glass-border);
        }

        .brand {
            font-family: 'Fraunces', serif;
            font-weight: 700;
            font-size: 1.05rem;
            color: var(--green-deep);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand small {
            display: block;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 400;
            font-size: 0.64rem;
            color: var(--muted);
            letter-spacing: 0.07em;
            text-transform: uppercase;
            margin-top: 2px;
        }

        nav.main-nav {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
            font-size: 0.83rem;
        }

        nav.main-nav a {
            color: var(--ink);
            padding: 6px 0;
            border-bottom: 2px solid transparent;
            transition: border-color .18s ease, color .18s ease;
        }

        nav.main-nav a:hover {
            color: var(--green);
            border-bottom-color: var(--gold);
        }

        .nav-home {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--green-tint);
            color: var(--green-deep);
            border-bottom: none !important;
            flex-shrink: 0;
        }

        .nav-home:hover {
            background: var(--gold-light);
            color: var(--green-deep);
        }

        .nav-home-label {
            display: none;
        }

        .nav-toggle {
            display: none;
            background: rgba(31, 77, 58, 0.08);
            border: 1px solid rgba(31, 77, 58, 0.15);
            border-radius: 8px;
            padding: 8px 12px;
            color: var(--green-deep);
            font-size: 1rem;
            cursor: pointer;
        }

        .theme-toggle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            position: fixed;
            top: 22px;
            right: 28px;
            z-index: 60;
            margin: 0;
            border: 1px solid rgba(31, 77, 58, 0.15);
            border-radius: 50%;
            background: rgba(31, 77, 58, 0.08);
            color: var(--green-deep);
            cursor: pointer;
            transition: background .2s ease, color .2s ease, border-color .2s ease;
        }

        .theme-toggle:hover {
            background: var(--gold-light);
            border-color: var(--gold);
        }

        .theme-toggle .icon-sun,
        html.dark .theme-toggle .icon-moon {
            display: none;
        }

        html.dark .theme-toggle {
            border-color: rgba(231, 213, 143, 0.28);
            background: rgba(231, 213, 143, 0.12);
            color: var(--gold-light);
        }

        html.dark .theme-toggle .icon-sun {
            display: block;
        }

        html.dark .brand {
            color: #fff;
        }

        html.dark :is(h1, h2, h3, .display) {
            color: #fff !important;
        }

        html.dark [style*="color: var(--green-deep)"] {
            color: #fff !important;
        }

        html.dark nav.main-nav a {
            color: #edf3ec;
        }

        html.dark nav.main-nav a:hover {
            color: #f0d98f;
        }

        html.dark .nav-home {
            background: #203d30;
            color: #f0d98f;
        }

        html.dark .nav-home:hover {
            background: #5aa47d;
            color: #102019;
        }

        html.dark .nav-toggle {
            background: rgba(231, 213, 143, 0.12);
            border-color: rgba(231, 213, 143, 0.28);
            color: #f0d98f;
        }

        @media (max-width: 1400px) {
            .nav-toggle {
                display: block;
                margin-right: 48px;
            }

            .header-inner {
                border-radius: 26px;
            }

            nav.main-nav {
                display: none;
                flex-direction: column;
                gap: 4px;
                width: 100%;
                padding-top: 10px;
                border-top: 1px solid rgba(31, 77, 58, 0.12);
                margin-top: 10px;
            }

            nav.main-nav.is-open {
                display: flex;
            }

            .header-inner {
                flex-wrap: wrap;
            }

            .nav-home {
                width: auto;
                height: auto;
                border-radius: 0;
                background: transparent;
                justify-content: flex-start;
                gap: 8px;
                padding: 6px 0;
                color: var(--ink);
            }

            .nav-home-label {
                display: inline;
            }
        }

        /* --- Authentic Hero Backdrop --- */
                /* --- Authentic Hero Backdrop --- */
        .hero-backdrop {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, var(--green-deep) 0%, var(--green) 100%);
        }

        html.dark .hero-backdrop {
            background: linear-gradient(135deg, #0A2118 0%, #173B2B 100%);
        }

        .hero-backdrop::after {
            content: "";
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(231, 200, 120, 0.08) 1px, transparent 1px);
            background-size: 24px 24px;
            pointer-events: none;
            opacity: 0.6;
        }

        /* --- Glass panel (liquid glass, gaya iOS) --- */
        .glass-panel {
            background: var(--glass);
            border: 1px solid var(--glass-border);
            border-top-color: rgba(255, 255, 255, 0.55);
            /* highlight tipis di atas, kesan kaca */
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            border-radius: var(--radius);
            box-shadow: var(--shadow-soft);
        }

        html.dark .floating-cta {
            background: var(--card);
            border-color: var(--line);
        }

        html.dark .glass-panel,
        html.dark .floating-cta {
            border-top-color: rgba(231, 213, 143, 0.2);
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.2), inset 0 1px 0 rgba(255, 255, 255, 0.06);
        }

        /* --- Glass card: varian .card yang transparan (dipakai di atas foto/gradasi) --- */
        .glass-card {
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-top-color: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(14px) saturate(180%);
            -webkit-backdrop-filter: blur(14px) saturate(180%);
            border-radius: var(--radius);
            color: #fff;
        }

        /* --- Floating glass CTA, mengambang di sambungan konten & footer --- */
        .floating-cta {
            max-width: 900px;
            margin: 0 auto;
            padding: 32px 36px;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.55);
            border: 1px solid rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            box-shadow: 0 20px 50px rgba(18, 51, 42, 0.18), inset 0 1px 0 rgba(255, 255, 255, 0.6);
            position: relative;
            z-index: 5;
            margin-top: -48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        /* --- Footer --- */
        footer.site {
            background: var(--green-deep);
            color: #C9D6CD;
            margin-top: 28px;
            position: relative;
        }

        .footer-inner {
            padding: 56px 24px 28px;
            display: grid;
            grid-template-columns: 1.4fr 1fr 1fr 1fr;
            gap: 32px;
            font-size: 0.9rem;
        }

        @media (max-width: 1000px) {
            .footer-inner {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 480px) {
            .footer-inner {
                grid-template-columns: 1fr;
            }
        }

        .footer-col h4 {
            color: #fff;
            font-family: 'Fraunces', serif;
            font-size: 0.95rem;
            margin: 0 0 14px;
        }

        .footer-col p,
        .footer-col li {
            color: #B7C8BE;
            line-height: 1.8;
        }

        .footer-col ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        footer.site a {
            transition: color .15s ease;
        }

        footer.site a:hover {
            color: #fff;
        }

        .footer-social {
            display: flex;
            gap: 10px;
            margin-top: 14px;
        }

        .footer-social a {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            font-size: 0.9rem;
            transition: background .2s ease, transform .2s ease;
        }

        .footer-social a:hover {
            background: var(--gold);
            transform: translateY(-2px);
            color: var(--green-deep) !important;
        }

        .footer-note {
            border-top: 1px solid rgba(255, 255, 255, 0.12);
            margin-top: 8px;
            padding: 16px 0;
            font-size: 0.8rem;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px;
            color: #8FA396;
        }

                /* --- Content blocks --- */
        .content-body {
            font-size: 1.02rem;
            line-height: 1.75;
        }

        .content-body h2 {
            font-size: 1.5rem;
            margin-top: 1.8em;
            margin-bottom: 0.6em;
        }

        .content-body h3 {
            font-size: 1.22rem;
            margin-top: 1.5em;
            margin-bottom: 0.5em;
        }

        .content-body p {
            margin: 0 0 1.25em;
        }

        .content-body img {
            border-radius: var(--radius);
            margin: 1.5em 0;
            box-shadow: var(--shadow-soft);
            max-width: 100%;
            height: auto;
        }

        .content-body blockquote {
            margin: 1.5em 0;
            padding: 16px 22px;
            border-left: 4px solid var(--gold);
            background: var(--green-tint);
            border-radius: 0 var(--radius) var(--radius) 0;
            font-style: italic;
            color: var(--ink);
        }

        .content-body table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5em 0;
            font-size: 0.92rem;
        }

        .content-body table th,
        .content-body table td {
            padding: 10px 14px;
            border: 1px solid var(--line);
            text-align: left;
        }

        .content-body table th {
            background: var(--green-tint);
            color: var(--ink);
            font-weight: 600;
        }

        .content-body ul,
        .content-body ol {
            padding-left: 1.4em;
            margin-bottom: 1.25em;
        }

        .content-body li {
            margin-bottom: 0.4em;
        }

        .content-body a {
            color: var(--green);
            text-decoration: underline;
            text-decoration-color: var(--gold);
            text-underline-offset: 3px;
        }

        /* --- Card --- */
        .card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: var(--radius);
            overflow: hidden;
            transition: transform .28s var(--ease-out-4), box-shadow .28s var(--ease-out-4), border-color .28s ease;
            will-change: transform;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-lift);
            border-color: transparent;
        }

        .card .thumb {
            overflow: hidden;
        }

        .card .thumb img {
            transition: transform .5s ease;
        }

        .card:hover .thumb img {
            transform: scale(1.06);
        }

        /* --- Scroll reveal --- */
        .reveal {
            opacity: 0;
            transform: translateY(18px);
            transition: opacity .6s var(--ease-out-3), transform .6s var(--ease-out-3);
        }

        .reveal.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        @media (prefers-reduced-motion: reduce) {
            .reveal {
                opacity: 1;
                transform: none;
                transition: none;
            }
        }

        /* --- Hero --- */
        .hero {
            padding: 72px 0 90px;
            color: #fff;
            background: linear-gradient(180deg, var(--green-deep), var(--green));
        }

        html.dark .hero {
            background: linear-gradient(180deg, #0A2118, #173B2B);
        }

        .hero-inner {
            max-width: 760px;
            position: relative;
            z-index: 5;
        }

        .hero h1 {
            color: #fff;
            font-size: clamp(2rem, 5vw, 3.1rem);
        }

        .page-header {
            padding-top: 48px;
        }

        .hero-image-overlap {
            max-width: 800px;
            margin: -48px auto 0;
            padding: 0 24px;
            position: relative;
            z-index: 2;
        }

        .hero-image-overlap img {
            border-radius: var(--radius);
            box-shadow: var(--shadow-lift);
        }

        /* --- Slide foto bergerak sebagai background hero --- */
        .hero-slideshow {
            position: absolute;
            inset: 0;
            z-index: 1;
        }

        .hero-slideshow img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 1.4s ease;
        }

        .hero-slideshow img.is-active {
            opacity: 1;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            z-index: 2;
            background: linear-gradient(180deg, rgba(18, 51, 42, 0.78), rgba(18, 51, 42, 0.55) 55%, rgba(18, 51, 42, 0.88));
        }

        /* --- Video (dibatasi ukurannya, nggak full layar) --- */
        .video-frame {
            max-width: 1000px;
            width: 100%;
            margin: 0 auto 32px;
            aspect-ratio: 16 / 9;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-lift);
            background: #000;
        }

        .video-frame iframe,
        .video-frame video {
            width: 100%;
            height: 100%;
            border: 0;
            display: block;
        }

        /* --- Buttons --- */
        .btn {
            display: inline-block;
            padding: 14px 28px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 0.95rem;
            transition: transform .2s var(--ease-out-3), box-shadow .2s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-soft);
        }

        .btn-gold {
            background: var(--gold);
            color: var(--green-deep);
        }

        .btn-green {
            background: var(--green-action);
            color: #fff;
        }

        .btn-green:hover {
            background: var(--green-light);
            color: #fff;
        }

        /* --- Grid kartu --- */
        .grid-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 22px;
        }

        /* --- Grid "Tentang Sekolah" (foto + teks), responsif --- */
        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: center;
        }

        .about-grid-single {
            grid-template-columns: 1fr;
        }

        @media (max-width: 900px) {
            .about-grid {
                grid-template-columns: 1fr;
            }
        }

        /* --- CTA box --- */
        .cta-box {
            padding: 28px;
            text-align: center;
            margin-top: 40px;
            background: var(--green-tint);
            border: none;
        }

        /* --- Stats bar (di dalam/bawah hero) --- */
        .stats-bar {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 20px;
            margin-top: 36px;
            padding-top: 28px;
            border-top: 1px solid rgba(255, 255, 255, 0.18);
        }

        .stat-item .stat-num {
            font-family: 'Fraunces', serif;
            font-size: clamp(1.6rem, 3vw, 2.1rem);
            font-weight: 700;
            color: var(--gold-light);
            display: block;
        }

        .stat-item .stat-label {
            font-size: 0.8rem;
            color: #D9E6DC;
            letter-spacing: 0.03em;
        }

        /* --- Pillar cards ("Kenapa Memilih Kami") --- */
        .pillars {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 24px;
        }

        .pillar-card {
            padding: 28px;
            position: relative;
        }

        .pillar-icon {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: var(--green-tint);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin-bottom: 16px;
        }

        .pillar-card ul {
            margin: 14px 0 0;
            padding-left: 0;
            list-style: none;
            font-size: 0.92rem;
            color: var(--muted);
        }

        .pillar-card ul li {
            padding: 5px 0 5px 20px;
            position: relative;
        }

        .pillar-card ul li::before {
            content: "";
            position: absolute;
            left: 0;
            top: 13px;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--gold);
        }

        /* --- Testimoni --- */
        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .testimonial-card {
            padding: 24px;
            position: relative;
        }

        .testimonial-card .quote-mark {
            font-family: 'Fraunces', serif;
            font-size: 2.6rem;
            color: var(--gold-light);
            line-height: 1;
            display: block;
            margin-bottom: 4px;
        }

        .testimonial-card .who {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 16px;
        }

        .testimonial-card .who-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--green-tint);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--green);
            font-size: 0.85rem;
        }

        /* --- Section peta --- */
        .map-frame {
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-soft);
            border: 1px solid var(--line);
        }

        .map-frame iframe {
            display: block;
            width: 100%;
            height: 340px;
            border: 0;
        }

        /* --- Section wrapper generik --- */
        .section {
            padding: 64px 0;
        }

        .section-head {
            max-width: 560px;
            margin: 0 auto 32px;
            text-align: center;
        }

        .section-head .eyebrow {
            display: block;
        }

        /* --- Gallery slider (Swiper) --- */
        .gallery-swiper {
            padding: 10px 0 44px;
        }

        .gallery-swiper .swiper-slide {
            border-radius: var(--radius);
            overflow: hidden;
            aspect-ratio: 4/3;
            position: relative;
        }

        .gallery-swiper .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .gallery-swiper .swiper-pagination-bullet {
            background: var(--green);
            opacity: 0.3;
        }

        .gallery-swiper .swiper-pagination-bullet-active {
            opacity: 1;
            background: var(--gold);
        }

        /* --- Dropdown menu navigasi (animasi turun saat hover) --- */
        .nav-item {
            position: relative;
        }

        .nav-item>a {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .nav-caret {
            font-size: 0.65rem;
            opacity: 0.6;
            transition: transform .2s ease;
        }

        .nav-item:hover .nav-caret {
            transform: rotate(180deg);
        }

        .nav-dropdown {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translate(-50%, -8px);
            margin-top: 14px;
            min-width: 240px;
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-radius: 16px;
            padding: 10px;
            box-shadow: 0 16px 40px rgba(18, 51, 42, 0.16);
            opacity: 0;
            visibility: hidden;
            transition: opacity .22s ease, transform .22s ease, visibility .22s;
            z-index: 60;
        }

        .nav-item:hover>.nav-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translate(-50%, 0);
        }

        .nav-dropdown a {
            display: block;
            padding: 9px 12px;
            border-radius: 10px;
            font-size: 0.85rem;
            color: var(--ink);
            border-bottom: none !important;
        }

        .nav-dropdown a:hover {
            background: var(--green-tint);
            color: var(--green);
        }

        .nav-dropdown .soon {
            display: block;
            padding: 9px 12px;
            font-size: 0.8rem;
            color: var(--muted);
            font-style: italic;
        }

        /* --- Sub-dropdown level 3 (kategori → daftar item), flyout ke kanan di desktop --- */
        .nav-dropdown .nav-item {
            position: relative;
        }

        .nav-dropdown .nav-item>a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .nav-dropdown .nav-item>.nav-dropdown {
            top: -10px;
            left: 100%;
            margin: 0 0 0 6px;
            transform: translate(-6px, 0);
        }

        .nav-dropdown .nav-item:hover>.nav-dropdown {
            transform: translate(0, 0);
        }

        .nav-preview-item {
            display: block;
            padding: 7px 12px;
            font-size: 0.82rem;
            color: var(--muted);
        }

        @media (max-width: 1400px) {
            .nav-preview-item {
                padding-left: 20px;
            }
        }

        @media (max-width: 1400px) {
            .nav-dropdown {
                display: none !important;
                position: static !important;
                top: auto !important;
                left: auto !important;
                right: auto !important;
                transform: none !important;
                opacity: 1 !important;
                visibility: visible !important;
                background: transparent !important;
                box-shadow: none !important;
                backdrop-filter: none !important;
                -webkit-backdrop-filter: none !important;
                border: none !important;
                min-width: 0 !important;
                width: 100% !important;
                max-height: none !important;
                overflow: visible !important;
                margin: 4px 0 4px 12px !important;
                padding: 0 !important;
            }

            .nav-item.mobile-open>.nav-dropdown {
                display: block !important;
            }

            .nav-dropdown a {
                color: var(--ink);
                padding: 7px 10px;
            }

            .nav-caret {
                transition: transform .2s ease;
            }

            .nav-item.mobile-open .nav-caret {
                transform: rotate(180deg);
            }
        }

        /* Layar sangat lebar (laptop/monitor besar) — lebarkan container biar nggak kosong kanan-kiri */
        @media (min-width: 1600px) {
            .wrap {
                max-width: 1520px;
            }

            .header-inner {
                max-width: 1520px;
            }
        }

        /* Ornamen kecil di ruang sisi agar halaman terasa lebih hidup tanpa mengganggu isi. */
        .school-motifs {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .school-motif {
            position: absolute;
            width: 42px;
            height: 42px;
            color: var(--green);
            opacity: 0.16;
            filter: drop-shadow(0 5px 12px rgba(18, 51, 42, 0.08));
            animation: motif-float 9s ease-in-out infinite;
        }

        .school-motif-left {
            top: 30%;
            left: clamp(8px, 2.5vw, 42px);
        }

        .school-motif-right {
            top: 62%;
            right: clamp(8px, 2.5vw, 42px);
            width: 36px;
            height: 36px;
            color: var(--gold);
            animation-delay: -4s;
        }

        .school-motif-bottom {
            top: 78%;
            left: clamp(12px, 8vw, 140px);
            width: 28px;
            height: 28px;
            color: var(--gold);
            opacity: 0.12;
            animation-delay: -6s;
        }

        @keyframes motif-float {
            0%, 100% {
                transform: translate3d(0, 0, 0) rotate(-3deg);
            }

            50% {
                transform: translate3d(0, -9px, 0) rotate(3deg);
            }
        }

        @media (max-width: 1100px) {
            .school-motifs {
                display: none;
            }
        }

        @media (max-width: 640px) {
            .wrap {
                padding-inline: 16px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .school-motif {
                animation: none;
            }
        }

        /* --- Tombol WhatsApp mengambang --- */
        .wa-float {
            position: fixed;
            right: 22px;
            bottom: 22px;
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: var(--green-action);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 28px rgba(18, 51, 42, 0.35);
            z-index: 200;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .wa-float:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 14px 32px rgba(18, 51, 42, 0.4);
        }

        .wa-float::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 50%;
            background: var(--green-action);
            opacity: 0.55;
            animation: wa-pulse 2.2s ease-out infinite;
            z-index: -1;
        }

        @keyframes wa-pulse {
            0% {
                transform: scale(1);
                opacity: 0.55;
            }

            100% {
                transform: scale(1.6);
                opacity: 0;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .wa-float::before {
                animation: none;
            }
        }

        @media (max-width: 640px) {
            .wa-float {
                right: 16px;
                bottom: 16px;
                width: 52px;
                height: 52px;
            }
        }

        /* --- Kartu berita dengan foto + gradasi --- */
        .news-card {
            padding: 0;
            overflow: hidden;
        }

        .news-card-media {
            position: relative;
            aspect-ratio: 4 / 3;
            overflow: hidden;
        }

        .news-card-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }

        .news-card:hover .news-card-media img {
            transform: scale(1.06);
        }

        .news-card-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--green), var(--green-deep));
        }

        html.dark .news-card-placeholder {
            background: linear-gradient(135deg, #1F4D3A, #0A2118);
        }

        .news-card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, transparent 35%, rgba(18, 51, 42, 0.92) 100%);
        }

        .news-card-text {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            padding: 16px;
            color: #fff;
        }

        .news-card-date {
            font-size: 0.72rem;
            color: var(--gold-light);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .news-card-text h3 {
            margin: 4px 0 0;
            font-size: 1.02rem;
            color: #fff;
        }

        /* --- Breadcrumb --- */
        .breadcrumb {
            font-size: 0.82rem;
            color: var(--muted);
            margin-bottom: 16px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 6px;
        }

        .breadcrumb a {
            color: var(--muted);
            transition: color .15s ease;
        }

        .breadcrumb a:hover {
            color: var(--green);
        }

        .breadcrumb-sep {
            color: var(--line);
        }

        .breadcrumb-current {
            color: var(--ink);
            font-weight: 600;
        }

        .scroll-top-btn {
            position: fixed;
            right: 22px;
            bottom: 92px;
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: var(--shadow-soft);
            color: var(--green-deep);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 199;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: opacity .25s ease, transform .25s ease, visibility .25s;
        }

        html.dark .scroll-top-btn {
            background: rgba(23, 39, 32, 0.94);
            border-color: var(--line);
            color: var(--ink);
        }

        .scroll-top-btn.is-visible {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .scroll-top-btn:hover {
            transform: translateY(-2px);
        }

        @media (max-width: 640px) {
            .scroll-top-btn {
                right: 16px;
                bottom: 78px;
                width: 42px;
                height: 42px;
            }
        }

        .lightbox {
            position: fixed;
            inset: 0;
            z-index: 300;
            background: rgba(18, 51, 42, 0.92);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .lightbox.is-open {
            display: flex;
        }

        .lightbox img {
            max-width: 90vw;
            max-height: 85vh;
            border-radius: var(--radius);
            box-shadow: var(--shadow-lift);
        }

        .lightbox-close,
        .lightbox-prev,
        .lightbox-next {
            position: absolute;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1.3rem;
            transition: background .2s ease;
        }

        .lightbox-close:hover,
        .lightbox-prev:hover,
        .lightbox-next:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .lightbox-close {
            top: 20px;
            right: 20px;
        }

        .lightbox-prev {
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
        }

        .lightbox-next {
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
        }

        @media (max-width: 640px) {

            .lightbox-prev,
            .lightbox-next {
                width: 38px;
                height: 38px;
                font-size: 1rem;
            }
        }

        .empty-state {
            padding: 32px;
            text-align: center;
            color: var(--muted);
            background: var(--green-tint);
            border-radius: var(--radius);
            font-size: 0.95rem;
        }

        html.dark .nav-dropdown {
            background: rgba(16, 27, 23, 0.96);
            border-color: var(--line);
            box-shadow: 0 18px 36px rgba(0, 0, 0, 0.3);
        }

        html.dark .card,
        html.dark .empty-state {
            background: var(--card);
        }

        html.dark .theme-toggle .icon-sun {
            display: block;
        }

        @media (max-width: 1400px) {
            html.dark nav.main-nav {
                border-top-color: rgba(231, 213, 143, 0.18);
            }
        }

        @media (max-width: 640px) {
            .theme-toggle {
                top: 20px;
                right: 20px;
            }
        }
    </style>

    @stack('styles')

    <script>
        (() => {
            const storedTheme = localStorage.getItem('sd-theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            if (storedTheme === 'dark' || (!storedTheme && prefersDark)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
</head>

<body>

    <div class="school-motifs" aria-hidden="true">
        <svg class="school-motif school-motif-left" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
            <path d="M7 11.5c5.5-2 10.5-1.2 17 2.2v25c-6.5-3.4-11.5-4.2-17-2.2v-25Z" />
            <path d="M41 11.5c-5.5-2-10.5-1.2-17 2.2v25c6.5-3.4 11.5-4.2 17-2.2v-25Z" />
            <path d="M24 13.7v25M12 16.5c3.3-.5 6.1.2 9.3 1.7M36 16.5c-3.3-.5-6.1.2-9.3 1.7" />
        </svg>
        <svg class="school-motif school-motif-right" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
            <path d="M31.8 7.5a15.5 15.5 0 1 0 8.7 27.8A16 16 0 1 1 31.8 7.5Z" />
            <path d="m36.5 10 .9 2.4 2.6.2-2 1.7.6 2.5-2.1-1.4-2.2 1.4.7-2.5-2-1.7 2.6-.2.9-2.4Z" />
        </svg>
        <svg class="school-motif school-motif-bottom" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
            <path d="m24 5 3.7 11.3H39l-9.2 7.1 3.5 11.1-9.3-6.8-9.3 6.8 3.5-11.1L9 16.3h11.3L24 5Z" />
        </svg>
    </div>

    <header class="site">
        <div class="header-inner wrap">
            <a href="{{ route('home') }}" class="brand">
                SD Khadijah Wonorejo
                <small>Sekolah Pemimpin yang Santun</small>
            </a>
            <button type="button" class="nav-toggle" id="navToggle" aria-label="Buka menu">&#9776;</button>
            <nav class="main-nav" id="mainNav">
                <a href="{{ route('home') }}" class="nav-home" aria-label="Beranda" title="Beranda">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <path d="M9 22V12h6v10" />
                    </svg>
                    <span class="nav-home-label">Beranda</span>
                </a>

                @foreach($navGroups as $group)
                @continue($group->pages->isEmpty() && ! $group->extra_link_url)
                <div class="nav-item">
                    @php $firstSlug = $group->pages->first()->slug ?? null; @endphp
                    <a href="{{ $firstSlug ? url($firstSlug) : '#' }}" @if(!$firstSlug) onclick="return false;" @endif>
                        {{ $group->name }} <span class="nav-caret">&#9662;</span>
                    </a>
                    <div class="nav-dropdown">
                        @foreach($group->pages as $item)
                        @if($item->children->isNotEmpty())
                        <div class="nav-item">
                            <a href="{{ url($item->slug) }}">
                                {{ $item->title }} <span class="nav-caret">&#9662;</span>
                            </a>
                            <div class="nav-dropdown">
                                @foreach($item->children as $child)
                                <a href="{{ url($child->slug) }}">{{ $child->title }}</a>
                                @endforeach
                            </div>
                        </div>
                        @elseif(!empty($item->nav_preview_items))
                        <div class="nav-item">
                            <a href="{{ url($item->slug) }}">
                                {{ $item->title }} <span class="nav-caret">&#9662;</span>
                            </a>
                            <div class="nav-dropdown">
                                @foreach($item->nav_preview_items as $previewItem)
                                <span class="nav-preview-item">{{ $previewItem }}</span>
                                @endforeach
                            </div>
                        </div>
                        @else
                        <a href="{{ url($item->slug) }}">{{ $item->title }}</a>
                        @endif
                        @endforeach
                        @if($group->extra_link_url)
                        <a href="{{ $group->extra_link_url }}"
                            @if(str_starts_with($group->extra_link_url, 'http')) target="_blank" rel="noopener" @endif>
                            {{ $group->extra_link_label ?: 'Selengkapnya' }}
                        </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </nav>
        </div>
        <button type="button" class="theme-toggle" id="themeToggle" aria-label="Aktifkan mode gelap" title="Ganti mode warna">
            <svg class="icon-moon" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M21 12.8A8.5 8.5 0 1 1 11.2 3 6.5 6.5 0 0 0 21 12.8Z" />
            </svg>
            <svg class="icon-sun" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="12" cy="12" r="4" />
                <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41" />
            </svg>
        </button>
    </header>
    <div class="motif-line"></div>

    <main style="display:block; padding-bottom: 64px;">
        @yield('content')
    </main>

    <div class="wrap">
        <div class="floating-cta" data-aos="fade-up">
            <div>
                <h3 style="margin:0 0 4px; font-size:1.15rem;">Masih ada pertanyaan?</h3>
                <p style="margin:0; color: var(--muted); font-size:0.92rem;">Tim kami siap membantu informasi pendaftaran & program sekolah.</p>
            </div>
            <a href="https://wa.me/6282336666926" target="_blank" rel="noopener" class="btn btn-green">
                Hubungi Kami &rarr;
            </a>
        </div>
    </div>

    <footer class="site">
        <div class="footer-inner wrap">
            <div class="footer-col">
                <strong style="color:#fff; font-family:'Fraunces', serif; font-size:1.05rem;">SD Khadijah Wonorejo</strong>
                <p style="margin-top:10px;">Sekolah Pemimpin yang Santun — mendidik generasi berakhlak dan berlandaskan nilai Ahlussunnah wal Jamaah An-Nahdliyah.</p>
                <div class="footer-social">
                    <a href="#" aria-label="Instagram">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="2" width="20" height="20" rx="5" />
                            <circle cx="12" cy="12" r="4" />
                            <circle cx="17.5" cy="6.5" r="1" />
                        </svg>
                    </a>
                    <a href="#" aria-label="Facebook">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                        </svg>
                    </a>
                    <a href="https://wa.me/6282336666926" aria-label="WhatsApp">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.9 9.9 0 0 0 4.74 1.21h.01c5.46 0 9.9-4.45 9.9-9.91C21.96 6.45 17.5 2 12.04 2zm0 18.02c-1.5 0-2.96-.4-4.24-1.16l-.3-.18-3.15.83.84-3.07-.2-.32a8.05 8.05 0 0 1-1.24-4.3c0-4.44 3.61-8.05 8.05-8.05a8 8 0 0 1 8.05 8.05c0 4.44-3.61 8.05-8.05 8.05z" />
                        </svg>
                    </a>
                    <a href="mailto:info@sdkhadijahwonorejo.sch.id" aria-label="Email">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="4" width="20" height="16" rx="2" />
                            <path d="m22 6-10 7L2 6" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="footer-col">
                <h4>Jelajahi</h4>
                <ul style="list-style:none; padding:0; margin:0;">
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('posts.index') }}">Berita &amp; Kegiatan</a></li>
                    {{-- Otomatis dari data yang sama dengan menu navbar —
                         nggak akan pernah nunjuk ke slug yang sudah nggak ada. --}}
                    @foreach($navGroups as $group)
                    @continue($group->pages->isEmpty() && !$group->extra_link_url)
                    @php $firstPage = $group->pages->first(); @endphp
                    @if($firstPage)
                    <li><a href="{{ url($firstPage->slug) }}">{{ $group->name }}</a></li>
                    @elseif($group->extra_link_url)
                    <li><a href="{{ $group->extra_link_url }}">{{ $group->extra_link_label ?? $group->name }}</a></li>
                    @endif
                    @endforeach
                </ul>
            </div>

            <div class="footer-col">
                <h4>Kontak</h4>
                <ul style="list-style:none; padding:0; margin:0;">
                    <li>Jl. Wonorejo Selatan IX No.2 Rungkut Wonorejo Selatan X Surabaya</li>
                    <li>+62-8233-6666-92</li>
                    <li>info@sdkhadijahwonorejo.sch.id</li>
                </ul>
            </div>

            <div class="footer-note">
                &copy; {{ date('Y') }} SD Khadijah Wonorejo. Semua hak dilindungi.
                <span style="float:right;">IT SD Khadijah Wonorejo</span>
            </div>
        </div>
    </footer>

    <script>
        if ('IntersectionObserver' in window) {
            const io = new IntersectionObserver((entries) => {
                entries.forEach(e => {
                    if (e.isIntersecting) {
                        e.target.classList.add('is-visible');
                        io.unobserve(e.target);
                    }
                });
            }, {
                threshold: 0.15
            });
            document.querySelectorAll('.reveal').forEach(el => io.observe(el));
        } else {
            document.querySelectorAll('.reveal').forEach(el => el.classList.add('is-visible'));
        }

        // Pengaman: kalau karena alasan apapun elemen .reveal nggak ke-trigger
        // (halaman panjang, timing render, dll), paksa muncul setelah 1.2 detik
        // supaya nggak pernah ada konten yang permanen blank/opacity 0.
        setTimeout(() => {
            document.querySelectorAll('.reveal:not(.is-visible)').forEach(el => el.classList.add('is-visible'));
        }, 1200);

        // Slide foto background hero (crossfade sederhana, tanpa library)
        document.querySelectorAll('.hero-slideshow').forEach((slideshow) => {
            const imgs = slideshow.querySelectorAll('img');
            if (imgs.length === 0) return;
            imgs[0].classList.add('is-active');
            if (imgs.length === 1) return;
            let i = 0;
            setInterval(() => {
                imgs[i].classList.remove('is-active');
                i = (i + 1) % imgs.length;
                imgs[i].classList.add('is-active');
            }, 5000);
        });

        const navToggle = document.getElementById('navToggle');
        const mainNav = document.getElementById('mainNav');
        if (navToggle && mainNav) {
            navToggle.addEventListener('click', () => mainNav.classList.toggle('is-open'));
        }

        const themeToggle = document.getElementById('themeToggle');
        if (themeToggle) {
            const updateThemeLabel = () => {
                const isDark = document.documentElement.classList.contains('dark');
                themeToggle.setAttribute('aria-label', isDark ? 'Aktifkan mode terang' : 'Aktifkan mode gelap');
            };

            updateThemeLabel();
            themeToggle.addEventListener('click', () => {
                const isDark = document.documentElement.classList.toggle('dark');
                localStorage.setItem('sd-theme', isDark ? 'dark' : 'light');
                updateThemeLabel();
            });
        }

        // Dropdown menu: di desktop pakai hover (CSS), di mobile pakai tap
        // (karena hover nggak ada di layar sentuh).
        document.querySelectorAll('.nav-item > a').forEach(link => {
            link.addEventListener('click', (e) => {
                if (window.innerWidth <= 1400) {
                    e.preventDefault();
                    link.closest('.nav-item').classList.toggle('mobile-open');
                }
            });
        });
    </script>

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper@11/swiper-bundle.min.js"></script>

    <!-- AOS: dipakai untuk section baru (data-aos="..."), .reveal lama tetap jalan sendiri -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 700,
            once: true,
            offset: 60,
            disable: () => window.matchMedia('(prefers-reduced-motion: reduce)').matches,
        });

        if (document.querySelector('.gallery-swiper')) {
            window.gallerySwiperInstance = new Swiper('.gallery-swiper', {
                loop: true,
                slidesPerView: 1.15,
                spaceBetween: 16,
                centeredSlides: true,
                speed: 900,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: false,
                    waitForTransition: true
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2.2
                    },
                    1024: {
                        slidesPerView: 3.2
                    },
                },
                pagination: {
                    el: '.gallery-swiper .swiper-pagination',
                    clickable: true
                },
            });
        }
    </script>

    <script>
        (function() {
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightboxImg');
            if (!lightbox) return;

            const images = Array.from(document.querySelectorAll('.gallery-swiper .swiper-slide img'));
            let currentIndex = 0;

            function open(index) {
                currentIndex = index;
                lightboxImg.src = images[currentIndex].src;
                lightbox.classList.add('is-open');
            }

            function close() {
                lightbox.classList.remove('is-open');
            }

            function next() {
                currentIndex = (currentIndex + 1) % images.length;
                lightboxImg.src = images[currentIndex].src;
            }

            function prev() {
                currentIndex = (currentIndex - 1 + images.length) % images.length;
                lightboxImg.src = images[currentIndex].src;
            }

            images.forEach((img, i) => {
                img.style.cursor = 'zoom-in';
                img.addEventListener('click', () => open(i));
            });

            lightbox.querySelector('.lightbox-close').addEventListener('click', close);
            lightbox.querySelector('.lightbox-next').addEventListener('click', next);
            lightbox.querySelector('.lightbox-prev').addEventListener('click', prev);
            lightbox.addEventListener('click', (e) => {
                if (e.target === lightbox) close();
            });
            document.addEventListener('keydown', (e) => {
                if (!lightbox.classList.contains('is-open')) return;
                if (e.key === 'Escape') close();
                if (e.key === 'ArrowRight') next();
                if (e.key === 'ArrowLeft') prev();
            });
        })();
    </script>

    <a href="https://wa.me/6282336666926" target="_blank" rel="noopener" class="wa-float" aria-label="Chat WhatsApp">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.9 9.9 0 0 0 4.74 1.21h.01c5.46 0 9.9-4.45 9.9-9.91C21.96 6.45 17.5 2 12.04 2zm0 18.02c-1.5 0-2.96-.4-4.24-1.16l-.3-.18-3.15.83.84-3.07-.2-.32a8.05 8.05 0 0 1-1.24-4.3c0-4.44 3.61-8.05 8.05-8.05a8 8 0 0 1 8.05 8.05c0 4.44-3.61 8.05-8.05 8.05z" />
        </svg>
    </a>

    <button id="scrollTop" class="scroll-top-btn" aria-label="Kembali ke atas">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="m18 15-6-6-6 6" />
        </svg>
    </button>

    <script>
        // Animasi hitung angka statistik — jalan sekali pas pertama kali terlihat
        document.querySelectorAll('.stat-num').forEach(el => {
            const target = parseInt(el.dataset.count, 10) || 0;
            const suffix = el.dataset.suffix || '';

            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                el.textContent = target + suffix;
                return;
            }

            const io = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (!entry.isIntersecting) return;
                    const duration = 1200;
                    const start = performance.now();

                    function tick(now) {
                        const progress = Math.min((now - start) / duration, 1);
                        const eased = 1 - Math.pow(1 - progress, 3);
                        el.textContent = Math.round(eased * target) + suffix;
                        if (progress < 1) requestAnimationFrame(tick);
                    }
                    requestAnimationFrame(tick);
                    io.unobserve(el);
                });
            }, {
                threshold: 0.5
            });

            io.observe(el);
        });
    </script>

    <script>
        const scrollBtn = document.getElementById('scrollTop');
        if (scrollBtn) {
            window.addEventListener('scroll', () => {
                scrollBtn.classList.toggle('is-visible', window.scrollY > 500);
            });
            scrollBtn.addEventListener('click', () => window.scrollTo({
                top: 0,
                behavior: 'smooth'
            }));
        }
    </script>

    <div id="lightbox" class="lightbox">
        <button class="lightbox-close" aria-label="Tutup">&times;</button>
        <button class="lightbox-prev" aria-label="Sebelumnya">&#10094;</button>
        <img id="lightboxImg" src="" alt="">
        <button class="lightbox-next" aria-label="Berikutnya">&#10095;</button>
    </div>

    @stack('scripts')

</body>

</html>
