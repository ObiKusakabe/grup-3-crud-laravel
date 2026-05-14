@extends('layouts.app')

@section('title', 'Edit Warna')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">🎨 Edit Warna</h1>
        <a href="{{ route('warna.index') }}" class="btn btn-primary">← Kembali</a>
    </div>

    <form action="{{ route('warna.update', $warna) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $warna->nama }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Kode Warna</label>
            <input type="color" name="kode_hex" class="form-control" value="{{ $warna->kode_hex ?: '#000000' }}" style="height:50px">
        </div>
        <button type="submit" class="btn btn-success">💾 Update</button>
    </form>
</div>
@endsection