<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'POS Fashion')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">POS <span>FASHION</span></div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('barang.index') }}" class="{{ request()->routeIs('barang.*') ? 'active' : '' }}"><i data-lucide="package" style="width: 18px; margin-right: 8px;"></i> Barang</a></li>
            <li><a href="{{ route('stok-masuk.index') }}" class="{{ request()->routeIs('stok-masuk.*') ? 'active' : '' }}"><i data-lucide="inbox" style="width: 18px; margin-right: 8px;"></i> Stok Masuk</a></li>
            <li><a href="{{ route('transaksi.index') }}" class="{{ request()->routeIs('transaksi.*') ? 'active' : '' }}"><i data-lucide="shopping-cart" style="width: 18px; margin-right: 8px;"></i> Transaksi</a></li>
            <li><a href="{{ route('kategori-barang.index') }}" class="{{ request()->routeIs('kategori-barang.*') ? 'active' : '' }}"><i data-lucide="tag" style="width: 18px; margin-right: 8px;"></i> Kategori</a></li>
            <li><a href="{{ route('ukuran.index') }}" class="{{ request()->routeIs('ukuran.*') ? 'active' : '' }}"><i data-lucide="ruler" style="width: 18px; margin-right: 8px;"></i> Ukuran</a></li>
            <li><a href="{{ route('warna.index') }}" class="{{ request()->routeIs('warna.*') ? 'active' : '' }}"><i data-lucide="palette" style="width: 18px; margin-right: 8px;"></i> Warna</a></li>
            <li><a href="{{ route('supplier.index') }}" class="{{ request()->routeIs('supplier.*') ? 'active' : '' }}"><i data-lucide="building-2" style="width: 18px; margin-right: 8px;"></i> Supplier</a></li>
            <li><a href="{{ route('member.index') }}" class="{{ request()->routeIs('member.*') ? 'active' : '' }}"><i data-lucide="users" style="width: 18px; margin-right: 8px;"></i> Member</a></li>
            <li><a href="{{ route('detail-transaksi.index') }}" class="{{ request()->routeIs('detail-transaksi.*') ? 'active' : '' }}"><i data-lucide="clipboard-list" style="width: 18px; margin-right: 8px;"></i> Detail Transaksi</a></li>
        </ul>
    </div>

    <div class="main-content">
        @yield('content')
    </div>
@stack('scripts')

<script>
    // Pass session data to JavaScript
    window.sessionSuccess = "{{ session('success') ?? '' }}";
    window.sessionError = "{{ session('error') ?? '' }}";

    // Initialize Lucide icons
    lucide.createIcons();
</script>
</body>
</html>