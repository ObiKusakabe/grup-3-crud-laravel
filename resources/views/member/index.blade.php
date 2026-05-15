@extends('layouts.app')

@section('title', 'Member')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title"><i data-lucide="users" style="width: 24px; vertical-align: middle; margin-right: 8px;"></i> Member</h1>
        <a href="{{ route('member.create') }}" class="btn btn-success"><i data-lucide="plus" style="width: 18px; margin-right: 6px;"></i> Tambah</a>
    </div>

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
            <tr><td colspan="4" class="text-center">Belum ada member</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection