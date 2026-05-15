@extends('layouts.app')

@section('title', 'Tambah Stok Masuk')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title"><i data-lucide="inbox" style="width: 24px; vertical-align: middle; margin-right: 8px;"></i> Tambah Stok Masuk</h1>
        <a href="{{ route('stok-masuk.index') }}" class="btn btn-primary"><i data-lucide="arrow-left" style="width: 18px; margin-right: 6px;"></i> Kembali</a>
    </div>

    <form action="{{ route('stok-masuk.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Nama Supplier</label>
            <input type="text" name="nama_supplier" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" min="1" required>
        </div>
        <div class="form-group">
            <label class="form-label">Harga Beli</label>
            <input type="number" name="harga_beli" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal_masuk" class="form-control" value="{{ date('Y-m-d') }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="2"></textarea>
        </div>
        <button type="submit" class="btn btn-success"><i data-lucide="save" style="width: 18px; margin-right: 6px;"></i> Simpan (Stok +)</button>
    </form>
</div>
@endsection