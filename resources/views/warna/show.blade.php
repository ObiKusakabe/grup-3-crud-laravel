@extends('layouts.app')

@section('title', 'Detail Warna')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title"><i data-lucide="palette" style="width: 24px; vertical-align: middle; margin-right: 8px;"></i> Detail Warna</h1>
        <a href="{{ route('warna.index') }}" class="btn btn-primary"><i data-lucide="arrow-left" style="width: 18px; margin-right: 6px;"></i> Kembali</a>
    </div>

    <table class="table">
        <tr><th>Nama</th><td>{{ $warna->nama }}</td></tr>
        <tr><th>Kode</th><td>{{ $warna->kode_hex ?: '-' }}</td></tr>
        <tr><th>Preview</th><td>
            @if($warna->kode_hex)
                <div style="width:100px;height:100px;background:{{ $warna->kode_hex }};border-radius:8px;border:2px solid #ddd"></div>
            @else
                -
            @endif
        </td></tr>
    </table>

    <div class="d-flex gap-2">
        <a href="{{ route('warna.edit', $warna) }}" class="btn btn-warning"><i data-lucide="edit" style="width: 18px; margin-right: 6px;"></i> Edit</a>
        <form action="{{ route('warna.destroy', $warna) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i data-lucide="trash-2" style="width: 18px; margin-right: 6px;"></i> Hapus</button>
        </form>
    </div>
</div>
@endsection