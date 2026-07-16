@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-page">

    {{-- ── Page Header ── --}}
    <div class="dashboard-header">
        <div>
            <p class="page-label">Overview</p>
            <h1 class="page-title">Dashboard</h1>
            <p class="page-subtitle">Ringkasan bisnis dan analitik toko Anda hari ini</p>
        </div>
    </div>

    {{-- ── Stat Cards ── --}}
    <div class="stats-grid">
        <div class="dashboard-stat-card">
            <div>
                <p class="metric-label">Penjualan Hari Ini</p>
                <h2 class="metric-value">Rp {{ number_format($penjualanHariIni, 0, ',', '.') }}</h2>
                <p class="metric-note">{{ $transaksiHariIni }} transaksi hari ini</p>
            </div>
            <div class="metric-icon metric-icon--success">
                <i data-lucide="trending-up"></i>
            </div>
        </div>

        <div class="dashboard-stat-card">
            <div>
                <p class="metric-label">Transaksi Hari Ini</p>
                <h2 class="metric-value">{{ $transaksiHariIni }}</h2>
                <p class="metric-note">Transaksi berhasil</p>
            </div>
            <div class="metric-icon metric-icon--info">
                <i data-lucide="shopping-cart"></i>
            </div>
        </div>

        <div class="dashboard-stat-card">
            <div>
                <p class="metric-label">Total Produk</p>
                <h2 class="metric-value">{{ $totalProduk }}</h2>
                <p class="metric-note">Produk tersedia di katalog</p>
            </div>
            <div class="metric-icon metric-icon--neutral">
                <i data-lucide="box"></i>
            </div>
        </div>

        <div class="dashboard-stat-card">
            <div>
                <p class="metric-label">Stok Rendah</p>
                <h2 class="metric-value">{{ $stokRendah }}</h2>
                <p class="metric-note">
                    @if($activeBranchId) Produk ≤ batas minimum @else Pilih cabang untuk cek stok @endif
                </p>
            </div>
            <div class="metric-icon metric-icon--warning">
                <i data-lucide="alert-circle"></i>
            </div>
        </div>
    </div>

    {{-- ── Charts Row 1: Line + Doughnut ── --}}
    <div class="chart-row">

        {{-- Line chart: penjualan 7 hari --}}
        <div class="card chart-card chart-card--wide">
            <div class="card-header">
                <h2 class="card-title">Penjualan 7 Hari Terakhir</h2>
                <span class="badge badge-dark">
                    Rp {{ number_format($penjualan7Hari, 0, ',', '.') }} total
                </span>
            </div>
            <div class="card-body chart-body">
                <canvas id="chartSales"></canvas>
            </div>
        </div>

        {{-- Doughnut chart: stok per kategori --}}
        <div class="card chart-card chart-card--narrow">
            <div class="card-header">
                <h2 class="card-title">Produk per Kategori</h2>
            </div>
            <div class="card-body chart-body chart-body--donut">
                <div class="donut-wrap">
                    <canvas id="chartKategori"></canvas>
                </div>
                <ul class="donut-legend" id="donutLegend"></ul>
            </div>
        </div>

    </div>

    {{-- ── Charts Row 2: Bar + Table ── --}}
    <div class="chart-row">

        {{-- Bar chart: top 5 produk terlaris 30 hari --}}
        <div class="card chart-card chart-card--narrow">
            <div class="card-header">
                <h2 class="card-title">Produk Terlaris</h2>
                <span class="badge badge-dark">30 hari terakhir</span>
            </div>
            <div class="card-body chart-body">
                <canvas id="chartTopProduk"></canvas>
            </div>
        </div>

        {{-- Recent transactions table --}}
        <div class="card chart-card chart-card--wide">
            <div class="card-header">
                <h2 class="card-title">Transaksi Terbaru</h2>
                <a href="{{ route('transaksi.index') }}" class="btn btn-sm" style="font-size:12px;padding:5px 12px;">Lihat semua</a>
            </div>
            <div class="card-body" style="padding:0;">
                @if($transaksiTerbaru->isEmpty())
                    <p style="padding:24px;color:var(--on-surface-variant);font-size:13px;">Belum ada transaksi.</p>
                @else
                    <table class="table dashboard-table" style="margin:0;">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Tanggal</th>
                                <th>Kasir</th>
                                <th style="text-align:right;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksiTerbaru as $item)
                                <tr>
                                    <td>
                                        <a href="{{ route('transaksi.show', $item) }}" style="color:var(--primary-container);font-weight:600;">
                                            {{ $item->kode_transaksi }}
                                        </a>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</td>
                                    <td>{{ $item->kasir }}</td>
                                    <td style="text-align:right;font-weight:600;">Rp {{ number_format($item->total_akhir, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>
(function () {
    // ── Design tokens ───────────────────────────────────────
    const navy   = '#131b2e';
    const accent = '#2563eb';
    const muted  = '#bec6e0';
    const gray   = '#e5e7eb';

    // Shared chart defaults
    Chart.defaults.font.family = "'Inter', 'Hanken Grotesk', sans-serif";
    Chart.defaults.font.size   = 12;
    Chart.defaults.color       = '#6b7280';

    // ── Chart 1: Sales Line ──────────────────────────────────
    const salesLabels = @json($dailyLabels);
    const salesData   = @json($dailySales);

    new Chart(document.getElementById('chartSales'), {
        type: 'line',
        data: {
            labels: salesLabels,
            datasets: [{
                label: 'Penjualan (Rp)',
                data: salesData,
                borderColor: navy,
                backgroundColor: 'rgba(19,27,46,0.08)',
                borderWidth: 2.5,
                pointBackgroundColor: navy,
                pointRadius: 4,
                pointHoverRadius: 6,
                tension: 0.4,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => ' Rp ' + ctx.parsed.y.toLocaleString('id-ID')
                    }
                }
            },
            scales: {
                x: {
                    grid: { color: 'rgba(0,0,0,0.04)' },
                    border: { display: false },
                },
                y: {
                    grid: { color: 'rgba(0,0,0,0.04)' },
                    border: { display: false },
                    ticks: {
                        callback: v => 'Rp ' + (v >= 1000000
                            ? (v/1000000).toFixed(1)+'jt'
                            : (v/1000).toFixed(0)+'rb')
                    }
                }
            }
        }
    });

    // ── Chart 2: Category Doughnut ───────────────────────────
    const katLabels = @json($kategoriLabels);
    const katData   = @json($kategoriStock);

    const palette = [
        '#131b2e','#2563eb','#64748b','#bec6e0',
        '#1e3a5f','#93c5fd','#475569','#dbeafe',
    ];

    const donutChart = new Chart(document.getElementById('chartKategori'), {
        type: 'doughnut',
        data: {
            labels: katLabels,
            datasets: [{
                data: katData,
                backgroundColor: palette.slice(0, katLabels.length),
                borderWidth: 2,
                borderColor: '#fff',
                hoverOffset: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => ' ' + ctx.label + ': ' + ctx.parsed + ' produk'
                    }
                }
            }
        }
    });

    // Build custom legend
    const legend = document.getElementById('donutLegend');
    katLabels.forEach((lbl, i) => {
        const li = document.createElement('li');
        li.style.cssText = 'display:flex;align-items:center;gap:7px;font-size:12px;margin-bottom:6px;';
        li.innerHTML = `<span style="width:10px;height:10px;border-radius:3px;background:${palette[i]};flex-shrink:0;"></span>
                        <span style="flex:1;color:var(--on-surface);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">${lbl}</span>
                        <strong style="color:var(--on-surface);font-size:12px;">${katData[i]}</strong>`;
        legend.appendChild(li);
    });

    // ── Chart 3: Top Products Bar ────────────────────────────
    const topLabels = @json($topProdukLabels);
    const topQty    = @json($topProdukQty);

    if (topLabels.length > 0) {
        new Chart(document.getElementById('chartTopProduk'), {
            type: 'bar',
            data: {
                labels: topLabels,
                datasets: [{
                    label: 'Qty Terjual',
                    data: topQty,
                    backgroundColor: [
                        'rgba(19,27,46,0.85)',
                        'rgba(37,99,235,0.80)',
                        'rgba(100,116,139,0.75)',
                        'rgba(190,198,224,0.90)',
                        'rgba(30,58,95,0.75)',
                    ],
                    borderRadius: 6,
                    borderSkipped: false,
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => ' ' + ctx.parsed.x + ' terjual'
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { color: 'rgba(0,0,0,0.04)' },
                        border: { display: false },
                        ticks: { stepSize: 1 }
                    },
                    y: {
                        grid: { display: false },
                        border: { display: false },
                        ticks: {
                            font: { size: 11 },
                            callback: function(val) {
                                const lbl = this.getLabelForValue(val);
                                return lbl.length > 18 ? lbl.substring(0, 18) + '…' : lbl;
                            }
                        }
                    }
                }
            }
        });
    } else {
        document.getElementById('chartTopProduk').closest('.chart-body').innerHTML =
            '<p style="color:var(--on-surface-variant);font-size:13px;padding:24px 0;">Belum ada data penjualan 30 hari terakhir.</p>';
    }

})();
</script>
@endpush
