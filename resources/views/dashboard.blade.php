@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="dashboard-page">
        <div class="dashboard-header">
            <div>
                <h1 class="page-title">Dashboard</h1>
                <p class="page-subtitle">Ringkasan bisnis dan analitik toko Anda</p>
            </div>
            <!-- <div class="dashboard-actions">
                <a href="{{ route('transaksi.create') }}" class="btn btn-dark">+ Transaksi Baru</a>
            </div> -->
        </div>

        <div class="stats-grid">
            <div class="dashboard-stat-card">
                <div>
                    <p class="metric-label">Penjualan Hari Ini</p>
                    <h2 class="metric-value">Rp {{ number_format($penjualanHariIni, 0, ',', '.') }}</h2>
                    <p class="metric-note">{{ $transaksiHariIni }} transaksi hari ini</p>
                </div>
                <div class="metric-icon metric-icon--success">
                    <i data-lucide="dollar-sign"></i>
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
                    <p class="metric-note">Jumlah produk tersedia</p>
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
                        @if($activeBranchId)
                            Produk stok ≤ batas minimum
                        @else
                            Pilih cabang untuk cek stok
                        @endif
                    </p>
                </div>
                <div class="metric-icon metric-icon--warning">
                    <i data-lucide="alert-circle"></i>
                </div>
            </div>
        </div>

        <div class="dashboard-layout">
            <div class="card summary-card">
                <div class="card-header">
                    <h2 class="card-title">Total Penjualan</h2>
                    <span class="badge badge-dark">7 hari terakhir</span>
                </div>
                <div class="card-body">
                    @php
                        $penjualan7Hari = \App\Models\Transaksi::whereDate('tanggal', '>=', \Carbon\Carbon::today()->subDays(6))
                            ->where('company_id', auth()->user()->company_id)
                            ->sum('total_akhir');
                        $transaksi7Hari = \App\Models\Transaksi::whereDate('tanggal', '>=', \Carbon\Carbon::today()->subDays(6))
                            ->where('company_id', auth()->user()->company_id)
                            ->count();
                    @endphp

                    <p class="dashboard-summary-text">
                        Pantau performa penjualan toko Anda dengan cepat. 
                        7 hari terakhir: <strong>Rp {{ number_format($penjualan7Hari, 0, ',', '.') }}</strong> 
                        dari <strong>{{ $transaksi7Hari }}</strong> transaksi.
                    </p>

                    <div class="dashboard-summary-values">
                        <div>
                            <p class="metric-label">Penjualan Hari Ini</p>
                            <h3 class="metric-value">Rp {{ number_format($penjualanHariIni, 0, ',', '.') }}</h3>
                        </div>
                        <div>
                            <p class="metric-label">Transaksi Hari Ini</p>
                            <h3 class="metric-value">{{ $transaksiHariIni }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card transactions-card">
                <div class="card-header">
                    <h2 class="card-title">Transaksi Terbaru</h2>
                </div>
                <div class="card-body">
                    @if($transaksiTerbaru->isEmpty())
                        <p class="dashboard-summary-text">Belum ada transaksi.</p>
                    @else
                        <table class="table dashboard-table">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Tanggal</th>
                                    <th>Kasir</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaksiTerbaru as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ route('transaksi.show', $item) }}">
                                                {{ $item->kode_transaksi }}
                                            </a>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</td>
                                        <td>{{ $item->kasir }}</td>
                                        <td>Rp {{ number_format($item->total_akhir, 0, ',', '.') }}</td>
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