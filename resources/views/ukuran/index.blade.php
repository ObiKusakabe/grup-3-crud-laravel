@extends('layouts.app')

@section('title', 'Ukuran')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">📏 Ukuran</h1>
        <a href="{{ route('ukuran.create') }}" class="btn btn-success">+ Tambah</a>
    </div>

    <table class="table">
        <thead>
            <tr><th>Nama</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @forelse($ukuran as $u)
            <tr>
                <td><span class="badge badge-info" style="font-size:1rem">{{ $u->nama }}</span></td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('ukuran.edit', $u) }}" class="btn btn-sm btn-warning">✏️</a>
                        <form action="{{ route('ukuran.destroy', $u) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">🗑️</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="2" class="text-center">Belum ada ukuran</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection