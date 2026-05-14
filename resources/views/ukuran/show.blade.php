@extends('layouts.app')

@section('title', 'Detail Ukuran')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">📏 Detail Ukuran</h1>
        <a href="{{ route('ukuran.index') }}" class="btn btn-primary">← Kembali</a>
    </div>

    <table class="table">
        <tr><th>Nama</th><td><span class="badge badge-info" style="font-size:1.5rem">{{ $ukuran->nama }}</span></td></tr>
    </table>

    <div class="d-flex gap-2">
        <a href="{{ route('ukuran.edit', $ukuran) }}" class="btn btn-warning">✏️ Edit</a>
        <form action="{{ route('ukuran.destroy', $ukuran) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">🗑️ Hapus</button>
        </form>
    </div>
</div>
@endsection