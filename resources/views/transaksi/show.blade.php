@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">🛒 Detail Transaksi</h1>
        <a href="{{ route('transaksi.index') }}" class="btn btn-primary">← Kembali</a>
    </div>

    <div style="border:2px dashed #ccc;padding:20px;text-align:center;margin-bottom:20px">
        <h2>NOTA</h2>
        <p><strong>{{ $transaksi->kode_transaksi }}</strong></p>
        <p>{{ $transaksi->tanggal }}</p>
    </div>

    <table class="table">
        <tr><th>Kasir</th><td>{{ $transaksi->kasir }}</td></tr>
        <tr><th>Member</th><td>{{ $transaksi->nama_member ?: '-' }}</td></tr>
        <tr><th>Status</th><td>{{ $transaksi->status }}</td></tr>
    </table>

    <h3>Item</h3>
    <table class="table">
        <thead>
            <tr><th>Barang</th><th>Ukuran</th><th>Warna</th><th>Jumlah</th><th>Harga</th><th>Subtotal</th></tr>
        </thead>
        <tbody>
            @foreach($details as $d)
            <tr>
                <td>{{ $d->nama_barang }}</td>
                <td>{{ $d->ukuran }}</td>
                <td>{{ $d->warna }}</td>
                <td>{{ $d->jumlah }}</td>
                <td>Rp {{ number_format($d->harga_satuan, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="text-align:right;font-size:1.1rem">
        <p>Total: Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</p>
        <p>Diskon: Rp {{ number_format($transaksi->diskon, 0, ',', '.') }}</p>
        <p style="font-size:1.5rem;color:#e74c3c">Total Akhir: Rp {{ number_format($transaksi->total_akhir, 0, ',', '.') }}</p>
        <p>Tunai: Rp {{ number_format($transaksi->tunai, 0, ',', '.') }}</p>
        <p style="color:#2ecc71">Kembalian: Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}</p>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('transaksi.edit', $transaksi) }}" class="btn btn-warning">✏️ Edit Status</a>
        <form action="{{ route('transaksi.destroy', $transaksi) }}" method="POST" onsubmit="return confirm('Yakin? Stok kembali!')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">🗑️ Hapus</button>
        </form>
    </div>
</div>
@endsection