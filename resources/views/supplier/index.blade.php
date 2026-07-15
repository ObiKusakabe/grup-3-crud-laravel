@extends('layouts.app')

@section('title', 'Supplier')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Data Supplier</h1>
        <p class="page-subtitle">Kelola informasi supplier dan pemasok barang</p>
    </div>
    <a href="{{ route('supplier.create') }}" class="btn btn-dark">
        <i data-lucide="plus" style="width: 16px;"></i> Tambah Supplier
    </a>
</div>

<div class="card">
    <div style="padding: 16px;">
        <div style="position: relative; max-width: 320px;">
            <i data-lucide="search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 16px; color: #adb5bd;"></i>
            <input type="text" id="globalTableSearch" class="form-control" placeholder="Cari data..." style="padding-left: 36px;">
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr><th>Nama</th><th>Telepon</th><th>Alamat</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($supplier as $s)
                <tr>
                    <td>{{ $s->nama }}</td>
                    <td>{{ $s->telepon ?: '-' }}</td>
                    <td>{{ $s->alamat ?: '-' }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('supplier.show', $s) }}" class="btn btn-sm btn-primary"><i data-lucide="eye" style="width: 16px;"></i></a>
                            <a href="{{ route('supplier.edit', $s) }}" class="btn btn-sm btn-warning"><i data-lucide="edit" style="width: 16px;"></i></a>
                            <form action="{{ route('supplier.destroy', $s) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i data-lucide="trash-2" style="width: 16px;"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center" style="padding: 32px; color: var(--outline);">Belum ada supplier</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection