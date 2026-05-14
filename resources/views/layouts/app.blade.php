<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'POS Fashion')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">POS FASHION</div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('supplier.index') }}">🏭 Supplier</a></li>
            <li><a href="{{ route('member.index') }}">👤 Member</a></li>
            <li><a href="{{ route('detail-transaksi.index') }}">📋 Detail Transaksi</a></li>
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
</body>
</html>