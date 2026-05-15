@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title"><i data-lucide="tag" style="width: 24px; vertical-align: middle; margin-right: 8px;"></i> Detail Kategori</h1>
        <a href="{{ route('kategori-barang.index') }}" class="btn btn-primary"><i data-lucide="arrow-left" style="width: 18px; margin-right: 6px;"></i> Kembali</a>
    </div>

    <table class="table">
        <tr><th>Nama</th><td>{{ $kategoriBarang->nama }}</td></tr>
        <tr><th>Keterangan</th><td>{{ $kategoriBarang->keterangan ?: '-' }}</td></tr>
    </table>

    <div class="d-flex gap-2" style="margin: 0 25px 25px;">
        <a href="{{ route('kategori-barang.edit', $kategoriBarang) }}" class="btn btn-warning"><i data-lucide="edit" style="width: 18px; margin-right: 6px;"></i> Edit</a>
        <form action="{{ route('kategori-barang.destroy', $kategoriBarang) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i data-lucide="trash-2" style="width: 18px; margin-right: 6px;"></i> Hapus</button>
        </form>
    </div>
</div>
@endsection