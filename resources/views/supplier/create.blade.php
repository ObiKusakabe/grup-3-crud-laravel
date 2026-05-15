@extends('layouts.app')

@section('title', 'Tambah Supplier')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title"><i data-lucide="building-2" style="width: 24px; vertical-align: middle; margin-right: 8px;"></i> Tambah Supplier</h1>
        <a href="{{ route('supplier.index') }}" class="btn btn-primary"><i data-lucide="arrow-left" style="width: 18px; margin-right: 6px;"></i> Kembali</a>
    </div>

    <form action="{{ route('supplier.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label">Nama Supplier</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Telepon</label>
            <input type="text" name="telepon" class="form-control">
        </div>
        <div class="form-group">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-success"><i data-lucide="save" style="width: 18px; margin-right: 6px;"></i> Simpan</button>
    </form>
</div>
@endsection