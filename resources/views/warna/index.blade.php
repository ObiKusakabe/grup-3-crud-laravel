@extends('layouts.app')

@section('title', 'Warna')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title"><i data-lucide="palette" style="width: 24px; vertical-align: middle; margin-right: 8px;"></i> Warna</h1>
        <a href="{{ route('warna.create') }}" class="btn btn-success"><i data-lucide="plus" style="width: 18px; margin-right: 6px;"></i> Tambah</a>
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
                        <a href="{{ route('warna.edit', $w) }}" class="btn btn-sm btn-warning"><i data-lucide="edit" style="width: 16px;"></i></a>
                        <form action="{{ route('warna.destroy', $w) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i data-lucide="trash-2" style="width: 16px;"></i></button>
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