<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TravelGo — Layanan Transportasi Travel Online</title>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>

*, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

:root {
  --bg: #f7f4ef;
  --bg2: #eee9e0;
  --dark: #0e0d0b;
  --mid: #3a3730;
  --muted: #8c8880;
  --accent: #c8965a;
  --accent2: #e8b97a;
  --white: #fdfcfa;
  --border: rgba(14,13,11,0.1);
}

html { scroll-behavior: smooth; }

body {
  background: var(--bg);
  color: var(--dark);
  font-family: 'DM Sans', sans-serif;
  min-height: 100vh;
  overflow-x: hidden;
  cursor: none;
}

/* CUSTOM CURSOR */
.cursor {
  position: fixed;
  width: 10px; height: 10px;
  background: var(--accent);
  border-radius: 50%;
  pointer-events: none;
  z-index: 9999;
  transform: translate(-50%, -50%);
  transition: transform 0.1s, width 0.3s, height 0.3s, background 0.3s;
}
.cursor-ring {
  position: fixed;
  width: 36px; height: 36px;
  border: 1.5px solid var(--accent);
  border-radius: 50%;
  pointer-events: none;
  z-index: 9998;
  transform: translate(-50%, -50%);
  transition: transform 0.12s ease, width 0.3s, height 0.3s, opacity 0.3s;
  opacity: 0.6;
}

/* ── NOISE TEXTURE OVERLAY ── */
body::before {
  content: '';
  position: fixed;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
  pointer-events: none;
  z-index: 1000;
  opacity: 0.5;
}

/* ── BURGER ── */
.burger-btn {
  position: fixed; top: 28px; right: 32px; z-index: 500;
  width: 46px; height: 46px;
  background: var(--dark); border: none; border-radius: 50%;
  cursor: none; display: flex; flex-direction: column;
  justify-content: center; align-items: center; gap: 5px;
  transition: background 0.3s, transform 0.3s;
}
.burger-btn:hover { background: var(--accent); transform: scale(1.08); }
.burger-btn span {
  display: block; width: 18px; height: 1.5px;
  background: var(--white); border-radius: 2px;
  transition: transform 0.35s cubic-bezier(0.4,0,0.2,1), opacity 0.25s, width 0.3s;
}
.burger-btn span:nth-child(2) { width: 12px; }
.burger-btn.open span:nth-child(1) { transform: translateY(6.5px) rotate(45deg); width: 18px; }
.burger-btn.open span:nth-child(2) { opacity: 0; }
.burger-btn.open span:nth-child(3) { transform: translateY(-6.5px) rotate(-45deg); width: 18px; }

/* ── SLIDE MENU ── */
.slide-menu {
  position: fixed; top: 0; right: -420px; width: 380px; height: 100vh;
  background: var(--dark);
  z-index: 499; transition: right 0.5s cubic-bezier(0.4,0,0.2,1);
  display: flex; flex-direction: column; padding: 100px 48px 48px;
}
.slide-menu.open { right: 0; box-shadow: -30px 0 80px rgba(0,0,0,0.3); }

.menu-label {
  font-family: 'DM Sans', sans-serif; font-size: 10px;
  letter-spacing: 5px; color: var(--muted); text-transform: uppercase; margin-bottom: 32px;
}
.slide-menu a {
  display: flex; align-items: center; justify-content: space-between;
  text-decoration: none; color: var(--white);
  font-family: 'Cormorant Garamond', serif; font-size: 36px; font-weight: 300;
  padding: 16px 0; border-bottom: 1px solid rgba(255,255,255,0.06);
  transition: color 0.25s, padding-left 0.3s;
  cursor: none;
}
.slide-menu a:hover { color: var(--accent); padding-left: 10px; }
.slide-menu a .num {
  font-family: 'DM Sans', sans-serif; font-size: 11px;
  color: var(--muted); letter-spacing: 2px;
}
.slide-menu .socials {
  margin-top: auto; display: flex; gap: 12px;
}
.slide-menu .socials a {
  font-family: 'DM Sans', sans-serif; font-size: 12px;
  font-weight: 400; color: var(--muted);
  border: 1px solid rgba(255,255,255,0.1);
  padding: 10px 18px; border-radius: 100px;
  flex: 1; text-align: center; justify-content: center;
  transition: color 0.25s, border-color 0.25s, padding-left 0.25s;
  letter-spacing: 1px;
}
.slide-menu .socials a:hover { color: var(--accent); border-color: var(--accent); padding-left: 18px; }

.overlay {
  position: fixed; inset: 0; background: rgba(14,13,11,0.4);
  z-index: 498; opacity: 0; pointer-events: none; transition: opacity 0.4s;
  backdrop-filter: blur(4px);
}
.overlay.show { opacity: 1; pointer-events: all; }

/* ── LOGO ── */
.logo {
  position: fixed; top: 32px; left: 36px; z-index: 500;
  font-family: 'Cormorant Garamond', serif; font-size: 22px;
  font-weight: 600; color: var(--dark); letter-spacing: 1px;
  opacity: 0; animation: fadeIn 0.8s ease forwards 0.3s;
}
.logo span { color: var(--accent); }

/* ── HERO ── */
.hero {
  position: relative; min-height: 100vh;
  display: grid; grid-template-rows: 1fr auto;
  padding: 0; overflow: hidden;
}

/* BIG BACKGROUND TEXT */
.bg-text {
  position: absolute; top: 50%; left: 50%;
  transform: translate(-50%, -50%);
  font-family: 'Cormorant Garamond', serif;
  font-size: clamp(100px, 18vw, 220px);
  font-weight: 700; letter-spacing: -8px;
  color: transparent; -webkit-text-stroke: 1px rgba(14,13,11,0.06);
  white-space: nowrap; pointer-events: none; user-select: none;
  animation: bgTextDrift 20s ease-in-out infinite alternate;
}
@keyframes bgTextDrift {
  from { transform: translate(-50%, -50%) translateX(-20px); }
  to   { transform: translate(-50%, -50%) translateX(20px); }
}

/* DECORATIVE LINE */
.deco-line {
  position: absolute; top: 0; left: 50%;
  width: 1px; height: 100%;
  background: linear-gradient(to bottom, transparent 0%, var(--border) 30%, var(--border) 70%, transparent 100%);
  pointer-events: none;
}

.hero-content {
  display: flex; flex-direction: column;
  justify-content: center; align-items: center;
  text-align: center;
  padding: 120px 24px 60px;
  position: relative; z-index: 2;
}

.hero-tag {
  display: inline-flex; align-items: center; gap: 10px;
  font-family: 'DM Sans', sans-serif; font-size: 11px;
  letter-spacing: 4px; text-transform: uppercase; color: var(--accent);
  margin-bottom: 40px;
  opacity: 0; animation: fadeUp 0.7s ease forwards 0.5s;
}
.hero-tag::before, .hero-tag::after {
  content: ''; display: block; width: 30px; height: 1px; background: var(--accent);
}

.hero-title {
  font-family: 'Cormorant Garamond', serif;
  font-size: clamp(52px, 9vw, 110px);
  font-weight: 300; line-height: 1.0; letter-spacing: -3px;
  color: var(--dark);
  opacity: 0; animation: fadeUp 0.9s ease forwards 0.7s;
  max-width: 900px;
}
.hero-title em {
  font-style: italic; color: var(--accent);
  font-weight: 300;
}

.hero-sub {
  font-family: 'DM Sans', sans-serif; font-size: 15px;
  font-weight: 300; color: var(--muted); line-height: 1.7;
  max-width: 440px; margin: 28px auto 0;
  opacity: 0; animation: fadeUp 0.9s ease forwards 0.9s;
}

