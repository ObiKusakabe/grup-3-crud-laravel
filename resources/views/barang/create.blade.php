@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">📦 Tambah Barang</h1>
        <a href="{{ route('barang.index') }}" class="btn btn-primary">← Kembali</a>
    </div>

    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="form-label">Kode Barang</label>
            <input type="text" name="kode_barang" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Kategori</label>
            <input type="text" name="kategori" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Ukuran</label>
            <input type="text" name="ukuran" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Warna</label>
            <input type="text" name="warna" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Harga Beli</label>
            <input type="number" name="harga_beli" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Harga Jual</label>
            <input type="number" name="harga_jual" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Stok Awal</label>
            <input type="number" name="stok" class="form-control" value="0" required>
        </div>
        <div class="form-group">
            <label class="form-label">Foto</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
        </div>
        <button type="submit" class="btn btn-success">💾 Simpan</button>
    </form>
</div>
@endsection