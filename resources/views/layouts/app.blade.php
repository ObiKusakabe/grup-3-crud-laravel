<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'POS Fashion')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">POS FASHION</div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('barang.index') }}" class="{{ request()->routeIs('barang.*') ? 'active' : '' }}">📦 Barang</a></li>
            <li><a href="{{ route('stok-masuk.index') }}" class="{{ request()->routeIs('stok-masuk.*') ? 'active' : '' }}">📥 Stok Masuk</a></li>
            <li><a href="{{ route('transaksi.index') }}" class="{{ request()->routeIs('transaksi.*') ? 'active' : '' }}">🛒 Transaksi</a></li>
            <li><a href="{{ route('kategori-barang.index') }}" class="{{ request()->routeIs('kategori-barang.*') ? 'active' : '' }}">🏷️ Kategori</a></li>
            <li><a href="{{ route('ukuran.index') }}" class="{{ request()->routeIs('ukuran.*') ? 'active' : '' }}">📏 Ukuran</a></li>
            <li><a href="{{ route('warna.index') }}" class="{{ request()->routeIs('warna.*') ? 'active' : '' }}">🎨 Warna</a></li>
            <li><a href="{{ route('supplier.index') }}" class="{{ request()->routeIs('supplier.*') ? 'active' : '' }}">🏭 Supplier</a></li>
            <li><a href="{{ route('member.index') }}" class="{{ request()->routeIs('member.*') ? 'active' : '' }}">👤 Member</a></li>
            <li><a href="{{ route('detail-transaksi.index') }}" class="{{ request()->routeIs('detail-transaksi.*') ? 'active' : '' }}">📋 Detail Transaksi</a></li>
        </ul>
    </div>

    <div class="main-content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>