/* SEARCH BAR */
.search-bar {
  margin-top: 52px; width: 100%; max-width: 680px;
  background: var(--white); border: 1px solid var(--border);
  border-radius: 100px; display: flex; align-items: center;
  padding: 8px 8px 8px 28px; gap: 12px;
  box-shadow: 0 4px 40px rgba(14,13,11,0.08);
  opacity: 0; animation: fadeUp 0.9s ease forwards 1.1s;
}
.search-bar input {
  flex: 1; border: none; background: transparent;
  font-family: 'DM Sans', sans-serif; font-size: 14px; color: var(--dark);
  outline: none;
}
.search-bar input::placeholder { color: var(--muted); }
.search-bar .divider {
  width: 1px; height: 24px; background: var(--border);
}
.search-bar select {
  border: none; background: transparent; font-family: 'DM Sans', sans-serif;
  font-size: 14px; color: var(--muted); outline: none; padding: 0 8px; cursor: none;
}
.search-bar button {
  background: var(--accent); border: none; color: var(--white);
  font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 500;
  padding: 14px 28px; border-radius: 100px; cursor: none;
  transition: background 0.25s, transform 0.2s;
  white-space: nowrap;
}
.search-bar button:hover { background: var(--dark); transform: scale(1.03); }

/* ── STATS ROW ── */
.hero-stats {
  display: flex; justify-content: center; align-items: center;
  gap: 0; padding: 32px 48px;
  border-top: 1px solid var(--border);
  position: relative; z-index: 2;
  opacity: 0; animation: fadeIn 1s ease forwards 1.4s;
}
.stat {
  flex: 1; text-align: center; padding: 20px 32px;
  border-right: 1px solid var(--border);
}
.stat:last-child { border-right: none; }
.stat-num {
  font-family: 'Cormorant Garamond', serif; font-size: 42px;
  font-weight: 600; color: var(--dark); line-height: 1;
}
.stat-num span { color: var(--accent); }
.stat-label {
  font-family: 'DM Sans', sans-serif; font-size: 11px;
  letter-spacing: 3px; text-transform: uppercase; color: var(--muted);
  margin-top: 6px;
}

/* ── FEATURES SECTION ── */
.features {
  padding: 100px 60px;
  background: var(--white);
  position: relative; overflow: hidden;
}
.features::before {
  content: '';
  position: absolute; top: -100px; right: -100px;
  width: 400px; height: 400px;
  background: radial-gradient(circle, rgba(200,150,90,0.06) 0%, transparent 70%);
  border-radius: 50%;
}

.section-header {
  display: flex; justify-content: space-between; align-items: flex-end;
  margin-bottom: 64px;
}
.section-tag {
  font-family: 'DM Sans', sans-serif; font-size: 10px;
  letter-spacing: 4px; text-transform: uppercase; color: var(--accent);
  margin-bottom: 12px;
}
.section-title {
  font-family: 'Cormorant Garamond', serif;
  font-size: clamp(36px, 4vw, 56px); font-weight: 400;
  line-height: 1.1; color: var(--dark); max-width: 400px;
}
.section-title em { font-style: italic; color: var(--accent); }
.section-desc {
  font-family: 'DM Sans', sans-serif; font-size: 14px;
  color: var(--muted); line-height: 1.7; max-width: 280px; text-align: right;
}

.features-grid {
  display: grid; grid-template-columns: repeat(3, 1fr); gap: 2px;
}
.feature-card {
  background: var(--bg); padding: 44px 36px;
  transition: background 0.3s;
  position: relative; overflow: hidden;
}
.feature-card::before {
  content: '';
  position: absolute; bottom: 0; left: 0; right: 0; height: 2px;
  background: var(--accent); transform: scaleX(0);
  transform-origin: left; transition: transform 0.4s ease;
}
.feature-card:hover { background: var(--bg2); }
.feature-card:hover::before { transform: scaleX(1); }

.feat-num {
  font-family: 'Cormorant Garamond', serif; font-size: 56px;
  font-weight: 300; color: rgba(14,13,11,0.06); line-height: 1;
  margin-bottom: 20px;
}
.feat-icon {
  font-size: 28px; margin-bottom: 16px; display: block;
}
.feat-title {
  font-family: 'Cormorant Garamond', serif; font-size: 24px;
  font-weight: 600; color: var(--dark); margin-bottom: 12px;
}
.feat-desc {
  font-family: 'DM Sans', sans-serif; font-size: 13px;
  color: var(--muted); line-height: 1.7;
}

/* ── TARGET SECTION ── */
.target {
  padding: 100px 60px;
  background: var(--dark);
  position: relative; overflow: hidden;
}
.target .bg-deco {
  position: absolute; top: -80px; left: -80px;
  width: 360px; height: 360px;
  border: 1px solid rgba(200,150,90,0.1); border-radius: 50%;
}
.target .bg-deco2 {
  position: absolute; bottom: -120px; right: -80px;
  width: 500px; height: 500px;
  border: 1px solid rgba(200,150,90,0.06); border-radius: 50%;
}

.target .section-title { color: var(--white); }
.target .section-desc { color: rgba(255,255,255,0.4); }

.target-grid {
  display: grid; grid-template-columns: repeat(3, 1fr);
  gap: 24px; margin-top: 60px; position: relative; z-index: 1;
}
.target-card {
  border: 1px solid rgba(255,255,255,0.07);
  padding: 44px 32px; border-radius: 4px;
  transition: border-color 0.3s, background 0.3s;
}
.target-card:hover {
  border-color: var(--accent);
  background: rgba(200,150,90,0.04);
}
.target-icon { font-size: 36px; margin-bottom: 20px; }
.target-title {
  font-family: 'Cormorant Garamond', serif; font-size: 26px;
  font-weight: 400; color: var(--white); margin-bottom: 12px;
}
.target-desc {
  font-family: 'DM Sans', sans-serif; font-size: 13px;
  color: rgba(255,255,255,0.4); line-height: 1.7;
}

/* ── MANFAAT SECTION ── */
.manfaat {
  padding: 100px 60px;
  background: var(--bg);
}

.manfaat-grid {
  display: grid; grid-template-columns: 1fr 1fr;
  gap: 2px; margin-top: 60px;
}
.manfaat-item {
  background: var(--white); padding: 48px 44px;
  display: flex; gap: 28px;
  transition: background 0.3s;
}
.manfaat-item:hover { background: var(--bg2); }
.manfaat-num {
  font-family: 'Cormorant Garamond', serif; font-size: 48px;
  font-weight: 300; color: var(--accent); line-height: 1;
  min-width: 40px;
}
.manfaat-content {}
.manfaat-title {
  font-family: 'Cormorant Garamond', serif; font-size: 22px;
  font-weight: 600; color: var(--dark); margin-bottom: 10px;
}
.manfaat-desc {
  font-family: 'DM Sans', sans-serif; font-size: 13px;
  color: var(--muted); line-height: 1.7;
}

/* ── CTA SECTION ── */
.cta {
  padding: 120px 60px;
  background: var(--accent);
  text-align: center; position: relative; overflow: hidden;
}
.cta::before {
  content: 'TRAVEL';
  position: absolute; top: 50%; left: 50%;
  transform: translate(-50%, -50%);
  font-family: 'Cormorant Garamond', serif;
  font-size: 220px; font-weight: 700; letter-spacing: -10px;
  color: rgba(255,255,255,0.06);
  white-space: nowrap; pointer-events: none;
}
.cta-sub {
  font-family: 'DM Sans', sans-serif; font-size: 11px;
  letter-spacing: 5px; text-transform: uppercase; color: rgba(14,13,11,0.5);
  margin-bottom: 24px;
}
.cta-title {
  font-family: 'Cormorant Garamond', serif;
  font-size: clamp(40px, 6vw, 80px); font-weight: 400;
  color: var(--dark); line-height: 1.1;
  margin-bottom: 40px; position: relative; z-index: 1;
}
.cta-btn {
  display: inline-flex; align-items: center; gap: 12px;
  background: var(--dark); color: var(--white);
  font-family: 'DM Sans', sans-serif; font-size: 14px;
  font-weight: 500; letter-spacing: 1px;
  padding: 18px 40px; border-radius: 100px; text-decoration: none;
  transition: background 0.3s, transform 0.25s;
  position: relative; z-index: 1; cursor: none;
}
.cta-btn:hover { background: var(--white); color: var(--dark); transform: translateY(-3px); }
.cta-btn .arrow { font-size: 18px; transition: transform 0.3s; }
.cta-btn:hover .arrow { transform: translateX(5px); }

