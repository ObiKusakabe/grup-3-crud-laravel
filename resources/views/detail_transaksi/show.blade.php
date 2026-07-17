@extends('layouts.app')

@section('title', 'Detail Item')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title"><i data-lucide="clipboard-list" style="width: 24px; vertical-align: middle; margin-right: 8px;"></i> Detail Item</h1>
        <a href="{{ route('detail-transaksi.index') }}" class="btn btn-primary"><i data-lucide="arrow-left" style="width: 18px; margin-right: 6px;"></i> Kembali</a>
    </div>

    <table class="table">
        <tr><th>Kode Transaksi</th><td>{{ $detailTransaksi->kode_transaksi }}</td></tr>
        <tr><th>Barang</th><td>{{ $detailTransaksi->nama_barang }}</td></tr>
        <tr><th>Jumlah</th><td>{{ $detailTransaksi->jumlah }}</td></tr>
        <tr><th>Harga</th><td>Rp {{ number_format($detailTransaksi->harga_satuan, 0, ',', '.') }}</td></tr>
        <tr><th>Subtotal</th><td>Rp {{ number_format($detailTransaksi->subtotal, 0, ',', '.') }}</td></tr>
        <tr><th>Jenis</th><td>{{ $detailTransaksi->jenis }}</td></tr>
        <tr><th>Alasan Retur</th><td>{{ $detailTransaksi->alasan_retur ?: '-' }}</td></tr>
    </table>

    <div class="d-flex gap-2" style="margin: 0 25px 25px;">
        <a href="{{ route('detail-transaksi.edit', $detailTransaksi) }}" class="btn btn-warning"><i data-lucide="edit" style="width: 18px; margin-right: 6px;"></i> Edit</a>
    </div>
</div>
@endsection