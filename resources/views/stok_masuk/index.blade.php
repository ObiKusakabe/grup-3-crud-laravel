@extends('layouts.app')

@section('title', 'Stok Masuk')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title"><i data-lucide="inbox" style="width: 24px; vertical-align: middle; margin-right: 8px;"></i> Stok Masuk</h1>
        <a href="{{ route('stok-masuk.create') }}" class="btn btn-success"><i data-lucide="plus" style="width: 18px; margin-right: 6px;"></i> Tambah</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Barang</th>
                <th>Supplier</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stokMasuk as $sm)
            <tr>
                <td>{{ $sm->tanggal_masuk }}</td>
                <td>{{ $sm->nama_barang }}</td>
                <td>{{ $sm->nama_supplier }}</td>
                <td>{{ $sm->jumlah }}</td>
                <td>Rp {{ number_format($sm->jumlah * $sm->harga_beli, 0, ',', '.') }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('stok-masuk.edit', $sm) }}" class="btn btn-sm btn-warning"><i data-lucide="edit" style="width: 16px;"></i></a>
                        <form action="{{ route('stok-masuk.destroy', $sm) }}" method="POST" onsubmit="return confirm('Yakin hapus? Stok berkurang!')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i data-lucide="trash-2" style="width: 16px;"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center">Belum ada data</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection