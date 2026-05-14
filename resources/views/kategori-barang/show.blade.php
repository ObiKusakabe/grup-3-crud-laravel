@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">🏷️ Detail Kategori</h1>
        <a href="{{ route('kategori-barang.index') }}" class="btn btn-primary">← Kembali</a>
    </div>

    <table class="table">
        <tr><th>Nama</th><td>{{ $kategoriBarang->nama }}</td></tr>
        <tr><th>Keterangan</th><td>{{ $kategoriBarang->keterangan ?: '-' }}</td></tr>
    </table>

    <div class="d-flex gap-2">
        <a href="{{ route('kategori-barang.edit', $kategoriBarang) }}" class="btn btn-warning">✏️ Edit</a>
        <form action="{{ route('kategori-barang.destroy', $kategoriBarang) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">🗑️ Hapus</button>
        </form>
    </div>
</div>
@endsection