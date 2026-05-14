@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">🏷️ Edit Kategori</h1>
        <a href="{{ route('kategori-barang.index') }}" class="btn btn-primary">← Kembali</a>
    </div>

    <form action="{{ route('kategori-barang.update', $kategoriBarang) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $kategoriBarang->nama }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="2">{{ $kategoriBarang->keterangan }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">💾 Update</button>
    </form>
</div>
@endsection