/* ── FOOTER ── */
footer {
  background: var(--dark); color: var(--white);
  padding: 60px; display: flex;
  justify-content: space-between; align-items: center;
  border-top: 1px solid rgba(255,255,255,0.05);
}
.footer-logo {
  font-family: 'Cormorant Garamond', serif; font-size: 28px;
  font-weight: 600; letter-spacing: 1px;
}
.footer-logo span { color: var(--accent); }
.footer-links { display: flex; gap: 32px; }
.footer-links a {
  font-family: 'DM Sans', sans-serif; font-size: 12px;
  letter-spacing: 2px; text-transform: uppercase; color: var(--muted);
  text-decoration: none; transition: color 0.25s; cursor: none;
}
.footer-links a:hover { color: var(--accent); }
.footer-copy {
  font-family: 'DM Sans', sans-serif; font-size: 12px; color: var(--muted);
}

/* PAGE FADE TRANSITION */
body.fade-out { animation: pageOut 0.5s ease forwards; }
@keyframes pageOut { to { opacity: 0; transform: translateY(-16px); } }

/* ANIMATIONS */
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(28px); }
  to   { opacity: 1; transform: translateY(0); }
}
@keyframes fadeIn {
  from { opacity: 0; }
  to   { opacity: 1; }
}

/* SCROLL REVEAL */
.reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.8s ease, transform 0.8s ease; }
.reveal.visible { opacity: 1; transform: translateY(0); }
.reveal-delay-1 { transition-delay: 0.1s; }
.reveal-delay-2 { transition-delay: 0.2s; }
.reveal-delay-3 { transition-delay: 0.3s; }
.reveal-delay-4 { transition-delay: 0.4s; }

/* SCROLL HINT */
.scroll-hint {
  position: absolute; bottom: 120px; left: 50%;
  transform: translateX(-50%); display: flex;
  flex-direction: column; align-items: center; gap: 10px;
  opacity: 0; animation: fadeIn 1s ease forwards 1.6s;
  z-index: 2;
}
.scroll-hint span {
  font-family: 'DM Sans', sans-serif; font-size: 9px;
  letter-spacing: 4px; text-transform: uppercase; color: var(--muted);
}
.scroll-line {
  width: 1px; height: 48px;
  background: linear-gradient(to bottom, var(--accent), transparent);
  animation: scrollPulse 2s ease-in-out infinite;
}
@keyframes scrollPulse { 0%,100%{opacity:0.3} 50%{opacity:1} }

/* RESPONSIVE */
@media (max-width: 768px) {
  .features-grid, .target-grid { grid-template-columns: 1fr; }
  .manfaat-grid { grid-template-columns: 1fr; }
  .hero-stats { flex-direction: column; gap: 0; }
  .stat { border-right: none; border-bottom: 1px solid var(--border); }
  .stat:last-child { border-bottom: none; }
  .section-header { flex-direction: column; align-items: flex-start; gap: 16px; }
  .section-desc { text-align: left; }
  footer { flex-direction: column; gap: 24px; text-align: center; }
  .footer-links { flex-wrap: wrap; justify-content: center; }
  .features, .target, .manfaat, .cta { padding: 60px 24px; }
  .search-bar { flex-direction: column; border-radius: 16px; padding: 16px; }
  .search-bar button { width: 100%; justify-content: center; }
  .search-bar .divider { width: 100%; height: 1px; }
}

</style>
</head>
<body>

<!-- CUSTOM CURSOR -->
<div class="cursor" id="cursor"></div>
<div class="cursor-ring" id="cursorRing"></div>

<!-- LOGO -->
<div class="logo">Mobi<span>Travel</span></div>

<!-- BURGER -->
<button class="burger-btn" id="burgerBtn">
  <span></span><span></span><span></span>
</button>

<!-- SLIDE MENU -->
<nav class="slide-menu" id="slideMenu">
  <div class="menu-label">Navigasi</div>
  <a href="#fitur"><span>Fitur</span> <span class="num">01</span></a>
  <a href="#target"><span>Target</span> <span class="num">02</span></a>
  <a href="#manfaat"><span>Manfaat</span> <span class="num">03</span></a>
  <a href="#booking"><span>Booking</span> <span class="num">04</span></a>
  <div class="socials">
    <a href="https://github.com/nafannz" target="_blank">GitHub</a>
    <a href="https://www.instagram.com/naff.java/" target="_blank">Instagram</a>
  </div>
</nav>

<div class="overlay" id="overlay"></div>

<!-- ── HERO ── -->
<section class="hero" id="home">
  <div class="bg-text">PERJALANAN</div>
  <div class="deco-line"></div>

  <div class="hero-content">
    <div class="hero-tag">Kelompok 7 · PENS PSDKU-LA</div>
    <h1 class="hero-title">
      Layanan Transportasi<br><em>Travel Online</em>
    </h1>
    <p class="hero-sub">
      Platform pemesanan perjalanan berbasis web & mobile yang cepat, aman, dan terintegrasi untuk semua kebutuhan transportasi Anda.
    </p>

    <!-- SEARCH BAR -->
    <div class="search-bar" id="booking">
      <input type="text" placeholder="Kota asal..." />
      <div class="divider"></div>
      <input type="text" placeholder="Kota tujuan..." />
      <div class="divider"></div>
      <select>
        <option>Pilih tanggal</option>
        <option>Hari ini</option>
        <option>Besok</option>
        <option>Pilih tanggal lain</option>
      </select>
      <button>Cari Tiket →</button>
    </div>
  </div>

  <!-- STATS -->
  <div class="hero-stats">
    <div class="stat">
      <div class="stat-num">500<span>+</span></div>
      <div class="stat-label">Destinasi</div>
    </div>
    <div class="stat">
      <div class="stat-num">50<span>K+</span></div>
      <div class="stat-label">Pengguna Aktif</div>
    </div>
    <div class="stat">
      <div class="stat-num">98<span>%</span></div>
      <div class="stat-label">Kepuasan Pelanggan</div>
    </div>
    <div class="stat">
      <div class="stat-num">24<span>/7</span></div>
      <div class="stat-label">Layanan Aktif</div>
    </div>
  </div>

  <div class="scroll-hint">
    <span>scroll</span>
    <div class="scroll-line"></div>
  </div>
</section>

<!-- ── FITUR ── -->
<section class="features" id="fitur">
  <div class="section-header reveal">
    <div>
      <div class="section-tag">Apa yang kami tawarkan</div>
      <h2 class="section-title">Fitur <em>Unggulan</em> Platform</h2>
    </div>
    <p class="section-desc">Dirancang untuk kemudahan pengguna dan efisiensi operasional bisnis travel modern.</p>
  </div>

  <div class="features-grid">
    <div class="feature-card reveal reveal-delay-1">
      <div class="feat-num">01</div>
      <span class="feat-icon">🎫</span>
      <div class="feat-title">Booking Online</div>
      <p class="feat-desc">Pesan tiket transportasi dan hotel kapan saja dan di mana saja dengan antarmuka yang intuitif dan responsif.</p>
    </div>
    <div class="feature-card reveal reveal-delay-2">
      <div class="feat-num">02</div>
      <span class="feat-icon">🔍</span>
      <div class="feat-title">Pencarian Real-time</div>
      <p class="feat-desc">Cari dan bandingkan harga tiket serta hotel secara real-time untuk mendapatkan penawaran terbaik.</p>
    </div>
    <div class="feature-card reveal reveal-delay-3">
      <div class="feat-num">03</div>
      <span class="feat-icon">💳</span>
      <div class="feat-title">Pembayaran Digital</div>
      <p class="feat-desc">Sistem pembayaran terintegrasi dengan payment gateway yang aman dan mendukung berbagai metode pembayaran.</p>
    </div>
    <div class="feature-card reveal reveal-delay-1">
      <div class="feat-num">04</div>
      <span class="feat-icon">📱</span>
      <div class="feat-title">E-Ticket Otomatis</div>
      <p class="feat-desc">Tiket digital langsung dikirim ke email dan tersimpan di aplikasi begitu pembayaran berhasil dikonfirmasi.</p>
    </div>
    <div class="feature-card reveal reveal-delay-2">
      <div class="feat-num">05</div>
      <span class="feat-icon">📊</span>
      <div class="feat-title">Riwayat Transaksi</div>
      <p class="feat-desc">Seluruh riwayat pemesanan tersimpan otomatis sehingga mudah diakses kembali kapan pun dibutuhkan.</p>
    </div>
    <div class="feature-card reveal reveal-delay-3">
      <div class="feat-num">06</div>
      <span class="feat-icon">🛡️</span>
      <div class="feat-title">Keamanan Transaksi</div>
      <p class="feat-desc">Data dan transaksi pengguna terlindungi dengan enkripsi end-to-end dan sistem keamanan berlapis.</p>
    </div>
  </div>
