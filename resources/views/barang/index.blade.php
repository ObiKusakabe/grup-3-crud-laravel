@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">📦 Daftar Barang</h1>
        <a href="{{ route('barang.create') }}" class="btn btn-success">+ Tambah Barang</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Ukuran</th>
                <th>Warna</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($barang as $b)
            <tr>
                <td>{{ $b->kode_barang }}</td>
                <td>{{ $b->nama }}</td>
                <td><span class="badge badge-info">{{ $b->kategori }}</span></td>
                <td>{{ $b->ukuran }}</td>
                <td>{{ $b->warna }}</td>
                <td>Rp {{ number_format($b->harga_jual, 0, ',', '.') }}</td>
                <td>
                    @if($b->stok <= 5)
                        <span class="badge badge-danger">{{ $b->stok }}</span>
                    @else
                        <span class="badge badge-success">{{ $b->stok }}</span>
                    @endif
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('barang.show', $b) }}" class="btn btn-sm btn-primary">👁️</a>
                        <a href="{{ route('barang.edit', $b) }}" class="btn btn-sm btn-warning">✏️</a>
                        <form action="{{ route('barang.destroy', $b) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">🗑️</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" class="text-center">Belum ada barang</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection