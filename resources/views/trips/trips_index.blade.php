<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Trip — MobiTravel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=DM+Sans:wght@300;400;500&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])

    <style>
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
            --danger:    #c0392b;
            --danger-bg: #fdf0ef;

            --font-display: 'Playfair Display', Georgia, serif;
            --font-body:    'DM Sans', sans-serif;
            --font-mono:    'DM Mono', monospace;

            --ease-smooth: cubic-bezier(.25,.46,.45,.94);
            --ease-bounce: cubic-bezier(.34,1.56,.64,1);
        }

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        html { font-size: 16px; overflow-x: hidden; }
        body { font-family: var(--font-body); background: var(--ivory); color: var(--ink); }
        a { text-decoration: none; color: inherit; }
        img { display: block; max-width: 100%; }

        body::before {
            content: '';
            position: fixed; inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none; z-index: 9999;
        }

        /* ===== NAVBAR ===== */
        .nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.25rem 4rem;
            background: rgba(245,240,232,.92);
            backdrop-filter: blur(12px);
            box-shadow: 0 1px 0 rgba(0,0,0,.08);
        }
        .nav__logo { font-family: var(--font-display); font-size: 1.5rem; font-weight: 900; color: var(--forest); }
        .nav__logo span { color: var(--gold); }
        .nav__links { display: flex; gap: 2rem; list-style: none; align-items: center; }
        .nav__links a { font-size: .875rem; font-weight: 500; letter-spacing: .04em; text-transform: uppercase; color: var(--ink); transition: color .2s; }
        .nav__links a:hover, .nav__links a.active { color: var(--sage); }
        .nav__cta { background: var(--gold); color: var(--forest) !important; padding: .5rem 1.25rem; border-radius: 2rem; font-weight: 700 !important; }

        /* ===== PAGE HEADER ===== */
        .page-header {
            background: linear-gradient(160deg, rgba(26,51,40,.92) 0%, rgba(45,90,61,.8) 60%, rgba(26,51,40,.92) 100%),
                        url('images/hero.jpg') center/cover no-repeat;
            padding: 8rem 4rem 4rem;
            position: relative; overflow: hidden;
        }
        .page-header::after {
            content: ''; position: absolute; bottom: -2px; left: 0; right: 0;
            height: 60px; background: var(--ivory);
            clip-path: polygon(0 100%, 100% 0, 100% 100%);
        }
        .page-header__breadcrumb {
            display: flex; align-items: center; gap: .5rem;
            font-family: var(--font-mono); font-size: .72rem; letter-spacing: .1em;
            text-transform: uppercase; color: rgba(245,240,232,.5); margin-bottom: 1rem;
        }
        .page-header__breadcrumb a { color: var(--gold); }
        .page-header__tag {
            display: inline-flex; align-items: center; gap: .5rem;
            font-family: var(--font-mono); font-size: .75rem; letter-spacing: .12em;
            text-transform: uppercase; color: var(--gold); margin-bottom: .75rem;
        }
        .page-header__tag::before { content: ''; display: inline-block; width: 2rem; height: 1px; background: var(--gold); }
        .page-header__title {
            font-family: var(--font-display); font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 900; color: var(--cream); letter-spacing: -.03em; line-height: 1.1;
        }
        .page-header__title em { font-style: italic; color: var(--gold); }
        .page-header__sub { font-size: .95rem; color: rgba(245,240,232,.65); margin-top: .75rem; max-width: 480px; line-height: 1.7; }

        /* ===== TOOLBAR ===== */
        .toolbar {
            padding: 1.5rem 4rem;
            background: var(--ivory);
            border-bottom: 1px solid var(--sand);
            display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;
        }
        .toolbar__search {
            flex: 1; min-width: 220px; position: relative;
        }
        .toolbar__search input {
            width: 100%; border: 1.5px solid var(--sand); border-radius: 2rem;
            padding: .6rem 1rem .6rem 2.4rem;
            font-family: var(--font-body); font-size: .9rem;
            color: var(--ink); background: #fff; outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        .toolbar__search input:focus { border-color: var(--sage); box-shadow: 0 0 0 3px rgba(78,128,96,.12); }
        .toolbar__search::before {
            content: '🔍'; position: absolute; left: .85rem; top: 50%;
            transform: translateY(-50%); font-size: .85rem; pointer-events: none;
        }
        .toolbar__select {
            border: 1.5px solid var(--sand); border-radius: 2rem;
            padding: .6rem 1.75rem .6rem 1rem;
            font-family: var(--font-body); font-size: .875rem; color: var(--ink);
            background: #fff; outline: none; appearance: none; cursor: pointer;
            transition: border-color .2s;
        }
        .toolbar__select:focus { border-color: var(--sage); }
        .btn-add {
            display: inline-flex; align-items: center; gap: .5rem;
            background: var(--forest); color: var(--cream);
            padding: .65rem 1.5rem; border-radius: 2rem;
            font-size: .875rem; font-weight: 600; border: none; cursor: pointer;
            transition: background .2s, transform .2s var(--ease-bounce);
            text-decoration: none; white-space: nowrap; margin-left: auto;
        }
        .btn-add:hover { background: var(--moss); transform: translateY(-2px); }

        /* ===== STATS STRIP ===== */
        .stats-strip {
            display: flex; gap: 0;
            border-bottom: 1px solid var(--sand);
            background: #fff;
        }
        .stat-item {
            flex: 1; padding: 1.25rem 2rem;
            border-right: 1px solid var(--sand);
            display: flex; align-items: center; gap: 1rem;
        }
        .stat-item:last-child { border-right: none; }
        .stat-item__icon {
            width: 2.5rem; height: 2.5rem; border-radius: .75rem;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
        }
        .stat-item__icon--green { background: rgba(78,128,96,.12); }
        .stat-item__icon--gold  { background: rgba(232,168,62,.12); }
        .stat-item__icon--terra { background: rgba(193,127,59,.12); }
        .stat-item__icon--mist  { background: rgba(168,197,176,.25); }
        .stat-item__val { font-family: var(--font-display); font-size: 1.5rem; font-weight: 900; color: var(--forest); line-height: 1; }
        .stat-item__label { font-size: .75rem; color: var(--muted); font-family: var(--font-mono); letter-spacing: .05em; text-transform: uppercase; margin-top: .15rem; }

        /* ===== MAIN TABLE AREA ===== */
        .main { padding: 2rem 4rem 4rem; }

        /* Flash message */
        .flash {
            display: flex; align-items: center; gap: .75rem;
            padding: 1rem 1.5rem; border-radius: .75rem;
            margin-bottom: 1.5rem; font-size: .9rem; font-weight: 500;
            animation: fadeDown .4s var(--ease-smooth) both;
        }
        @keyframes fadeDown { from { opacity:0; transform: translateY(-10px); } to { opacity:1; transform: none; } }
        .flash--success { background: rgba(78,128,96,.1); border: 1px solid rgba(78,128,96,.25); color: var(--moss); }
        .flash--error   { background: var(--danger-bg); border: 1px solid rgba(192,57,43,.2); color: var(--danger); }

        /* Table card */
        .table-card {
            background: #fff;
            border: 1.5px solid var(--sand);
            border-radius: 1.25rem;
            overflow: hidden;
        }

        table { width: 100%; border-collapse: collapse; }

        thead { background: var(--forest); }
        thead th {
            padding: 1rem 1.25rem;
            font-family: var(--font-mono); font-size: .7rem;
            letter-spacing: .1em; text-transform: uppercase;
            color: rgba(245,240,232,.6); font-weight: 400;
            text-align: left; white-space: nowrap;
        }
        thead th:last-child { text-align: center; }

        tbody tr {
            border-bottom: 1px solid var(--sand);
            transition: background .15s;
        }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: var(--cream); }

        tbody td { padding: 1rem 1.25rem; font-size: .875rem; color: var(--ink); vertical-align: middle; }

        /* Trip name cell */
        .trip-name { font-weight: 600; color: var(--forest); margin-bottom: .2rem; font-size: .9rem; }
        .trip-route { font-size: .78rem; color: var(--muted); display: flex; align-items: center; gap: .3rem; }

        /* Badge */
        .badge {
            display: inline-block; font-size: .68rem; font-weight: 600;
            letter-spacing: .05em; text-transform: uppercase;
            padding: .25rem .65rem; border-radius: 2rem;
        }
        .badge--active   { background: rgba(78,128,96,.12); color: var(--sage); }
        .badge--inactive { background: rgba(122,122,110,.1); color: var(--muted); }
        .badge--full     { background: rgba(232,168,62,.15); color: var(--terra); }

        /* Price */
        .price-val { font-family: var(--font-display); font-size: 1rem; font-weight: 700; color: var(--forest); }
        .price-unit { font-size: .72rem; color: var(--muted); font-family: var(--font-body); }

        /* Seat bar */
        .seat-bar { width: 80px; }
        .seat-bar__track {
            height: 5px; background: var(--sand); border-radius: 99px;
            margin-bottom: .3rem; overflow: hidden;
        }
        .seat-bar__fill { height: 100%; border-radius: 99px; background: var(--sage); }
        .seat-bar__fill--warn { background: var(--gold); }
        .seat-bar__fill--full { background: var(--terra); }
        .seat-bar__label { font-size: .72rem; color: var(--muted); font-family: var(--font-mono); }

        /* Actions */
        .actions { display: flex; gap: .5rem; justify-content: center; }
        .btn-icon {
            width: 2rem; height: 2rem; border-radius: .5rem;
            border: 1.5px solid var(--sand); background: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: .85rem; cursor: pointer; transition: all .2s var(--ease-bounce);
            text-decoration: none;
        }
        .btn-icon:hover { transform: scale(1.12); }
        .btn-icon--view  { border-color: var(--mist); }
        .btn-icon--view:hover  { background: rgba(168,197,176,.15); border-color: var(--sage); }
        .btn-icon--edit  { border-color: rgba(232,168,62,.4); }
        .btn-icon--edit:hover  { background: rgba(232,168,62,.1); border-color: var(--gold); }
        .btn-icon--delete { border-color: rgba(192,57,43,.25); }
        .btn-icon--delete:hover { background: var(--danger-bg); border-color: var(--danger); }

        /* Empty state */
        .empty-state {
            text-align: center; padding: 5rem 2rem;
        }
        .empty-state__emoji { font-size: 3rem; margin-bottom: 1rem; }
        .empty-state__title { font-family: var(--font-display); font-size: 1.4rem; font-weight: 700; color: var(--forest); margin-bottom: .5rem; }
        .empty-state__sub { font-size: .9rem; color: var(--muted); margin-bottom: 1.5rem; }

        /* Pagination */
        .pagination { display: flex; justify-content: space-between; align-items: center; padding: 1.25rem 1.5rem; border-top: 1px solid var(--sand); }
        .pagination__info { font-size: .8rem; color: var(--muted); font-family: var(--font-mono); }
        .pagination__btns { display: flex; gap: .4rem; }
        .page-btn {
            width: 2.2rem; height: 2.2rem; border-radius: .5rem;
            border: 1.5px solid var(--sand); background: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: .8rem; font-weight: 500; cursor: pointer; transition: all .2s;
            text-decoration: none; color: var(--ink);
        }
        .page-btn:hover { border-color: var(--sage); color: var(--forest); }
        .page-btn.active { background: var(--forest); border-color: var(--forest); color: var(--cream); }

        /* Delete confirm modal */
        .modal-overlay {
            position: fixed; inset: 0; background: rgba(26,51,40,.55);
            backdrop-filter: blur(4px); z-index: 200;
            display: none; align-items: center; justify-content: center;
        }
        .modal-overlay.open { display: flex; animation: fadeIn .25s var(--ease-smooth); }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        .modal {
            background: #fff; border-radius: 1.25rem;
            padding: 2.5rem; max-width: 400px; width: 90%;
            animation: slideUp .3s var(--ease-bounce);
        }
        @keyframes slideUp { from { opacity:0; transform: translateY(20px); } to { opacity:1; transform:none; } }
        .modal__icon { font-size: 2.5rem; margin-bottom: 1rem; }
        .modal__title { font-family: var(--font-display); font-size: 1.4rem; font-weight: 700; color: var(--forest); margin-bottom: .5rem; }
        .modal__sub { font-size: .9rem; color: var(--muted); line-height: 1.6; margin-bottom: 1.75rem; }
        .modal__actions { display: flex; gap: .75rem; }
        .btn-cancel { flex: 1; padding: .75rem; border-radius: 2rem; border: 1.5px solid var(--sand); background: #fff; font-family: var(--font-body); font-size: .9rem; font-weight: 500; cursor: pointer; transition: all .2s; }
        .btn-cancel:hover { border-color: var(--muted); }
        .btn-confirm-delete { flex: 1; padding: .75rem; border-radius: 2rem; border: none; background: var(--danger); color: #fff; font-family: var(--font-body); font-size: .9rem; font-weight: 600; cursor: pointer; transition: all .2s var(--ease-bounce); }
        .btn-confirm-delete:hover { background: #a93226; transform: translateY(-2px); }

        @media (max-width: 1024px) { .nav { padding: 1.25rem 2rem; } .main { padding: 1.5rem 2rem; } .toolbar { padding: 1.25rem 2rem; } }
        @media (max-width: 640px) { .nav__links { display: none; } .stats-strip { flex-wrap: wrap; } .stat-item { min-width: 50%; } }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="nav">
        <a href="/" class="nav__logo">Mobi<span>Travel</span></a>
        <ul class="nav__links">
            <li><a href="/">Beranda</a></li>
            <li><a href="/agen">Agen</a></li>
            <li><a href="{{ route('trips.index') }}" class="active">Kelola Trip</a></li>
        </ul>
    </nav>

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div class="page-header__breadcrumb">
            <a href="/">Beranda</a> <span>/</span>
            <a href="/agen">Agen</a> <span>/</span>
            <span>Kelola Trip</span>
        </div>
        <div class="page-header__tag">Manajemen Perjalanan</div>
        <h1 class="page-header__title">Kelola <em>Rute Trip</em><br>Agen Anda</h1>
        <p class="page-header__sub">Tambah, ubah, dan hapus paket perjalanan yang ditawarkan oleh agen travel Anda.</p>
    </div>

    {{-- STATS STRIP --}}
    <div class="stats-strip">
        <div class="stat-item">
            <div class="stat-item__icon stat-item__icon--green">🗺️</div>
            <div>
                <div class="stat-item__val">{{ $trips->total() }}</div>
                <div class="stat-item__label">Total Trip</div>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-item__icon stat-item__icon--gold">✅</div>
            <div>
                <div class="stat-item__val">{{ $trips->where('status','aktif')->count() }}</div>
                <div class="stat-item__label">Trip Aktif</div>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-item__icon stat-item__icon--terra">👥</div>
            <div>
                <div class="stat-item__val">{{ $trips->sum('seat_booked') }}</div>
                <div class="stat-item__label">Kursi Terisi</div>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-item__icon stat-item__icon--mist">💰</div>
            <div>
                <div class="stat-item__val">Rp {{ number_format($trips->sum('harga')/1000000,1).'jt' }}</div>
                <div class="stat-item__label">Total Nilai</div>
            </div>
        </div>
    </div>

    {{-- TOOLBAR --}}
    <div class="toolbar">
        <div class="toolbar__search">
            <input type="text" id="searchInput" placeholder="Cari nama trip atau rute..." value="{{ request('search') }}">
        </div>
        <select class="toolbar__select" id="statusFilter" onchange="applyFilter()">
            <option value="">Semua Status</option>
            <option value="aktif"    {{ request('status')=='aktif'    ? 'selected':'' }}>Aktif</option>
            <option value="penuh"    {{ request('status')=='penuh'    ? 'selected':'' }}>Penuh</option>
            <option value="nonaktif" {{ request('status')=='nonaktif' ? 'selected':'' }}>Nonaktif</option>
        </select>
        <select class="toolbar__select" id="sortFilter" onchange="applyFilter()">
            <option value="terbaru"  {{ request('sort')=='terbaru'  ? 'selected':'' }}>Terbaru</option>
            <option value="harga_asc" {{ request('sort')=='harga_asc' ? 'selected':'' }}>Harga Terendah</option>
            <option value="harga_desc"{{ request('sort')=='harga_desc'? 'selected':'' }}>Harga Tertinggi</option>
        </select>
        <a href="{{ route('trips.create') }}" class="btn-add">+ Tambah Trip</a>
    </div>

    {{-- MAIN --}}
    <div class="main">

        {{-- Flash Messages --}}
        @if(session('success'))
        <div class="flash flash--success">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="flash flash--error">⚠️ {{ session('error') }}</div>
        @endif

        <div class="table-card">
            @if($trips->isEmpty())
            <div class="empty-state">
                <div class="empty-state__emoji">🗺️</div>
                <div class="empty-state__title">Belum ada trip</div>
                <p class="empty-state__sub">Mulai tambahkan paket perjalanan pertama Anda.</p>
                <a href="{{ route('trips.create') }}" class="btn-add" style="display:inline-flex">+ Tambah Trip Pertama</a>
            </div>
            @else
            <table>
                <thead>
                    <tr>
                        <th>Trip</th>
                        <th>Tanggal</th>
                        <th>Harga</th>
                        <th>Kursi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trips as $trip)
                    <tr>
                        <td>
                            <div class="trip-name">{{ $trip->nama }}</div>
                            <div class="trip-route">
                                <span>{{ $trip->kota_asal }}</span>
                                <span>→</span>
                                <span>{{ $trip->kota_tujuan }}</span>
                            </div>
                        </td>
                        <td>
                            <div style="font-size:.875rem;font-weight:500;color:var(--forest)">{{ \Carbon\Carbon::parse($trip->tanggal_berangkat)->format('d M Y') }}</div>
                            <div style="font-size:.75rem;color:var(--muted);font-family:var(--font-mono)">{{ \Carbon\Carbon::parse($trip->tanggal_berangkat)->format('H:i') }} WIB</div>
                        </td>
                        <td>
                            <div class="price-val">Rp {{ number_format($trip->harga) }}</div>
                            <div class="price-unit">/ orang</div>
                        </td>
                        <td>
                            @php $pct = $trip->kapasitas > 0 ? ($trip->seat_booked / $trip->kapasitas) * 100 : 0; @endphp
                            <div class="seat-bar">
                                <div class="seat-bar__track">
                                    <div class="seat-bar__fill {{ $pct >= 100 ? 'seat-bar__fill--full' : ($pct >= 70 ? 'seat-bar__fill--warn' : '') }}" style="width:{{ min($pct,100) }}%"></div>
                                </div>
                                <div class="seat-bar__label">{{ $trip->seat_booked }}/{{ $trip->kapasitas }}</div>
                            </div>
                        </td>
                        <td>
                            @php
                                $statusMap = ['aktif'=>'badge--active','nonaktif'=>'badge--inactive','penuh'=>'badge--full'];
                                $labelMap  = ['aktif'=>'Aktif','nonaktif'=>'Nonaktif','penuh'=>'Penuh'];
                            @endphp
                            <span class="badge {{ $statusMap[$trip->status] ?? 'badge--inactive' }}">
                                {{ $labelMap[$trip->status] ?? $trip->status }}
                            </span>
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('trips.show', $trip) }}" class="btn-icon btn-icon--view" title="Lihat detail">👁️</a>
                                <a href="{{ route('trips.edit', $trip) }}" class="btn-icon btn-icon--edit" title="Edit">✏️</a>
                                <button class="btn-icon btn-icon--delete" title="Hapus" onclick="openDelete({{ $trip->id }}, '{{ addslashes($trip->nama) }}')">🗑️</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="pagination">
                <div class="pagination__info">
                    Menampilkan {{ $trips->firstItem() }}–{{ $trips->lastItem() }} dari {{ $trips->total() }} trip
                </div>
                <div class="pagination__btns">
                    @if($trips->onFirstPage())
                        <span class="page-btn" style="opacity:.4">‹</span>
                    @else
                        <a class="page-btn" href="{{ $trips->previousPageUrl() }}">‹</a>
                    @endif

                    @foreach($trips->getUrlRange(1, $trips->lastPage()) as $page => $url)
                        <a class="page-btn {{ $page == $trips->currentPage() ? 'active' : '' }}" href="{{ $url }}">{{ $page }}</a>
                    @endforeach

                    @if($trips->hasMorePages())
                        <a class="page-btn" href="{{ $trips->nextPageUrl() }}">›</a>
                    @else
                        <span class="page-btn" style="opacity:.4">›</span>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- DELETE MODAL --}}
    <div class="modal-overlay" id="deleteModal">
        <div class="modal">
            <div class="modal__icon">⚠️</div>
            <div class="modal__title">Hapus Trip?</div>
            <p class="modal__sub">Trip "<strong id="deleteTripName"></strong>" akan dihapus permanen dan tidak bisa dikembalikan.</p>
            <div class="modal__actions">
                <button class="btn-cancel" onclick="closeDelete()">Batal</button>
                <form id="deleteForm" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-confirm-delete" style="width:100%">Ya, Hapus</button> 
                </form>
            </div>
        </div>
    </div>

    <script>
        function openDelete(id, name) {
            document.getElementById('deleteTripName').textContent = name;
            document.getElementById('deleteForm').action = '/trips/' + id;
            document.getElementById('deleteModal').classList.add('open');
        }
        function closeDelete() {
            document.getElementById('deleteModal').classList.remove('open');
        }
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) closeDelete();
        });

        // Live search
        let searchTimer;
        document.getElementById('searchInput').addEventListener('input', function() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => applyFilter(), 400);
        });

        function applyFilter() {
            const search = document.getElementById('searchInput').value;
            const status = document.getElementById('statusFilter').value;
            const sort   = document.getElementById('sortFilter').value;
            const url = new URL(window.location.href);
            url.searchParams.set('search', search);
            url.searchParams.set('status', status);
            url.searchParams.set('sort', sort);
            url.searchParams.delete('page');
            window.location = url;
        }
    </script>
</body>
</html>