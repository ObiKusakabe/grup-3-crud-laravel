@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">🏷️ Kategori</h1>
        <a href="{{ route('kategori-barang.create') }}" class="btn btn-success">+ Tambah</a>
    </div>

    <table class="table">
        <thead>
            <tr><th>Nama</th><th>Keterangan</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @forelse($kategori as $k)
            <tr>
                <td>{{ $k->nama }}</td>
                <td>{{ $k->keterangan ?: '-' }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('kategori-barang.edit', $k) }}" class="btn btn-sm btn-warning">✏️</a>
                        <form action="{{ route('kategori-barang.destroy', $k) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">🗑️</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="3" class="text-center">Belum ada kategori</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection