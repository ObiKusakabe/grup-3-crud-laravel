@extends('layouts.app')

@section('title', 'Detail Supplier')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title"><i data-lucide="building-2" style="width: 24px; vertical-align: middle; margin-right: 8px;"></i> Detail Supplier</h1>
        <a href="{{ route('supplier.index') }}" class="btn btn-primary"><i data-lucide="arrow-left" style="width: 18px; margin-right: 6px;"></i> Kembali</a>
    </div>

    <table class="table">
        <tr><th>Nama</th><td>{{ $supplier->nama }}</td></tr>
        <tr><th>Telepon</th><td>{{ $supplier->telepon ?: '-' }}</td></tr>
        <tr><th>Alamat</th><td>{{ $supplier->alamat ?: '-' }}</td></tr>
    </table>

    <div class="d-flex gap-2">
        <a href="{{ route('supplier.edit', $supplier) }}" class="btn btn-warning"><i data-lucide="edit" style="width: 18px; margin-right: 6px;"></i> Edit</a>
        <form action="{{ route('supplier.destroy', $supplier) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i data-lucide="trash-2" style="width: 18px; margin-right: 6px;"></i> Hapus</button>
        </form>
    </div>
</div>
@endsection