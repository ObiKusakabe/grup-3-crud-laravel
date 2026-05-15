**File:** `resources/views/stok_masuk/show.blade.php`

```html
@extends('layouts.app')

@section('title', 'Detail Stok Masuk')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title"><i data-lucide="inbox" style="width: 24px; vertical-align: middle; margin-right: 8px;"></i> Detail Stok Masuk</h1>
        <a href="{{ route('stok-masuk.index') }}" class="btn btn-primary"><i data-lucide="arrow-left" style="width: 18px; margin-right: 6px;"></i> Kembali</a>
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

    <div class="d-flex gap-2" style="margin: 0 25px 25px;">
        <a href="{{ route('stok-masuk.edit', $stokMasuk) }}" class="btn btn-warning"><i data-lucide="edit" style="width: 18px; margin-right: 6px;"></i> Edit</a>
        <form action="{{ route('stok-masuk.destroy', $stokMasuk) }}" method="POST" onsubmit="return confirm('Yakin? Stok berkurang!')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i data-lucide="trash-2" style="width: 18px; margin-right: 6px;"></i> Hapus</button>
        </form>
    </div>
</div>
@endsection