@extends('layouts.app')

@section('title', 'Kategori Barang')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Kategori Barang</h1>
        <p class="page-subtitle">Kelola kategori pengelompokan produk</p>
    </div>
    <a href="{{ route('kategori-barang.create') }}" class="btn btn-dark">
        <i data-lucide="plus" style="width: 16px;"></i> Tambah Kategori
    </a>
</div>

<div class="card">
    <div style="padding: 16px;">
        <div style="position: relative; max-width: 320px;">
            <i data-lucide="search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 16px; color: #adb5bd;"></i>
            <input type="text" id="globalTableSearch" class="form-control" placeholder="Cari data..." style="padding-left: 36px;">
        </div>
    </div>
    <div class="table-responsive" style="overflow-x: auto;">
        <table class="table" style="min-width: 600px;">
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
                            <a href="{{ route('kategori-barang.edit', $k) }}" class="btn btn-sm btn-warning"><i data-lucide="edit" style="width: 16px;"></i></a>
                            <form action="{{ route('kategori-barang.destroy', $k) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i data-lucide="trash-2" style="width: 16px;"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center" style="padding: 32px; color: var(--outline);">Belum ada kategori</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection