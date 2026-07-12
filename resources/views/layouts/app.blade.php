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
            <li><a href="{{ route('dashboard.index') }}" class="{{ request()->routeIs('dashboard.*') ? 'active' : '' }}"><i data-lucide="package" style="width: 18px; margin-right: 8px;"></i> Dashboard</a></li>
            <li><a href="{{ route('barang.index') }}" class="{{ request()->routeIs('barang.*') ? 'active' : '' }}"><i data-lucide="package" style="width: 18px; margin-right: 8px;"></i> Barang</a></li>
            <li><a href="{{ route('stock-management.index') }}" class="{{ request()->routeIs('stock-management.*') ? 'active' : '' }}"><i data-lucide="inbox" style="width: 18px; margin-right: 8px;"></i> Manajemen Stok</a></li>
            <li><a href="{{ route('transaksi.index') }}" class="{{ request()->routeIs('transaksi.*') ? 'active' : '' }}"><i data-lucide="shopping-cart" style="width: 18px; margin-right: 8px;"></i> Transaksi</a></li>
            <li><a href="{{ route('kategori-barang.index') }}" class="{{ request()->routeIs('kategori-barang.*') ? 'active' : '' }}"><i data-lucide="tag" style="width: 18px; margin-right: 8px;"></i> Kategori</a></li>
            <li><a href="{{ route('supplier.index') }}" class="{{ request()->routeIs('supplier.*') ? 'active' : '' }}"><i data-lucide="building-2" style="width: 18px; margin-right: 8px;"></i> Supplier</a></li>
            <li><a href="{{ route('member.index') }}" class="{{ request()->routeIs('member.*') ? 'active' : '' }}"><i data-lucide="users" style="width: 18px; margin-right: 8px;"></i> Member</a></li>
            <li><a href="{{ route('detail-transaksi.index') }}" class="{{ request()->routeIs('detail-transaksi.*') ? 'active' : '' }}"><i data-lucide="clipboard-list" style="width: 18px; margin-right: 8px;"></i> Detail Transaksi</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <div class="branch-selector">
                <form action="{{ route('stock-management.set-branch') }}" method="POST">
                    @csrf
                    <label>Cabang:</label>
                    <select name="branch_id" class="form-select" style="width: auto; display: inline-block;" onchange="this.form.submit()">
                        @foreach(\App\Models\Branch::all() as $branch)
                            <option value="{{ $branch->id }}" {{ session('active_branch_id', 1) == $branch->id ? 'selected' : '' }}>
                                {{ $branch->name }} ({{ $branch->code }})
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <div class="account-menu">
                <button type="button" class="account-trigger" onclick="toggleAccountMenu()">
                    <span class="account-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}</span>
                    <span class="account-name">{{ auth()->user()->name ?? 'User' }}</span>
                    <i data-lucide="chevron-down" style="width: 16px;"></i>
                </button>

                <div class="account-dropdown" id="accountDropdown">
                    <div class="account-dropdown-header">
                        <p class="account-dropdown-name">{{ auth()->user()->name ?? 'User' }}</p>
                        <p class="account-dropdown-email">{{ auth()->user()->email ?? '' }}</p>
                    </div>
                    <form method="POST" action="{{ url('/logout') }}">
                        @csrf
                        <button type="submit" class="account-dropdown-logout">
                            <i data-lucide="log-out" style="width: 16px; margin-right: 8px;"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @yield('content')
    </div>
@stack('scripts')

<script>
    // Pass session data ke JavaScript
    window.sessionSuccess = "{{ session('success') ?? '' }}";
    window.sessionError = "{{ session('error') ?? '' }}";

    function toggleAccountMenu() {
        document.getElementById('accountDropdown').classList.toggle('open');
    }

    // Tutup dropdown kalau klik di luar area
    document.addEventListener('click', function (e) {
        const menu = document.querySelector('.account-menu');
        const dropdown = document.getElementById('accountDropdown');
        if (menu && !menu.contains(e.target)) {
            dropdown.classList.remove('open');
        }
    });

    // Initialize Lucide icons
    lucide.createIcons();
</script>
</body>
</html>