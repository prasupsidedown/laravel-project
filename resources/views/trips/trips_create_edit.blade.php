<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($trip) ? 'Edit Trip' : 'Tambah Trip' }} — MobiTravel</title>
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
        html { font-size: 16px; overflow-x: hidden; }
        body { font-family: var(--font-body); background: var(--ivory); color: var(--ink); }
        a { text-decoration: none; color: inherit; }

        body::before {
            content: ''; position: fixed; inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none; z-index: 9999;
        }

        /* NAVBAR */
        .nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.25rem 4rem;
            background: rgba(245,240,232,.92); backdrop-filter: blur(12px);
            box-shadow: 0 1px 0 rgba(0,0,0,.08);
        }
        .nav__logo { font-family: var(--font-display); font-size: 1.5rem; font-weight: 900; color: var(--forest); }
        .nav__logo span { color: var(--gold); }
        .nav__links { display: flex; gap: 2rem; list-style: none; align-items: center; }
        .nav__links a { font-size: .875rem; font-weight: 500; letter-spacing: .04em; text-transform: uppercase; color: var(--ink); transition: color .2s; }
        .nav__links a:hover, .nav__links a.active { color: var(--sage); }

        /* LAYOUT */
        .page-wrap {
            min-height: 100vh;
            padding: 6.5rem 4rem 4rem;
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* FORM CARD */
        .form-card {
            background: #fff;
            border: 1.5px solid var(--sand);
            border-radius: 1.5rem;
            overflow: hidden;
            height: fit-content;
        }
        .form-card__header {
            background: var(--forest);
            padding: 2rem 2.5rem;
        }
        .form-card__tag {
            display: inline-flex; align-items: center; gap: .5rem;
            font-family: var(--font-mono); font-size: .7rem; letter-spacing: .12em;
            text-transform: uppercase; color: var(--mist); margin-bottom: .75rem;
        }
        .form-card__tag::before { content:''; display:inline-block; width:1.5rem; height:1px; background:var(--mist); }
        .form-card__title {
            font-family: var(--font-display); font-size: 1.6rem; font-weight: 900;
            color: var(--cream); letter-spacing: -.02em; line-height: 1.1;
        }
        .form-card__title em { font-style: italic; color: var(--gold); }
        .form-card__body { padding: 2.5rem; }

        /* BREADCRUMB */
        .breadcrumb {
            display: flex; align-items: center; gap: .5rem;
            font-family: var(--font-mono); font-size: .72rem; letter-spacing: .08em;
            text-transform: uppercase; color: var(--muted); margin-bottom: 1.5rem;
        }
        .breadcrumb a { color: var(--sage); }
        .breadcrumb a:hover { color: var(--forest); }
        .breadcrumb span { opacity: .4; }

        /* SECTION LABEL */
        .section-label {
            font-family: var(--font-mono); font-size: .72rem; letter-spacing: .1em;
            text-transform: uppercase; color: var(--muted);
            display: flex; align-items: center; gap: .5rem;
            margin-bottom: 1.25rem; margin-top: 2rem;
        }
        .section-label:first-of-type { margin-top: 0; }
        .section-label::after { content:''; flex:1; height:1px; background:var(--sand); }

        /* FORM GROUP */
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .form-row--3 { grid-template-columns: 1fr 1fr 1fr; }

        .form-group { display: flex; flex-direction: column; gap: .45rem; margin-bottom: 1rem; }
        .form-group:last-child { margin-bottom: 0; }

        label {
            font-size: .8rem; font-weight: 500; color: var(--forest);
            display: flex; align-items: center; gap: .35rem;
        }
        label .req { color: var(--terra); font-size: .9em; }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        input[type="time"],
        select,
        textarea {
            border: 1.5px solid var(--sand); border-radius: .65rem;
            padding: .7rem 1rem;
            font-family: var(--font-body); font-size: .9rem; color: var(--ink);
            background: var(--ivory); outline: none;
            transition: border-color .2s, box-shadow .2s;
            width: 100%;
        }
        input:focus, select:focus, textarea:focus {
            border-color: var(--sage);
            box-shadow: 0 0 0 3px rgba(78,128,96,.12);
            background: #fff;
        }
        input.is-error, select.is-error, textarea.is-error {
            border-color: var(--danger);
            box-shadow: 0 0 0 3px rgba(192,57,43,.1);
        }
        textarea { resize: vertical; min-height: 100px; }
        select { appearance: none; }
        .field-hint { font-size: .75rem; color: var(--muted); }
        .field-error { font-size: .75rem; color: var(--danger); }

        /* Price preview */
        .price-preview {
            background: var(--cream); border: 1px solid var(--sand);
            border-radius: .65rem; padding: .75rem 1rem;
            font-family: var(--font-display); font-size: 1.1rem; font-weight: 700;
            color: var(--forest); min-height: 2.8rem;
        }

        /* FORM ACTIONS */
        .form-actions {
            display: flex; gap: .75rem; margin-top: 2rem;
            padding-top: 2rem; border-top: 1px solid var(--sand);
        }
        .btn-submit {
            flex: 1; padding: .85rem 2rem; border-radius: 2rem;
            background: var(--forest); color: var(--cream);
            font-family: var(--font-body); font-size: .9375rem; font-weight: 600;
            border: none; cursor: pointer;
            transition: background .2s, transform .2s var(--ease-bounce);
            display: flex; align-items: center; justify-content: center; gap: .5rem;
        }
        .btn-submit:hover { background: var(--moss); transform: translateY(-2px); }
        .btn-back {
            padding: .85rem 1.75rem; border-radius: 2rem;
            border: 1.5px solid var(--sand); background: #fff;
            font-family: var(--font-body); font-size: .9375rem; font-weight: 500; color: var(--muted);
            cursor: pointer; transition: all .2s;
            text-decoration: none; display: flex; align-items: center; gap: .4rem;
        }
        .btn-back:hover { border-color: var(--muted); color: var(--ink); }

        /* SIDE PANEL */
        .side-panel { display: flex; flex-direction: column; gap: 1.25rem; }

        .info-card {
            background: #fff; border: 1.5px solid var(--sand);
            border-radius: 1.25rem; overflow: hidden;
        }
        .info-card__header {
            padding: 1.25rem 1.5rem;
            background: var(--cream);
            border-bottom: 1px solid var(--sand);
            font-family: var(--font-mono); font-size: .72rem;
            letter-spacing: .1em; text-transform: uppercase; color: var(--muted);
        }
        .info-card__body { padding: 1.5rem; }

        /* Trip preview card */
        .preview-card {
            background: var(--forest); border-radius: .85rem;
            padding: 1.5rem; color: var(--cream); margin-bottom: .75rem;
        }
        .preview-card__route {
            display: flex; align-items: center; gap: .5rem;
            font-family: var(--font-display); font-size: 1.1rem; font-weight: 700;
            margin-bottom: .5rem;
        }
        .preview-card__route span { color: var(--gold); }
        .preview-card__name { font-size: .85rem; color: rgba(245,240,232,.65); margin-bottom: 1rem; }
        .preview-card__meta { display: flex; gap: 1.25rem; }
        .preview-meta { display: flex; flex-direction: column; gap: .1rem; }
        .preview-meta__val { font-family: var(--font-display); font-size: 1rem; font-weight: 700; }
        .preview-meta__label { font-size: .7rem; color: rgba(245,240,232,.5); font-family: var(--font-mono); letter-spacing: .04em; text-transform: uppercase; }

        /* Tips */
        .tip { display: flex; gap: .65rem; padding: .65rem 0; border-bottom: 1px solid var(--sand); font-size: .83rem; line-height: 1.5; color: var(--ink); }
        .tip:last-child { border-bottom: none; padding-bottom: 0; }
        .tip__icon { font-size: 1rem; flex-shrink: 0; margin-top: .05rem; }

        @media (max-width: 1024px) {
            .nav { padding: 1.25rem 2rem; }
            .page-wrap { grid-template-columns: 1fr; padding: 6rem 2rem 3rem; gap: 1.5rem; }
        }
        @media (max-width: 640px) {
            .nav__links { display: none; }
            .form-row, .form-row--3 { grid-template-columns: 1fr; }
        }
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

    <div class="page-wrap">

        {{-- MAIN FORM --}}
        <div>
            <div class="breadcrumb">
                <a href="{{ route('trips.index') }}">← Kelola Trip</a>
                <span>/</span>
                <span>{{ isset($trip) ? 'Edit Trip' : 'Tambah Trip Baru' }}</span>
            </div>

            <div class="form-card">
                <div class="form-card__header">
                    <div class="form-card__tag">{{ isset($trip) ? 'Edit Data' : 'Tambah Baru' }}</div>
                    <div class="form-card__title">
                        {{ isset($trip) ? 'Edit' : 'Tambah' }} <em>Trip</em>
                    </div>
                </div>

                <div class="form-card__body">
                    <form method="POST"
                          action="{{ isset($trip) ? route('trips.update', $trip) : route('trips.store') }}"
                          id="tripForm">
                        @csrf
                        @if(isset($trip)) @method('PUT') @endif

                        {{-- INFORMASI DASAR --}}
                        <div class="section-label">Informasi Dasar</div>

                        <div class="form-group">
                            <label for="nama">Nama Trip <span class="req">*</span></label>
                            <input type="text" id="nama" name="nama"
                                   value="{{ old('nama', $trip->nama ?? '') }}"
                                   placeholder="cth: Paket Wisata Bali 3D2N"
                                   class="{{ $errors->has('nama') ? 'is-error' : '' }}">
                            @error('nama')<span class="field-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="kota_asal">Kota Asal <span class="req">*</span></label>
                                <input type="text" id="kota_asal" name="kota_asal"
                                       value="{{ old('kota_asal', $trip->kota_asal ?? '') }}"
                                       placeholder="cth: Surabaya"
                                       oninput="updatePreview()"
                                       class="{{ $errors->has('kota_asal') ? 'is-error' : '' }}">
                                @error('kota_asal')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="kota_tujuan">Kota Tujuan <span class="req">*</span></label>
                                <input type="text" id="kota_tujuan" name="kota_tujuan"
                                       value="{{ old('kota_tujuan', $trip->kota_tujuan ?? '') }}"
                                       placeholder="cth: Bali"
                                       oninput="updatePreview()"
                                       class="{{ $errors->has('kota_tujuan') ? 'is-error' : '' }}">
                                @error('kota_tujuan')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Trip</label>
                            <textarea id="deskripsi" name="deskripsi"
                                      placeholder="Jelaskan detail paket, fasilitas, dan itinerary perjalanan...">{{ old('deskripsi', $trip->deskripsi ?? '') }}</textarea>
                        </div>

                        {{-- JADWAL --}}
                        <div class="section-label">Jadwal Perjalanan</div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="tanggal_berangkat">Tanggal Berangkat <span class="req">*</span></label>
                                <input type="date" id="tanggal_berangkat" name="tanggal_berangkat"
                                       value="{{ old('tanggal_berangkat', isset($trip) ? \Carbon\Carbon::parse($trip->tanggal_berangkat)->format('Y-m-d') : '') }}"
                                       oninput="updatePreview()"
                                       class="{{ $errors->has('tanggal_berangkat') ? 'is-error' : '' }}">
                                @error('tanggal_berangkat')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="jam_berangkat">Jam Berangkat</label>
                                <input type="time" id="jam_berangkat" name="jam_berangkat"
                                       value="{{ old('jam_berangkat', $trip->jam_berangkat ?? '07:00') }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="durasi">Durasi (Hari) <span class="req">*</span></label>
                                <input type="number" id="durasi" name="durasi" min="1" max="30"
                                       value="{{ old('durasi', $trip->durasi ?? '') }}"
                                       placeholder="cth: 3"
                                       class="{{ $errors->has('durasi') ? 'is-error' : '' }}">
                                @error('durasi')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="jenis_layanan">Jenis Layanan <span class="req">*</span></label>
                                <select id="jenis_layanan" name="jenis_layanan"
                                        class="{{ $errors->has('jenis_layanan') ? 'is-error' : '' }}">
                                    <option value="">Pilih layanan...</option>
                                    @foreach(['Wisata + Supir','Antar Jemput Keluarga','Paket Liburan','Supir Saja','Paket Honeymoon','Corporate Tour','Wisata Alam','Diving & Snorkeling'] as $l)
                                    <option value="{{ $l }}" {{ old('jenis_layanan', $trip->jenis_layanan ?? '') == $l ? 'selected' : '' }}>{{ $l }}</option>
                                    @endforeach
                                </select>
                                @error('jenis_layanan')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        {{-- KAPASITAS & HARGA --}}
                        <div class="section-label">Kapasitas & Harga</div>

                        <div class="form-row--3 form-row">
                            <div class="form-group">
                                <label for="kapasitas">Kapasitas Kursi <span class="req">*</span></label>
                                <input type="number" id="kapasitas" name="kapasitas" min="1"
                                       value="{{ old('kapasitas', $trip->kapasitas ?? '') }}"
                                       placeholder="cth: 20"
                                       class="{{ $errors->has('kapasitas') ? 'is-error' : '' }}">
                                @error('kapasitas')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="seat_booked">Kursi Terisi</label>
                                <input type="number" id="seat_booked" name="seat_booked" min="0"
                                       value="{{ old('seat_booked', $trip->seat_booked ?? 0) }}">
                                <span class="field-hint">Isi jika ada yang sudah booking</span>
                            </div>
                            <div class="form-group">
                                <label for="status">Status <span class="req">*</span></label>
                                <select id="status" name="status"
                                        class="{{ $errors->has('status') ? 'is-error' : '' }}">
                                    <option value="aktif"    {{ old('status', $trip->status ?? 'aktif') == 'aktif'    ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ old('status', $trip->status ?? '') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    <option value="penuh"    {{ old('status', $trip->status ?? '') == 'penuh'    ? 'selected' : '' }}>Penuh</option>
                                </select>
                                @error('status')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="harga">Harga (Rp) <span class="req">*</span></label>
                                <input type="number" id="harga" name="harga" min="0"
                                       value="{{ old('harga', $trip->harga ?? '') }}"
                                       placeholder="cth: 350000"
                                       oninput="updatePreview()"
                                       class="{{ $errors->has('harga') ? 'is-error' : '' }}">
                                @error('harga')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label>Preview Harga</label>
                                <div class="price-preview" id="pricePreview">—</div>
                            </div>
                        </div>

                        {{-- FORM ACTIONS --}}
                        <div class="form-actions">
                            <a href="{{ route('trips.index') }}" class="btn-back">← Batal</a>
                            <button type="submit" class="btn-submit">
                                {{ isset($trip) ? '💾 Simpan Perubahan' : '✅ Tambah Trip' }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        {{-- SIDE PANEL --}}
        <div class="side-panel">

            {{-- Live Preview --}}
            <div class="info-card">
                <div class="info-card__header">Preview Trip Card</div>
                <div class="info-card__body">
                    <div class="preview-card">
                        <div class="preview-card__route">
                            <span id="prev-asal">Asal</span>
                            <span>→</span>
                            <span id="prev-tujuan">Tujuan</span>
                        </div>
                        <div class="preview-card__name" id="prev-nama">Nama trip akan muncul di sini</div>
                        <div class="preview-card__meta">
                            <div class="preview-meta">
                                <div class="preview-meta__val" id="prev-tanggal">—</div>
                                <div class="preview-meta__label">Berangkat</div>
                            </div>
                            <div class="preview-meta">
                                <div class="preview-meta__val" id="prev-harga">—</div>
                                <div class="preview-meta__label">Per orang</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tips --}}
            <div class="info-card">
                <div class="info-card__header">💡 Tips Pengisian</div>
                <div class="info-card__body">
                    <div class="tip"><span class="tip__icon">📝</span> Nama trip yang jelas dan menarik akan meningkatkan minat calon penumpang.</div>
                    <div class="tip"><span class="tip__icon">💰</span> Harga yang kompetitif meningkatkan peluang booking. Survei harga pasar dahulu.</div>
                    <div class="tip"><span class="tip__icon">🗓️</span> Pastikan tanggal berangkat sudah dikonfirmasi sebelum diaktifkan.</div>
                    <div class="tip"><span class="tip__icon">👥</span> Sesuaikan kapasitas dengan kendaraan yang tersedia agar tidak overbooked.</div>
                </div>
            </div>

            {{-- Validation summary --}}
            @if($errors->any())
            <div style="background:var(--danger-bg);border:1.5px solid rgba(192,57,43,.2);border-radius:1rem;padding:1.25rem 1.5rem;">
                <div style="font-weight:600;color:var(--danger);margin-bottom:.5rem;font-size:.9rem;">⚠️ Ada {{ $errors->count() }} kesalahan:</div>
                <ul style="list-style:none;display:flex;flex-direction:column;gap:.35rem;">
                    @foreach($errors->all() as $e)
                    <li style="font-size:.82rem;color:var(--danger);">• {{ $e }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

        </div>
    </div>

    <script>
        const bulanId = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];

        function updatePreview() {
            const asal    = document.getElementById('kota_asal').value || 'Asal';
            const tujuan  = document.getElementById('kota_tujuan').value || 'Tujuan';
            const nama    = document.getElementById('nama').value || 'Nama trip akan muncul di sini';
            const harga   = parseInt(document.getElementById('harga').value) || 0;
            const tglRaw  = document.getElementById('tanggal_berangkat').value;

            document.getElementById('prev-asal').textContent   = asal;
            document.getElementById('prev-tujuan').textContent = tujuan;
            document.getElementById('prev-nama').textContent   = nama;

            // Format harga
            if (harga > 0) {
                const formatted = harga >= 1000000
                    ? 'Rp ' + (harga/1000000).toFixed(1).replace('.0','') + 'jt'
                    : 'Rp ' + (harga/1000).toFixed(0) + 'rb';
                document.getElementById('prev-harga').textContent = formatted;
                document.getElementById('pricePreview').textContent = 'Rp ' + harga.toLocaleString('id-ID');
            } else {
                document.getElementById('prev-harga').textContent = '—';
                document.getElementById('pricePreview').textContent = '—';
            }

            // Format tanggal
            if (tglRaw) {
                const d = new Date(tglRaw);
                document.getElementById('prev-tanggal').textContent =
                    d.getDate() + ' ' + bulanId[d.getMonth()] + ' ' + d.getFullYear();
            } else {
                document.getElementById('prev-tanggal').textContent = '—';
            }
        }

        // Init preview on edit mode
        updatePreview();

        // Tambahkan event listener ke semua field preview
        ['nama','kota_asal','kota_tujuan','harga','tanggal_berangkat'].forEach(id => {
            document.getElementById(id)?.addEventListener('input', updatePreview);
        });
    </script>
</body>
</html>