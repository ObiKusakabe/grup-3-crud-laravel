@extends('layouts.app')

@section('title', 'Tambah Warna')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">🎨 Tambah Warna</h1>
        <a href="{{ route('warna.index') }}" class="btn btn-primary">← Kembali</a>
    </div>

    <form action="{{ route('warna.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label">Nama Warna</label>
            <input type="text" name="nama" class="form-control" placeholder="Merah, Biru, Hitam" required>
        </div>
        <div class="form-group">
            <label class="form-label">Kode Warna</label>
            <input type="color" name="kode_hex" class="form-control" value="#000000" style="height:50px">
        </div>
        <button type="submit" class="btn btn-success">💾 Simpan</button>
    </form>
</div>
@endsection