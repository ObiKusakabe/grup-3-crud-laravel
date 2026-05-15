@extends('layouts.app')

@section('title', 'Supplier')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title"><i data-lucide="building-2" style="width: 24px; vertical-align: middle; margin-right: 8px;"></i> Supplier</h1>
        <a href="{{ route('supplier.create') }}" class="btn btn-success"><i data-lucide="plus" style="width: 18px; margin-right: 6px;"></i> Tambah</a>
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
            <tr><td colspan="4" class="text-center">Belum ada supplier</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection