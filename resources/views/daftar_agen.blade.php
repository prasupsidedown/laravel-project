<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Agen — MobiTravel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=DM+Sans:wght@300;400;500&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

    <style>
        /* ============================================================
           DESIGN TOKENS — sama persis dengan main site
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

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        html { scroll-behavior: smooth; font-size: 16px; overflow-x: hidden; }

        body {
            font-family: var(--font-body);
            background: var(--ivory);
            color: var(--ink);
            overflow-x: hidden;
            width: 100%;
        }

        img { display: block; max-width: 100%; }
        a   { text-decoration: none; color: inherit; }

        /* Noise texture */
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
            background: rgba(245,240,232,.92);
            backdrop-filter: blur(12px);
            box-shadow: 0 1px 0 rgba(0,0,0,.08);
        }

        .nav__logo {
            font-family: var(--font-display);
            font-size: 1.5rem;
            font-weight: 900;
            color: var(--forest);
            letter-spacing: -.02em;
        }
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
            color: var(--ink);
            transition: color .2s;
        }
        .nav__links a:hover,
        .nav__links a.active { color: var(--sage); }

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
           PAGE HERO / HEADER
        ============================================================ */
        .page-hero {
            background:
                linear-gradient(160deg, rgba(26,51,40,.9) 0%, rgba(45,90,61,.75) 60%, rgba(26,51,40,.9) 100%),
                url('images/hero.jpg') center/cover no-repeat;
            padding: 9rem 4rem 5rem;
            position: relative;
            overflow: hidden;
        }

        .page-hero::after {
            content: '';
            position: absolute;
            bottom: -2px; left: 0; right: 0;
            height: 80px;
            background: var(--ivory);
            clip-path: polygon(0 100%, 100% 0, 100% 100%);
        }

        /* Decorative circle */
        .page-hero::before {
            content: '';
            position: absolute;
            width: 500px; height: 500px;
            border-radius: 50%;
            border: 1px solid rgba(168,197,176,.15);
            top: -100px; right: -100px;
        }

        .page-hero__breadcrumb {
            display: flex;
            align-items: center;
            gap: .5rem;
            font-family: var(--font-mono);
            font-size: .72rem;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: rgba(245,240,232,.5);
            margin-bottom: 1.25rem;
            position: relative;
            z-index: 1;
        }
        .page-hero__breadcrumb a { color: var(--gold); transition: opacity .2s; }
        .page-hero__breadcrumb a:hover { opacity: .8; }
        .page-hero__breadcrumb span { opacity: .4; }

        .page-hero__tag {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            font-family: var(--font-mono);
            font-size: .75rem;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }
        .page-hero__tag::before {
            content: '';
            display: inline-block;
            width: 2.5rem; height: 1px;
            background: var(--gold);
        }

        .page-hero__title {
            font-family: var(--font-display);
            font-size: clamp(2.25rem, 5vw, 4rem);
            font-weight: 900;
            color: var(--cream);
            letter-spacing: -.03em;
            line-height: 1.05;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }
        .page-hero__title em { font-style: italic; color: var(--gold); }

        .page-hero__sub {
            font-size: 1rem;
            color: rgba(245,240,232,.7);
            max-width: 500px;
            line-height: 1.7;
            position: relative;
            z-index: 1;
        }

        /* Stats bar */
        .page-hero__stats {
            display: flex;
            gap: 3rem;
            margin-top: 2.5rem;
            position: relative;
            z-index: 1;
        }

        .stat {
            display: flex;
            flex-direction: column;
            gap: .2rem;
        }
        .stat__num {
            font-family: var(--font-display);
            font-size: 1.75rem;
            font-weight: 900;
            color: var(--cream);
            line-height: 1;
        }
        .stat__num span { color: var(--gold); }
        .stat__label {
            font-size: .78rem;
            color: rgba(245,240,232,.5);
            font-family: var(--font-mono);
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        /* ============================================================
           FILTER & SEARCH BAR
        ============================================================ */
        .filter-bar {
            background: var(--ivory);
            border-bottom: 1px solid var(--sand);
            padding: 1.5rem 4rem;
            position: sticky;
            top: 73px;
            z-index: 50;
            box-shadow: 0 4px 20px rgba(26,51,40,.06);
        }

        .filter-bar__inner {
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .filter-search {
            flex: 1;
            min-width: 220px;
            position: relative;
        }

        .filter-search__icon {
            position: absolute;
            left: .85rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: .95rem;
            pointer-events: none;
        }

        .filter-search input {
            width: 100%;
            border: 1.5px solid var(--sand);
            border-radius: 2rem;
            padding: .6rem 1rem .6rem 2.4rem;
            font-family: var(--font-body);
            font-size: .9rem;
            color: var(--ink);
            background: #fff;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        .filter-search input:focus {
            border-color: var(--sage);
            box-shadow: 0 0 0 3px rgba(78,128,96,.12);
        }
        .filter-search input::placeholder { color: var(--muted); }

        .filter-select {
            border: 1.5px solid var(--sand);
            border-radius: 2rem;
            padding: .6rem 2rem .6rem 1rem;
            font-family: var(--font-body);
            font-size: .875rem;
            color: var(--ink);
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%237a7a6e'/%3E%3C/svg%3E") no-repeat right .85rem center;
            outline: none;
            appearance: none;
            cursor: pointer;
            transition: border-color .2s, box-shadow .2s;
        }
        .filter-select:focus {
            border-color: var(--sage);
            box-shadow: 0 0 0 3px rgba(78,128,96,.12);
        }

        .filter-chip {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .5rem 1rem;
            border-radius: 2rem;
            border: 1.5px solid var(--sand);
            background: #fff;
            font-size: .8rem;
            font-weight: 500;
            color: var(--muted);
            cursor: pointer;
            transition: all .2s;
            white-space: nowrap;
        }
        .filter-chip:hover { border-color: var(--sage); color: var(--forest); }
        .filter-chip.active {
            background: var(--forest);
            border-color: var(--forest);
            color: var(--cream);
        }

        .filter-bar__count {
            font-family: var(--font-mono);
            font-size: .75rem;
            color: var(--muted);
            letter-spacing: .06em;
            margin-left: auto;
            white-space: nowrap;
        }

        /* ============================================================
           MAIN LAYOUT — sidebar + grid
        ============================================================ */
        .page-body {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 0;
            min-height: 60vh;
        }

        /* ============================================================
           SIDEBAR
        ============================================================ */
        .sidebar {
            border-right: 1px solid var(--sand);
            padding: 2.5rem 2rem;
            background: var(--ivory);
            position: sticky;
            top: calc(73px + 73px); /* nav + filter bar */
            height: fit-content;
            max-height: calc(100vh - 160px);
            overflow-y: auto;
        }

        .sidebar__section { margin-bottom: 2.25rem; }

        .sidebar__title {
            font-family: var(--font-mono);
            font-size: .72rem;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .sidebar__title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--sand);
        }

        .sidebar__list { list-style: none; display: flex; flex-direction: column; gap: .35rem; }

        .sidebar__item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: .45rem .65rem;
            border-radius: .5rem;
            cursor: pointer;
            transition: background .2s, color .2s;
            font-size: .875rem;
            color: var(--ink);
        }
        .sidebar__item:hover { background: var(--cream); }
        .sidebar__item.active {
            background: var(--forest);
            color: var(--cream);
            font-weight: 500;
        }

        .sidebar__count {
            font-family: var(--font-mono);
            font-size: .7rem;
            color: var(--muted);
            background: var(--sand);
            padding: .1rem .45rem;
            border-radius: 1rem;
        }
        .sidebar__item.active .sidebar__count {
            background: rgba(255,255,255,.15);
            color: rgba(245,240,232,.7);
        }

        /* Rating filter */
        .rating-option {
            display: flex;
            align-items: center;
            gap: .5rem;
            padding: .4rem .65rem;
            border-radius: .5rem;
            cursor: pointer;
            transition: background .2s;
            font-size: .875rem;
        }
        .rating-option:hover { background: var(--cream); }
        .rating-option input[type="checkbox"] { accent-color: var(--sage); width: 1rem; height: 1rem; }
        .stars { color: var(--gold); font-size: .85rem; }

        /* Range slider */
        .price-range {
            padding: 0 .65rem;
        }
        .price-range__labels {
            display: flex;
            justify-content: space-between;
            font-size: .78rem;
            color: var(--muted);
            margin-bottom: .5rem;
            font-family: var(--font-mono);
        }
        .price-range input[type="range"] {
            width: 100%;
            accent-color: var(--sage);
        }

        /* ============================================================
           AGENTS GRID
        ============================================================ */
        .agents-main {
            padding: 2.5rem 3rem;
            background: var(--ivory);
        }

        .agents-main__toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.75rem;
            gap: 1rem;
        }

        .toolbar__info {
            font-size: .875rem;
            color: var(--muted);
        }
        .toolbar__info strong { color: var(--forest); }

        .toolbar__sort {
            display: flex;
            align-items: center;
            gap: .5rem;
            font-size: .8rem;
            color: var(--muted);
        }
        .toolbar__sort select {
            border: 1.5px solid var(--sand);
            border-radius: .5rem;
            padding: .4rem .8rem;
            font-family: var(--font-body);
            font-size: .8rem;
            color: var(--ink);
            background: #fff;
            outline: none;
            cursor: pointer;
            appearance: none;
        }

        .view-toggle {
            display: flex;
            gap: .25rem;
        }
        .view-btn {
            width: 2rem; height: 2rem;
            border-radius: .4rem;
            border: 1.5px solid var(--sand);
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: .85rem;
            color: var(--muted);
            transition: all .2s;
        }
        .view-btn.active { background: var(--forest); border-color: var(--forest); color: var(--cream); }

        /* Grid layout */
        .agent-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        /* List layout */
        .agent-grid.list-view {
            grid-template-columns: 1fr;
        }
        .agent-grid.list-view .agent-card {
            display: grid;
            grid-template-columns: 200px 1fr;
        }
        .agent-grid.list-view .agent-card__img { height: 100%; min-height: 160px; }
        .agent-grid.list-view .agent-card__img-wrap { height: 100%; }

        /* ============================================================
           AGENT CARD
        ============================================================ */
        .agent-card {
            background: #fff;
            border: 1.5px solid var(--sand);
            border-radius: 1.25rem;
            overflow: hidden;
            transition: transform .3s var(--ease-bounce), box-shadow .3s;
            cursor: pointer;
            position: relative;
        }
        .agent-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 50px rgba(26,51,40,.12);
        }

        /* Unggulan badge ribbon */
        .agent-card__ribbon {
            position: absolute;
            top: 1rem;
            left: 1rem;
            z-index: 2;
            background: var(--gold);
            color: var(--forest);
            font-family: var(--font-mono);
            font-size: .65rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: .3rem .65rem;
            border-radius: 2rem;
        }

        /* Verified badge */
        .agent-card__verified {
            position: absolute;
            top: 1rem;
            right: 1rem;
            z-index: 2;
            background: rgba(26,51,40,.85);
            backdrop-filter: blur(4px);
            color: var(--mist);
            font-size: .7rem;
            font-weight: 600;
            padding: .3rem .6rem;
            border-radius: 2rem;
            display: flex;
            align-items: center;
            gap: .3rem;
        }

        .agent-card__img-wrap { overflow: hidden; position: relative; }
        .agent-card__img {
            width: 100%;
            height: 190px;
            object-fit: cover;
            transition: transform .5s var(--ease-smooth);
            display: block;
        }
        .agent-card:hover .agent-card__img { transform: scale(1.05); }

        .agent-card__body { padding: 1.4rem; }

        .agent-card__meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: .65rem;
        }

        .agent-card__badge {
            display: inline-block;
            background: var(--mist);
            color: var(--forest);
            font-size: .68rem;
            font-weight: 600;
            letter-spacing: .06em;
            text-transform: uppercase;
            padding: .2rem .6rem;
            border-radius: 2rem;
        }
        .agent-card__badge.unggulan { background: rgba(232,168,62,.2); color: var(--terra); }

        .agent-card__rating {
            display: flex;
            align-items: center;
            gap: .3rem;
            font-size: .82rem;
            font-weight: 700;
            color: var(--terra);
        }
        .agent-card__rating span { color: var(--muted); font-weight: 400; font-size: .78rem; }

        .agent-card__name {
            font-family: var(--font-display);
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--forest);
            margin-bottom: .3rem;
            line-height: 1.2;
        }

        .agent-card__city {
            font-size: .82rem;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: .3rem;
            margin-bottom: .75rem;
        }

        /* Stats row */
        .agent-card__stats {
            display: flex;
            gap: 1.25rem;
            padding: .75rem 0;
            border-top: 1px solid var(--sand);
            border-bottom: 1px solid var(--sand);
            margin-bottom: .85rem;
        }

        .astat {
            display: flex;
            flex-direction: column;
            gap: .1rem;
        }
        .astat__val {
            font-family: var(--font-display);
            font-size: 1rem;
            font-weight: 700;
            color: var(--forest);
        }
        .astat__label {
            font-size: .68rem;
            color: var(--muted);
            font-family: var(--font-mono);
            letter-spacing: .04em;
        }

        .agent-card__tags { display: flex; gap: .4rem; flex-wrap: wrap; margin-bottom: .9rem; }

        .tag {
            font-size: .7rem;
            padding: .2rem .55rem;
            border-radius: 2rem;
            background: var(--cream);
            border: 1px solid var(--sand);
            color: var(--muted);
        }

        .agent-card__footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: .5rem;
        }

        .agent-card__price {
            display: flex;
            flex-direction: column;
        }
        .agent-card__price-label { font-size: .7rem; color: var(--muted); font-family: var(--font-mono); }
        .agent-card__price-val {
            font-family: var(--font-display);
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--forest);
        }
        .agent-card__price-val small {
            font-size: .72rem;
            font-family: var(--font-body);
            font-weight: 400;
            color: var(--muted);
        }

        .agent-card__cta {
            background: var(--forest);
            color: var(--cream);
            border: none;
            border-radius: 2rem;
            padding: .5rem 1.15rem;
            font-size: .82rem;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s, transform .2s var(--ease-bounce);
            white-space: nowrap;
            flex-shrink: 0;
        }
        .agent-card__cta:hover { background: var(--moss); transform: scale(1.05); }

        /* Wishlist button */
        .agent-card__wish {
            position: absolute;
            bottom: 1.35rem;
            right: 8.5rem;
            width: 2rem; height: 2rem;
            border-radius: 50%;
            border: 1.5px solid var(--sand);
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .9rem;
            cursor: pointer;
            transition: all .2s var(--ease-bounce);
            z-index: 1;
        }
        .agent-card__wish:hover { border-color: #e55; transform: scale(1.15); }
        .agent-card__wish.liked { background: #fff0f0; border-color: #e55; }

        /* ============================================================
           FEATURED AGENT (full-width card)
        ============================================================ */
        .agent-card--featured {
            grid-column: 1 / -1;
            display: grid;
            grid-template-columns: 340px 1fr;
        }
        .agent-card--featured .agent-card__img { height: 100%; min-height: 240px; }
        .agent-card--featured .agent-card__img-wrap { height: 100%; }
        .agent-card--featured .agent-card__name { font-size: 1.4rem; }
        .agent-card--featured .agent-card__body { padding: 2rem; }

        /* ============================================================
           EMPTY STATE
        ============================================================ */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 5rem 2rem;
        }
        .empty-state__icon { font-size: 3rem; margin-bottom: 1rem; }
        .empty-state__title {
            font-family: var(--font-display);
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--forest);
            margin-bottom: .5rem;
        }
        .empty-state__sub { color: var(--muted); font-size: .9rem; }

        /* ============================================================
           PAGINATION
        ============================================================ */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: .5rem;
            margin-top: 3rem;
        }

        .page-btn {
            width: 2.4rem; height: 2.4rem;
            border-radius: .6rem;
            border: 1.5px solid var(--sand);
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .875rem;
            font-weight: 500;
            color: var(--ink);
            cursor: pointer;
            transition: all .2s;
        }
        .page-btn:hover { border-color: var(--sage); color: var(--forest); }
        .page-btn.active { background: var(--forest); border-color: var(--forest); color: var(--cream); }
        .page-btn.arrow { font-size: 1rem; }

        /* ============================================================
           CTA BOTTOM BANNER
        ============================================================ */
        .join-banner {
            background: var(--forest);
            padding: 5rem 4rem;
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: center;
            gap: 3rem;
            position: relative;
            overflow: hidden;
        }
        .join-banner::before {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            border-radius: 50%;
            border: 1px solid rgba(168,197,176,.1);
            top: -150px; right: 200px;
        }

        .join-banner__tag {
            font-family: var(--font-mono);
            font-size: .72rem;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--mist);
            display: flex;
            align-items: center;
            gap: .5rem;
            margin-bottom: .75rem;
        }
        .join-banner__tag::before {
            content: '';
            display: inline-block;
            width: 2rem; height: 1px;
            background: var(--mist);
        }

        .join-banner__title {
            font-family: var(--font-display);
            font-size: clamp(1.5rem, 3vw, 2.5rem);
            font-weight: 900;
            color: var(--cream);
            letter-spacing: -.02em;
            line-height: 1.1;
        }
        .join-banner__title em { font-style: italic; color: var(--gold); }

        .join-banner__sub {
            font-size: .9375rem;
            color: rgba(245,240,232,.6);
            margin-top: .75rem;
            line-height: 1.7;
            max-width: 480px;
        }

        .join-banner__actions { display: flex; gap: 1rem; flex-shrink: 0; flex-wrap: wrap; }

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
            white-space: nowrap;
        }
        .btn--primary { background: var(--gold); color: var(--forest); }
        .btn--primary:hover {
            background: var(--terra);
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(200,120,40,.35);
        }
        .btn--outline {
            background: transparent;
            border: 1.5px solid rgba(255,255,255,.35);
            color: var(--cream);
        }
        .btn--outline:hover { background: rgba(255,255,255,.08); transform: translateY(-3px); }

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

        .footer__logo { font-family: var(--font-display); font-size: 1.75rem; font-weight: 900; color: var(--cream); margin-bottom: .75rem; }
        .footer__logo span { color: var(--gold); }
        .footer__desc { font-size: .875rem; color: rgba(255,255,255,.45); line-height: 1.7; margin-bottom: 1.5rem; }
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

        .footer__heading { font-size: .75rem; letter-spacing: .1em; text-transform: uppercase; font-family: var(--font-mono); color: rgba(255,255,255,.3); margin-bottom: 1.25rem; }
        .footer__links { list-style: none; display: flex; flex-direction: column; gap: .6rem; }
        .footer__links a { font-size: .875rem; color: rgba(255,255,255,.55); transition: color .2s; }
        .footer__links a:hover { color: var(--gold); }

        .footer__bottom { display: flex; justify-content: space-between; align-items: center; font-size: .8125rem; color: rgba(255,255,255,.3); }

        /* ============================================================
           SCROLL REVEAL
        ============================================================ */
        .reveal { opacity: 0; transform: translateY(24px); transition: opacity .6s var(--ease-smooth), transform .6s var(--ease-smooth); }
        .reveal.visible { opacity: 1; transform: none; }
        .reveal-delay-1 { transition-delay: .08s; }
        .reveal-delay-2 { transition-delay: .16s; }
        .reveal-delay-3 { transition-delay: .24s; }

        /* ============================================================
           RESPONSIVE
        ============================================================ */
        @media (max-width: 1024px) {
            .nav { padding: 1.25rem 2rem; }
            .page-hero { padding: 8rem 2rem 4rem; }
            .filter-bar { padding: 1.25rem 2rem; }
            .page-body { grid-template-columns: 1fr; }
            .sidebar { position: static; max-height: none; border-right: none; border-bottom: 1px solid var(--sand); padding: 1.5rem 2rem; }
            .agents-main { padding: 1.5rem 2rem; }
            .join-banner { padding: 4rem 2rem; grid-template-columns: 1fr; text-align: center; }
            .join-banner__actions { justify-content: center; }
            .footer__top { grid-template-columns: 1fr 1fr; }
            .footer { padding: 3rem 2rem; }
        }

        @media (max-width: 768px) {
            .page-hero__stats { gap: 1.5rem; }
            .agent-card--featured { grid-template-columns: 1fr; }
            .agent-card--featured .agent-card__img { height: 200px; }
            .agent-grid.list-view .agent-card { grid-template-columns: 1fr; }
            .agent-grid.list-view .agent-card__img { height: 180px; }
        }

        @media (max-width: 640px) {
            .nav__links { display: none; }
            .filter-bar__count { display: none; }
            .agent-grid { grid-template-columns: 1fr; }
            .footer__top { grid-template-columns: 1fr; }
            .footer__bottom { flex-direction: column; gap: 1rem; text-align: center; }
        }
    </style>
</head>
<body>

    {{-- ===== NAVBAR ===== --}}
    <nav class="nav" id="mainNav">
        <a href="/" class="nav__logo">Mobi<span>Travel</span></a>
        <ul class="nav__links">
            <li><a href="/#layanan">Layanan</a></li>
            <li><a href="/agen" class="active">Agen</a></li>
            <li><a href="/#destinasi">Destinasi</a></li>
            <li><a href="/#ulasan">Ulasan</a></li>
            <li><a href="/daftar-agen" class="nav__cta">Daftar Agen</a></li>
        </ul>
    </nav>

    {{-- ===== PAGE HERO ===== --}}
    <div class="page-hero">
        <div class="page-hero__breadcrumb">
            <a href="/">Beranda</a>
            <span>/</span>
            <span>Daftar Agen</span>
        </div>
        <div class="page-hero__tag">Agen Mitra Terverifikasi</div>
        <h1 class="page-hero__title">Temukan Agen Travel<br><em>Terpercaya di Kotamu</em></h1>
        <p class="page-hero__sub">Semua agen telah melalui proses verifikasi ketat — berizin, berpengalaman, dan siap melayani perjalananmu dengan profesional.</p>
        <div class="page-hero__stats">
            <div class="stat">
                <div class="stat__num">240</div>
                <div class="stat__label">Agen Aktif</div>
            </div>
            <div class="stat">
                <div class="stat__num">38</div>
                <div class="stat__label">Kota & Kabupaten</div>
            </div>
            <div class="stat">
                <div class="stat__num">4.8</div>
                <div class="stat__label">Rating Rata-rata</div>
            </div>
        </div>
    </div>

    {{-- ===== FILTER BAR ===== --}}
    <div class="filter-bar">
        <div class="filter-bar__inner">
            <div class="filter-search">
                <input type="text" id="searchInput" placeholder="Cari nama agen atau kota...">
            </div>
            <select class="filter-select" id="kotaFilter">
                <option value="">Semua Kota</option>
                <option>Bali</option>
                <option>Lombok</option>
                <option>Yogyakarta</option>
                <option>Surabaya</option>
                <option>Medan</option>
                <option>Makassar</option>
                <option>Malang</option>
                <option>Bandung</option>
            </select>
            <select class="filter-select" id="layananFilter">
                <option value="">Semua Layanan</option>
                <option>Wisata</option>
                <option>Supir</option>
                <option>Antar Jemput</option>
                <option>Paket Honeymoon</option>
                <option>Corporate Tour</option>
            </select>
            <button class="filter-chip active" onclick="toggleChip(this)">Semua</button>
            <button class="filter-chip" onclick="toggleChip(this)">Unggulan</button>
            <button class="filter-chip" onclick="toggleChip(this)">Terverifikasi</button>
            <button class="filter-chip" onclick="toggleChip(this)">Baru</button>
            <span class="filter-bar__count" id="agentCount">Menampilkan <strong>12</strong> agen</span>
        </div>
    </div>

    {{-- ===== MAIN CONTENT ===== --}}
    <div class="page-body">

        {{-- SIDEBAR --}}
        <aside class="sidebar">

            <div class="sidebar__section">
                <div class="sidebar__title">Provinsi</div>
                <ul class="sidebar__list" id="provinsiList">
                    @php
                        $provinsi = [
                            ['name' => 'Semua Provinsi', 'count' => 240, 'active' => true],
                            ['name' => 'Bali',           'count' => 48],
                            ['name' => 'Jawa Timur',     'count' => 37],
                            ['name' => 'Jawa Tengah',    'count' => 29],
                            ['name' => 'DI Yogyakarta',  'count' => 22],
                            ['name' => 'NTB',            'count' => 18],
                            ['name' => 'NTT',            'count' => 15],
                            ['name' => 'Sumatera Utara', 'count' => 14],
                            ['name' => 'Sulawesi Sel.',  'count' => 12],
                            ['name' => 'Papua Barat',    'count' => 8],
                        ];
                    @endphp
                    @foreach($provinsi as $p)
                    <li class="sidebar__item {{ $p['active'] ?? false ? 'active' : '' }}" onclick="filterProvinsi(this)">
                        {{ $p['name'] }}
                        <span class="sidebar__count">{{ $p['count'] }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="sidebar__section">
                <div class="sidebar__title">Rating</div>
                @php
                    $ratings = [5,4,3];
                @endphp
                @foreach($ratings as $r)
                <label class="rating-option">
                    <input type="checkbox" {{ $r >= 4 ? 'checked' : '' }}>
                    <span class="stars">{{ str_repeat('★', $r) }}{{ str_repeat('☆', 5-$r) }}</span>
                    <span style="font-size:.8rem;color:var(--muted)">{{ $r }}+</span>
                </label>
                @endforeach
            </div>

            <div class="sidebar__section">
                <div class="sidebar__title">Layanan</div>
                <ul class="sidebar__list">
                    @php
                        $layananList = ['Wisata Keluarga','Sewa Supir','Antar Jemput','Paket Honeymoon','Wisata Alam','Corporate Tour','Kapal & Ferry'];
                    @endphp
                    @foreach($layananList as $l)
                    <li class="sidebar__item" onclick="this.classList.toggle('active')">{{ $l }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="sidebar__section">
                <div class="sidebar__title">Harga Mulai Dari</div>
                <div class="price-range">
                    <div class="price-range__labels">
                        <span>Rp 100rb</span>
                        <span id="priceVal">Rp 5jt</span>
                    </div>
                    <input type="range" min="100000" max="5000000" step="100000" value="5000000"
                        oninput="updatePrice(this.value)">
                </div>
            </div>

        </aside>

        {{-- AGENTS MAIN --}}
        <main class="agents-main">

            <div class="agents-main__toolbar">
                <div class="toolbar__info">
                    Menampilkan <strong>12</strong> dari <strong>240</strong> agen
                </div>
                <div style="display:flex;align-items:center;gap:1rem;">
                    <div class="toolbar__sort">
                        <span>Urutkan:</span>
                        <select>
                            <option>Rating Tertinggi</option>
                            <option>Ulasan Terbanyak</option>
                            <option>Harga Terendah</option>
                            <option>Terbaru</option>
                        </select>
                    </div>
                    <div class="view-toggle">
                        <button class="view-btn active" onclick="setView('grid', this)" title="Grid view">⊞</button>
                        <button class="view-btn" onclick="setView('list', this)" title="List view">≡</button>
                    </div>
                </div>
            </div>

            <div class="agent-grid" id="agentGrid">

                {{-- ===== FEATURED CARD ===== --}}
                @php
                $featured = [
                    'img'   => 'images/bali.jpg',
                    'name'  => 'Surya Wisata Bali',
                    'city'  => 'Denpasar, Bali',
                    'rating'=> '4.9',
                    'review'=> '312',
                    'trips' => '1.200+',
                    'years' => '8',
                    'price' => 'Rp 350rb',
                    'tags'  => ['Wisata','Supir','Antar Jemput','Honeymoon'],
                    'badge' => 'unggulan',
                ];
                @endphp
                <div class="agent-card agent-card--featured reveal">
                    <div class="agent-card__img-wrap">
                        <img src="{{ $featured['img'] }}" alt="{{ $featured['name'] }}" class="agent-card__img">
                    </div>
                    <div class="agent-card__body">
                        <div class="agent-card__meta">
                            <span class="agent-card__badge unggulan">Agen Unggulan</span>
                            <div class="agent-card__rating">{{ $featured['rating'] }} <span>({{ $featured['review'] }} ulasan)</span></div>
                        </div>
                        <div class="agent-card__name">{{ $featured['name'] }}</div>
                        <div class="agent-card__city">{{ $featured['city'] }}</div>
                        <div class="agent-card__stats">
                            <div class="astat">
                                <div class="astat__val">{{ $featured['trips'] }}</div>
                                <div class="astat__label">Perjalanan</div>
                            </div>
                            <div class="astat">
                                <div class="astat__val">{{ $featured['years'] }} Thn</div>
                                <div class="astat__label">Pengalaman</div>
                            </div>
                            <div class="astat">
                                <div class="astat__val">{{ $featured['review'] }}</div>
                                <div class="astat__label">Ulasan</div>
                            </div>
                        </div>
                        <div class="agent-card__tags">
                            @foreach($featured['tags'] as $tag)
                            <span class="tag">{{ $tag }}</span>
                            @endforeach
                        </div>
                        <div class="agent-card__footer">
                            <div class="agent-card__price">
                                <span class="agent-card__price-label">Mulai dari</span>
                                <span class="agent-card__price-val">{{ $featured['price'] }} <small>/ hari</small></span>
                            </div>
                            <div style="display:flex;gap:.5rem;align-items:center">
                                <button class="agent-card__wish" onclick="toggleWish(this)" title="Simpan"></button>
                                <button class="agent-card__cta">Lihat Profil</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== REGULAR CARDS ===== --}}
                @php
                $agents = [
                    [
                        'img'   => 'images/lombok.jpg',
                        'name'  => 'Lombok Express Tour',
                        'city'  => 'Mataram, NTB',
                        'rating'=> '4.8',
                        'review'=> '198',
                        'trips' => '860+',
                        'years' => '6',
                        'price' => 'Rp 280rb',
                        'tags'  => ['Paket Wisata','Supir','Kapal'],
                        'badge' => 'Terverifikasi',
                    ],
                    [
                        'img'   => 'images/bromo.jpg',
                        'name'  => 'Bromo Adventure Jaya',
                        'city'  => 'Probolinggo, Jawa Timur',
                        'rating'=> '4.7',
                        'review'=> '145',
                        'trips' => '540+',
                        'years' => '5',
                        'price' => 'Rp 220rb',
                        'tags'  => ['Wisata Alam','Supir','Jeep'],
                        'badge' => 'Terverifikasi',
                    ],
                    [
                        'img'   => 'images/dieng.jpg',
                        'name'  => 'Dieng Jaya Wisata',
                        'city'  => 'Wonosobo, Jawa Tengah',
                        'rating'=> '4.8',
                        'review'=> '203',
                        'trips' => '720+',
                        'years' => '7',
                        'price' => 'Rp 190rb',
                        'tags'  => ['Wisata Alam','Supir','Camping'],
                        'badge' => 'Agen Unggulan',
                        'featured' => true,
                    ],
                    [
                        'img'   => 'images/raja.jpg',
                        'name'  => 'Raja Ampat Explorer',
                        'city'  => 'Sorong, Papua Barat',
                        'rating'=> '4.9',
                        'review'=> '89',
                        'trips' => '310+',
                        'years' => '4',
                        'price' => 'Rp 550rb',
                        'tags'  => ['Diving','Kapal','Paket Wisata'],
                        'badge' => 'Terverifikasi',
                    ],
                    [
                        'img'   => 'images/toba.jpg',
                        'name'  => 'Danau Toba Travel',
                        'city'  => 'Parapat, Sumatera Utara',
                        'rating'=> '4.6',
                        'review'=> '117',
                        'trips' => '430+',
                        'years' => '5',
                        'price' => 'Rp 210rb',
                        'tags'  => ['Wisata','Supir','Feri'],
                        'badge' => 'Terverifikasi',
                    ],
                    [
                        'img'   => 'images/wakatobi.jpg',
                        'name'  => 'Wakatobi Sea Tours',
                        'city'  => 'Wangi-wangi, Sulawesi Tenggara',
                        'rating'=> '4.7',
                        'review'=> '74',
                        'trips' => '280+',
                        'years' => '3',
                        'price' => 'Rp 480rb',
                        'tags'  => ['Diving','Snorkeling','Kapal'],
                        'badge' => 'Terverifikasi',
                    ],
                    [
                        'img'   => 'images/labuan.jpg',
                        'name'  => 'Labuan Bajo Prima',
                        'city'  => 'Labuan Bajo, NTT',
                        'rating'=> '4.8',
                        'review'=> '156',
                        'trips' => '610+',
                        'years' => '6',
                        'price' => 'Rp 420rb',
                        'tags'  => ['Wisata','Kapal','Komodo Tour'],
                        'badge' => 'Agen Unggulan',
                        'featured' => true,
                    ],
                    [
                        'img'   => 'images/jogja.jpg',
                        'name'  => 'Jogja Heritage Tour',
                        'city'  => 'Yogyakarta, DIY',
                        'rating'=> '4.7',
                        'review'=> '281',
                        'trips' => '1.050+',
                        'years' => '9',
                        'price' => 'Rp 175rb',
                        'tags'  => ['Wisata Budaya','Supir','Kraton'],
                        'badge' => 'Terverifikasi',
                    ],
                    [
                        'img'   => 'images/medan.jpg',
                        'name'  => 'Sumatra Explore',
                        'city'  => 'Medan, Sumatera Utara',
                        'rating'=> '4.5',
                        'review'=> '93',
                        'trips' => '340+',
                        'years' => '4',
                        'price' => 'Rp 200rb',
                        'tags'  => ['Wisata','Supir','Antar Jemput'],
                        'badge' => 'Terverifikasi',
                    ],
                    [
                        'img'   => 'images/makassar.jpg',
                        'name'  => 'Makassar Journey',
                        'city'  => 'Makassar, Sulawesi Selatan',
                        'rating'=> '4.6',
                        'review'=> '108',
                        'trips' => '390+',
                        'years' => '5',
                        'price' => 'Rp 230rb',
                        'tags'  => ['Wisata','Supir','Kapal'],
                        'badge' => 'Terverifikasi',
                    ],
                    [
                        'img'   => 'images/malang.jpg',
                        'name'  => 'Malang Raya Tour',
                        'city'  => 'Malang, Jawa Timur',
                        'rating'=> '4.7',
                        'review'=> '176',
                        'trips' => '680+',
                        'years' => '6',
                        'price' => 'Rp 195rb',
                        'tags'  => ['Wisata Alam','Supir','Batu City Tour'],
                        'badge' => 'Agen Unggulan',
                        'featured' => true,
                    ],
                ];
                @endphp

                @foreach($agents as $i => $agent)
                <div class="agent-card reveal reveal-delay-{{ ($i % 3) + 1 }}">
                    <div class="agent-card__ribbon">{{ ($agent['featured'] ?? false) ? 'Unggulan' : 'Verified' }}</div>
                    <div class="agent-card__img-wrap">
                        <img src="{{ $agent['img'] }}" alt="{{ $agent['name'] }}" class="agent-card__img" loading="lazy">
                    </div>
                    <div class="agent-card__body">
                        <div class="agent-card__meta">
                            <span class="agent-card__badge {{ ($agent['featured'] ?? false) ? 'unggulan' : '' }}">{{ $agent['badge'] }}</span>
                            <div class="agent-card__rating">{{ $agent['rating'] }} <span>({{ $agent['review'] }})</span></div>
                        </div>
                        <div class="agent-card__name">{{ $agent['name'] }}</div>
                        <div class="agent-card__city">{{ $agent['city'] }}</div>
                        <div class="agent-card__stats">
                            <div class="astat">
                                <div class="astat__val">{{ $agent['trips'] }}</div>
                                <div class="astat__label">Trip</div>
                            </div>
                            <div class="astat">
                                <div class="astat__val">{{ $agent['years'] }} Thn</div>
                                <div class="astat__label">Pengalaman</div>
                            </div>
                            <div class="astat">
                                <div class="astat__val">{{ $agent['review'] }}</div>
                                <div class="astat__label">Ulasan</div>
                            </div>
                        </div>
                        <div class="agent-card__tags">
                            @foreach($agent['tags'] as $tag)
                            <span class="tag">{{ $tag }}</span>
                            @endforeach
                        </div>
                        <div class="agent-card__footer">
                            <div class="agent-card__price">
                                <span class="agent-card__price-label">Mulai dari</span>
                                <span class="agent-card__price-val">{{ $agent['price'] }} <small>/ hari</small></span>
                            </div>
                            <div style="display:flex;gap:.5rem;align-items:center">
                                <button class="agent-card__wish" onclick="toggleWish(this)" title="Simpan"></button>
                                <button class="agent-card__cta">Lihat →</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>{{-- end .agent-grid --}}

            {{-- PAGINATION --}}
            <div class="pagination">
                <button class="page-btn arrow">‹</button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">4</button>
                <span style="color:var(--muted);font-size:.875rem">...</span>
                <button class="page-btn">20</button>
                <button class="page-btn arrow">›</button>
            </div>

        </main>

    </div>{{-- end .page-body --}}

    {{-- ===== JOIN BANNER ===== --}}
    <div class="join-banner">
        <div>
            <div class="join-banner__tag">Untuk Pengusaha Travel</div>
            <h2 class="join-banner__title">Punya Usaha Travel Lokal?<br><em>Bergabung bersama Kami</em></h2>
            <p class="join-banner__sub">Daftarkan agen travelmu dan jangkau ribuan pelanggan baru. Gratis pendaftaran, mudah dikelola, dan didukung penuh tim MobiTravel.</p>
        </div>
        <div class="join-banner__actions">
            <a href="/daftar-agen" class="btn btn--primary">Daftar Agen Gratis</a>
            <a href="/kontak" class="btn btn--outline">Hubungi Kami</a>
        </div>
    </div>

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
            <span>© {{ date('Y') }} MobiTravel. Hak cipta dilindungi.</span>
            <span>Dibuat dengan kepedulian untuk agen travel lokal Indonesia</span>
        </div>
    </footer>

    {{-- ===== SCRIPTS ===== --}}
    <script>
        /* Scroll reveal */
        const reveals = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    observer.unobserve(e.target);
                }
            });
        }, { threshold: 0.08 });
        reveals.forEach(el => observer.observe(el));

        /* Provinsi filter */
        function filterProvinsi(el) {
            document.querySelectorAll('#provinsiList .sidebar__item').forEach(i => i.classList.remove('active'));
            el.classList.add('active');
        }

        /* Layanan / sidebar toggle */
        document.querySelectorAll('.sidebar__list .sidebar__item').forEach(item => {
            item.addEventListener('click', () => item.classList.toggle('active'));
        });

        /* Filter chips */
        function toggleChip(el) {
            document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
            el.classList.add('active');
        }

        /* Grid / List view toggle */
        function setView(mode, btn) {
            document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const grid = document.getElementById('agentGrid');
            if (mode === 'list') {
                grid.classList.add('list-view');
            } else {
                grid.classList.remove('list-view');
            }
        }

        /* Price range label */
        function updatePrice(val) {
            const num = parseInt(val);
            const label = num >= 1000000
                ? 'Rp ' + (num / 1000000).toFixed(1).replace('.0','') + 'jt'
                : 'Rp ' + (num / 1000) + 'rb';
            document.getElementById('priceVal').textContent = label;
        }

        /* Pagination */
        document.querySelectorAll('.page-btn:not(.arrow)').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.page-btn:not(.arrow)').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });

        /* Live search (UI only — filter real data server-side di production) */
        document.getElementById('searchInput').addEventListener('input', function() {
            const q = this.value.toLowerCase();
            document.querySelectorAll('.agent-card').forEach(card => {
                const name = card.querySelector('.agent-card__name')?.textContent.toLowerCase() || '';
                const city = card.querySelector('.agent-card__city')?.textContent.toLowerCase() || '';
                card.style.display = (name.includes(q) || city.includes(q)) ? '' : 'none';
            });
        });
    </script>

</body>
</html>