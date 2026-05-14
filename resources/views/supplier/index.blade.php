@extends('layouts.app')

@section('title', 'Supplier')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">🏭 Supplier</h1>
        <a href="{{ route('supplier.create') }}" class="btn btn-success">+ Tambah</a>
    </div>

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
                        <a href="{{ route('supplier.show', $s) }}" class="btn btn-sm btn-primary">👁️</a>
                        <a href="{{ route('supplier.edit', $s) }}" class="btn btn-sm btn-warning">✏️</a>
                        <form action="{{ route('supplier.destroy', $s) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">🗑️</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center">Belum ada supplier</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection