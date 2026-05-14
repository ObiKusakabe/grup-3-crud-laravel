@extends('layouts.app')
@section('title', 'Edit Detail Transaksi')
@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Edit Detail Transaksi</h2>
        <a href="{{ route('detail-transaksi.index') }}" class="btn btn-warning">Kembali</a>
    </div>
    <form action="{{ route('detail-transaksi.update', $detailTransaksi) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group">
            <label class="form-label">Kode Transaksi</label>
            <input type="text" class="form-control" value="{{ $detailTransaksi->kode_transaksi }}" disabled>
        </div>
        <div class="form-group">
            <label class="form-label">Nama Barang</label>
            <input type="text" class="form-control" value="{{ $detailTransaksi->nama_barang }}" disabled>
        </div>
        <div class="form-group">
            <label class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" value="{{ $detailTransaksi->jumlah }}" min="1" required>
        </div>
        <div class="form-group">
            <label class="form-label">Jenis</label>
            <select name="jenis" class="form-select">
                <option value="jual" {{ $detailTransaksi->jenis == 'jual' ? 'selected' : '' }}>Jual</option>
                <option value="retur" {{ $detailTransaksi->jenis == 'retur' ? 'selected' : '' }}>Retur</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Alasan Retur</label>
            <textarea name="alasan_retur" class="form-control" rows="2">{{ $detailTransaksi->alasan_retur }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection