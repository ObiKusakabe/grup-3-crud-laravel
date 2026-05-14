**File:** `resources/views/stok_masuk/show.blade.php`

```html
@extends('layouts.app')

@section('title', 'Detail Stok Masuk')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">📥 Detail Stok Masuk</h1>
        <a href="{{ route('stok-masuk.index') }}" class="btn btn-primary">← Kembali</a>
    </div>

    <table class="table">
        <tr><th>Tanggal</th><td>{{ $stokMasuk->tanggal_masuk }}</td></tr>
        <tr><th>Barang</th><td>{{ $stokMasuk->nama_barang }}</td></tr>
        <tr><th>Supplier</th><td>{{ $stokMasuk->nama_supplier }}</td></tr>
        <tr><th>Jumlah</th><td>{{ $stokMasuk->jumlah }}</td></tr>
        <tr><th>Harga Beli</th><td>Rp {{ number_format($stokMasuk->harga_beli, 0, ',', '.') }}</td></tr>
        <tr><th>Total</th><td>Rp {{ number_format($stokMasuk->jumlah * $stokMasuk->harga_beli, 0, ',', '.') }}</td></tr>
        <tr><th>Keterangan</th><td>{{ $stokMasuk->keterangan ?: '-' }}</td></tr>
    </table>

    <div class="d-flex gap-2">
        <a href="{{ route('stok-masuk.edit', $stokMasuk) }}" class="btn btn-warning">✏️ Edit</a>
        <form action="{{ route('stok-masuk.destroy', $stokMasuk) }}" method="POST" onsubmit="return confirm('Yakin? Stok berkurang!')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">🗑️ Hapus</button>
        </form>
    </div>
</div>
@endsection