@extends('layouts.app')
@section('title', 'Detail Transaksi')
@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Detail Transaksi</h2>
        <a href="{{ route('detail-transaksi.index') }}" class="btn btn-warning">Kembali</a>
    </div>
    <p><strong>Kode Transaksi:</strong> {{ $detailTransaksi->kode_transaksi }}</p>
    <p><strong>Nama Barang:</strong> {{ $detailTransaksi->nama_barang }}</p>
    <p><strong>Ukuran:</strong> {{ $detailTransaksi->ukuran }}</p>
    <p><strong>Warna:</strong> {{ $detailTransaksi->warna }}</p>
    <p><strong>Jumlah:</strong> {{ $detailTransaksi->jumlah }}</p>
    <p><strong>Harga Satuan:</strong> Rp {{ number_format($detailTransaksi->harga_satuan,0,',','.') }}</p>
    <p><strong>Subtotal:</strong> Rp {{ number_format($detailTransaksi->subtotal,0,',','.') }}</p>
    <p><strong>Jenis:</strong> {{ $detailTransaksi->jenis }}</p>
    <p><strong>Alasan Retur:</strong> {{ $detailTransaksi->alasan_retur ?? '-' }}</p>
</div>
@endsection