@extends('layouts.app')

@section('title', 'Edit Stok Masuk')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title"><i data-lucide="inbox" style="width: 24px; vertical-align: middle; margin-right: 8px;"></i> Edit Stok Masuk</h1>
        <a href="{{ route('stok-masuk.index') }}" class="btn btn-primary"><i data-lucide="arrow-left" style="width: 18px; margin-right: 6px;"></i> Kembali</a>
    </div>

    <form action="{{ route('stok-masuk.update', $stokMasuk) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" value="{{ $stokMasuk->nama_barang }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Supplier</label>
            <input type="text" name="nama_supplier" class="form-control" value="{{ $stokMasuk->nama_supplier }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Jumlah (Sebelum: {{ $stokMasuk->jumlah }})</label>
            <input type="number" name="jumlah" class="form-control" value="{{ $stokMasuk->jumlah }}" min="1" required>
        </div>
        <div class="form-group">
            <label class="form-label">Harga Beli</label>
            <input type="number" name="harga_beli" class="form-control" value="{{ $stokMasuk->harga_beli }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal_masuk" class="form-control" value="{{ $stokMasuk->tanggal_masuk }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="2">{{ $stokMasuk->keterangan }}</textarea>
        </div>
        <button type="submit" class="btn btn-success"><i data-lucide="save" style="width: 18px; margin-right: 6px;"></i> Update (Stok dikoreksi)</button>
    </form>
</div>
@endsection