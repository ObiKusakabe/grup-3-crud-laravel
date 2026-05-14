@extends('layouts.app')
@section('title', 'Tambah Detail Transaksi')
@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Tambah Detail Transaksi</h2>
        <a href="{{ route('detail-transaksi.index') }}" class="btn btn-warning">Kembali</a>
    </div>
    <form action="{{ route('detail-transaksi.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label">Kode Transaksi</label>
            <input type="text" name="kode_transaksi" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" required>
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
            <label class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" min="1" required>
        </div>
        <div class="form-group">
            <label class="form-label">Harga Satuan</label>
            <input type="number" name="harga_satuan" class="form-control" min="0" required>
        </div>
        <div class="form-group">
            <label class="form-label">Jenis</label>
            <select name="jenis" class="form-select">
                <option value="jual">Jual</option>
                <option value="retur">Retur</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Alasan Retur (isi jika retur)</label>
            <textarea name="alasan_retur" class="form-control" rows="2"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection