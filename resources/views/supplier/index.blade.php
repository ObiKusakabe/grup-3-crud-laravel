@extends('layouts.app')
@section('title', 'Data Supplier')
@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Data Supplier</h2>
        <a href="{{ route('supplier.create') }}" class="btn btn-primary">+ Tambah Supplier</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>No</th><th>Nama</th><th>Telepon</th><th>Alamat</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($supplier as $i => $s)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $s->nama }}</td>
                <td>{{ $s->telepon ?? '-' }}</td>
                <td>{{ $s->alamat ?? '-' }}</td>
                <td>
                    <a href="{{ route('supplier.edit', $s) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('supplier.destroy', $s) }}" method="POST" style="display:inline">
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