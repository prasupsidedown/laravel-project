/**
 * mobitravel.js
 * Letakkan di: public/js/mobitravel.js
 *
 * Semua logika pencarian, pemesanan, dan CRUD pesanan berjalan
 * sepenuhnya di frontend menggunakan localStorage — tanpa backend.
 *
 * ─────────────────────────────────────────────────────────────
 * CARA MENGHUBUNGKAN DENGAN BACKEND NANTI (opsional):
 *   Ganti fungsi getOrders() dan saveOrders() dengan fetch/Axios
 *   ke endpoint Laravel kamu. Contoh ada di bagian bawah file.
 * ─────────────────────────────────────────────────────────────
 */

/* ============================================================
   DATA AGEN — ganti dengan @json($agents) dari controller
   ============================================================
   Contoh di blade:
       <script>
           const AGENTS = @json($agents);
       </script>
   Lalu hapus const AGENTS di bawah ini.
   ============================================================ */
const AGENTS = [
    {
        id: 1,
        name: 'Surya Wisata Bali',
        city: 'Denpasar, Bali',
        badge: 'Agen Unggulan',
        rating: '4.9',
        reviews: '312',
        price: 850000,
        tags: ['Wisata', 'Supir', 'Antar Jemput'],
        dest: ['Bali'],
        icon: '🌴',
        layanan: ['Wisata + Supir', 'Antar Jemput Keluarga'],
    },
    {
        id: 2,
        name: 'Bali Harmony Tours',
        city: 'Kuta, Bali',
        badge: 'Terverifikasi',
        rating: '4.7',
        reviews: '204',
        price: 720000,
        tags: ['Wisata', 'Paket Keluarga'],
        dest: ['Bali'],
        icon: '🏖️',
        layanan: ['Paket Liburan', 'Wisata + Supir'],
    },
    {
        id: 3,
        name: 'Lombok Express Tour',
        city: 'Mataram, NTB',
        badge: 'Terverifikasi',
        rating: '4.8',
        reviews: '198',
        price: 780000,
        tags: ['Paket Wisata', 'Supir', 'Kapal'],
        dest: ['Lombok'],
        icon: '⛵',
        layanan: ['Wisata + Supir', 'Paket Liburan'],
    },
    {
        id: 4,
        name: 'Lombok Indah Travel',
        city: 'Senggigi, NTB',
        badge: 'Terverifikasi',
        rating: '4.6',
        reviews: '113',
        price: 650000,
        tags: ['Supir', 'Wisata Bahari'],
        dest: ['Lombok'],
        icon: '🐠',
        layanan: ['Supir Saja', 'Wisata + Supir'],
    },
    {
        id: 5,
        name: 'Bromo Adventure Jaya',
        city: 'Probolinggo, Jatim',
        badge: 'Terverifikasi',
        rating: '4.7',
        reviews: '145',
        price: 550000,
        tags: ['Wisata Alam', 'Supir', 'Jeep'],
        dest: ['Bromo'],
        icon: '🌋',
        layanan: ['Wisata + Supir', 'Supir Saja'],
    },
    {
        id: 6,
        name: 'Dieng Plateau Tour',
        city: 'Wonosobo, Jateng',
        badge: 'Terverifikasi',
        rating: '4.5',
        reviews: '89',
        price: 420000,
        tags: ['Wisata', 'Supir'],
        dest: ['Dieng'],
        icon: '🌄',
        layanan: ['Wisata + Supir', 'Supir Saja'],
    },
    {
        id: 7,
        name: 'Raja Ampat Dive & Tour',
        city: 'Sorong, Papua',
        badge: 'Agen Unggulan',
        rating: '4.9',
        reviews: '76',
        price: 1950000,
        tags: ['Diving', 'Kapal', 'Wisata Bahari'],
        dest: ['Raja Ampat'],
        icon: '🤿',
        layanan: ['Paket Liburan', 'Wisata + Supir'],
    },
    {
        id: 8,
        name: 'Flores Labuan Tour',
        city: 'Labuan Bajo, NTT',
        badge: 'Terverifikasi',
        rating: '4.8',
        reviews: '132',
        price: 1200000,
        tags: ['Kapal', 'Wisata', 'Supir'],
        dest: ['Labuan Bajo'],
        icon: '🦎',
        layanan: ['Paket Liburan', 'Wisata + Supir'],
    },
    {
        id: 9,
        name: 'Nusa Wisata Seribu',
        city: 'Jakarta Utara, DKI',
        badge: 'Terverifikasi',
        rating: '4.5',
        reviews: '65',
        price: 380000,
        tags: ['Kapal', 'Hari Ini'],
        dest: ['Kepulauan Seribu'],
        icon: '🏝️',
        layanan: ['Paket Liburan', 'Antar Jemput Keluarga'],
    },
    {
        id: 10,
        name: 'Trans Nusa Driver',
        city: 'Jakarta, DKI',
        badge: 'Terverifikasi',
        rating: '4.6',
        reviews: '220',
        price: 300000,
        tags: ['Supir Profesional'],
        dest: ['Bali', 'Lombok', 'Bromo', 'Dieng', 'Raja Ampat', 'Labuan Bajo', 'Kepulauan Seribu'],
        icon: '🚗',
        layanan: ['Supir Saja', 'Antar Jemput Keluarga'],
    },
];

/* ============================================================
   STATE
   ============================================================ */
let searchCtx     = {};   // menyimpan input form pencarian
let selectedAgent = null; // agen yang sedang dipilih untuk dipesan
let currentDetailId = null; // id pesanan yang sedang dibuka di modal

/* ============================================================
   HELPER
   ============================================================ */
function fmtRp(n) {
    return 'Rp ' + parseInt(n).toLocaleString('id-ID');
}

function genId() {
    // Generate ID unik: MB + 6 karakter base36 dari timestamp
    return 'MB' + Date.now().toString(36).toUpperCase().slice(-6);
}

/* ============================================================
   CRUD STORAGE
   Ganti dua fungsi ini dengan fetch/Axios ketika backend siap.
   ============================================================ */

/** READ — ambil semua pesanan dari localStorage */
function getOrders() {
    try {
        return JSON.parse(localStorage.getItem('mb_orders') || '[]');
    } catch {
        return [];
    }
}

/** WRITE — simpan array pesanan ke localStorage */
function saveOrders(orders) {
    localStorage.setItem('mb_orders', JSON.stringify(orders));
}

/* ============================================================
   NAVIGASI ANTAR HALAMAN
   ============================================================ */
function goPage(p) {
    // Sembunyikan semua page
    document.querySelectorAll('.page').forEach(x => x.classList.remove('active'));
    // Tampilkan page yang dituju
    document.getElementById('page-' + p).classList.add('active');

    // Update state tombol navbar
    document.querySelectorAll('.nav-btn').forEach(b => b.classList.remove('active'));
    if (p === 'search' || p === 'results') {
        document.querySelectorAll('.nav-btn')[0].classList.add('active');
    }
    if (p === 'orders') {
        document.querySelectorAll('.nav-btn')[1].classList.add('active');
        renderOrders();
    }

    closeModal();
}

/* ============================================================
   TOAST NOTIFIKASI
   ============================================================ */
function showToast(msg) {
    const t = document.getElementById('toast');
    t.textContent = msg;
    t.classList.add('show');
    setTimeout(() => t.classList.remove('show'), 2500);
}

/* ============================================================
   PENCARIAN AGEN
   ============================================================ */
function doSearch() {
    const asal    = document.getElementById('s-asal').value;
    const tujuan  = document.getElementById('s-tujuan').value;
    const tgl     = document.getElementById('s-tgl').value;
    const pax     = document.getElementById('s-pax').value;
    const layanan = document.getElementById('s-layanan').value;

    // Validasi minimal
    if (!asal || !tujuan) {
        showToast('Pilih kota asal dan tujuan dulu ya!');
        return;
    }

    // Simpan konteks pencarian untuk dipakai di form pemesanan
    searchCtx = { asal, tujuan, tgl, pax, layanan };

    // Filter agen berdasarkan tujuan dan layanan
    let results = [...AGENTS].filter(a => a.dest.includes(tujuan));
    if (layanan) {
        results = results.filter(a => a.layanan.includes(layanan));
    }

    // Isi header hasil pencarian
    document.getElementById('res-title').textContent = asal + ' → ' + tujuan;
    document.getElementById('res-sub').textContent   = results.length + ' agen tersedia';

    // Chips meta info
    const meta = document.getElementById('res-meta');
    meta.innerHTML = '';
    if (tgl) {
        const d = new Date(tgl);
        meta.innerHTML += `<span class="meta-chip">${d.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' })}</span>`;
    }
    meta.innerHTML += `<span class="meta-chip">${pax} penumpang</span>`;
    if (layanan) meta.innerHTML += `<span class="meta-chip highlight">${layanan}</span>`;

    // Render kartu agen
    const body = document.getElementById('res-body');
    body.innerHTML = `<div class="result-count">Menampilkan <strong>${results.length} agen</strong> yang sesuai</div>`;

    if (!results.length) {
        body.innerHTML += '<div class="no-result">Tidak ada agen untuk rute ini.<br>Coba ubah tujuan atau jenis layanan.</div>';
        goPage('results');
        return;
    }

    results.forEach(a => {
        const card = document.createElement('div');
        card.className = 'agent-card';
        card.innerHTML = `
            <div class="agent-card-icon">${a.icon}</div>
            <div class="agent-card-body">
                <div class="agent-card-top">
                    <div class="agent-name">${a.name}</div>
                    <span class="agent-badge">${a.badge}</span>
                </div>
                <div class="agent-city">${a.city}</div>
                <div class="agent-tags">
                    ${a.tags.map(t => `<span class="tag">${t}</span>`).join('')}
                </div>
                <div class="agent-footer">
                    <div>
                        <div class="agent-rating">★ ${a.rating} <span>(${a.reviews} ulasan)</span></div>
                        <div class="agent-price">Mulai <strong>${fmtRp(a.price)}</strong>/pax</div>
                    </div>
                    <button class="pilih-btn" data-id="${a.id}">Pesan →</button>
                </div>
            </div>`;

        card.querySelector('.pilih-btn').addEventListener('click', (e) => {
            e.stopPropagation();
            openBooking(a.id);
        });
        card.addEventListener('click', () => openBooking(a.id));
        body.appendChild(card);
    });

    goPage('results');
}

/* ============================================================
   FORM PEMESANAN — CREATE & UPDATE
   ============================================================ */

/**
 * Buka halaman pemesanan.
 * @param {number} agentId  - ID agen yang dipilih
 * @param {string} [orderId] - Jika diisi, mode edit pesanan yang sudah ada
 */
function openBooking(agentId, orderId = null) {
    selectedAgent = AGENTS.find(a => a.id === agentId);
    if (!selectedAgent) return;

    // Tampilkan strip info agen di atas form
    document.getElementById('booking-strip').innerHTML = `
        <div class="agent-strip-icon">${selectedAgent.icon}</div>
        <div>
            <div class="agent-strip-name">${selectedAgent.name}</div>
            <div class="agent-strip-city">${selectedAgent.city}</div>
        </div>`;

    // Reset mode
    document.getElementById('b-editid').value = '';
    document.getElementById('b-submitbtn').textContent = 'Konfirmasi Pemesanan';

    if (orderId) {
        // ── MODE EDIT ── isi form dari data pesanan yang ada
        const o = getOrders().find(x => x.id === orderId);
        if (o) {
            document.getElementById('b-nama').value    = o.nama;
            document.getElementById('b-wa').value      = o.wa;
            document.getElementById('b-email').value   = o.email;
            document.getElementById('b-asal').value    = o.asal;
            document.getElementById('b-tujuan').value  = o.tujuan;
            document.getElementById('b-tgl').value     = o.tgl;
            document.getElementById('b-pax').value     = o.pax;
            document.getElementById('b-layanan').value = o.layanan;
            document.getElementById('b-pickup').value  = o.pickup;
            document.getElementById('b-catatan').value = o.catatan;
            document.getElementById('b-editid').value  = orderId;
            document.getElementById('b-submitbtn').textContent = 'Simpan Perubahan';
        }
    } else {
        // ── MODE CREATE ── isi form dari konteks pencarian
        document.getElementById('b-nama').value    = '';
        document.getElementById('b-wa').value      = '';
        document.getElementById('b-email').value   = '';
        document.getElementById('b-asal').value    = searchCtx.asal    || '';
        document.getElementById('b-tujuan').value  = searchCtx.tujuan  || '';
        document.getElementById('b-tgl').value     = searchCtx.tgl     || '';
        document.getElementById('b-pax').value     = searchCtx.pax     || '1';
        document.getElementById('b-layanan').value = searchCtx.layanan || (selectedAgent.layanan[0] || '');
        document.getElementById('b-pickup').value  = '';
        document.getElementById('b-catatan').value = '';
    }

    updatePrice();
    goPage('booking');
}

/** Hitung ulang estimasi harga ketika jumlah pax berubah */
function updatePrice() {
    if (!selectedAgent) return;
    const pax   = parseInt(document.getElementById('b-pax').value) || 1;
    const total = selectedAgent.price * pax;
    document.getElementById('p-perpax').textContent = fmtRp(selectedAgent.price);
    document.getElementById('p-pax').textContent    = pax + ' orang';
    document.getElementById('p-total').textContent  = fmtRp(total);
}