</section>

<!-- ── TARGET PENGGUNA ── -->
<section class="target" id="target">
  <div class="bg-deco"></div>
  <div class="bg-deco2"></div>

  <div class="section-header reveal">
    <div>
      <div class="section-tag" style="color: var(--accent2);">Siapa yang kami layani</div>
      <h2 class="section-title" style="color: var(--white);">Target <em>Pengguna</em></h2>
    </div>
    <p class="section-desc">Platform dirancang untuk melayani berbagai segmen pengguna secara optimal.</p>
  </div>

  <div class="target-grid">
    <div class="target-card reveal reveal-delay-1">
      <div class="target-icon">🌍</div>
      <div class="target-title">Wisatawan Lokal & Internasional</div>
      <p class="target-desc">Pengguna yang mencari kemudahan dalam merencanakan perjalanan wisata, baik di dalam maupun luar negeri.</p>
    </div>
    <div class="target-card reveal reveal-delay-2">
      <div class="target-icon">🤝</div>
      <div class="target-title">Agen Travel & Mitra Transportasi</div>
      <p class="target-desc">Mitra bisnis yang ingin mengembangkan jaringan distribusi tiket dan layanan transportasi secara digital.</p>
    </div>
    <div class="target-card reveal reveal-delay-3">
      <div class="target-icon">👨‍👩‍👧‍👦</div>
      <div class="target-title">Keluarga & Rombongan</div>
      <p class="target-desc">Kelompok pelancong yang membutuhkan kemudahan pemesanan tiket dalam jumlah banyak sekaligus.</p>
    </div>
  </div>
</section>

<!-- ── MANFAAT ── -->
<section class="manfaat" id="manfaat">
  <div class="section-header reveal">
    <div>
      <div class="section-tag">Nilai yang kami hadirkan</div>
      <h2 class="section-title">Manfaat Bagi <em>Pengguna</em> & Bisnis</h2>
    </div>
    <p class="section-desc">Empat fase manfaat yang dihadirkan platform untuk mendorong pertumbuhan ekosistem travel digital.</p>
  </div>

  <div class="manfaat-grid">
    <div class="manfaat-item reveal reveal-delay-1">
      <div class="manfaat-num">1</div>
      <div class="manfaat-content">
        <div class="manfaat-title">Pencarian & Perbandingan Harga</div>
        <p class="manfaat-desc">Mempermudah pencarian tiket & hotel dengan perbandingan harga secara real-time sehingga pengguna selalu mendapatkan penawaran terbaik.</p>
      </div>
    </div>
    <div class="manfaat-item reveal reveal-delay-2">
      <div class="manfaat-num">2</div>
      <div class="manfaat-content">
        <div class="manfaat-title">Booking Cepat & Praktis</div>
        <p class="manfaat-desc">Proses pemesanan yang streamlined dan riwayat transaksi tersimpan otomatis untuk memudahkan pengelolaan perjalanan.</p>
      </div>
    </div>
    <div class="manfaat-item reveal reveal-delay-3">
      <div class="manfaat-num">3</div>
      <div class="manfaat-content">
        <div class="manfaat-title">Efisiensi Operasional</div>
        <p class="manfaat-desc">Meningkatkan efisiensi operasional bisnis travel dan memperluas jangkauan pasar digital secara signifikan.</p>
      </div>
    </div>
    <div class="manfaat-item reveal reveal-delay-4">
      <div class="manfaat-num">4</div>
      <div class="manfaat-content">
        <div class="manfaat-title">Integrasi Data Terpusat</div>
        <p class="manfaat-desc">Sistem data terintegrasi yang mendukung loyalitas pelanggan dan pengambilan keputusan bisnis berbasis data.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── CTA ── -->
<section class="cta">
  <div class="cta-sub">Mulai perjalanan Anda</div>
  <h2 class="cta-title">Siap Berpetualang<br>Bersama Kami?</h2>
  <a href="#booking" class="cta-btn">
    Pesan Sekarang <span class="arrow">→</span>
  </a>
</section>

<!-- ── FOOTER ── -->
<footer>
  <div class="footer-logo">Travel<span>Go</span></div>
  <div class="footer-links">
    <a href="#fitur">Fitur</a>
    <a href="#target">Target</a>
    <a href="#manfaat">Manfaat</a>
    <a href="#booking">Booking</a>
  </div>
  <div class="footer-copy">© 2026 TravelGo · Kelompok 7 PENS</div>
</footer>

<script>
// ── CUSTOM CURSOR ──
const cursor = document.getElementById('cursor');
const ring   = document.getElementById('cursorRing');
let mx = 0, my = 0, rx = 0, ry = 0;

document.addEventListener('mousemove', e => {
  mx = e.clientX; my = e.clientY;
  cursor.style.left = mx + 'px'; cursor.style.top = my + 'px';
});

function animRing() {
  rx += (mx - rx) * 0.12;
  ry += (my - ry) * 0.12;
  ring.style.left = rx + 'px'; ring.style.top = ry + 'px';
  requestAnimationFrame(animRing);
}
animRing();

document.querySelectorAll('a, button, select, input').forEach(el => {
  el.addEventListener('mouseenter', () => {
    cursor.style.width = '6px'; cursor.style.height = '6px';
    ring.style.width = '56px'; ring.style.height = '56px'; ring.style.opacity = '1';
  });
  el.addEventListener('mouseleave', () => {
    cursor.style.width = '10px'; cursor.style.height = '10px';
    ring.style.width = '36px'; ring.style.height = '36px'; ring.style.opacity = '0.6';
  });
});

// ── BURGER MENU ──
const burgerBtn = document.getElementById('burgerBtn');
const slideMenu = document.getElementById('slideMenu');
const overlay   = document.getElementById('overlay');

burgerBtn.addEventListener('click', () => {
  const open = slideMenu.classList.toggle('open');
  burgerBtn.classList.toggle('open', open);
  overlay.classList.toggle('show', open);
});
overlay.addEventListener('click', closeMenu);
slideMenu.querySelectorAll('a').forEach(a => a.addEventListener('click', closeMenu));

function closeMenu() {
  slideMenu.classList.remove('open');
  burgerBtn.classList.remove('open');
  overlay.classList.remove('show');
}

// ── SCROLL REVEAL ──
const revealEls = document.querySelectorAll('.reveal');
const observer = new IntersectionObserver(entries => {
  entries.forEach(e => {
    if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); }
  });
}, { threshold: 0.12 });
revealEls.forEach(el => observer.observe(el));

// ── SMOOTH ANCHOR SCROLL ──
document.querySelectorAll('a[href^="#"]').forEach(a => {
  a.addEventListener('click', e => {
    e.preventDefault();
    const target = document.querySelector(a.getAttribute('href'));
    if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
  });
});

// ── PAGE FADE OUT ──
function navigate(e, url) {
  if (e) e.preventDefault();
  document.body.classList.add('fade-out');
  setTimeout(() => { window.location.href = url; }, 450);
}
</script>
</body>
</html>
