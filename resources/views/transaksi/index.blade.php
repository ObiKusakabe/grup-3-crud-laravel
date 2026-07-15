@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Riwayat Transaksi</h1>
        <p class="page-subtitle">Lihat seluruh riwayat transaksi penjualan</p>
    </div>
    <a href="{{ route('transaksi.create') }}" class="btn btn-dark">
        <i data-lucide="plus" style="width: 16px;"></i> Transaksi Baru
    </a>
</div>

<div class="card">
    <div style="padding: 16px;">
        <div style="position: relative; max-width: 320px;">
            <i data-lucide="search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 16px; color: #adb5bd;"></i>
            <input type="text" id="globalTableSearch" class="form-control" placeholder="Cari data..." style="padding-left: 36px;">
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>KODE</th>
                    <th>TANGGAL</th>
                    <th>KASIR</th>
                    <th>TOTAL</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi as $item)
                <tr>
                    <td><strong>{{ $item->kode_transaksi }}</strong></td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</td>
                    <td>{{ $item->kasir }}</td>
                    <td>Rp {{ number_format($item->total_akhir, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('transaksi.show', $item) }}" class="btn btn-sm btn-dark" title="Lihat Detail">
                            <i data-lucide="eye" style="width: 16px;"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center" style="padding: 32px; color: var(--outline);">
                        <i data-lucide="inbox" style="width: 40px; margin-bottom: 12px; display: block; margin-left: auto; margin-right: auto;"></i>
                        Belum ada transaksi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection