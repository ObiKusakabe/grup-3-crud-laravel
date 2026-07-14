@extends('layouts.app')

@section('title', 'Member')

@section('content')
<div class="page-header">
    <div>
        <p class="page-label">Penjualan</p>
        <h1 class="page-title">Member</h1>
        <p class="page-subtitle">Kelola data pelanggan member dan diskon mereka</p>
    </div>
    <a href="{{ route('member.create') }}" class="btn btn-success">
        <i data-lucide="plus" style="width: 16px;"></i> Tambah Member
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr><th>Nama</th><th>Telepon</th><th>Diskon</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($member as $m)
                <tr>
                    <td>{{ $m->nama }}</td>
                    <td>{{ $m->telepon ?: '-' }}</td>
                    <td><span class="badge badge-success">{{ $m->diskon_persen }}%</span></td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('member.show', $m) }}" class="btn btn-sm btn-primary"><i data-lucide="eye" style="width: 16px;"></i></a>
                            <a href="{{ route('member.edit', $m) }}" class="btn btn-sm btn-warning"><i data-lucide="edit" style="width: 16px;"></i></a>
                            <form action="{{ route('member.destroy', $m) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i data-lucide="trash-2" style="width: 16px;"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center" style="padding: 32px; color: var(--outline);">Belum ada member</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection