@extends('layouts.app')
@section('title', 'Tambah Supplier')
@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Tambah Supplier</h2>
        <a href="{{ route('supplier.index') }}" class="btn btn-warning">Kembali</a>
    </div>
    <form action="{{ route('supplier.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label">Nama</label>
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
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection