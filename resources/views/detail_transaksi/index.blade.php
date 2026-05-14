@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">📋 Detail Transaksi</h1>
        <a href="{{ route('detail-transaksi.create') }}" class="btn btn-success">+ Tambah</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Kode TRX</th><th>Barang</th><th>Ukuran</th><th>Warna</th>
                <th>Jumlah</th><th>Harga</th><th>Subtotal</th><th>Jenis</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($details as $d)
            <tr>
                <td>{{ $d->kode_transaksi }}</td>
                <td>{{ $d->nama_barang }}</td>
                <td>{{ $d->ukuran }}</td>
                <td>{{ $d->warna }}</td>
                <td>{{ $d->jumlah }}</td>
                <td>Rp {{ number_format($d->harga_satuan, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                <td>
                    @if($d->jenis == 'jual')
                        <span class="badge badge-success">Jual</span>
                    @else
                        <span class="badge badge-danger">Retur</span>
                    @endif
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('detail-transaksi.show', $d) }}" class="btn btn-sm btn-primary">👁️</a>
                        <a href="{{ route('detail-transaksi.edit', $d) }}" class="btn btn-sm btn-warning">✏️</a>
                        <form action="{{ route('detail-transaksi.destroy', $d) }}" method="POST" onsubmit="return confirm('Yakin? Stok otomatis berubah!')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">🗑️</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="9" class="text-center">Belum ada data</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection