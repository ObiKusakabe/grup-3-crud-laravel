@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="dashboard-page">
        <div class="dashboard-header">
            <div>
                <p class="page-label">Dashboard</p>
                <h1 class="page-title">Ringkasan bisnis dan analitik toko Anda</h1>
            </div>

            <div class="dashboard-actions">
                <div class="form-group short">
                    <label class="form-label" for="branch">Cabang</label>
                    <select id="branch" class="form-select">
                        <option>Cabang Batujajar</option>
                    </select>
                </div>
                <a href="{{ route('transaksi.create') }}" class="btn btn-primary">+ Quick Create</a>
            </div>
        </div>

        <div class="stats-grid">
            <div class="dashboard-stat-card">
                <div>
                    <p class="metric-label">Penjualan Hari Ini</p>
                    <h2 class="metric-value">Rp {{ number_format($penjualanHariIni, 0, ',', '.') }}</h2>
                    <p class="metric-note">Total penjualan selesai hari ini</p>
                </div>
                <div class="metric-icon">
                    <i data-lucide="dollar-sign"></i>
                </div>
            </div>

            <div class="dashboard-stat-card">
                <div>
                    <p class="metric-label">Transaksi Hari Ini</p>
                    <h2 class="metric-value">{{ $transaksiHariIni }}</h2>
                    <p class="metric-note">Transaksi berhasil hari ini</p>
                </div>
                <div class="metric-icon">
                    <i data-lucide="shopping-cart"></i>
                </div>
            </div>

            <div class="dashboard-stat-card">
                <div>
                    <p class="metric-label">Total Produk</p>
                    <h2 class="metric-value">{{ $totalProduk }}</h2>
                    <p class="metric-note">Jumlah produk tersedia</p>
                </div>
                <div class="metric-icon">
                    <i data-lucide="box"></i>
                </div>
            </div>

            <div class="dashboard-stat-card">
                <div>
                    <p class="metric-label">Stok Rendah</p>
                    <h2 class="metric-value">{{ $stokRendah }}</h2>
                    <p class="metric-note">Produk dengan stok 5 atau kurang</p>
                </div>
                <div class="metric-icon">
                    <i data-lucide="alert-circle"></i>
                </div>
            </div>
        </div>

        <div class="dashboard-layout">
            <div class="card summary-card">
                <div class="card-header">
                    <h2 class="card-title">Total Penjualan</h2>
                    <span class="badge badge-info">7 hari terakhir</span>
                </div>
                <div class="card-body">
                    <p class="dashboard-summary-text">
                        Pantau performa penjualan toko Anda dengan cepat. Ringkasan ini membantu Anda melihat tren transaksi dan stok secara instan.
                    </p>
                    <div class="dashboard-summary-values">
                        <div>
                            <p class="metric-label">Penjualan Hari Ini</p>
                            <h3 class="metric-value">Rp {{ number_format($penjualanHariIni, 0, ',', '.') }}</h3>
                        </div>
                        <div>
                            <p class="metric-label">Transaksi Selesai</p>
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
                        <p class="dashboard-summary-text">Belum ada transaksi hari ini.</p>
                    @else
                        <table class="table dashboard-table">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Tanggal</th>
                                    <th>Kasir</th>
                                    <th>Total Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaksiTerbaru as $item)
                                    <tr>
                                        <td>{{ $item->kode_transaksi }}</td>
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