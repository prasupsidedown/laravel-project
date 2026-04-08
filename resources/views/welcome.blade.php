<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MobiTravel — Perjalanan Berasa Rumah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=DM+Sans:wght@300;400;500&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

    <style>
        /* ============================================================
           DESIGN TOKENS
        ============================================================ */
        :root {
            --forest:    #1a3328;
            --moss:      #2d5a3d;
            --sage:      #4e8060;
            --mist:      #a8c5b0;
            --cream:     #f5f0e8;
            --ivory:     #faf8f3;
            --sand:      #e8dfc8;
            --terra:     #c17f3b;
            --gold:      #e8a83e;
            --charcoal:  #1c1c1c;
            --ink:       #2e2e2e;
            --muted:     #7a7a6e;

            --font-display: 'Playfair Display', Georgia, serif;
            --font-body:    'DM Sans', sans-serif;
            --font-mono:    'DM Mono', monospace;

            --ease-smooth: cubic-bezier(.25,.46,.45,.94);
            --ease-bounce: cubic-bezier(.34,1.56,.64,1);
        }

        /* ============================================================
           RESET & BASE
        ============================================================ */
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        html {
            scroll-behavior: smooth;
            font-size: 16px;
            overflow-x: hidden; /* FIX: cegah scroll horizontal di level html */
        }

        body {
            font-family: var(--font-body);
            background: var(--ivory);
            color: var(--ink);
            overflow-x: hidden; /* FIX: cegah scroll horizontal */
            width: 100%;
        }

        img { display: block; max-width: 100%; }

        a { text-decoration: none; color: inherit; }

        /* ============================================================
           NOISE TEXTURE OVERLAY
        ============================================================ */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 9999;
        }

        /* ============================================================
           NAVBAR
        ============================================================ */
        .nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.25rem 4rem;
            transition: background .4s var(--ease-smooth), box-shadow .4s;
        }

        .nav.scrolled {
            background: rgba(245,240,232,.92);
            backdrop-filter: blur(12px);
            box-shadow: 0 1px 0 rgba(0,0,0,.08);
        }

        .nav__logo {
            font-family: var(--font-display);
            font-size: 1.5rem;
            font-weight: 900;
            color: var(--cream);
            letter-spacing: -.02em;
            transition: color .3s;
        }
        .nav.scrolled .nav__logo { color: var(--forest); }
        .nav__logo span { color: var(--gold); }

        .nav__links {
            display: flex;
            gap: 2.5rem;
            list-style: none;
        }

        .nav__links a {
            font-size: .875rem;
            font-weight: 500;
            letter-spacing: .04em;
            text-transform: uppercase;
            color: rgba(255,255,255,.85);
            transition: color .2s;
        }
        .nav.scrolled .nav__links a { color: var(--ink); }
        .nav__links a:hover { color: var(--gold); }

        .nav__cta {
            background: var(--gold);
            color: var(--forest) !important;
            padding: .5rem 1.25rem;
            border-radius: 2rem;
            font-weight: 700 !important;
            transition: transform .2s var(--ease-bounce), background .2s !important;
        }
        .nav__cta:hover { background: var(--terra); transform: translateY(-2px); }

        /* ============================================================
           HERO
        ============================================================ */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .hero__bg {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(160deg, rgba(26,51,40,.85) 0%, rgba(45,90,61,.5) 55%, rgba(26,51,40,.8) 100%),
                url('images/hero.jpg') center/cover no-repeat;
            animation: heroZoom 20s ease-in-out infinite alternate;
        }

        @keyframes heroZoom {
            from { transform: scale(1); }
            to   { transform: scale(1.06); }
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -2px; left: 0; right: 0;
            height: 120px;
            background: var(--ivory);
            clip-path: polygon(0 100%, 100% 0, 100% 100%);
        }

        .hero__content {
            position: relative;
            z-index: 2;
            max-width: 900px;
            padding: 0 4rem;
            animation: fadeUp .9s var(--ease-smooth) both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(40px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .hero__tag {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            font-family: var(--font-mono);
            font-size: .75rem;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 1.5rem;
            animation: fadeUp .9s .15s var(--ease-smooth) both;
        }
        .hero__tag::before {
            content: '';
            display: inline-block;
            width: 2.5rem; height: 1px;
            background: var(--gold);
        }

        .hero__title {
            font-family: var(--font-display);
            font-size: clamp(3rem, 7vw, 6rem);
            font-weight: 900;
            line-height: 1.0;
            color: var(--cream);
            letter-spacing: -.03em;
            margin-bottom: 1.5rem;
            animation: fadeUp .9s .25s var(--ease-smooth) both;
        }
        .hero__title em { font-style: italic; color: var(--gold); }

        .hero__sub {
            font-size: 1.125rem;
            line-height: 1.7;
            color: rgba(245,240,232,.8);
            max-width: 520px;
            margin-bottom: 2.5rem;
            animation: fadeUp .9s .35s var(--ease-smooth) both;
        }

        .hero__actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            animation: fadeUp .9s .45s var(--ease-smooth) both;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .875rem 2rem;
            border-radius: 3rem;
            font-weight: 600;
            font-size: .9375rem;
            cursor: pointer;
            transition: transform .2s var(--ease-bounce), box-shadow .2s, background .2s;
            border: none;
        }
        .btn--primary { background: var(--gold); color: var(--forest); }
        .btn--primary:hover {
            background: var(--terra);
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(200,120,40,.35);
        }
        .btn--outline {
            background: transparent;
            border: 1.5px solid rgba(255,255,255,.5);
            color: var(--cream);
        }
        .btn--outline:hover { background: rgba(255,255,255,.1); transform: translateY(-3px); }

        /* ============================================================
           SEARCH / BOOKING BAR
        ============================================================ */
        .search-bar {
            position: relative;
            z-index: 10;
            margin-top: -3rem;
            padding: 0 4rem;
            animation: fadeUp 1s .55s var(--ease-smooth) both;
        }

        .search-bar__inner {
            background: var(--ivory);
            border-radius: 1.25rem;
            box-shadow: 0 20px 60px rgba(26,51,40,.18);
            padding: 1.75rem 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr auto;
            gap: 1rem;
            align-items: end;
        }

        .sb-field label {
            display: block;
            font-family: var(--font-mono);
            font-size: .7rem;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: .4rem;
        }

        .sb-field select,
        .sb-field input {
            width: 100%;
            border: 1.5px solid var(--sand);
            border-radius: .6rem;
            padding: .65rem .9rem;
            font-family: var(--font-body);
            font-size: .9375rem;
            color: var(--ink);
            background: var(--ivory);
            outline: none;
            transition: border-color .2s, box-shadow .2s;
            appearance: none;
            -webkit-appearance: none;
        }
        .sb-field select:focus,
        .sb-field input:focus {
            border-color: var(--sage);
            box-shadow: 0 0 0 3px rgba(78,128,96,.15);
        }

        .search-bar__btn {
            background: var(--forest);
            color: var(--cream);
            border: none;
            border-radius: .75rem;
            padding: .75rem 1.75rem;
            font-size: .9375rem;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s, transform .2s var(--ease-bounce);
            white-space: nowrap;
        }
        .search-bar__btn:hover { background: var(--moss); transform: translateY(-2px); }

        /* ============================================================
           SECTION COMMONS
        ============================================================ */
        section { padding: 5rem 4rem; }

        .section-tag {
            font-family: var(--font-mono);
            font-size: .75rem;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--sage);
            display: flex;
            align-items: center;
            gap: .6rem;
            margin-bottom: .75rem;
        }
        .section-tag::before {
            content: '';
            display: inline-block;
            width: 2rem; height: 1px;
            background: var(--sage);
        }

        .section-title {
            font-family: var(--font-display);
            font-size: clamp(2rem, 4vw, 3.25rem);
            font-weight: 900;
            letter-spacing: -.02em;
            color: var(--forest);
            line-height: 1.1;
        }
        .section-title em { font-style: italic; color: var(--terra); }

        /* ============================================================
           WHY US
        ============================================================ */
        .why {
            background: var(--forest);
            position: relative;
            overflow: hidden;
        }
        .why::before {
            content: '';
            position: absolute;
            top: -80px; right: -80px;
            width: 400px; height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(78,128,96,.4) 0%, transparent 70%);
        }
        .why .section-tag { color: var(--mist); }
        .why .section-tag::before { background: var(--mist); }
        .why .section-title { color: var(--cream); }

        .why__grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 1.5rem;
            margin-top: 3rem;
        }

        .why__card {
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(168,197,176,.15);
            border-radius: 1rem;
            padding: 2rem;
            transition: background .3s, transform .3s var(--ease-bounce);
        }
        .why__card:hover { 
            background: rgba(255,255,255,.11); 
            transform: translateY(-6px); }

        .why__name {
            font-family: var(--font-display);
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--cream);
            margin-bottom: .6rem;
        }
        .why__desc { font-size: .9rem; line-height: 1.7; color: rgba(245,240,232,.6); }

        /* ============================================================
           HOW IT WORKS
        ============================================================ */
        .how { background: var(--cream); }

        .how__steps {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            margin-top: 3.5rem;
            position: relative;
        }

        .how__steps::before {
            content: '';
            position: absolute;
            top: 2.25rem;
            left: calc(12.5% + 1rem);
            right: calc(12.5% + 1rem);
            height: 1px;
            background: repeating-linear-gradient(90deg, var(--sage) 0 8px, transparent 8px 16px);
        }

        .step {
            text-align: center;
            position: relative;
        }

        .step__num {
            width: 4rem; height: 4rem;
            border-radius: 50%;
            background: var(--ivory);
            border: 2px solid var(--sage);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem;
            font-family: var(--font-display);
            font-size: 1.25rem;
            font-weight: 900;
            color: var(--forest);
            position: relative;
            z-index: 1;
            transition: background .3s, transform .3s var(--ease-bounce);
        }

        .step:hover .step__num {
            background: var(--forest);
            color: var(--cream);
            transform: scale(1.1);
        }

        .step__title {
            font-family: var(--font-display);
            font-size: 1.0625rem;
            font-weight: 700;
            color: var(--forest);
            margin-bottom: .5rem;
        }

        .step__desc {
            font-size: .875rem;
            color: var(--muted);
            line-height: 1.65;  
        }

        /* ============================================================
           AGENTS
        ============================================================ */
        .agents { background: var(--ivory); }

        .agents__header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 3rem;
        }

        .agents__link {
            font-size: .875rem;
            font-weight: 600;
            color: var(--sage);
            letter-spacing: .04em;
            border-bottom: 1px solid var(--sage);
            padding-bottom: .1rem;
            transition: color .2s, border-color .2s;
            white-space: nowrap;
        }
        .agents__link:hover { color: var(--terra); border-color: var(--terra); }

        /* FIX: grid responsif otomatis, tidak ada lagi scroll ke samping */
        .agents__grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .agent-card {
            background: #fff;
            border: 1.5px solid var(--sand);
            border-radius: 1.25rem;
            overflow: hidden;
            transition: transform .3s var(--ease-bounce), box-shadow .3s;
            cursor: pointer;
        }
        .agent-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(26,51,40,.12);
        }

        .agent-card__img-wrap { overflow: hidden; }
        .agent-card__img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform .5s var(--ease-smooth);
            display: block;
        }
        .agent-card:hover .agent-card__img { transform: scale(1.05); }

        .agent-card__body { padding: 1.5rem; }

        .agent-card__badge {
            display: inline-block;
            background: var(--mist);
            color: var(--forest);
            font-size: .7rem;
            font-weight: 600;
            letter-spacing: .06em;
            text-transform: uppercase;
            padding: .25rem .65rem;
            border-radius: 2rem;
            margin-bottom: .75rem;
        }

        .agent-card__name {
            font-family: var(--font-display);
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--forest);
            margin-bottom: .35rem;
        }

        .agent-card__city {
            font-size: .85rem;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: .35rem;
            margin-bottom: .85rem;
        }

        .agent-card__rating {
            display: flex;
            align-items: center;
            gap: .35rem;
            font-size: .85rem;
            font-weight: 600;
            color: var(--terra);
        }

        .agent-card__footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid var(--sand);
            padding-top: 1rem;
            margin-top: 1rem;
            gap: .5rem;
        }

        .agent-card__services { display: flex; gap: .4rem; flex-wrap: wrap; }

        .tag {
            font-size: .7rem;
            padding: .2rem .55rem;
            border-radius: 2rem;
            background: var(--cream);
            border: 1px solid var(--sand);
            color: var(--muted);
        }

        .agent-card__cta {
            background: var(--forest);
            color: var(--cream);
            border: none;
            border-radius: 2rem;
            padding: .4rem 1rem;
            font-size: .8rem;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s, transform .2s var(--ease-bounce);
            white-space: nowrap;
            flex-shrink: 0;
        }
        .agent-card__cta:hover { background: var(--moss); transform: scale(1.05); }

        /* ============================================================
           DESTINATIONS — FIX: grid wrap, bukan horizontal scroll
        ============================================================ */
        .destinations {
            background: var(--forest);
            padding: 5rem 4rem; /* FIX: padding normal seperti section lain */
            overflow: hidden;
        }

        .destinations__header { margin-bottom: 2.5rem; }
        .destinations__header .section-tag { color: var(--mist); }
        .destinations__header .section-tag::before { background: var(--mist); }
        .destinations__header .section-title { color: var(--cream); }

        /* FIX: ganti flex scroll ke samping → grid responsif ke bawah */
        .dest-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1.25rem;
        }

        .dest-card {
            height: 300px;
            border-radius: 1.25rem;
            overflow: hidden;
            position: relative;
            cursor: pointer;
            transition: transform .3s var(--ease-bounce);
        }
        .dest-card:hover { transform: scale(1.03); }

        .dest-card__bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            transition: transform .5s var(--ease-smooth);
        }
        .dest-card:hover .dest-card__bg { transform: scale(1.08); }

        .dest-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(26,51,40,.85) 0%, transparent 60%);
        }

        .dest-card__info {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 1.5rem;
            z-index: 1;
        }

        .dest-card__name {
            font-family: var(--font-display);
            font-size: 1.375rem;
            font-weight: 700;
            color: var(--cream);
            margin-bottom: .25rem;
        }
        .dest-card__province { font-size: .8rem; color: var(--mist); }

        /* ============================================================
           TESTIMONIALS
        ============================================================ */
        .testimonials { background: var(--cream); }

        .testi__grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-top: 3rem;
        }

        .testi-card {
            background: var(--ivory);
            border: 1.5px solid var(--sand);
            border-radius: 1.25rem;
            padding: 1.75rem;
            transition: transform .3s var(--ease-bounce), box-shadow .3s;
        }
        .testi-card:hover { transform: translateY(-5px); box-shadow: 0 16px 40px rgba(26,51,40,.1); }

        .testi-card:first-child { background: var(--forest); }
        .testi-card:first-child .testi__quote { color: rgba(245,240,232,.85); }
        .testi-card:first-child .testi__name  { color: var(--cream); }
        .testi-card:first-child .testi__role  { color: var(--mist); }
        .testi-card:first-child .testi__stars { color: var(--gold); }
        .testi-card:first-child .testi__mark  { color: rgba(255,255,255,.15); }

        .testi__mark {
            font-family: var(--font-display);
            font-size: 5rem;
            line-height: 1;
            color: var(--sand);
            margin-bottom: .5rem;
        }
        .testi__stars { color: var(--gold); font-size: 1rem; margin-bottom: 1rem; }
        .testi__quote { font-size: .9375rem; line-height: 1.75; color: var(--ink); margin-bottom: 1.25rem; }
        .testi__user { display: flex; align-items: center; gap: .75rem; }

        .testi__avatar {
            width: 2.5rem; height: 2.5rem;
            border-radius: 50%;
            background: var(--mist);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-display);
            font-weight: 700;
            color: var(--forest);
            font-size: 1rem;
            flex-shrink: 0;
        }
        .testi__name { font-weight: 600; font-size: .9rem; color: var(--forest); }
        .testi__role { font-size: .8rem; color: var(--muted); }

        /* ============================================================
           CTA BANNER
        ============================================================ */
        .cta-banner {
            background:
                linear-gradient(135deg, rgba(26,51,40,.92) 0%, rgba(45,90,61,.85) 100%),
                url('https://images.unsplash.com/photo-1588392382834-a891154bca4d?w=1400&q=80') center/cover;
            text-align: center;
            padding: 6rem 4rem;
            position: relative;
            overflow: hidden;
        }
        .cta-banner::before {
            content: '';
            position: absolute;
            width: 600px; height: 600px;
            border-radius: 50%;
            border: 1px solid rgba(168,197,176,.15);
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
        }
        .cta-banner__tag { color: var(--gold); }
        .cta-banner__tag::before { background: var(--gold); }
        .cta-banner__title { color: var(--cream); margin: .75rem auto 1.5rem; max-width: 640px; }
        .cta-banner__sub {
            font-size: 1.0625rem;
            color: rgba(245,240,232,.7);
            max-width: 480px;
            margin: 0 auto 2.5rem;
            line-height: 1.7;
        }

        /* ============================================================
           FOOTER
        ============================================================ */
        .footer { background: var(--charcoal); padding: 4rem; }

        .footer__top {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1fr;
            gap: 3rem;
            padding-bottom: 3rem;
            border-bottom: 1px solid rgba(255,255,255,.08);
            margin-bottom: 2rem;
        }

        .footer__logo {
            font-family: var(--font-display);
            font-size: 1.75rem;
            font-weight: 900;
            color: var(--cream);
            margin-bottom: .75rem;
        }
        .footer__logo span { color: var(--gold); }

        .footer__desc {
            font-size: .875rem;
            color: rgba(255,255,255,.45);
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }

        .footer__socials { display: flex; gap: .75rem; }

        .social-btn {
            width: 2.25rem; height: 2.25rem;
            border-radius: 50%;
            background: rgba(255,255,255,.08);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .9rem;
            color: rgba(255,255,255,.6);
            transition: background .2s, transform .2s var(--ease-bounce);
        }
        .social-btn:hover { background: var(--gold); color: var(--forest); transform: translateY(-3px); }

        .footer__heading {
            font-size: .75rem;
            letter-spacing: .1em;
            text-transform: uppercase;
            font-family: var(--font-mono);
            color: rgba(255,255,255,.3);
            margin-bottom: 1.25rem;
        }

        .footer__links { list-style: none; display: flex; flex-direction: column; gap: .6rem; }
        .footer__links a { font-size: .875rem; color: rgba(255,255,255,.55); transition: color .2s; }
        .footer__links a:hover { color: var(--gold); }

        .footer__bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: .8125rem;
            color: rgba(255,255,255,.3);
        }

        /* ============================================================
           SCROLL REVEAL
        ============================================================ */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity .7s var(--ease-smooth), transform .7s var(--ease-smooth);
        }
        .reveal.visible { opacity: 1; transform: none; }
        .reveal-delay-1 { transition-delay: .1s; }
        .reveal-delay-2 { transition-delay: .2s; }
        .reveal-delay-3 { transition-delay: .3s; }
        .reveal-delay-4 { transition-delay: .4s; }

        /* ============================================================
           RESPONSIVE
        ============================================================ */
        @media (max-width: 1024px) {
            .nav { padding: 1.25rem 2rem; }
            section { padding: 4rem 2rem; }
            .destinations { padding: 4rem 2rem; }
            .search-bar { padding: 0 2rem; }
            .search-bar__inner { grid-template-columns: 1fr 1fr; }
            .footer__top { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 640px) {
            .nav__links { display: none; }
            .hero__content { padding: 0 1.5rem; }
            .search-bar__inner { grid-template-columns: 1fr; }
            .agents__header { flex-direction: column; align-items: flex-start; gap: 1rem; }
            .dest-grid { grid-template-columns: 1fr 1fr; }
            .footer__top { grid-template-columns: 1fr; }
            .footer__bottom { flex-direction: column; gap: 1rem; text-align: center; }
        }

        @media (max-width: 400px) {
            .dest-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    {{-- ===== NAVBAR ===== --}}
    <nav class="nav" id="mainNav">
        <div class="nav__logo">Mobi<span>Travel</span></div>
        <ul class="nav__links">
            <li><a href="#layanan">Layanan</a></li>
            <li><a href="#agen">Agen</a></li>
            <li><a href="#destinasi">Destinasi</a></li>
            <li><a href="#ulasan">Ulasan</a></li>
            <li><a href="{{ route('login') }}" class="nav__cta">Login</a></li>
        </ul>
    </nav>

    {{-- ===== HERO ===== --}}
    <section class="hero">
        <div class="hero__bg"></div>
        <div class="hero__content">
            <div class="hero__tag">Platform Travel Lokal Indonesia</div>
            <h1 class="hero__title">
                Pergi Jauh,<br>
                <em>Pulang ke Rumah</em>
            </h1>
            <p class="hero__sub">
                Temukan agen travel lokal terpercaya di kotamu. Wisata keluarga, pulang kampung dengan nyaman — tersedia supir berpengalaman agar kamu tak kelelahan di jalan.
            </p>
            <div class="hero__actions">
                <a href="#cari" class="btn btn--primary">Cari Perjalanan</a>
                <a href="#agen" class="btn btn--outline">Lihat Agen Lokal</a>
            </div>
        </div>
    </section>

    {{-- ===== SEARCH BAR ===== --}}
    <div class="search-bar" id="cari">
        <div class="search-bar__inner">
            <div class="sb-field sb-field--icon">
                <label for="kota-asal">Kota Asal</label>
                <select id="kota-asal">
                    <option value="">Pilih kota asal...</option>
                    <option>Surabaya</option>
                    <option>Jakarta</option>
                    <option>Bandung</option>
                    <option>Semarang</option>
                    <option>Yogyakarta</option>
                    <option>Malang</option>
                    <option>Medan</option>
                    <option>Makassar</option>
                </select>
            </div>
            <div class="sb-field sb-field--icon">
                <label for="tujuan">Tujuan</label>
                <select id="tujuan">
                    <option value="">Pilih tujuan...</option>
                    <option>Bali</option>
                    <option>Lombok</option>
                    <option>Raja Ampat</option>
                    <option>Labuan Bajo</option>
                    <option>Bromo</option>
                    <option>Dieng</option>
                    <option>Kepulauan Seribu</option>
                </select>
            </div>
            <div class="sb-field sb-field--icon">
                <label for="tgl">Tanggal Berangkat</label>
                <input type="date" id="tgl">
            </div>
            <div class="sb-field sb-field--icon">
                <label for="layanan">Jenis Layanan</label>
                <select id="layanan">
                    <option value="">Semua layanan</option>
                    <option>Wisata + Supir</option>
                    <option>Antar Jemput Keluarga</option>
                    <option>Paket Liburan</option>
                    <option>Supir Saja</option>
                </select>
            </div>
            <button class="search-bar__btn">Cari Sekarang →</button>
        </div>
    </div>

    {{-- ===== WHY US ===== --}}
    <section class="why" id="layanan">
        <div class="section-tag">Kenapa MobiTravel?</div>
        <h2 class="section-title">Perjalanan <em>Lebih Mudah,</em><br>Lebih Nyaman</h2>
        <div class="why__grid">
            @php
                $features = [
                    ['name'=>'Agen Lokal Terverifikasi',   'desc'=>'Semua agen mitra kami adalah pengusaha travel lokal yang telah diverifikasi, berizin, dan berpengalaman di wilayahnya masing-masing.'],
                    ['name'=>'Supir Profesional',           'desc'=>'Untuk keluarga yang ingin bawa kendaraan sendiri namun tidak ingin lelah, kami sediakan supir terlatih yang siap menemani perjalanan.'],
                    ['name'=>'Destinasi Seluruh Nusantara', 'desc'=>'Dari Sabang sampai Merauke. Kami menghubungkan wisatawan dengan agen travel lokal di ratusan kota dan kabupaten.'],
                    ['name'=>'Harga Transparan',            'desc'=>'Tanpa biaya tersembunyi. Semua harga paket ditampilkan jelas dan bisa dikustomisasi sesuai kebutuhan perjalananmu.'],
                    ['name'=>'Dukungan 24/7',               'desc'=>'Tim kami siap membantu perjalananmu kapan saja. Hubungi agen langsung atau kontak dukungan MobiTravel sepanjang waktu.'],
                    ['name'=>'Ulasan Nyata Pengguna',       'desc'=>'Setiap agen dinilai oleh pelanggan sungguhan. Pilih agen berdasarkan rating, ulasan, dan rekam jejak yang terverifikasi.'],
                ];
            @endphp
            @foreach($features as $i => $f)
            <div class="why__card reveal reveal-delay-{{ ($i % 3) + 1 }}">
                <div class="why__name">{{ $f['name'] }}</div>
                <p class="why__desc">{{ $f['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    {{-- ===== HOW IT WORKS ===== --}}
    <section class="how">
        <div class="section-tag">Cara Kerja</div>
        <h2 class="section-title">Pesan dalam <em>4 Langkah</em> Mudah</h2>
        <div class="how__steps">
            @php
                $steps = [
                    ['n'=>'01', 'title'=>'Pilih Tujuan',       'desc'=>'Masukkan kota asal, tujuan, dan tanggal perjalananmu.'],
                    ['n'=>'02', 'title'=>'Temukan Agen',        'desc'=>'Bandingkan agen lokal terpercaya berdasarkan harga dan ulasan.'],
                    ['n'=>'03', 'title'=>'Konfirmasi & Bayar',  'desc'=>'Pilih paket, konfirmasi detail, dan bayar dengan aman.'],
                    ['n'=>'04', 'title'=>'Nikmati Perjalanan',  'desc'=>'Agen & supir kami siap mengantar hingga tujuan.'],
                ];
            @endphp
            @foreach($steps as $i => $s)
            <div class="step reveal reveal-delay-{{ $i + 1 }}">
                <div class="step__num">{{ $s['n'] }}</div>
                <div class="step__title">{{ $s['title'] }}</div>
                <p class="step__desc">{{ $s['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    {{-- ===== AGENTS ===== --}}
    <section class="agents" id="agen">
        <div class="agents__header">
            <div>
                <div class="section-tag">Agen Mitra</div>
                <h2 class="section-title">Agen Lokal <em>Pilihan</em></h2>
            </div>
            <a href="/agen" class="agents__link">Lihat semua agen →</a>
        </div>

        <div class="agents__grid">
            @php
                $agents = [
                    [
                        'img'   => 'images/bali.jpg',
                        'badge' => 'Agen Unggulan',
                        'name'  => 'Surya Wisata Bali',
                        'city'  => 'Denpasar, Bali',
                        'rating'=> '4.9',
                        'review'=> '312 ulasan',
                        'tags'  => ['Wisata','Supir','Antar Jemput'],
                    ],
                    [
                        'img'   => 'images/lombok.jpg',
                        'badge' => 'Terverifikasi',
                        'name'  => 'Lombok Express Tour',
                        'city'  => 'Mataram, NTB',
                        'rating'=> '4.8',
                        'review'=> '198 ulasan',
                        'tags'  => ['Paket Wisata','Supir','Kapal'],
                    ],
                    [
                        'img'   => 'images/bromo.jpg',
                        'badge' => 'Terverifikasi',
                        'name'  => 'Bromo Adventure Jaya',
                        'city'  => 'Probolinggo, Jawa Timur',
                        'rating'=> '4.7',
                        'review'=> '145 ulasan',
                        'tags'  => ['Wisata Alam','Supir','Jeep'],
                    ],
                ];
            @endphp

            @foreach($agents as $i => $agent)
            <div class="agent-card reveal reveal-delay-{{ $i + 1 }}">
                <div class="agent-card__img-wrap">
                    <img src="{{ $agent['img'] }}" alt="{{ $agent['name'] }}" class="agent-card__img">
                </div>
                <div class="agent-card__body">
                    <span class="agent-card__badge">{{ $agent['badge'] }}</span>
                    <div class="agent-card__name">{{ $agent['name'] }}</div>
                    <div class="agent-card__city">{{ $agent['city'] }}</div>
                    <div class="agent-card__rating">
                        {{ $agent['rating'] }} &nbsp; <span style="color:var(--muted);font-weight:400">({{ $agent['review'] }})</span>
                    </div>
                    <div class="agent-card__footer">
                        <div class="agent-card__services">
                            @foreach($agent['tags'] as $tag)
                            <span class="tag">{{ $tag }}</span>
                            @endforeach
                        </div>
                        <button class="agent-card__cta">Pilih</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- ===== DESTINATIONS ===== --}}
    {{-- FIX: ganti .dest-scroll (flex horizontal) → .dest-grid (grid vertikal/wrap) --}}
    <section class="destinations" id="destinasi">
        <div class="destinations__header">
            <div class="section-tag">Jelajahi Indonesia</div>
            <h2 class="section-title">Destinasi <em>Populer</em></h2>
        </div>
        <div class="dest-grid">
            @php
                $destinations = [
                    ['name'=>'Bali',         'province'=>'Bali',               'bg'=>'images/bali-con.jpg'],
                    ['name'=>'Labuan Bajo',  'province'=>'NTT',                'bg'=>'images/labuan.jpg'],
                    ['name'=>'Raja Ampat',   'province'=>'Papua Barat Daya',   'bg'=>'images/raja.jpg'],
                    ['name'=>'Lombok',       'province'=>'NTB',                'bg'=>'images/lombok-con.jpg'],
                    ['name'=>'Bromo',        'province'=>'Jawa Timur',         'bg'=>'images/bromo.jpg'],
                    ['name'=>'Dieng',        'province'=>'Jawa Tengah',        'bg'=>'images/dieng.jpg'],
                    ['name'=>'Wakatobi',     'province'=>'Sulawesi Tenggara',  'bg'=>'images/wakatobi.jpg'],
                    ['name'=>'Danau Toba',   'province'=>'Sumatera Utara',     'bg'=>'images/toba.jpg'],
                ];
            @endphp
            @foreach($destinations as $d)
            <div class="dest-card reveal">
                <div class="dest-card__bg" style="background-image: url('{{ $d['bg'] }}')"></div>
                <div class="dest-card__info">
                    <div class="dest-card__name">{{ $d['name'] }}</div>
                    <div class="dest-card__province">{{ $d['province'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- ===== TESTIMONIALS ===== --}}
    <section class="testimonials" id="ulasan">
        <div class="section-tag">Ulasan Pelanggan</div>
        <h2 class="section-title">Kata Mereka <em>Soal MobiTravel</em></h2>

        <div class="testi__grid">
            @php
                $testimonials = [
                    ['quote'=>'Awalnya skeptis pakai platform ini buat pulang kampung ke Purwokerto dari Surabaya. Ternyata supirnya profesional banget, tepat waktu, ramah, dan kendaraan bersih. Keluarga kami nyaman sepanjang perjalanan. Pasti bakal pakai lagi!', 'name'=>'Rizky Firmansyah', 'role'=>'Karyawan Swasta, Surabaya', 'stars'=>5, 'initial'=>'R'],
                    ['quote'=>'Paket wisata Bromo via MobiTravel beyond expectation. Agen lokal yang ditunjuk sudah hafal semua spot terbaik.', 'name'=>'Aulia Putri',       'role'=>'Fotografer, Malang',       'stars'=>5, 'initial'=>'A'],
                    ['quote'=>'Harga transparan, tidak ada biaya tambahan dadakan. Sangat recommended buat yang mau liburan keluarga hemat tapi berkualitas.', 'name'=>'Budi Santoso',  'role'=>'Wiraswasta, Jakarta',      'stars'=>4, 'initial'=>'B'],
                    ['quote'=>'Kami sekeluarga 8 orang pergi ke Bali, semua koordinasinya rapi banget. Agen lokalnya responsif 24 jam.', 'name'=>'Dewi Lestari',      'role'=>'Ibu Rumah Tangga, Bandung', 'stars'=>5, 'initial'=>'D'],
                ];
            @endphp
            @foreach($testimonials as $t)
            <div class="testi-card reveal">
                <div class="testi__mark">"</div>
                <div class="testi__stars">{{ str_repeat('★', $t['stars']) }}</div>
                <p class="testi__quote">{{ $t['quote'] }}</p>
                <div class="testi__user">
                    <div class="testi__avatar">{{ $t['initial'] }}</div>
                    <div>
                        <div class="testi__name">{{ $t['name'] }}</div>
                        <div class="testi__role">{{ $t['role'] }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- ===== CTA BANNER ===== --}}
    <section class="cta-banner">
        <div class="section-tag cta-banner__tag" style="justify-content:center">Bergabung Sekarang</div>
        <h2 class="section-title cta-banner__title">Punya Usaha Travel Lokal? <em>Bergabung bersama Kami</em></h2>
        <p class="cta-banner__sub">Daftarkan agen travelmu dan jangkau ribuan pelanggan baru. Gratis pendaftaran, mudah dikelola, dan didukung tim MobiTravel.</p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
            <a href="#" class="btn btn--primary">Daftar Agen Gratis →</a>
            <a href="#" class="btn btn--outline">Hubungi Kami</a>
        </div>
    </section>

    {{-- ===== FOOTER ===== --}}
    <footer class="footer">
        <div class="footer__top">
            <div>
                <div class="footer__logo">Mobi<span>Travel</span></div>
                <p class="footer__desc">Platform yang menghubungkan wisatawan dengan agen travel lokal terpercaya di seluruh nusantara — termasuk layanan supir untuk perjalanan nyaman.</p>
                <div class="footer__socials">
                    <a class="social-btn" href="#" title="Instagram">IG</a>
                    <a class="social-btn" href="#" title="Facebook">FB</a>
                    <a class="social-btn" href="#" title="WhatsApp">WA</a>
                    <a class="social-btn" href="#" title="TikTok">TT</a>
                </div>
            </div>
            <div>
                <div class="footer__heading">Layanan</div>
                <ul class="footer__links">
                    <li><a href="#">Wisata Keluarga</a></li>
                    <li><a href="#">Antar Jemput</a></li>
                    <li><a href="#">Sewa Supir</a></li>
                    <li><a href="#">Paket Honeymoon</a></li>
                    <li><a href="#">Corporate Tour</a></li>
                </ul>
            </div>
            <div>
                <div class="footer__heading">Perusahaan</div>
                <ul class="footer__links">
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Daftar Jadi Agen</a></li>
                    <li><a href="#">Blog & Tips</a></li>
                    <li><a href="#">Karir</a></li>
                    <li><a href="#">Hubungi Kami</a></li>
                </ul>
            </div>
            <div>
                <div class="footer__heading">Bantuan</div>
                <ul class="footer__links">
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Syarat & Ketentuan</a></li>
                    <li><a href="#">Kebijakan Refund</a></li>
                    <li><a href="#">Pusat Bantuan</a></li>
                </ul>
            </div>
        </div>
        <div class="footer__bottom">
            <span>Dibuat dengan kepedulian untuk agen travel lokal Indonesia</span>
        </div>
    </footer>

    {{-- ===== SCRIPTS ===== --}}
    <script>
        const nav = document.getElementById('mainNav');
        window.addEventListener('scroll', () => {
            nav.classList.toggle('scrolled', window.scrollY > 60);
        });

        const reveals = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    observer.unobserve(e.target);
                }
            });
        }, { threshold: 0.12 });
        reveals.forEach(el => observer.observe(el));
    </script>
</body>
</html>