// Update harga saat pax berubah
document.getElementById('b-pax').addEventListener('change', updatePrice);

/**
 * Simpan pesanan baru atau perbarui pesanan yang sudah ada.
 * Ini adalah fungsi CREATE dan UPDATE.
 */
function submitBooking() {
    const nama = document.getElementById('b-nama').value.trim();
    const wa   = document.getElementById('b-wa').value.trim();
    const tgl  = document.getElementById('b-tgl').value;

    if (!nama || !wa || !tgl) {
        showToast('Nama, WhatsApp, dan tanggal wajib diisi!');
        return;
    }

    const editId = document.getElementById('b-editid').value;
    const pax    = parseInt(document.getElementById('b-pax').value) || 1;
    const orders = getOrders();

    // Bangun objek pesanan
    const order = {
        id:         editId || genId(),
        agentId:    selectedAgent.id,
        agentName:  selectedAgent.name,
        agentCity:  selectedAgent.city,
        agentIcon:  selectedAgent.icon,
        nama,
        wa,
        email:      document.getElementById('b-email').value.trim(),
        asal:       document.getElementById('b-asal').value,
        tujuan:     document.getElementById('b-tujuan').value,
        tgl,
        pax,
        layanan:    document.getElementById('b-layanan').value,
        pickup:     document.getElementById('b-pickup').value.trim(),
        catatan:    document.getElementById('b-catatan').value.trim(),
        price:      selectedAgent.price,
        total:      selectedAgent.price * pax,
        // Pertahankan status lama jika edit, baru = pending
        status:     editId
                        ? (orders.find(o => o.id === editId) || {}).status || 'pending'
                        : 'pending',
        createdAt:  editId
                        ? (orders.find(o => o.id === editId) || {}).createdAt || new Date().toISOString()
                        : new Date().toISOString(),
    };

    if (editId) {
        // UPDATE — ganti data lama di array
        const idx = orders.findIndex(o => o.id === editId);
        if (idx > -1) orders[idx] = order;
    } else {
        // CREATE — tambah ke awal array
        orders.unshift(order);
    }

    saveOrders(orders);
    showToast(editId ? 'Pesanan berhasil diperbarui!' : 'Pesanan berhasil dibuat!');
    goPage('orders');
}

/* ============================================================
   HALAMAN PESANAN SAYA — READ, UPDATE STATUS, DELETE
   ============================================================ */

/** Render semua pesanan ke halaman Pesanan Saya */
function renderOrders() {
    const orders = getOrders();
    const body   = document.getElementById('orders-body');

    if (!orders.length) {
        body.innerHTML = '<div class="no-orders">Belum ada pesanan.<br>Yuk cari perjalananmu dulu!</div>';
        return;
    }

    body.innerHTML = '';

    const statusClass = { pending: 'status-pending', confirmed: 'status-confirmed', cancelled: 'status-cancelled' };
    const statusLabel = { pending: 'Menunggu', confirmed: 'Dikonfirmasi', cancelled: 'Dibatalkan' };

    orders.forEach(o => {
        const tgl = o.tgl
            ? new Date(o.tgl).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' })
            : '—';

        const card = document.createElement('div');
        card.className = 'order-card';
        card.innerHTML = `
            <div class="order-card-top">
                <div>
                    <div class="order-id">#${o.id}</div>
                    <div class="order-agent">${o.agentIcon} ${o.agentName}</div>
                    <div class="order-route">${o.asal} → ${o.tujuan}</div>
                </div>
                <span class="order-status ${statusClass[o.status] || 'status-pending'}">
                    ${statusLabel[o.status] || 'Menunggu'}
                </span>
            </div>
            <div class="order-details">
                <div class="detail-item"><div class="dl">Tanggal</div><div class="dv">${tgl}</div></div>
                <div class="detail-item"><div class="dl">Penumpang</div><div class="dv">${o.pax} orang</div></div>
                <div class="detail-item"><div class="dl">Layanan</div><div class="dv">${o.layanan || '—'}</div></div>
                <div class="detail-item"><div class="dl">Total</div><div class="dv order-total">${fmtRp(o.total)}</div></div>
            </div>
            <div class="order-actions">
                <button class="action-btn btn-detail"  data-id="${o.id}">Detail</button>
                ${o.status !== 'cancelled' ? `<button class="action-btn btn-edit" data-id="${o.id}">Edit</button>` : ''}
                ${o.status === 'pending'   ? `<button class="action-btn btn-cancel" data-id="${o.id}">Batalkan</button>` : ''}
                <button class="action-btn btn-delete" data-id="${o.id}">Hapus</button>
            </div>`;

        // Pasang event listener per tombol
        card.querySelector('.btn-detail').onclick = () => openDetail(o.id);

        const editBtn = card.querySelector('.btn-edit');
        if (editBtn) editBtn.onclick = () => {
            searchCtx = { asal: o.asal, tujuan: o.tujuan };
            openBooking(o.agentId, o.id);
        };

        const cancelBtn = card.querySelector('.btn-cancel');
        if (cancelBtn) cancelBtn.onclick = () => cancelOrder(o.id);

        card.querySelector('.btn-delete').onclick = () => deleteOrder(o.id);

        body.appendChild(card);
    });
}

/* ============================================================
   MODAL DETAIL PESANAN
   ============================================================ */
function openDetail(id) {
    currentDetailId = id;
    const o = getOrders().find(x => x.id === id);
    if (!o) return;

    const tgl = o.tgl
        ? new Date(o.tgl).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })
        : '—';

    const rows = [
        ['ID Pesanan', `#${o.id}`],
        ['Agen',       `${o.agentIcon} ${o.agentName}`],
        ['Rute',       `${o.asal} → ${o.tujuan}`],
        ['Tanggal',    tgl],
        ['Penumpang',  `${o.pax} orang`],
        ['Layanan',    o.layanan || '—'],
        ['Pemesan',    o.nama],
        ['WhatsApp',   o.wa],
        ['Email',      o.email || '—'],
        ['Titik Jemput', o.pickup || '—'],
        ['Total',      fmtRp(o.total)],
        ['Catatan',    o.catatan || '—'],
    ];

    document.getElementById('modal-content').innerHTML = rows
        .map(([l, v]) => `<div class="modal-row"><span class="ml">${l}</span><span class="mr">${v}</span></div>`)
        .join('');

    const cb = document.getElementById('modal-cancel-btn');
    if (o.status === 'pending') {
        cb.style.display = '';
        cb.onclick = () => { cancelOrder(id); closeModal(); };
    } else {
        cb.style.display = 'none';
    }

    document.getElementById('detail-modal').classList.add('open');
}

/** Buka form edit dari dalam modal detail */
function editFromModal() {
    const o = getOrders().find(x => x.id === currentDetailId);
    if (!o) return;
    closeModal();
    searchCtx = { asal: o.asal, tujuan: o.tujuan };
    openBooking(o.agentId, o.id);
}

function closeModal() {
    document.getElementById('detail-modal').classList.remove('open');
}

/* ============================================================
   CRUD: CANCEL & DELETE
   ============================================================ */

/** UPDATE STATUS → cancelled */
function cancelOrder(id) {
    const orders = getOrders();
    const idx    = orders.findIndex(o => o.id === id);
    if (idx > -1) {
        orders[idx].status = 'cancelled';
        saveOrders(orders);
        renderOrders();
        showToast('Pesanan berhasil dibatalkan.');
    }
}

/** DELETE — hapus permanen */
function deleteOrder(id) {
    const orders = getOrders().filter(o => o.id !== id);
    saveOrders(orders);
    renderOrders();
    showToast('Pesanan berhasil dihapus.');
}


/* ============================================================
   ── PANDUAN MIGRASI KE BACKEND (baca sebelum integrasi) ──
   ============================================================

   Ketika kamu siap menghubungkan ke Laravel backend, ganti
   hanya dua fungsi: getOrders() dan saveOrders().

   Contoh dengan Axios (pastikan sudah ada axios di project):

   // READ
   async function getOrders() {
       const res = await axios.get('/api/orders');
       return res.data;
   }

   // WRITE (CREATE / UPDATE)
   async function saveOrders(orders) {
       // Tidak dipakai lagi — simpan langsung dari submitBooking()
   }

   // CREATE
   async function submitBooking() {
       // ... validasi seperti sekarang ...
       if (editId) {
           await axios.put(`/api/orders/${editId}`, order);
       } else {
           await axios.post('/api/orders', order);
       }
       showToast('Berhasil!');
       goPage('orders');
   }

   // DELETE
   async function deleteOrder(id) {
       await axios.delete(`/api/orders/${id}`);
       renderOrders();
   }

   // CANCEL
   async function cancelOrder(id) {
       await axios.patch(`/api/orders/${id}/cancel`);
       renderOrders();
   }
   ============================================================ */
