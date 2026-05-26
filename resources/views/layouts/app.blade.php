{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MobiTravel')</title>

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@300;400;500&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

    {{-- CSS Utama MobiTravel (yang sudah ada) --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/mobitravel.css') }}"> --}}

    {{-- CSS halaman pencarian & pemesanan --}}
    <link rel="stylesheet" href="{{ asset('css/mobitravel-search.css') }}">

    @stack('styles')
</head>
<body>

    {{-- ===== NAVBAR ===== --}}
    <nav class="nav" id="mainNav">
        <div class="nav__logo">Mobi<span>Travel</span></div>
        <ul class="nav__links">
            <li><a href="{{ url('/') }}">Beranda</a></li>
            <li><a href="{{ url('/cari') }}" class="nav__cta">Cari Perjalanan</a></li>
            {{-- Tombol navigasi SPA (hanya tampil di halaman /cari) --}}
            @if(request()->is('cari'))
            <li>
                <button class="nav-btn active" onclick="goPage('search')">Cari</button>
            </li>
            <li>
                <button class="nav-btn" onclick="goPage('orders')">Pesanan Saya</button>
            </li>
            @else
            <li><a href="{{ route('login') }}" class="nav__cta">Login</a></li>
            @endif
        </ul>
    </nav>

    {{-- ===== KONTEN UTAMA ===== --}}
    <main style="padding-top: 70px"> {{-- sesuaikan padding dengan tinggi navbar --}}
        @yield('content')
    </main>

    {{-- ===== SCRIPT NAVBAR SCROLL ===== --}}
    <script>
        const nav = document.getElementById('mainNav');
        if (nav) {
            window.addEventListener('scroll', () => {
                nav.classList.toggle('scrolled', window.scrollY > 60);
            });
        }
    </script>

    @stack('scripts')
</body>
</html>
