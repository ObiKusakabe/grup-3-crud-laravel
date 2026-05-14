@extends('layouts.app')

@section('title', 'Tambah Ukuran')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">📏 Tambah Ukuran</h1>
        <a href="{{ route('ukuran.index') }}" class="btn btn-primary">← Kembali</a>
    </div>

    <form action="{{ route('ukuran.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label">Nama Ukuran</label>
            <input type="text" name="nama" class="form-control" placeholder="S, M, L, XL, XXL" required>
        </div>
        <button type="submit" class="btn btn-success">💾 Simpan</button>
    </form>
</div>
@endsection