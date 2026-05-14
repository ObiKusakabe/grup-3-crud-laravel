@extends('layouts.app')

@section('title', 'Detail Supplier')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">🏭 Detail Supplier</h1>
        <a href="{{ route('supplier.index') }}" class="btn btn-primary">← Kembali</a>
    </div>

    <table class="table">
        <tr><th>Nama</th><td>{{ $supplier->nama }}</td></tr>
        <tr><th>Telepon</th><td>{{ $supplier->telepon ?: '-' }}</td></tr>
        <tr><th>Alamat</th><td>{{ $supplier->alamat ?: '-' }}</td></tr>
    </table>

    <div class="d-flex gap-2">
        <a href="{{ route('supplier.edit', $supplier) }}" class="btn btn-warning">✏️ Edit</a>
        <form action="{{ route('supplier.destroy', $supplier) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">🗑️ Hapus</button>
        </form>
    </div>
</div>
@endsection