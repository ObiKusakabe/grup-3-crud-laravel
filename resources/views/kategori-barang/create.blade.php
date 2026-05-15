@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title"><i data-lucide="tag" style="width: 24px; vertical-align: middle; margin-right: 8px;"></i> Tambah Kategori</h1>
        <a href="{{ route('kategori-barang.index') }}" class="btn btn-primary"><i data-lucide="arrow-left" style="width: 18px; margin-right: 6px;"></i> Kembali</a>
    </div>

    <form action="{{ route('kategori-barang.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="2"></textarea>
        </div>
        <button type="submit" class="btn btn-success"><i data-lucide="save" style="width: 18px; margin-right: 6px;"></i> Simpan</button>
    </form>
</div>
@endsection