@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">🏭 Edit Supplier</h1>
        <a href="{{ route('supplier.index') }}" class="btn btn-primary">← Kembali</a>
    </div>

    <form action="{{ route('supplier.update', $supplier) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $supplier->nama }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Telepon</label>
            <input type="text" name="telepon" class="form-control" value="{{ $supplier->telepon }}">
        </div>
        <div class="form-group">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3">{{ $supplier->alamat }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">💾 Update</button>
    </form>
</div>
@endsection