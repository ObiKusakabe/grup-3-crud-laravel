@extends('layouts.app')

@section('title', 'Edit Ukuran')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">📏 Edit Ukuran</h1>
        <a href="{{ route('ukuran.index') }}" class="btn btn-primary">← Kembali</a>
    </div>

    <form action="{{ route('ukuran.update', $ukuran) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $ukuran->nama }}" required>
        </div>
        <button type="submit" class="btn btn-success">💾 Update</button>
    </form>
</div>
@endsection