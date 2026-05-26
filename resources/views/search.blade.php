{{-- resources/views/search.blade.php --}}
@extends('layouts.app')

@section('title', 'Cari Perjalanan — MobiTravel')

@section('content')

{{-- ===== HALAMAN PENCARIAN ===== --}}
<div id="page-search" class="page active">
    <div class="search-hero">
        <h1>Temukan Agen Perjalananmu</h1>
        <p>Isi semua kolom lalu klik Cari Sekarang</p>
    </div>

    <div class="search-form">
        <div class="sf-row">
            <div class="sf-field">
                <label for="s-asal">Kota Asal</label>
                <select id="s-asal">
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
            <div class="sf-field">
                <label for="s-tujuan">Tujuan</label>
                <select id="s-tujuan">
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
        </div>

        <div class="sf-row3">
            <div class="sf-field">
                <label for="s-tgl">Tanggal Berangkat</label>
                <input type="date" id="s-tgl">
            </div>
            <div class="sf-field">
                <label for="s-pax">Jumlah Orang</label>
                <select id="s-pax">
                    <option value="1">1 orang</option>
                    <option value="2">2 orang</option>
                    <option value="3">3 orang</option>
                    <option value="4">4 orang</option>
                    <option value="5">5 orang</option>
                    <option value="6">6+ orang</option>
                </select>
            </div>
            <div class="sf-field">
                <label for="s-layanan">Jenis Layanan</label>
                <select id="s-layanan">
                    <option value="">Semua layanan</option>
                    <option>Wisata + Supir</option>
                    <option>Antar Jemput Keluarga</option>
                    <option>Paket Liburan</option>
                    <option>Supir Saja</option>
                </select>
            </div>
        </div>

        <button class="cari-btn" onclick="doSearch()">Cari Sekarang →</button>
    </div>
</div>

{{-- ===== HALAMAN HASIL PENCARIAN ===== --}}
<div id="page-results" class="page">
    <div class="results-header">
        <button class="back-btn" onclick="goPage('search')">←</button>
        <div>
            <div class="results-title" id="res-title">—</div>
            <div class="results-sub" id="res-sub">—</div>
        </div>
    </div>
    <div class="results-meta" id="res-meta"></div>
    <div class="results-body" id="res-body"></div>
</div>

{{-- ===== HALAMAN FORM PEMESANAN ===== --}}
<div id="page-booking" class="page">
    <div class="booking-header">
        <h2>Form Pemesanan</h2>
        <p>Isi data perjalanan kamu dengan lengkap</p>
    </div>
    <div class="booking-agent-strip" id="booking-strip"></div>

    <div class="booking-body">

        {{-- Data Pemesan --}}
        <div class="form-section">
            <div class="form-section-title">Data Pemesan</div>
            <div class="form-grid">
                <div class="form-field">
                    <label>Nama Lengkap</label>
                    <input type="text" id="b-nama" placeholder="Nama lengkap kamu">
                </div>
                <div class="form-field">
                    <label>No. WhatsApp</label>
                    <input type="tel" id="b-wa" placeholder="08xx...">
                </div>
                <div class="form-field full">
                    <label>Email</label>
                    <input type="email" id="b-email" placeholder="email@contoh.com">
                </div>
            </div>
        </div>

        {{-- Detail Perjalanan --}}
        <div class="form-section">
            <div class="form-section-title">Detail Perjalanan</div>
            <div class="form-grid">
                <div class="form-field">
                    <label>Kota Asal</label>
                    <input type="text" id="b-asal" readonly>
                </div>
                <div class="form-field">
                    <label>Tujuan</label>
                    <input type="text" id="b-tujuan" readonly>
                </div>
                <div class="form-field">
                    <label>Tanggal Berangkat</label>
                    <input type="date" id="b-tgl">
                </div>
                <div class="form-field">
                    <label>Jumlah Penumpang</label>
                    <select id="b-pax">
                        <option value="1">1 orang</option>
                        <option value="2">2 orang</option>
                        <option value="3">3 orang</option>
                        <option value="4">4 orang</option>
                        <option value="5">5 orang</option>
                        <option value="6">6 orang</option>
                    </select>
                </div>
                <div class="form-field">
                    <label>Jenis Layanan</label>
                    <input type="text" id="b-layanan" readonly>
                </div>
                <div class="form-field">
                    <label>Titik Jemput</label>
                    <input type="text" id="b-pickup" placeholder="Alamat penjemputan">
                </div>
                <div class="form-field full">
                    <label>Catatan Tambahan</label>
                    <textarea id="b-catatan" placeholder="Kebutuhan khusus, permintaan tambahan..."></textarea>
                </div>
            </div>
        </div>

        {{-- Estimasi Biaya --}}
        <div class="form-section">
            <div class="form-section-title">Estimasi Biaya</div>
            <div class="price-preview">
                <div class="price-row">
                    <span>Harga per pax</span><span id="p-perpax">Rp 0</span>
                </div>
                <div class="price-row">
                    <span>Jumlah penumpang</span><span id="p-pax">1 orang</span>
                </div>
                <div class="price-row total">
                    <span>Total Estimasi</span><span id="p-total">Rp 0</span>
                </div>
            </div>
        </div>

        <input type="hidden" id="b-editid">
        <button class="submit-btn" id="b-submitbtn" onclick="submitBooking()">Konfirmasi Pemesanan</button>
        <button class="cancel-btn" onclick="goPage('results')">← Kembali ke Hasil Pencarian</button>
    </div>
</div>

{{-- ===== HALAMAN PESANAN SAYA ===== --}}
<div id="page-orders" class="page">
    <div class="orders-header">
        <h2>Pesanan Saya</h2>
        <p>Kelola semua pemesanan perjalananmu</p>
    </div>
    <div class="orders-body" id="orders-body"></div>
</div>

{{-- ===== MODAL DETAIL PESANAN ===== --}}
{{--
    CATATAN: Modal ini menggunakan teknik "faux modal" (bukan position:fixed)
    agar bisa render di dalam iframe / widget Claude.
    Di proyek Laravel asli, kamu bisa ganti ke position:fixed bebas.
--}}
<div class="modal-wrap" id="detail-modal">
    <div class="modal-box">
        <div class="modal-top">
            <h3>Detail Pesanan</h3>
            <button class="modal-close" onclick="closeModal()">✕</button>
        </div>
        <div class="modal-content" id="modal-content"></div>
        <div class="modal-actions">
            <button class="action-btn btn-edit" onclick="editFromModal()">Edit Pesanan</button>
            <button class="action-btn btn-cancel" id="modal-cancel-btn">Batalkan</button>
        </div>
    </div>
</div>

{{-- Toast notifikasi --}}
<div class="toast" id="toast"></div>

@endsection

@push('scripts')
<script src="{{ asset('js/mobitravel.js') }}"></script>
@endpush
