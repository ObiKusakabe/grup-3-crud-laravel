@extends('layouts.app')

@section('title', 'Kelola Cabang')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Kelola Cabang</h1>
        <p class="page-subtitle">Manajemen daftar cabang toko Anda</p>
    </div>
    <a href="{{ route('branches.create') }}" class="btn btn-dark">
        <i data-lucide="plus" style="width: 16px;"></i> Tambah Cabang
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
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Kode Cabang</th>
                    <th>Nama Cabang</th>
                    <th>Status</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($branches as $branch)
                    <tr>
                        <td><strong>{{ $branch->code }}</strong></td>
                        <td>{{ $branch->name }}</td>
                        <td>
                            @if($branch->is_active)
                                <span style="display: inline-block; padding: 4px 12px; border-radius: 4px; font-size: 12px; background-color: #e8f5e9; color: #2e7d32; font-weight: 600;">
                                    Aktif
                                </span>
                            @else
                                <span style="display: inline-block; padding: 4px 12px; border-radius: 4px; font-size: 12px; background-color: #ffebee; color: #c62828; font-weight: 600;">
                                    Nonaktif
                                </span>
                            @endif
                        </td>
                        <td>{{ $branch->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('branches.edit', $branch->id) }}" class="btn btn-sm btn-warning">
                                    <i data-lucide="edit" style="width: 16px;"></i>
                                </a>
                                <form action="{{ route('branches.destroy', $branch->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus cabang ini? Semua data stok cabang ini mungkin akan terdampak.');">
                                        <i data-lucide="trash-2" style="width: 16px;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center" style="padding: 32px; color: var(--outline);">
                            Belum ada cabang. <a href="{{ route('branches.create') }}">Tambah cabang</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
