@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title"><i data-lucide="package" style="width: 24px; vertical-align: middle; margin-right: 8px;"></i> Edit Barang</h1>
        <a href="{{ route('barang.index') }}" class="btn btn-primary"><i data-lucide="arrow-left" style="width: 18px; margin-right: 6px;"></i> Kembali</a>
    </div>

    <form action="{{ route('barang.update', $barang) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-label">SKU</label>
            <input type="text" class="form-control" value="{{ $barang->kode_barang }}" disabled style="background: var(--surface-container); color: var(--on-surface-variant); cursor: not-allowed;">
            <small style="color: var(--on-surface-variant); font-size: 12px; margin-top: 4px; display: block;">SKU dibuat otomatis dan tidak dapat diubah.</small>
        </div>
        <div class="form-group">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $barang->nama }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Ukuran</label>
            <input type="text" name="ukuran" class="form-control" value="{{ $barang->ukuran }}">
        </div>
        <div class="form-group">
            <label class="form-label">Kategori</label>
            <select name="kategori_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $kat)
                    <option value="{{ $kat->id }}" {{ $barang->kategori_id == $kat->id ? 'selected' : '' }}>{{ $kat->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Supplier <span style="color:var(--on-surface-variant);font-weight:400;">(Opsional)</span></label>
            <select name="supplier_id" class="form-control">
                <option value="">-- Pilih Supplier --</option>
                @foreach($suppliers as $sup)
                    <option value="{{ $sup->id }}" {{ $barang->supplier_id == $sup->id ? 'selected' : '' }}>{{ $sup->nama }}</option>
                @endforeach
            </select>
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
            <label class="form-label">Foto</label><br>
            @if($barang->foto)
                <img src="{{ asset('storage/' . $barang->foto) }}" width="100"><br><br>
            @endif
            <input type="file" name="foto" class="form-control" accept="image/*">
        </div>
        <button type="submit" class="btn btn-success"><i data-lucide="save" style="width: 18px; margin-right: 6px;"></i> Update</button>
    </form>
</div>
@endsection