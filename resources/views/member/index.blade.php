@extends('layouts.app')

@section('title', 'Member')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">👤 Member</h1>
        <a href="{{ route('member.create') }}" class="btn btn-success">+ Tambah</a>
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
                        <a href="{{ route('member.show', $m) }}" class="btn btn-sm btn-primary">👁️</a>
                        <a href="{{ route('member.edit', $m) }}" class="btn btn-sm btn-warning">✏️</a>
                        <form action="{{ route('member.destroy', $m) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">🗑️</button>
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