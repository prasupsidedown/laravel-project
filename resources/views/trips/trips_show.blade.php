<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $trip->nama }} — MobiTravel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=DM+Sans:wght@300;400;500&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])

    <style>
        :root {
            --forest: #1a3328; --moss: #2d5a3d; --sage: #4e8060; --mist: #a8c5b0;
            --cream: #f5f0e8; --ivory: #faf8f3; --sand: #e8dfc8; --terra: #c17f3b;
            --gold: #e8a83e; --charcoal: #1c1c1c; --ink: #2e2e2e; --muted: #7a7a6e;
            --danger: #c0392b; --danger-bg: #fdf0ef;
            --font-display: 'Playfair Display', Georgia, serif;
            --font-body: 'DM Sans', sans-serif;
            --font-mono: 'DM Mono', monospace;
            --ease-smooth: cubic-bezier(.25,.46,.45,.94);
            --ease-bounce: cubic-bezier(.34,1.56,.64,1);
        }
        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        html { font-size:16px; overflow-x:hidden; }
        body { font-family:var(--font-body); background:var(--ivory); color:var(--ink); } 
        a { text-decoration:none; color:inherit; }

        body::before {
            content:''; position:fixed; inset:0;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events:none; z-index:9999;
        }

        /* NAVBAR */
        .nav {
            position:fixed; top:0; left:0; right:0; z-index:100;
            display:flex; align-items:center; justify-content:space-between;
            padding:1.25rem 4rem;
            background:rgba(245,240,232,.92); backdrop-filter:blur(12px);
            box-shadow:0 1px 0 rgba(0,0,0,.08);
        }
        .nav__logo { font-family:var(--font-display); font-size:1.5rem; font-weight:900; color:var(--forest); }
        .nav__logo span { color:var(--gold); }
        .nav__links { display:flex; gap:2rem; list-style:none; align-items:center; }
        .nav__links a { font-size:.875rem; font-weight:500; letter-spacing:.04em; text-transform:uppercase; color:var(--ink); transition:color .2s; }
        .nav__links a:hover, .nav__links a.active { color:var(--sage); }

        /* HERO */
        .trip-hero {
            background: linear-gradient(160deg, rgba(26,51,40,.92) 0%, rgba(45,90,61,.8) 60%, rgba(26,51,40,.92) 100%),
                        url('images/hero.jpg') center/cover;
            padding: 7.5rem 4rem 3.5rem; position:relative; overflow:hidden;
        }
        .trip-hero::after {
            content:''; position:absolute; bottom:-2px; left:0; right:0;
            height:60px; background:var(--ivory);
            clip-path: polygon(0 100%, 100% 0, 100% 100%);
        }
        .trip-hero__breadcrumb {
            display:flex; align-items:center; gap:.5rem;
            font-family:var(--font-mono); font-size:.72rem; letter-spacing:.1em;
            text-transform:uppercase; color:rgba(245,240,232,.5); margin-bottom:1rem;
        }
        .trip-hero__breadcrumb a { color:var(--gold); }

        .trip-hero__top {
            display:flex; align-items:flex-start; justify-content:space-between; gap:2rem; flex-wrap:wrap;
        }
        .trip-hero__status {
            display:inline-flex; align-items:center; gap:.4rem;
            font-family:var(--font-mono); font-size:.7rem; letter-spacing:.1em;
            text-transform:uppercase; color:var(--mist); margin-bottom:.75rem;
        }
        .trip-hero__status::before { content:''; display:inline-block; width:1.5rem; height:1px; background:var(--mist); }
        .trip-hero__name {
            font-family:var(--font-display); font-size:clamp(1.8rem,4vw,3rem);
            font-weight:900; color:var(--cream); letter-spacing:-.03em; line-height:1.1;
        }
        .trip-hero__name em { font-style:italic; color:var(--gold); }
        .trip-hero__route {
            display:flex; align-items:center; gap:.75rem;
            font-size:.95rem; color:rgba(245,240,232,.65); margin-top:.75rem;
        }
        .trip-hero__route strong { color:var(--cream); font-weight:600; }
        .trip-hero__route span { color:var(--gold); }

        .trip-hero__actions { display:flex; gap:.75rem; flex-shrink:0; }
        .btn { display:inline-flex; align-items:center; gap:.5rem; padding:.75rem 1.5rem; border-radius:2rem; font-size:.875rem; font-weight:600; cursor:pointer; transition:all .2s var(--ease-bounce); border:none; text-decoration:none; white-space:nowrap; }
        .btn--primary { background:var(--gold); color:var(--forest); }
        .btn--primary:hover { background:var(--terra); transform:translateY(-2px); }
        .btn--outline { background:transparent; border:1.5px solid rgba(255,255,255,.35); color:var(--cream); }
        .btn--outline:hover { background:rgba(255,255,255,.1); transform:translateY(-2px); }
        .btn--danger { background:var(--danger); color:#fff; }
        .btn--danger:hover { background:#a93226; transform:translateY(-2px); }

        /* MAIN CONTENT */
        .page-body {
            display:grid; grid-template-columns:1fr 320px; gap:2rem;
            padding:2rem 4rem 4rem; max-width:1200px; margin:0 auto;
        }

        /* DETAIL CARD */
        .detail-card {
            background:#fff; border:1.5px solid var(--sand);
            border-radius:1.25rem; overflow:hidden; margin-bottom:1.5rem;
        }
        .detail-card__header {
            background:var(--forest); padding:1.25rem 1.75rem;
            font-family:var(--font-mono); font-size:.7rem; letter-spacing:.1em;
            text-transform:uppercase; color:rgba(245,240,232,.55);
        }
        .detail-card__body { padding:1.75rem; }

        .detail-grid { display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; }
        .detail-item__label { font-family:var(--font-mono); font-size:.72rem; letter-spacing:.08em; text-transform:uppercase; color:var(--muted); margin-bottom:.3rem; }
        .detail-item__val { font-size:.9375rem; font-weight:500; color:var(--forest); }
        .detail-item__val--large { font-family:var(--font-display); font-size:1.5rem; font-weight:900; color:var(--forest); }

        /* Badge */
        .badge { display:inline-block; font-size:.72rem; font-weight:600; letter-spacing:.05em; text-transform:uppercase; padding:.3rem .75rem; border-radius:2rem; }
        .badge--active   { background:rgba(78,128,96,.12); color:var(--sage); }
        .badge--inactive { background:rgba(122,122,110,.1); color:var(--muted); }
        .badge--full     { background:rgba(232,168,62,.15); color:var(--terra); }

        /* Seat progress */
        .seat-progress { margin-top:1rem; }
        .seat-progress__label { display:flex; justify-content:space-between; font-size:.8rem; margin-bottom:.5rem; }
        .seat-progress__label span { font-family:var(--font-mono); color:var(--muted); }
        .seat-progress__label strong { color:var(--forest); }
        .seat-progress__track { height:8px; background:var(--sand); border-radius:99px; overflow:hidden; }
        .seat-progress__fill { height:100%; border-radius:99px; background:var(--sage); transition:width .6s var(--ease-smooth); }
        .seat-progress__fill--warn { background:var(--gold); }
        .seat-progress__fill--full { background:var(--terra); }

        /* Description */
        .description { font-size:.9rem; line-height:1.8; color:var(--ink); }

        /* SIDEBAR */
        .sidebar { display:flex; flex-direction:column; gap:1.25rem; }

        .action-card {
            background:#fff; border:1.5px solid var(--sand); border-radius:1.25rem;
            padding:1.5rem; display:flex; flex-direction:column; gap:.75rem;
        }
        .action-card__title { font-family:var(--font-mono); font-size:.72rem; letter-spacing:.1em; text-transform:uppercase; color:var(--muted); margin-bottom:.25rem; }
        .action-card .btn { justify-content:center; }

        .meta-card { background:#fff; border:1.5px solid var(--sand); border-radius:1.25rem; overflow:hidden; }
        .meta-card__header { padding:1rem 1.5rem; background:var(--cream); border-bottom:1px solid var(--sand); font-family:var(--font-mono); font-size:.72rem; letter-spacing:.1em; text-transform:uppercase; color:var(--muted); }
        .meta-card__body { padding:1.5rem; display:flex; flex-direction:column; gap:1rem; }
        .meta-row { display:flex; justify-content:space-between; align-items:center; padding-bottom:1rem; border-bottom:1px solid var(--sand); font-size:.875rem; }
        .meta-row:last-child { border-bottom:none; padding-bottom:0; }
        .meta-row__label { color:var(--muted); }
        .meta-row__val { font-weight:600; color:var(--forest); text-align:right; }

        /* Delete modal */
        .modal-overlay { position:fixed; inset:0; background:rgba(26,51,40,.55); backdrop-filter:blur(4px); z-index:200; display:none; align-items:center; justify-content:center; }
        .modal-overlay.open { display:flex; animation:fadeIn .25s ease; }
        @keyframes fadeIn { from{opacity:0} to{opacity:1} }
        .modal { background:#fff; border-radius:1.25rem; padding:2.5rem; max-width:400px; width:90%; animation:slideUp .3s var(--ease-bounce); }
        @keyframes slideUp { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:none} }
        .modal__icon { font-size:2.5rem; margin-bottom:1rem; }
        .modal__title { font-family:var(--font-display); font-size:1.4rem; font-weight:700; color:var(--forest); margin-bottom:.5rem; }
        .modal__sub { font-size:.9rem; color:var(--muted); line-height:1.6; margin-bottom:1.75rem; }
        .modal__actions { display:flex; gap:.75rem; }
        .btn-cancel { flex:1; padding:.75rem; border-radius:2rem; border:1.5px solid var(--sand); background:#fff; font-family:var(--font-body); font-size:.9rem; font-weight:500; cursor:pointer; }
        .btn-cancel:hover { border-color:var(--muted); }
        .btn-confirm-delete { flex:1; padding:.75rem; border-radius:2rem; border:none; background:var(--danger); color:#fff; font-family:var(--font-body); font-size:.9rem; font-weight:600; cursor:pointer; }
        .btn-confirm-delete:hover { background:#a93226; }

        @media (max-width:1024px) { .nav{padding:1.25rem 2rem;} .page-body{grid-template-columns:1fr;padding:1.5rem 2rem;} .trip-hero{padding:7rem 2rem 3rem;} }
        @media (max-width:640px) { .nav__links{display:none;} .detail-grid{grid-template-columns:1fr;} .trip-hero__top{flex-direction:column;} }
    </style>
</head>
<body>

    <nav class="nav">
        <a href="/" class="nav__logo">Mobi<span>Travel</span></a>
        <ul class="nav__links">
            <li><a href="/">Beranda</a></li>
            <li><a href="/agen">Agen</a></li>
            <li><a href="{{ route('trips.index') }}" class="active">Kelola Trip</a></li>
        </ul>
    </nav>

    <div class="trip-hero">
        <div class="trip-hero__breadcrumb">
            <a href="{{ route('trips.index') }}">← Kelola Trip</a>
            <span>/</span>
            <span>Detail Trip</span>
        </div>
        <div class="trip-hero__top">
            <div>
                <div class="trip-hero__status">{{ $trip->jenis_layanan ?? 'Paket Wisata' }}</div>
                <h1 class="trip-hero__name">{{ $trip->nama }}</h1>
                <div class="trip-hero__route">
                    <strong>{{ $trip->kota_asal }}</strong>
                    <span>→</span>
                    <strong>{{ $trip->kota_tujuan }}</strong>
                    <span style="opacity:.4">|</span>
                    <span>{{ $trip->durasi }} Hari</span>
                </div>
            </div>
            <div class="trip-hero__actions">
                <a href="{{ route('trips.edit', $trip) }}" class="btn btn--outline">✏️ Edit</a>
                <button class="btn btn--danger" onclick="document.getElementById('deleteModal').classList.add('open')">🗑️ Hapus</button>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div>
            {{-- JADWAL & RUTE --}}
            <div class="detail-card">
                <div class="detail-card__header">Informasi Perjalanan</div>
                <div class="detail-card__body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <div class="detail-item__label">Kota Asal</div>
                            <div class="detail-item__val">{{ $trip->kota_asal }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-item__label">Kota Tujuan</div>
                            <div class="detail-item__val">{{ $trip->kota_tujuan }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-item__label">Tanggal Berangkat</div>
                            <div class="detail-item__val">{{ \Carbon\Carbon::parse($trip->tanggal_berangkat)->translatedFormat('l, d F Y') }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-item__label">Jam Berangkat</div>
                            <div class="detail-item__val">{{ $trip->jam_berangkat ?? '—' }} WIB</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-item__label">Durasi</div>
                            <div class="detail-item__val">{{ $trip->durasi }} Hari</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-item__label">Jenis Layanan</div>
                            <div class="detail-item__val">{{ $trip->jenis_layanan ?? '—' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KAPASITAS --}}
            <div class="detail-card">
                <div class="detail-card__header">Kapasitas & Ketersediaan Kursi</div>
                <div class="detail-card__body">
                    <div class="detail-grid" style="margin-bottom:1.25rem">
                        <div class="detail-item">
                            <div class="detail-item__label">Kapasitas Total</div>
                            <div class="detail-item__val--large">{{ $trip->kapasitas }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-item__label">Kursi Terisi</div>
                            <div class="detail-item__val--large">{{ $trip->seat_booked }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-item__label">Kursi Tersisa</div>
                            <div class="detail-item__val--large" style="color:var(--sage)">{{ $trip->kapasitas - $trip->seat_booked }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-item__label">Status</div>
                            @php $statusMap=['aktif'=>'badge--active','nonaktif'=>'badge--inactive','penuh'=>'badge--full']; $labelMap=['aktif'=>'Aktif','nonaktif'=>'Nonaktif','penuh'=>'Penuh']; @endphp
                            <span class="badge {{ $statusMap[$trip->status] ?? 'badge--inactive' }}">{{ $labelMap[$trip->status] ?? $trip->status }}</span>
                        </div>
                    </div>
                    @php $pct = $trip->kapasitas > 0 ? ($trip->seat_booked / $trip->kapasitas)*100 : 0; @endphp
                    <div class="seat-progress">
                        <div class="seat-progress__label">
                            <span>Tingkat Kepenuhan</span>
                            <strong>{{ round($pct) }}%</strong>
                        </div>
                        <div class="seat-progress__track">
                            <div class="seat-progress__fill {{ $pct >= 100 ? 'seat-progress__fill--full' : ($pct >= 70 ? 'seat-progress__fill--warn' : '') }}"
                                 style="width:{{ min($pct,100) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- DESKRIPSI --}}
            @if($trip->deskripsi)
            <div class="detail-card">
                <div class="detail-card__header">Deskripsi Trip</div>
                <div class="detail-card__body">
                    <p class="description">{{ $trip->deskripsi }}</p>
                </div>
            </div>
            @endif
        </div>

        {{-- SIDEBAR --}}
        <div class="sidebar">
            <div class="action-card">
                <div class="action-card__title">Aksi</div>
                <a href="{{ route('trips.edit', $trip) }}" class="btn btn--primary">✏️ Edit Trip Ini</a>
                <a href="{{ route('trips.create') }}" class="btn" style="background:var(--cream);color:var(--forest);border:1.5px solid var(--sand)">+ Tambah Trip Baru</a>
                <a href="{{ route('trips.index') }}" class="btn" style="background:transparent;color:var(--muted);border:1.5px solid var(--sand)">← Kembali ke Daftar</a>
            </div>

            <div class="meta-card">
                <div class="meta-card__header">Informasi Harga</div>
                <div class="meta-card__body">
                    <div class="meta-row">
                        <span class="meta-row__label">Harga per orang</span>
                        <span class="meta-row__val" style="font-family:var(--font-display);font-size:1.2rem">Rp {{ number_format($trip->harga) }}</span>
                    </div>
                    <div class="meta-row">
                        <span class="meta-row__label">Potensi pendapatan</span>
                        <span class="meta-row__val">Rp {{ number_format($trip->harga * $trip->kapasitas) }}</span>
                    </div>
                    <div class="meta-row">
                        <span class="meta-row__label">Sudah terkumpul</span>
                        <span class="meta-row__val" style="color:var(--sage)">Rp {{ number_format($trip->harga * $trip->seat_booked) }}</span>
                    </div>
                </div>
            </div>

            <div class="meta-card">
                <div class="meta-card__header">Riwayat</div>
                <div class="meta-card__body">
                    <div class="meta-row">
                        <span class="meta-row__label">Dibuat</span>
                        <span class="meta-row__val">{{ $trip->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="meta-row">
                        <span class="meta-row__label">Terakhir diubah</span>
                        <span class="meta-row__val">{{ $trip->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- DELETE MODAL --}}
    <div class="modal-overlay" id="deleteModal">
        <div class="modal">
            <div class="modal__icon">⚠️</div>
            <div class="modal__title">Hapus Trip?</div>
            <p class="modal__sub">Trip "<strong>{{ $trip->nama }}</strong>" akan dihapus permanen.</p>
            <div class="modal__actions">
                <button class="btn-cancel" onclick="document.getElementById('deleteModal').classList.remove('open')">Batal</button>
                <form action="{{ route('trips.destroy', $trip) }}" method="POST" style="flex:1">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-confirm-delete" style="width:100%">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) this.classList.remove('open');
        });
    </script>
</body>
</html>