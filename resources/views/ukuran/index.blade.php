@extends('layouts.app')

@section('title', 'Ukuran')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title"><i data-lucide="ruler" style="width: 24px; vertical-align: middle; margin-right: 8px;"></i> Ukuran</h1>
        <a href="{{ route('ukuran.create') }}" class="btn btn-success"><i data-lucide="plus" style="width: 18px; margin-right: 6px;"></i> Tambah</a>
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
                        <a href="{{ route('ukuran.edit', $u) }}" class="btn btn-sm btn-warning"><i data-lucide="edit" style="width: 16px;"></i></a>
                        <form action="{{ route('ukuran.destroy', $u) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i data-lucide="trash-2" style="width: 16px;"></i></button>
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