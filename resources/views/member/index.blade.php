@extends('layouts.app')
@section('title', 'Data Member')
@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Data Member</h2>
        <a href="{{ route('member.create') }}" class="btn btn-primary">+ Tambah Member</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>No</th><th>Nama</th><th>Telepon</th><th>Alamat</th><th>Diskon</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($member as $i => $m)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $m->nama }}</td>
                <td>{{ $m->telepon ?? '-' }}</td>
                <td>{{ $m->alamat ?? '-' }}</td>
                <td>{{ $m->diskon_persen }}%</td>
                <td>
                    <a href="{{ route('member.edit', $m) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('member.destroy', $m) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection