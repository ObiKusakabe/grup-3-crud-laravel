@extends('layouts.app')

@section('title', 'Detail Member')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">👤 Detail Member</h1>
        <a href="{{ route('member.index') }}" class="btn btn-primary">← Kembali</a>
    </div>

    <table class="table">
        <tr><th>Nama</th><td>{{ $member->nama }}</td></tr>
        <tr><th>Telepon</th><td>{{ $member->telepon ?: '-' }}</td></tr>
        <tr><th>Alamat</th><td>{{ $member->alamat ?: '-' }}</td></tr>
        <tr><th>Diskon</th><td><span class="badge badge-success">{{ $member->diskon_persen }}%</span></td></tr>
    </table>

    <div class="d-flex gap-2">
        <a href="{{ route('member.edit', $member) }}" class="btn btn-warning">✏️ Edit</a>
        <form action="{{ route('member.destroy', $member) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">🗑️ Hapus</button>
        </form>
    </div>
</div>
@endsection