@extends('layouts.app')

@section('title', 'Detail Barang')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">📦 Detail Barang</h1>
        <a href="{{ route('barang.index') }}" class="btn btn-primary">← Kembali</a>
    </div>

    @if($barang->foto)
        <img src="{{ asset('storage/' . $barang->foto) }}" width="200" style="border-radius:8px; margin-bottom:20px">
    @endif

    <table class="table">
        <tr><th>Kode</th><td>{{ $barang->kode_barang }}</td></tr>
        <tr><th>Nama</th><td>{{ $barang->nama }}</td></tr>
        <tr><th>Kategori</th><td>{{ $barang->kategori }}</td></tr>
        <tr><th>Ukuran</th><td>{{ $barang->ukuran }}</td></tr>
        <tr><th>Warna</th><td>{{ $barang->warna }}</td></tr>
        <tr><th>Harga Beli</th><td>Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}</td></tr>
        <tr><th>Harga Jual</th><td>Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td></tr>
        <tr><th>Stok</th><td>{{ $barang->stok }}</td></tr>
    </table>

    <div class="d-flex gap-2">
        <a href="{{ route('barang.edit', $barang) }}" class="btn btn-warning">✏️ Edit</a>
        <form action="{{ route('barang.destroy', $barang) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">🗑️ Hapus</button>
        </form>
    </div>
</div>
@endsection