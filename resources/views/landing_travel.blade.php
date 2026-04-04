<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MobiTravel — Layanan Transportasi Travel Online</title>
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

/* NOISE TEXTURE OVERLAY */
body::before {
  content: '';
  position: fixed;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
  pointer-events: none;
  z-index: 1000;
  opacity: 0.5;
}

/* BURGER */
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

/* SLIDE MENU */
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

/* LOGO */
.logo {
  position: fixed; top: 32px; left: 36px; z-index: 500;
  font-family: 'Cormorant Garamond', serif; font-size: 22px;
  font-weight: 600; color: var(--dark); letter-spacing: 1px;
  opacity: 0; animation: fadeIn 0.8s ease forwards 0.3s;
}
.logo span { color: var(--accent); }

/* HERO */
.hero {
  position: relative; min-height: 100vh;
  display: grid; grid-template-rows: 1fr auto;
  padding: 0; overflow: hidden;
}

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
.hero-title em { font-style: italic; color: var(--accent); font-weight: 300; }

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
  position: relative;
}
.search-bar input[type="text"] {
  flex: 1; border: none; background: transparent;
  font-family: 'DM Sans', sans-serif; font-size: 14px; color: var(--dark);
  outline: none; min-width: 0;
}
.search-bar input[type="text"]::placeholder { color: var(--muted); }
.search-bar .divider {
  width: 1px; height: 24px; background: var(--border); flex-shrink: 0;
}
.search-bar .search-cta {
  background: var(--accent); border: none; color: var(--white);
  font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 500;
  padding: 14px 28px; border-radius: 100px; cursor: none;
  transition: background 0.25s, transform 0.2s;
  white-space: nowrap; flex-shrink: 0;
}
.search-bar .search-cta:hover { background: var(--dark); transform: scale(1.03); }

/* CITY PICKER */
.city-wrap {
  position: relative; flex: 1; min-width: 0;
}
.city-input-btn {
  width: 100%; border: none; background: transparent;
  font-family: 'DM Sans', sans-serif; font-size: 14px;
  color: var(--dark); outline: none; cursor: none;
  text-align: left; padding: 0; display: flex;
  align-items: center; gap: 6px;
  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.city-input-btn.placeholder { color: var(--muted); }
.city-input-btn .chevron { font-size: 10px; flex-shrink: 0; transition: transform 0.2s; }
.city-input-btn.open .chevron { transform: rotate(180deg); }

.city-popup {
  position: absolute;
  bottom: calc(100% + 20px);
  left: 50%; transform: translateX(-50%);
  width: 300px;
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 20px 60px rgba(14,13,11,0.15);
  z-index: 600;
  opacity: 0; pointer-events: none;
  transform: translateX(-50%) translateY(8px);
  transition: opacity 0.25s ease, transform 0.25s ease;
}
.city-popup.open {
  opacity: 1; pointer-events: all;
  transform: translateX(-50%) translateY(0);
}
.city-popup::after {
  content: '';
  position: absolute; bottom: -7px; left: 50%;
  transform: translateX(-50%) rotate(45deg);
  width: 13px; height: 13px;
  background: var(--white);
  border-right: 1px solid var(--border);
  border-bottom: 1px solid var(--border);
}

.city-search {
  padding: 14px 16px 10px;
  border-bottom: 1px solid var(--border);
}
.city-search input {
  width: 100%; border: none; background: var(--bg);
  border-radius: 8px; padding: 8px 12px;
  font-family: 'DM Sans', sans-serif; font-size: 13px;
  color: var(--dark); outline: none;
}
.city-search input::placeholder { color: var(--muted); }

.city-list {
  max-height: 240px; overflow-y: auto;
  padding: 6px 0;
}
.city-list::-webkit-scrollbar { width: 4px; }
.city-list::-webkit-scrollbar-track { background: transparent; }
.city-list::-webkit-scrollbar-thumb { background: var(--bg2); border-radius: 4px; }

.city-group-label {
  font-family: 'DM Sans', sans-serif; font-size: 10px;
  letter-spacing: 3px; text-transform: uppercase; color: var(--muted);
  padding: 10px 16px 4px; pointer-events: none;
}
.city-option {
  width: 100%; border: none; background: none;
  text-align: left; font-family: 'DM Sans', sans-serif;
  font-size: 13px; color: var(--dark);
  padding: 9px 16px; cursor: none;
  transition: background 0.15s;
  display: block;
}
.city-option:hover { background: var(--bg2); }
.city-option.selected { color: var(--accent); font-weight: 500; }
.city-option.hidden { display: none; }

/* SWAP BUTTON */
.swap-btn {
  border: 1px solid var(--border); background: var(--white);
  border-radius: 50%; width: 28px; height: 28px;
  display: flex; align-items: center; justify-content: center;
  cursor: none; flex-shrink: 0;
  transition: background 0.2s, border-color 0.2s, transform 0.3s;
  font-size: 13px; color: var(--muted);
}
.swap-btn:hover { background: var(--bg2); border-color: var(--accent); color: var(--accent); transform: rotate(180deg); }

/* DATE PICKER WRAPPER */
.date-picker-wrap {
  position: relative; flex-shrink: 0;
}

#dateBtn {
  border: none; background: transparent;
  font-family: 'DM Sans', sans-serif; font-size: 14px;
  color: var(--muted); outline: none; cursor: none;
  padding: 0 8px; white-space: nowrap;
  display: flex; align-items: center; gap: 6px;
  transition: color 0.2s;
}
#dateBtn.has-date { color: var(--dark); }
#dateBtn .cal-icon {
  width: 14px; height: 14px; opacity: 0.5;
}
#dateBtn .chevron {
  font-size: 10px; transition: transform 0.2s;
}
#dateBtn.open .chevron { transform: rotate(180deg); }

/* CALENDAR POPUP */
.cal-popup {
  position: absolute;
  bottom: calc(100% + 20px);
  left: 50%; transform: translateX(-50%);
  width: 300px;
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: 20px;
  padding: 20px;
  box-shadow: 0 20px 60px rgba(14,13,11,0.15);
  z-index: 600;
  opacity: 0; pointer-events: none;
  transform: translateX(-50%) translateY(8px);
  transition: opacity 0.25s ease, transform 0.25s ease;
}
.cal-popup.open {
  opacity: 1; pointer-events: all;
  transform: translateX(-50%) translateY(0);
}

/* Calendar arrow pointer */
.cal-popup::after {
  content: '';
  position: absolute; bottom: -7px; left: 50%;
  transform: translateX(-50%) rotate(45deg);
  width: 13px; height: 13px;
  background: var(--white);
  border-right: 1px solid var(--border);
  border-bottom: 1px solid var(--border);
}

.cal-nav {
  display: flex; justify-content: space-between; align-items: center;
  margin-bottom: 16px;
}
.cal-nav-btn {
  border: none; background: none; cursor: none;
  width: 32px; height: 32px; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  color: var(--mid); font-size: 16px;
  transition: background 0.2s, color 0.2s;
}
.cal-nav-btn:hover { background: var(--bg2); color: var(--dark); }

.cal-month-label {
  font-family: 'Cormorant Garamond', serif;
  font-size: 17px; font-weight: 600; color: var(--dark);
  letter-spacing: 0.3px;
}

.cal-days-header {
  display: grid; grid-template-columns: repeat(7, 1fr);
  margin-bottom: 6px;
}
.cal-days-header span {
  text-align: center; font-size: 10px; font-weight: 500;
  letter-spacing: 1px; color: var(--muted);
  padding: 4px 0; text-transform: uppercase;
}

.cal-grid {
  display: grid; grid-template-columns: repeat(7, 1fr);
  gap: 2px;
}

.cal-day {
  aspect-ratio: 1; border: none; background: none;
  border-radius: 50%; cursor: none;
  font-family: 'DM Sans', sans-serif; font-size: 12px;
  color: var(--dark); transition: background 0.15s, color 0.15s;
  display: flex; align-items: center; justify-content: center;
}
.cal-day:hover:not(:disabled) { background: var(--bg2); }
.cal-day.today {
  color: var(--accent); font-weight: 500;
  outline: 1px solid rgba(200,150,90,0.4);
  outline-offset: -2px;
}
.cal-day.selected {
  background: var(--accent); color: var(--white); font-weight: 500;
}
.cal-day.selected:hover { background: var(--mid); }
.cal-day:disabled { color: rgba(14,13,11,0.18); cursor: default; }
.cal-day.empty { pointer-events: none; }

/* Calendar footer */
.cal-footer {
  margin-top: 14px; padding-top: 14px;
  border-top: 1px solid var(--border);
  display: flex; gap: 8px;
}
.cal-footer-btn {
  flex: 1; border: 1px solid var(--border); background: none;
  border-radius: 100px; font-family: 'DM Sans', sans-serif;
  font-size: 12px; padding: 8px 12px; cursor: none;
  transition: background 0.2s, color 0.2s, border-color 0.2s;
  color: var(--mid);
}
.cal-footer-btn:hover { background: var(--bg2); border-color: var(--mid); }
.cal-footer-btn.accent-btn {
  background: var(--accent); color: var(--white); border-color: var(--accent);
}
.cal-footer-btn.accent-btn:hover { background: var(--mid); border-color: var(--mid); }

/* STATS ROW */
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

/* FEATURES SECTION */
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
.feat-title {
  font-family: 'Cormorant Garamond', serif; font-size: 24px;
  font-weight: 600; color: var(--dark); margin-bottom: 12px;
}
.feat-desc {
  font-family: 'DM Sans', sans-serif; font-size: 13px;
  color: var(--muted); line-height: 1.7;
}

/* TARGET SECTION */
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
.target-card:hover { border-color: var(--accent); background: rgba(200,150,90,0.04); }
.target-title {
  font-family: 'Cormorant Garamond', serif; font-size: 26px;
  font-weight: 400; color: var(--white); margin-bottom: 12px;
}
.target-desc {
  font-family: 'DM Sans', sans-serif; font-size: 13px;
  color: rgba(255,255,255,0.4); line-height: 1.7;
}

/* MANFAAT SECTION */
.manfaat { padding: 100px 60px; background: var(--bg); }

.manfaat-grid {
  display: grid; grid-template-columns: 1fr 1fr;
  gap: 2px; margin-top: 60px;
}
.manfaat-item {
  background: var(--white); padding: 48px 44px;
  display: flex; gap: 28px; transition: background 0.3s;
}
.manfaat-item:hover { background: var(--bg2); }
.manfaat-num {
  font-family: 'Cormorant Garamond', serif; font-size: 48px;
  font-weight: 300; color: var(--accent); line-height: 1; min-width: 40px;
}
.manfaat-title {
  font-family: 'Cormorant Garamond', serif; font-size: 22px;
  font-weight: 600; color: var(--dark); margin-bottom: 10px;
}
.manfaat-desc {
  font-family: 'DM Sans', sans-serif; font-size: 13px;
  color: var(--muted); line-height: 1.7;
}

/* CTA SECTION */
.cta {
  padding: 120px 60px; background: var(--accent);
  text-align: center; position: relative; overflow: hidden;
}
.cta::before {
  content: 'TRAVEL';
  position: absolute; top: 50%; left: 50%;
  transform: translate(-50%, -50%);
  font-family: 'Cormorant Garamond', serif;
  font-size: 220px; font-weight: 700; letter-spacing: -10px;
  color: rgba(255,255,255,0.06); white-space: nowrap; pointer-events: none;
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

/* FOOTER */
footer {
  background: var(--dark); color: var(--white);
  padding: 60px; display: flex;
  justify-content: space-between; align-items: center;
  border-top: 1px solid rgba(255,255,255,0.05);
}
.footer-logo { font-family: 'Cormorant Garamond', serif; font-size: 28px; font-weight: 600; letter-spacing: 1px; }
.footer-logo span { color: var(--accent); }
.footer-links { display: flex; gap: 32px; }
.footer-links a {
  font-family: 'DM Sans', sans-serif; font-size: 12px;
  letter-spacing: 2px; text-transform: uppercase; color: var(--muted);
  text-decoration: none; transition: color 0.25s; cursor: none;
}
.footer-links a:hover { color: var(--accent); }
.footer-copy { font-family: 'DM Sans', sans-serif; font-size: 12px; color: var(--muted); }

/* ANIMATIONS */
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(28px); }
  to   { opacity: 1; transform: translateY(0); }
}
@keyframes fadeIn {
  from { opacity: 0; }
  to   { opacity: 1; }
}

body.fade-out { animation: pageOut 0.5s ease forwards; }
@keyframes pageOut { to { opacity: 0; transform: translateY(-16px); } }

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
  opacity: 0; animation: fadeIn 1s ease forwards 1.6s; z-index: 2;
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

/* ── RESULTS PAGE ── */
.results-page {
  position: fixed; inset: 0;
  background: var(--bg);
  z-index: 700;
  overflow-y: auto;
  opacity: 0; pointer-events: none;
  transform: translateY(40px);
  transition: opacity 0.45s ease, transform 0.45s ease;
}
.results-page.show {
  opacity: 1; pointer-events: all; transform: translateY(0);
}

.results-topbar {
  position: sticky; top: 0; z-index: 10;
  background: var(--white);
  border-bottom: 1px solid var(--border);
  padding: 18px 48px;
  display: flex; align-items: center; gap: 20px;
}
.results-back {
  border: 1px solid var(--border); background: none;
  border-radius: 50%; width: 40px; height: 40px;
  display: flex; align-items: center; justify-content: center;
  cursor: none; font-size: 18px; color: var(--mid);
  transition: background 0.2s, border-color 0.2s, color 0.2s;
  flex-shrink: 0;
}
.results-back:hover { background: var(--bg2); border-color: var(--accent); color: var(--accent); }

.results-route {
  display: flex; align-items: center; gap: 12px; flex: 1;
}
.results-route-city {
  font-family: 'Cormorant Garamond', serif; font-size: 20px;
  font-weight: 600; color: var(--dark);
  white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 220px;
}
.results-route-arrow {
  color: var(--accent); font-size: 18px; flex-shrink: 0;
}
.results-route-date {
  font-family: 'DM Sans', sans-serif; font-size: 12px;
  color: var(--muted); letter-spacing: 1px; margin-left: auto;
  white-space: nowrap;
}

.results-body { padding: 48px; max-width: 1100px; margin: 0 auto; }

/* SECTION DIVIDER */
.res-section { margin-bottom: 60px; }
.res-section-head {
  display: flex; align-items: center; gap: 16px; margin-bottom: 28px;
}
.res-section-tag {
  font-family: 'DM Sans', sans-serif; font-size: 10px;
  letter-spacing: 4px; text-transform: uppercase; color: var(--accent);
}
.res-section-title {
  font-family: 'Cormorant Garamond', serif; font-size: 32px;
  font-weight: 400; color: var(--dark);
}
.res-section-title em { font-style: italic; color: var(--accent); }
.res-section-line {
  flex: 1; height: 1px; background: var(--border);
}

/* VEHICLE CARDS */
.vehicle-grid {
  display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px;
}
.vehicle-card {
  background: var(--white); border: 1px solid var(--border);
  border-radius: 16px; padding: 28px 24px;
  transition: border-color 0.3s, box-shadow 0.3s, transform 0.2s;
  cursor: none; position: relative; overflow: hidden;
}
.vehicle-card:hover {
  border-color: var(--accent);
  box-shadow: 0 8px 32px rgba(200,150,90,0.12);
  transform: translateY(-3px);
}
.vehicle-card.selected {
  border-color: var(--accent);
  background: rgba(200,150,90,0.04);
}
.vehicle-card.selected::after {
  content: '✓';
  position: absolute; top: 14px; right: 14px;
  width: 24px; height: 24px; border-radius: 50%;
  background: var(--accent); color: var(--white);
  font-size: 12px; display: flex; align-items: center; justify-content: center;
}
.vehicle-badge {
  display: inline-block; font-family: 'DM Sans', sans-serif;
  font-size: 10px; letter-spacing: 2px; text-transform: uppercase;
  padding: 4px 10px; border-radius: 100px; margin-bottom: 16px;
}
.badge-ours { background: rgba(200,150,90,0.12); color: var(--accent); }
.badge-private { background: rgba(58,55,48,0.08); color: var(--mid); }
.vehicle-icon { font-size: 36px; margin-bottom: 12px; display: block; }
.vehicle-name {
  font-family: 'Cormorant Garamond', serif; font-size: 22px;
  font-weight: 600; color: var(--dark); margin-bottom: 6px;
}
.vehicle-desc {
  font-family: 'DM Sans', sans-serif; font-size: 12px;
  color: var(--muted); line-height: 1.6; margin-bottom: 16px;
}
.vehicle-price {
  font-family: 'Cormorant Garamond', serif; font-size: 26px;
  font-weight: 600; color: var(--dark);
}
.vehicle-price span { font-size: 13px; font-family: 'DM Sans'; color: var(--muted); font-weight: 400; }
.vehicle-select-btn {
  width: 100%; margin-top: 16px; padding: 11px;
  border: 1px solid var(--border); background: none;
  border-radius: 100px; font-family: 'DM Sans', sans-serif;
  font-size: 12px; font-weight: 500; color: var(--mid);
  cursor: none; transition: background 0.2s, border-color 0.2s, color 0.2s;
}
.vehicle-select-btn:hover { background: var(--accent); border-color: var(--accent); color: var(--white); }
.vehicle-card.selected .vehicle-select-btn { background: var(--accent); border-color: var(--accent); color: var(--white); }

/* DESTINATION QUESTION */
.dest-question {
  background: var(--dark); border-radius: 20px;
  padding: 40px 48px; display: flex;
  align-items: center; justify-content: space-between; gap: 32px;
  margin-bottom: 60px;
}
.dest-q-text {}
.dest-q-tag {
  font-family: 'DM Sans', sans-serif; font-size: 10px;
  letter-spacing: 4px; text-transform: uppercase; color: var(--accent2);
  margin-bottom: 8px;
}
.dest-q-title {
  font-family: 'Cormorant Garamond', serif; font-size: 28px;
  font-weight: 400; color: var(--white); line-height: 1.2;
}
.dest-q-title em { font-style: italic; color: var(--accent2); }
.dest-q-sub {
  font-family: 'DM Sans', sans-serif; font-size: 13px;
  color: rgba(255,255,255,0.4); margin-top: 8px;
}
.dest-q-btns { display: flex; gap: 12px; flex-shrink: 0; }
.dest-q-btn {
  padding: 14px 32px; border-radius: 100px;
  font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 500;
  cursor: none; transition: background 0.25s, color 0.25s, transform 0.2s;
  border: none;
}
.dest-q-btn.yes { background: var(--accent); color: var(--white); }
.dest-q-btn.yes:hover { background: var(--accent2); transform: scale(1.04); }
.dest-q-btn.no { background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); }
.dest-q-btn.no:hover { background: rgba(255,255,255,0.14); color: var(--white); }

/* HOTEL SECTION */
.hotel-section {
  opacity: 0; max-height: 0; overflow: hidden;
  transition: opacity 0.5s ease, max-height 0.6s ease;
}
.hotel-section.show { opacity: 1; max-height: 2000px; }

.hotel-grid {
  display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px;
}
.hotel-card {
  background: var(--white); border: 1px solid var(--border);
  border-radius: 16px; overflow: hidden;
  transition: border-color 0.3s, box-shadow 0.3s, transform 0.2s;
  cursor: none;
}
.hotel-card:hover {
  border-color: var(--accent);
  box-shadow: 0 8px 32px rgba(200,150,90,0.1);
  transform: translateY(-3px);
}
.hotel-thumb {
  height: 120px; background: var(--bg2);
  display: flex; align-items: center; justify-content: center;
  font-size: 40px; position: relative; overflow: hidden;
}
.hotel-thumb::before {
  content: '';
  position: absolute; inset: 0;
  background: linear-gradient(135deg, rgba(200,150,90,0.08) 0%, transparent 60%);
}
.hotel-body { padding: 20px; }
.hotel-area {
  font-family: 'DM Sans', sans-serif; font-size: 10px;
  letter-spacing: 3px; text-transform: uppercase; color: var(--muted);
  margin-bottom: 6px;
}
.hotel-name {
  font-family: 'Cormorant Garamond', serif; font-size: 18px;
  font-weight: 600; color: var(--dark); margin-bottom: 8px; line-height: 1.2;
}
.hotel-stars { color: var(--accent); font-size: 12px; margin-bottom: 10px; }
.hotel-tags { display: flex; gap: 6px; flex-wrap: wrap; }
.hotel-tag {
  font-family: 'DM Sans', sans-serif; font-size: 10px;
  padding: 3px 9px; border-radius: 100px;
  background: var(--bg); color: var(--muted);
  letter-spacing: 0.5px;
}

/* RESULTS BOTTOM CTA */
.results-cta {
  background: var(--accent); border-radius: 20px;
  padding: 48px; text-align: center; margin-top: 40px;
  position: relative; overflow: hidden;
}
.results-cta::before {
  content: 'GO';
  position: absolute; top: 50%; left: 50%;
  transform: translate(-50%,-50%);
  font-family: 'Cormorant Garamond', serif;
  font-size: 160px; font-weight: 700; letter-spacing: -6px;
  color: rgba(255,255,255,0.07); pointer-events: none;
}
.results-cta-title {
  font-family: 'Cormorant Garamond', serif; font-size: 40px;
  font-weight: 400; color: var(--dark); margin-bottom: 20px;
  position: relative; z-index: 1;
}
.results-cta-btn {
  display: inline-flex; align-items: center; gap: 10px;
  background: var(--dark); color: var(--white);
  font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 500;
  padding: 16px 36px; border-radius: 100px; border: none;
  cursor: none; transition: background 0.3s, transform 0.25s;
  position: relative; z-index: 1;
}
.results-cta-btn:hover { background: var(--white); color: var(--dark); transform: translateY(-3px); }

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
  .search-bar { flex-direction: column; border-radius: 16px; padding: 16px; align-items: stretch; }
  .search-bar .search-cta { width: 100%; justify-content: center; }
  .search-bar .divider { width: 100%; height: 1px; }
  .cal-popup { left: 0; transform: translateX(0); }
  .cal-popup.open { transform: translateX(0); }
  .cal-popup::after { display: none; }
  .vehicle-grid, .hotel-grid { grid-template-columns: 1fr; }
  .dest-question { flex-direction: column; padding: 28px 24px; }
  .results-topbar { padding: 14px 20px; }
  .results-body { padding: 24px 20px; }
  .results-route-city { max-width: 120px; font-size: 15px; }
}

</style>
</head>
<body>

<div class="cursor" id="cursor"></div>
<div class="cursor-ring" id="cursorRing"></div>

<div class="logo">Mobi<span>Travel</span></div>

<button class="burger-btn" id="burgerBtn">
  <span></span><span></span><span></span>
</button>

<nav class="slide-menu" id="slideMenu">
  <div class="menu-label">Navigasi</div>
  <a href="#fitur"><span>Fitur</span> <span class="num">01</span></a>
  <a href="#target"><span>Target</span> <span class="num">02</span></a>
  <a href="#manfaat"><span>Manfaat</span> <span class="num">03</span></a>
  <a href="#booking"><span>Booking</span> <span class="num">04</span></a>
  <div class="socials">
    <a href="https://github.com/prasupsidedown" target="_blank">GitHub</a>
    <a href="https://www.instagram.com/wildmoss___/" target="_blank">Instagram</a>
  </div>
</nav>

<div class="overlay" id="overlay"></div>

<!-- HERO -->
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

      <!-- KOTA ASAL -->
      <div class="city-wrap" id="originWrap">
        <button class="city-input-btn placeholder" id="originBtn" onclick="toggleCity('origin')">
          <span id="originLabel">Kota asal...</span>
          <span class="chevron">▾</span>
        </button>
        <div class="city-popup" id="originPopup">
          <div class="city-search">
            <input type="text" id="originSearch" placeholder="Cari kota..." oninput="filterCity('origin')" />
          </div>
          <div class="city-list" id="originList"></div>
        </div>
      </div>

      <!-- SWAP -->
      <button class="swap-btn" onclick="swapCities()" title="Tukar kota">⇄</button>

      <!-- KOTA TUJUAN -->
      <div class="city-wrap" id="destWrap">
        <button class="city-input-btn placeholder" id="destBtn" onclick="toggleCity('dest')">
          <span id="destLabel">Kota tujuan...</span>
          <span class="chevron">▾</span>
        </button>
        <div class="city-popup" id="destPopup">
          <div class="city-search">
            <input type="text" id="destSearch" placeholder="Cari kota..." oninput="filterCity('dest')" />
          </div>
          <div class="city-list" id="destList"></div>
        </div>
      </div>

      <div class="divider"></div>

      <!-- DATE PICKER -->
      <div class="date-picker-wrap">
        <button id="dateBtn" onclick="toggleCal()">
          <svg class="cal-icon" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="1" y="3" width="14" height="12" rx="2" stroke="currentColor" stroke-width="1.2"/>
            <path d="M1 7h14" stroke="currentColor" stroke-width="1.2"/>
            <path d="M5 1v3M11 1v3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/>
          </svg>
          <span id="dateBtnLabel">Pilih tanggal</span>
          <span class="chevron">▾</span>
        </button>

        <!-- CALENDAR POPUP -->
        <div class="cal-popup" id="calPopup">
          <div class="cal-nav">
            <button class="cal-nav-btn" onclick="prevMonth()">‹</button>
            <span class="cal-month-label" id="calMonthLabel"></span>
            <button class="cal-nav-btn" onclick="nextMonth()">›</button>
          </div>

          <div class="cal-days-header">
            <span>Min</span><span>Sen</span><span>Sel</span><span>Rab</span>
            <span>Kam</span><span>Jum</span><span>Sab</span>
          </div>

          <div class="cal-grid" id="calGrid"></div>

          <div class="cal-footer">
            <button class="cal-footer-btn" onclick="pickToday()">Hari ini</button>
            <button class="cal-footer-btn" onclick="clearDate()">Reset</button>
          </div>
        </div>
      </div>

      <button class="search-cta" onclick="openResults()">Cari Tiket →</button>
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

<!-- FITUR -->
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
      <div class="feat-title">Booking Online</div>
      <p class="feat-desc">Pesan tiket transportasi dan hotel kapan saja dan di mana saja dengan antarmuka yang intuitif dan responsif.</p>
    </div>
    <div class="feature-card reveal reveal-delay-2">
      <div class="feat-num">02</div>
      <div class="feat-title">Pencarian Real-time</div>
      <p class="feat-desc">Cari dan bandingkan harga tiket serta hotel secara real-time untuk mendapatkan penawaran terbaik.</p>
    </div>
    <div class="feature-card reveal reveal-delay-3">
      <div class="feat-num">03</div>
      <div class="feat-title">Pembayaran Digital</div>
      <p class="feat-desc">Sistem pembayaran terintegrasi dengan payment gateway yang aman dan mendukung berbagai metode pembayaran.</p>
    </div>
    <div class="feature-card reveal reveal-delay-1">
      <div class="feat-num">04</div>
      <div class="feat-title">E-Ticket Otomatis</div>
      <p class="feat-desc">Tiket digital langsung dikirim ke email dan tersimpan di aplikasi begitu pembayaran berhasil dikonfirmasi.</p>
    </div>
    <div class="feature-card reveal reveal-delay-2">
      <div class="feat-num">05</div>
      <div class="feat-title">Riwayat Transaksi</div>
      <p class="feat-desc">Seluruh riwayat pemesanan tersimpan otomatis sehingga mudah diakses kembali kapan pun dibutuhkan.</p>
    </div>
    <div class="feature-card reveal reveal-delay-3">
      <div class="feat-num">06</div>
      <div class="feat-title">Keamanan Transaksi</div>
      <p class="feat-desc">Data dan transaksi pengguna terlindungi dengan enkripsi end-to-end dan sistem keamanan berlapis.</p>
    </div>
  </div>
</section>

<!-- TARGET PENGGUNA -->
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
      <div class="target-title">Wisatawan Lokal & Internasional</div>
      <p class="target-desc">Pengguna yang mencari kemudahan dalam merencanakan perjalanan wisata, baik di dalam maupun luar negeri.</p>
    </div>
    <div class="target-card reveal reveal-delay-2">
      <div class="target-title">Agen Travel & Mitra Transportasi</div>
      <p class="target-desc">Mitra bisnis yang ingin mengembangkan jaringan distribusi tiket dan layanan transportasi secara digital.</p>
    </div>
    <div class="target-card reveal reveal-delay-3">
      <div class="target-title">Keluarga & Rombongan</div>
      <p class="target-desc">Kelompok pelancong yang membutuhkan kemudahan pemesanan tiket dalam jumlah banyak sekaligus.</p>
    </div>
  </div>
</section>

<!-- MANFAAT -->
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

<!-- CTA -->
<section class="cta">
  <div class="cta-sub">Mulai perjalanan Anda</div>
  <h2 class="cta-title">Siap Berpetualang<br>Bersama Kami?</h2>
  <a href="#booking" class="cta-btn">
    Pesan Sekarang <span class="arrow">→</span>
  </a>
</section>

<!-- FOOTER -->
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

<!-- ── RESULTS PAGE ── -->
<div class="results-page" id="resultsPage">

  <!-- TOPBAR -->
  <div class="results-topbar">
    <button class="results-back" onclick="closeResults()">←</button>
    <div class="results-route">
      <span class="results-route-city" id="resOrigin">—</span>
      <span class="results-route-arrow">→</span>
      <span class="results-route-city" id="resDest">—</span>
      <span class="results-route-date" id="resDate"></span>
    </div>
  </div>

  <div class="results-body">

    <!-- PILIHAN KENDARAAN -->
    <div class="res-section">
      <div class="res-section-head">
        <div class="res-section-tag">Langkah 1</div>
        <h2 class="res-section-title">Pilih <em>Kendaraan</em></h2>
        <div class="res-section-line"></div>
      </div>

      <div class="vehicle-grid">
        <!-- Armada Kami -->
        <div class="vehicle-card" id="vc-hiace" onclick="selectVehicle('hiace')">
          <span class="vehicle-badge badge-ours">Armada Kami</span>
          <div class="vehicle-name">Bus / Minibus</div>
          <p class="vehicle-desc">Minibus premium 12 kursi, ber-AC, bagasi luas. Cocok untuk rombongan keluarga atau grup wisata.</p>
          <div class="vehicle-price">Rp 2.800.000 <span>/ trip</span></div>
          <button class="vehicle-select-btn">Pilih Kendaraan</button>
        </div>
        <div class="vehicle-card" id="vc-elf" onclick="selectVehicle('elf')">
          <span class="vehicle-badge badge-ours">Armada Kami</span>
          <div class="vehicle-name">SUV / MPV</div>
          <p class="vehicle-desc">Minibus tangguh 8 kursi, ideal untuk perjalanan jauh dengan kenyamanan ekstra dan bagasi besar.</p>
          <div class="vehicle-price">Rp 2.200.000 <span>/ trip</span></div>
          <button class="vehicle-select-btn">Pilih Kendaraan</button>
        </div>
        <div class="vehicle-card" id="vc-innova" onclick="selectVehicle('innova')">
          <span class="vehicle-badge badge-ours">Armada Kami</span>
          <div class="vehicle-name">Sedan</div>
          <p class="vehicle-desc">SUV premium 7 kursi, nyaman untuk keluarga kecil atau perjalanan bisnis dengan kesan elegan.</p>
          <div class="vehicle-price">Rp 1.600.000 <span>/ trip</span></div>
          <button class="vehicle-select-btn">Pilih Kendaraan</button>
        </div>
        <!-- Mobil Pribadi -->
        <div class="vehicle-card" id="vc-private-s" onclick="selectVehicle('private-s')">
          <span class="vehicle-badge badge-private">Mobil Pribadi</span>
          <div class="vehicle-name">Bus / Minibus</div>
          <p class="vehicle-desc">Bawa kendaraan sendiri? Kami siapkan panduan rute, rest area, dan titik SPBU terbaik untuk Anda.</p>
          <div class="vehicle-price">Rp 350.000 <span>/ guide fee</span></div>
          <button class="vehicle-select-btn">Pilih Opsi Ini</button>
        </div>
        <div class="vehicle-card" id="vc-private-suv" onclick="selectVehicle('private-suv')">
          <span class="vehicle-badge badge-private">Mobil Pribadi</span>
          <div class="vehicle-name">SUV / MPV</div>
          <p class="vehicle-desc">Pakai SUV atau MPV pribadi Anda dengan layanan koordinasi penuh dari tim kami sepanjang perjalanan.</p>
          <div class="vehicle-price">Rp 350.000 <span>/ guide fee</span></div>
          <button class="vehicle-select-btn">Pilih Opsi Ini</button>
        </div>
        <div class="vehicle-card" id="vc-private-bus" onclick="selectVehicle('private-bus')">
          <span class="vehicle-badge badge-private">Mobil Pribadi</span>
          <div class="vehicle-name">Sedan</div>
          <p class="vehicle-desc">Miliki bus sendiri? Kami bantu koordinasi izin perjalanan, rest area khusus, dan logistik rombongan.</p>
          <div class="vehicle-price">Rp 500.000 <span>/ guide fee</span></div>
          <button class="vehicle-select-btn">Pilih Opsi Ini</button>
        </div>
      </div>
    </div>

    <!-- PERTANYAAN DESTINASI -->
    <div class="dest-question" id="destQuestion">
      <div class="dest-q-text">
        <div class="dest-q-tag">Destinasi Wisata</div>
        <div class="dest-q-title">Apakah Anda memiliki<br><em>destinasi wisata</em> yang dituju?</div>
        <div class="dest-q-sub">Jika iya, kami siapkan rekomendasi hotel terbaik di sekitar tujuan Anda.</div>
      </div>
      <div class="dest-q-btns">
        <button class="dest-q-btn yes" onclick="showHotels()">Ya, tampilkan hotel →</button>
        <button class="dest-q-btn no" onclick="skipHotels()">Tidak, lanjutkan</button>
      </div>
    </div>

    <!-- HOTEL SECTION (hidden by default) -->
    <div class="hotel-section" id="hotelSection">
      <div class="res-section-head">
        <div class="res-section-tag">Rekomendasi</div>
        <h2 class="res-section-title">Hotel <em>Terdekat</em></h2>
        <div class="res-section-line"></div>
      </div>
      <div class="hotel-grid" id="hotelGrid"></div>
    </div>

    <!-- BOTTOM CTA -->
    <div class="results-cta" id="resultsCta">
      <div class="results-cta-title">Siap melanjutkan<br>pemesanan?</div>
      <button class="results-cta-btn">Konfirmasi Pesanan →</button>
    </div>

  </div>
</div>

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

document.querySelectorAll('a, button, input').forEach(el => {
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

// ── CITY DATA ──
const CITIES = {
  'Jakarta': [
    'Jakarta Pusat — Menteng',
    'Jakarta Pusat — Tanah Abang',
    'Jakarta Pusat — Senen',
    'Jakarta Pusat — Gambir',
    'Jakarta Selatan — Kebayoran Baru',
    'Jakarta Selatan — Cilandak',
    'Jakarta Selatan — Pasar Minggu',
    'Jakarta Selatan — Tebet',
    'Jakarta Barat — Grogol',
    'Jakarta Barat — Kalideres',
    'Jakarta Barat — Cengkareng',
    'Jakarta Utara — Tanjung Priok',
    'Jakarta Utara — Kelapa Gading',
    'Jakarta Timur — Cawang',
    'Jakarta Timur — Jatinegara',
    'Jakarta Timur — Duren Sawit',
  ],
  'Surabaya': [
    'Surabaya Pusat — Tegalsari',
    'Surabaya Pusat — Genteng',
    'Surabaya Pusat — Gubeng',
    'Surabaya Selatan — Wonokromo',
    'Surabaya Selatan — Gayungan',
    'Surabaya Selatan — Wiyung',
    'Surabaya Barat — Pakuwon Indah',
    'Surabaya Barat — Tandes',
    'Surabaya Barat — Sambikerep',
    'Surabaya Timur — Rungkut',
    'Surabaya Timur — Gunung Anyar',
    'Surabaya Timur — Mulyorejo',
    'Surabaya / Sidoarjo — Bandara Juanda',
    'Sidoarjo — Kota Sidoarjo',
  ]
};

let selectedOrigin = null;
let selectedDest   = null;
let cityOpenPanel  = null; // 'origin' | 'dest' | null

function buildCityList(panelId, targetKey) {
  const list = document.getElementById(panelId + 'List');
  list.innerHTML = '';
  const groups = targetKey === 'origin'
    ? Object.keys(CITIES)          // semua kota tersedia sebagai asal
    : Object.keys(CITIES);         // semua kota tersedia sebagai tujuan

  groups.forEach(group => {
    const label = document.createElement('div');
    label.className = 'city-group-label';
    label.textContent = group;
    list.appendChild(label);

    CITIES[group].forEach(city => {
      const btn = document.createElement('button');
      btn.className = 'city-option';
      btn.textContent = city;
      btn.dataset.city = city;
      if ((targetKey === 'origin' && selectedOrigin === city) ||
          (targetKey === 'dest'   && selectedDest   === city)) {
        btn.classList.add('selected');
      }
      btn.addEventListener('click', () => selectCity(targetKey, city));
      list.appendChild(btn);
    });
  });
}

function toggleCity(key) {
  const popup  = document.getElementById(key === 'origin' ? 'originPopup' : 'destPopup');
  const btn    = document.getElementById(key === 'origin' ? 'originBtn'   : 'destBtn');
  const search = document.getElementById(key === 'origin' ? 'originSearch': 'destSearch');

  const opening = cityOpenPanel !== key;

  // tutup panel manapun yang terbuka
  closeAllCityPanels();

  if (opening) {
    cityOpenPanel = key;
    buildCityList(key, key);
    popup.classList.add('open');
    btn.classList.add('open');
    search.value = '';
    filterCity(key);
    setTimeout(() => search.focus(), 50);
  }
}

function closeAllCityPanels() {
  ['origin','dest'].forEach(k => {
    document.getElementById(k === 'origin' ? 'originPopup' : 'destPopup').classList.remove('open');
    document.getElementById(k === 'origin' ? 'originBtn'   : 'destBtn').classList.remove('open');
  });
  cityOpenPanel = null;
}

function selectCity(key, city) {
  if (key === 'origin') {
    selectedOrigin = city;
    document.getElementById('originLabel').textContent = city;
    document.getElementById('originBtn').classList.remove('placeholder');
  } else {
    selectedDest = city;
    document.getElementById('destLabel').textContent = city;
    document.getElementById('destBtn').classList.remove('placeholder');
  }
  closeAllCityPanels();
}

function swapCities() {
  const tmpCity  = selectedOrigin;
  const tmpLabel = document.getElementById('originLabel').textContent;
  const originPlaceholder = document.getElementById('originBtn').classList.contains('placeholder');
  const destPlaceholder   = document.getElementById('destBtn').classList.contains('placeholder');

  // swap values
  selectedOrigin = selectedDest;
  selectedDest   = tmpCity;

  // swap labels
  document.getElementById('originLabel').textContent = document.getElementById('destLabel').textContent;
  document.getElementById('destLabel').textContent   = tmpLabel;

  // swap placeholder classes
  if (destPlaceholder)   document.getElementById('originBtn').classList.add('placeholder');
  else                   document.getElementById('originBtn').classList.remove('placeholder');
  if (originPlaceholder) document.getElementById('destBtn').classList.add('placeholder');
  else                   document.getElementById('destBtn').classList.remove('placeholder');
}

function filterCity(key) {
  const query = document.getElementById(key === 'origin' ? 'originSearch' : 'destSearch')
    .value.toLowerCase();
  const list  = document.getElementById(key === 'origin' ? 'originList' : 'destList');

  list.querySelectorAll('.city-option').forEach(opt => {
    opt.classList.toggle('hidden', !opt.textContent.toLowerCase().includes(query));
  });
  list.querySelectorAll('.city-group-label').forEach(lbl => {
    const next = lbl.nextElementSibling;
    let hasVisible = false;
    let el = next;
    while (el && el.classList.contains('city-option')) {
      if (!el.classList.contains('hidden')) hasVisible = true;
      el = el.nextElementSibling;
    }
    lbl.style.display = hasVisible ? '' : 'none';
  });
}

// close city panels on outside click
document.addEventListener('click', e => {
  if (!cityOpenPanel) return;
  const originWrap = document.getElementById('originWrap');
  const destWrap   = document.getElementById('destWrap');
  if (!originWrap.contains(e.target) && !destWrap.contains(e.target)) {
    closeAllCityPanels();
  }
});

// ── DATE PICKER ──
const MONTHS_ID = [
  'Januari','Februari','Maret','April','Mei','Juni',
  'Juli','Agustus','September','Oktober','November','Desember'
];

let calOpen    = false;
let curYear    = new Date().getFullYear();
let curMonth   = new Date().getMonth();
let selectedDate = null;

function toggleCal() {
  calOpen = !calOpen;
  const popup = document.getElementById('calPopup');
  const btn   = document.getElementById('dateBtn');
  popup.classList.toggle('open', calOpen);
  btn.classList.toggle('open', calOpen);
  if (calOpen) renderCalendar();
}

function renderCalendar() {
  document.getElementById('calMonthLabel').textContent =
    MONTHS_ID[curMonth] + ' ' + curYear;

  const grid   = document.getElementById('calGrid');
  grid.innerHTML = '';

  const today     = new Date(); today.setHours(0,0,0,0);
  const firstDay  = new Date(curYear, curMonth, 1).getDay();
  const daysTotal = new Date(curYear, curMonth + 1, 0).getDate();

  // Empty cells before first day
  for (let i = 0; i < firstDay; i++) {
    const empty = document.createElement('div');
    empty.className = 'cal-day empty';
    grid.appendChild(empty);
  }

  for (let d = 1; d <= daysTotal; d++) {
    const date = new Date(curYear, curMonth, d);
    const btn  = document.createElement('button');
    btn.className = 'cal-day';
    btn.textContent = d;

    const isPast   = date < today;
    const isToday  = date.getTime() === today.getTime();
    const isSel    = selectedDate && date.getTime() === selectedDate.getTime();

    if (isPast) {
      btn.disabled = true;
    } else {
      btn.addEventListener('click', () => selectDate(date));
    }

    if (isToday)  btn.classList.add('today');
    if (isSel)    btn.classList.add('selected');

    grid.appendChild(btn);
  }
}

function selectDate(date) {
  selectedDate = date;

  const label = date.toLocaleDateString('id-ID', {
    weekday: 'short', day: 'numeric', month: 'short', year: 'numeric'
  });
  const btn = document.getElementById('dateBtn');
  document.getElementById('dateBtnLabel').textContent = label;
  btn.classList.add('has-date');

  // Close calendar
  calOpen = false;
  document.getElementById('calPopup').classList.remove('open');
  btn.classList.remove('open');
}

function pickToday() {
  const today = new Date(); today.setHours(0,0,0,0);
  curYear  = today.getFullYear();
  curMonth = today.getMonth();
  selectDate(today);
}

function clearDate() {
  selectedDate = null;
  document.getElementById('dateBtnLabel').textContent = 'Pilih tanggal';
  document.getElementById('dateBtn').classList.remove('has-date');
  renderCalendar();
}

function prevMonth() {
  curMonth--;
  if (curMonth < 0) { curMonth = 11; curYear--; }
  renderCalendar();
}

function nextMonth() {
  curMonth++;
  if (curMonth > 11) { curMonth = 0; curYear++; }
  renderCalendar();
}

// Close calendar when clicking outside
document.addEventListener('click', e => {
  if (!calOpen) return;
  const wrap = document.querySelector('.date-picker-wrap');
  if (!wrap.contains(e.target)) {
    calOpen = false;
    document.getElementById('calPopup').classList.remove('open');
    document.getElementById('dateBtn').classList.remove('open');
  }
});

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

// ── RESULTS PAGE ──
const HOTELS = [
  { area: 'Jakarta Pusat · Menteng',          name: 'Whiz Hotel Cikini Jakarta',       stars: 3, icon: '🏨', tags: ['Free WiFi', 'Sarapan', 'AC'] },
  { area: 'Jakarta Pusat · Menteng',          name: 'Ibis Budget Jakarta Menteng',     stars: 3, icon: '🏩', tags: ['Free WiFi', 'Parkir', 'AC'] },
  { area: 'Jakarta Selatan · Tebet',          name: 'Amaris Hotel Tebet',              stars: 3, icon: '🏨', tags: ['Free WiFi', 'Kolam Renang', 'AC'] },
  { area: 'Jakarta Selatan · Gatot Subroto',  name: 'Favehotel Gatot Subroto',         stars: 3, icon: '🏩', tags: ['Free WiFi', 'Sarapan', 'Gym'] },
  { area: 'Jakarta Selatan · Tendean',        name: 'Hotel Neo Tendean Jakarta',       stars: 3, icon: '🏨', tags: ['Free WiFi', 'Sarapan', 'AC'] },
  { area: 'Jakarta Barat · Grogol',           name: 'Hotel 88 Grogol Jakarta',         stars: 3, icon: '🏨', tags: ['Free WiFi', 'Parkir', 'AC'] },
  { area: 'Jakarta Barat · Cengkareng',       name: 'Ibis Budget Jakarta Airport',     stars: 3, icon: '🏩', tags: ['Free WiFi', 'Dekat Bandara', 'AC'] },
  { area: 'Jakarta Barat · Puri Indah',       name: 'Favehotel Puri Indah Jakarta',    stars: 3, icon: '🏨', tags: ['Free WiFi', 'Kolam Renang', 'Gym'] },
  { area: 'Jakarta Timur · Cililitan',        name: 'Favehotel PGC Cililitan',         stars: 3, icon: '🏩', tags: ['Free WiFi', 'Parkir', 'AC'] },
  { area: 'Surabaya Pusat · Gubeng',          name: 'G Suites Hotel',                  stars: 4, icon: '🏨', tags: ['Free WiFi', 'Kolam Renang', 'Sarapan'] },
  { area: 'Surabaya Pusat · Gubeng',          name: 'The Win Hotel Surabaya',          stars: 3, icon: '🏩', tags: ['Free WiFi', 'Sarapan', 'AC'] },
  { area: 'Surabaya Timur · Rungkut',         name: 'Hotel Gunawangsa MERR',           stars: 3, icon: '🏨', tags: ['Free WiFi', 'Gym', 'Parkir'] },
  { area: 'Surabaya Barat · Pakuwon Indah',   name: 'Favehotel Graha Agung Surabaya',  stars: 3, icon: '🏩', tags: ['Free WiFi', 'Kolam Renang', 'Sarapan'] },
  { area: 'Sidoarjo · Juanda',               name: 'Ibis Budget Surabaya Airport',    stars: 3, icon: '🏨', tags: ['Free WiFi', 'Dekat Bandara', 'AC'] },
];

let selectedVehicle = null;
let hotelsVisible = false;

function openResults() {
  const origin = selectedOrigin || 'Kota Asal';
  const dest   = selectedDest   || 'Kota Tujuan';
  const date   = selectedDate
    ? selectedDate.toLocaleDateString('id-ID', { weekday:'short', day:'numeric', month:'short', year:'numeric' })
    : '';

  document.getElementById('resOrigin').textContent = origin;
  document.getElementById('resDest').textContent   = dest;
  document.getElementById('resDate').textContent   = date;

  // reset state
  selectedVehicle = null;
  hotelsVisible = false;
  document.getElementById('hotelSection').classList.remove('show');
  document.getElementById('destQuestion').style.display = '';
  document.querySelectorAll('.vehicle-card').forEach(c => c.classList.remove('selected'));

  // filter hotels based on cities
  buildHotelGrid(origin, dest);

  const page = document.getElementById('resultsPage');
  page.classList.add('show');
  page.scrollTop = 0;
}

function closeResults() {
  document.getElementById('resultsPage').classList.remove('show');
}

function selectVehicle(id) {
  document.querySelectorAll('.vehicle-card').forEach(c => c.classList.remove('selected'));
  document.getElementById('vc-' + id).classList.add('selected');
  selectedVehicle = id;
}

function showHotels() {
  document.getElementById('hotelSection').classList.add('show');
  document.getElementById('destQuestion').style.display = 'none';
  hotelsVisible = true;
  setTimeout(() => {
    document.getElementById('hotelSection').scrollIntoView({ behavior: 'smooth', block: 'start' });
  }, 100);
}

function skipHotels() {
  document.getElementById('destQuestion').style.display = 'none';
  document.getElementById('resultsCta').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function buildHotelGrid(origin, dest) {
  const grid = document.getElementById('hotelGrid');
  grid.innerHTML = '';

  // Hanya tampilkan hotel di dekat kota TUJUAN
  const destLower = dest.toLowerCase();
  const isJakartaDest  = destLower.includes('jakarta');
  const isSurabayaDest = destLower.includes('surabaya') || destLower.includes('sidoarjo');

  let filtered = HOTELS.filter(h => {
    const area = h.area.toLowerCase();
    if (isJakartaDest  && area.includes('jakarta'))                          return true;
    if (isSurabayaDest && (area.includes('surabaya') || area.includes('sidoarjo'))) return true;
    return false;
  });

  // Fallback jika kota tujuan tidak dipilih
  if (filtered.length === 0) filtered = HOTELS;

  filtered.forEach(h => {
    const stars = '★'.repeat(h.stars) + '☆'.repeat(5 - h.stars);
    const tagsHtml = h.tags.map(t => `<span class="hotel-tag">${t}</span>`).join('');
    const card = document.createElement('div');
    card.className = 'hotel-card';
    card.innerHTML = `
      <div class="hotel-thumb">${h.icon}</div>
      <div class="hotel-body">
        <div class="hotel-area">${h.area}</div>
        <div class="hotel-name">${h.name}</div>
        <div class="hotel-stars">${stars}</div>
        <div class="hotel-tags">${tagsHtml}</div>
      </div>`;
    grid.appendChild(card);
  });
}
</script>
</body>
</html>