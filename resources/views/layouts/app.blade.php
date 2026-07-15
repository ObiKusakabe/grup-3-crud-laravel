<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FitStock')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        (function() {
            if (localStorage.getItem('sidebarCollapsed') === 'true' && window.innerWidth > 768) {
                document.documentElement.classList.add('sidebar-collapsed');
            }
        })();
    </script>
</head>
<body>
    <!-- Mobile Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeMobileSidebar()"></div>

    <!-- Sidebar Navigation -->
    <div class="sidebar" id="sidebar" style="display: flex; flex-direction: column;">
        <div class="sidebar-brand">
            <span>POS <strong>FASHION</strong></span>
            <button class="sidebar-toggle" id="sidebarToggle" title="Toggle Sidebar" onclick="toggleSidebar()">
                <i data-lucide="panel-left-close" id="toggleIcon" style="width: 18px;"></i>
            </button>
        </div>
        <ul class="sidebar-menu" style="flex: 1; overflow-y: auto; overflow-x: hidden;">

            {{-- ANALITIK --}}
            <li class="nav-group-label"><span class="nav-label">Analitik</span></li>
            <li><a href="{{ route('dashboard.index') }}" class="{{ request()->routeIs('dashboard.*') ? 'active' : '' }}" data-label="Dashboard"><i data-lucide="layout-dashboard" style="width: 18px;"></i><span class="nav-label">Dashboard</span></a></li>

            {{-- INVENTARIS: Admin + Inventaris --}}
            @if(in_array(auth()->user()->role, ['admin', 'inventaris']))
                <li class="nav-group-label"><span class="nav-label">Inventaris</span></li>
                <li><a href="{{ route('barang.index') }}" class="{{ request()->routeIs('barang.*') ? 'active' : '' }}" data-label="Daftar Barang"><i data-lucide="package" style="width: 18px;"></i><span class="nav-label">Daftar Barang</span></a></li>
                <li><a href="{{ route('stock-management.index') }}" class="{{ request()->routeIs('stock-management.*') ? 'active' : '' }}" data-label="Manajemen Stok"><i data-lucide="inbox" style="width: 18px;"></i><span class="nav-label">Manajemen Stok</span></a></li>
                <li><a href="{{ route('kategori-barang.index') }}" class="{{ request()->routeIs('kategori-barang.*') ? 'active' : '' }}" data-label="Kategori"><i data-lucide="tag" style="width: 18px;"></i><span class="nav-label">Kategori</span></a></li>
                <li><a href="{{ route('supplier.index') }}" class="{{ request()->routeIs('supplier.*') ? 'active' : '' }}" data-label="Data Supplier"><i data-lucide="building-2" style="width: 18px;"></i><span class="nav-label">Data Supplier</span></a></li>
            @endif

            {{-- PENJUALAN: Admin + POS --}}
            @if(in_array(auth()->user()->role, ['admin', 'pos']))
                <li class="nav-group-label"><span class="nav-label">Penjualan</span></li>
                <li><a href="{{ route('transaksi.create') }}" class="{{ request()->routeIs('transaksi.create') ? 'active' : '' }}" data-label="POS / Kasir"><i data-lucide="shopping-cart" style="width: 18px;"></i><span class="nav-label">POS / Kasir</span></a></li>
                <li><a href="{{ route('transaksi.index') }}" class="{{ request()->routeIs('transaksi.index') || request()->routeIs('transaksi.show') || request()->routeIs('transaksi.edit') ? 'active' : '' }}" data-label="Riwayat Transaksi"><i data-lucide="clipboard-list" style="width: 18px;"></i><span class="nav-label">Riwayat Transaksi</span></a></li>
                <li><a href="{{ route('member.index') }}" class="{{ request()->routeIs('member.*') ? 'active' : '' }}" data-label="Member"><i data-lucide="users" style="width: 18px;"></i><span class="nav-label">Member</span></a></li>
            @endif

            {{-- MANAJEMEN: Admin saja --}}
            @if(auth()->user()->role === 'admin')
                <li class="nav-group-label"><span class="nav-label">Manajemen</span></li>
                <li><a href="{{ route('employees.index') }}" class="{{ request()->routeIs('employees.*') ? 'active' : '' }}" data-label="Kelola Akun"><i data-lucide="user-cog" style="width: 18px;"></i><span class="nav-label">Kelola Akun</span></a></li>
                <li><a href="{{ route('branches.index') }}" class="{{ request()->routeIs('branches.*') ? 'active' : '' }}" data-label="Kelola Cabang"><i data-lucide="store" style="width: 18px;"></i><span class="nav-label">Kelola Cabang</span></a></li>
            @endif

        </ul>
        
        <div class="account-menu" style="padding: 16px; border-top: 1px solid rgba(255,255,255,0.08);">
            <button type="button" class="account-trigger" onclick="toggleAccountMenu()" style="width: 100%; background: rgba(255,255,255,0.05); border: none; color: white; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span class="account-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}</span>
                    <span class="account-name" style="text-align: left; transition: opacity 0.2s; white-space: nowrap; color: white;">{{ auth()->user()->name ?? 'User' }}</span>
                </div>
                <i data-lucide="chevron-up" style="width: 16px; transition: opacity 0.2s; color: white;"></i>
            </button>

            <div class="account-dropdown" id="accountDropdown" style="bottom: 100%; top: auto; margin-bottom: 8px; left: 16px; width: calc(100% - 32px);">
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
    <!-- /Sidebar -->

    <div class="main-content" id="mainContent">
        <div class="top-bar">
            {{-- Hamburger: hanya tampil di mobile --}}
            <button class="mobile-menu-toggle" id="mobileMenuToggle" onclick="openMobileSidebar()" title="Buka Menu">
                <i data-lucide="menu" style="width: 20px;"></i>
            </button>

            <div class="branch-selector">
                <form action="{{ route('stock-management.set-branch') }}" method="POST">
                    @csrf
                    <label>Cabang:</label>
                    <select name="branch_id" class="form-select" style="width: auto; display: inline-block;" onchange="this.form.submit()">
                        @foreach(\App\Models\Branch::where('company_id', auth()->user()->company_id)->get() as $branch)
                            <option value="{{ $branch->id }}" {{ session('active_branch_id') == $branch->id ? 'selected' : '' }}>
                                {{ $branch->name }} ({{ $branch->code }})
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>



        @yield('content')
    </div>
    <!-- /Main Content -->

@stack('scripts')

<script>
    window.sessionSuccess = "{{ session('success') ?? '' }}";
    window.sessionError   = "{{ session('error') ?? '' }}";

    // ── Global Table Search ─────────────────────────────────
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('globalTableSearch');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const filter = this.value.toLowerCase();
                const rows = document.querySelectorAll('.table tbody tr');
                
                rows.forEach(row => {
                    if (row.querySelector('td[colspan]')) return; // Skip "No Data" row
                    const text = row.innerText.toLowerCase();
                    row.style.display = text.includes(filter) ? '' : 'none';
                });
            });
        }
    });

    // ── Desktop Sidebar Toggle ──────────────────────────────
    function toggleSidebar() {
        const isMobile = window.innerWidth <= 768;
        if (isMobile) {
            openMobileSidebar();
            return;
        }
        const html   = document.documentElement;
        const isOpen = !html.classList.contains('sidebar-collapsed');
        const icon   = document.getElementById('toggleIcon');

        if (isOpen) {
            html.classList.add('sidebar-collapsed');
            icon.setAttribute('data-lucide', 'panel-left-open');
            localStorage.setItem('sidebarCollapsed', 'true');
        } else {
            html.classList.remove('sidebar-collapsed');
            icon.setAttribute('data-lucide', 'panel-left-close');
            localStorage.setItem('sidebarCollapsed', 'false');
        }
        lucide.createIcons();
    }

    // ── Mobile Sidebar ──────────────────────────────────────
    function openMobileSidebar() {
        document.getElementById('sidebar').classList.add('mobile-open');
        document.getElementById('sidebarOverlay').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeMobileSidebar() {
        document.getElementById('sidebar').classList.remove('mobile-open');
        document.getElementById('sidebarOverlay').classList.remove('active');
        document.body.style.overflow = '';
    }

    // Close mobile sidebar when a nav link is clicked
    document.querySelectorAll('.sidebar-menu a').forEach(function(link) {
        link.addEventListener('click', function() {
            if (window.innerWidth <= 768) closeMobileSidebar();
        });
    });


    // ── Account Dropdown ───────────────────────────────────
    function toggleAccountMenu() {
        document.getElementById('accountDropdown').classList.toggle('open');
    }

    document.addEventListener('click', function (e) {
        const menu     = document.querySelector('.account-menu');
        const dropdown = document.getElementById('accountDropdown');
        if (menu && !menu.contains(e.target)) {
            dropdown.classList.remove('open');
        }
    });

    // Initialize Lucide icons
    lucide.createIcons();

    // Set correct toggle icon on first load (desktop)
    (function() {
        if (localStorage.getItem('sidebarCollapsed') === 'true') {
            const icon = document.getElementById('toggleIcon');
            if (icon) {
                icon.setAttribute('data-lucide', 'panel-left-open');
                lucide.createIcons();
            }
        }
    })();
</script>
</body>
</html>