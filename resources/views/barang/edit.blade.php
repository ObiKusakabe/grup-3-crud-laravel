@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">📦 Edit Barang</h1>
        <a href="{{ route('barang.index') }}" class="btn btn-primary">← Kembali</a>
    </div>

    <form action="{{ route('barang.update', $barang) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-label">Kode Barang</label>
            <input type="text" name="kode_barang" class="form-control" value="{{ $barang->kode_barang }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $barang->nama }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Kategori</label>
            <input type="text" name="kategori" class="form-control" value="{{ $barang->kategori }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Ukuran</label>
            <input type="text" name="ukuran" class="form-control" value="{{ $barang->ukuran }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Warna</label>
            <input type="text" name="warna" class="form-control" value="{{ $barang->warna }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Harga Beli</label>
            <input type="number" name="harga_beli" class="form-control" value="{{ $barang->harga_beli }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Harga Jual</label>
            <input type="number" name="harga_jual" class="form-control" value="{{ $barang->harga_jual }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ $barang->stok }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Foto</label><br>
            @if($barang->foto)
                <img src="{{ asset('storage/' . $barang->foto) }}" width="100"><br><br>
            @endif
            <input type="file" name="foto" class="form-control" accept="image/*">
        </div>
        <button type="submit" class="btn btn-success">💾 Update</button>
    </form>
</div>
@endsection