@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Detail Transaksi</h1>
        <p class="page-subtitle">Detail informasi transaksi #{{ $transaksi->kode_transaksi }}</p>
    </div>
    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary" style="display: inline-flex; align-items: center; gap: 8px;">
        <i data-lucide="arrow-left" style="width: 16px;"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title" style="display: inline-flex; align-items: center; gap: 8px;">
            <i data-lucide="receipt" style="width: 20px; color: var(--on-surface-variant);"></i>
            Nota Transaksi
        </h2>
        <div>
            @if($transaksi->status == 'Pending')
                <span class="badge badge-warning">{{ $transaksi->status }}</span>
            @elseif($transaksi->status == 'Selesai')
                <span class="badge badge-success">{{ $transaksi->status }}</span>
            @else
                <span class="badge badge-danger">{{ $transaksi->status }}</span>
            @endif
        </div>
    </div>

    <div class="card-body" style="padding: 24px;">
        <!-- Invoice Metadata Section -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 24px; margin-bottom: 32px; padding-bottom: 24px; border-bottom: 1px dashed var(--outline-variant);">
            <div>
                <p style="font-size: 11px; font-weight: 600; color: var(--on-surface-variant); text-transform: uppercase; margin-bottom: 6px; letter-spacing: 0.05em;">Kode Transaksi</p>
                <p style="font-family: var(--font-heading); font-size: 15px; font-weight: 700; color: var(--primary); margin: 0;">{{ $transaksi->kode_transaksi }}</p>
            </div>
            <div>
                <p style="font-size: 11px; font-weight: 600; color: var(--on-surface-variant); text-transform: uppercase; margin-bottom: 6px; letter-spacing: 0.05em;">Tanggal Transaksi</p>
                <p style="font-size: 14px; font-weight: 500; color: var(--on-surface); margin: 0;">{{ $transaksi->tanggal }}</p>
            </div>
            <div>
                <p style="font-size: 11px; font-weight: 600; color: var(--on-surface-variant); text-transform: uppercase; margin-bottom: 6px; letter-spacing: 0.05em;">Kasir</p>
                <p style="font-size: 14px; font-weight: 500; color: var(--on-surface); margin: 0;">{{ $transaksi->kasir }}</p>
            </div>
            <div>
                <p style="font-size: 11px; font-weight: 600; color: var(--on-surface-variant); text-transform: uppercase; margin-bottom: 6px; letter-spacing: 0.05em;">Pelanggan / Member</p>
                <p style="font-size: 14px; font-weight: 500; color: var(--on-surface); margin: 0;">{{ $transaksi->nama_member ?: '-' }}</p>
            </div>
        </div>

        <!-- Items Table -->
        <h3 style="font-family: var(--font-heading); font-size: 16px; font-weight: 600; margin-bottom: 16px; color: var(--on-surface);">Daftar Item</h3>
        <div class="table-responsive" style="margin-bottom: 32px; border: 1px solid var(--outline-variant); border-radius: 8px; overflow: hidden;">
            <table class="table table-hover" style="margin-bottom: 0;">
                <thead>
                    <tr>
                        <th style="padding: 12px 16px;">Barang</th>
                        <th style="text-align: center; padding: 12px 16px; width: 100px;">Jumlah</th>
                        <th style="text-align: right; padding: 12px 16px; width: 150px;">Harga Satuan</th>
                        <th style="text-align: right; padding: 12px 16px; width: 150px;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($details as $d)
                    <tr>
                        <td style="padding: 12px 16px; font-weight: 500; color: var(--on-surface);">{{ $d->nama_barang }}</td>
                        <td style="text-align: center; padding: 12px 16px; color: var(--on-surface-variant);">{{ $d->jumlah }}</td>
                        <td style="text-align: right; padding: 12px 16px; color: var(--on-surface-variant);">Rp {{ number_format($d->harga_satuan, 0, ',', '.') }}</td>
                        <td style="text-align: right; padding: 12px 16px; font-weight: 600; color: var(--on-surface);">Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Summary & Actions Section -->
        <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; gap: 24px;">
            <!-- Left Side Actions -->
            <div style="display: flex; gap: 12px; align-items: center;">
            </div>

            <!-- Right Side Financial Summary -->
            <div style="width: 100%; max-width: 340px; background: var(--surface-container-low); padding: 20px; border-radius: 10px; border: 1px solid var(--outline-variant);">
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 13px; color: var(--on-surface-variant);">
                    <span>Total Belanja</span>
                    <span style="font-weight: 500; color: var(--on-surface);">Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 13px; color: var(--on-surface-variant);">
                    <span>Diskon</span>
                    <span style="font-weight: 600; color: var(--error);">Rp {{ number_format($transaksi->diskon, 0, ',', '.') }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; padding-top: 12px; border-top: 1px solid var(--outline-variant); margin-bottom: 12px;">
                    <span style="font-weight: 700; color: var(--on-surface);">Total Akhir</span>
                    <span style="font-family: var(--font-heading); font-size: 18px; font-weight: 800; color: var(--primary);">Rp {{ number_format($transaksi->total_akhir, 0, ',', '.') }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 13px; color: var(--on-surface-variant);">
                    <span>Tunai</span>
                    <span style="font-weight: 500; color: var(--on-surface);">Rp {{ number_format($transaksi->tunai, 0, ',', '.') }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; padding-top: 10px; border-top: 1px dashed var(--outline-variant); font-size: 13px;">
                    <span style="font-weight: 700; color: var(--on-surface-variant);">Kembalian</span>
                    <span style="font-weight: 800; color: #10b981; font-size: 16px;">Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection