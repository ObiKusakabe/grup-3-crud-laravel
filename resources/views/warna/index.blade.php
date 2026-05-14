@extends('layouts.app')

@section('title', 'Warna')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">🎨 Warna</h1>
        <a href="{{ route('warna.create') }}" class="btn btn-success">+ Tambah</a>
    </div>

    <table class="table">
        <thead>
            <tr><th>Nama</th><th>Kode</th><th>Preview</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @forelse($warna as $w)
            <tr>
                <td>{{ $w->nama }}</td>
                <td>{{ $w->kode_hex ?: '-' }}</td>
                <td>
                    @if($w->kode_hex)
                        <div style="width:30px;height:30px;background:{{ $w->kode_hex }};border-radius:4px;border:1px solid #ddd"></div>
                    @else
                        -
                    @endif
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('warna.edit', $w) }}" class="btn btn-sm btn-warning">✏️</a>
                        <form action="{{ route('warna.destroy', $w) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">🗑️</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center">Belum ada warna</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection