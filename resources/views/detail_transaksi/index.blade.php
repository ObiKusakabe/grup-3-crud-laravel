@extends('layouts.app')
@section('title', 'Detail Transaksi')
@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Detail Transaksi</h2>
        <a href="{{ route('detail-transaksi.create') }}" class="btn btn-primary">+ Tambah Detail</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>No</th><th>Kode Transaksi</th><th>Barang</th><th>Ukuran</th><th>Warna</th><th>Jumlah</th><th>Harga</th><th>Subtotal</th><th>Jenis</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($details as $i => $d)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $d->kode_transaksi }}</td>
                <td>{{ $d->nama_barang }}</td>
                <td>{{ $d->ukuran }}</td>
                <td>{{ $d->warna }}</td>
                <td>{{ $d->jumlah }}</td>
                <td>Rp {{ number_format($d->harga_satuan,0,',','.') }}</td>
                <td>Rp {{ number_format($d->subtotal,0,',','.') }}</td>
                <td><span class="badge {{ $d->jenis == 'jual' ? 'badge-success' : 'badge-danger' }}">{{ $d->jenis }}</span></td>
                <td>
                    <a href="{{ route('detail-transaksi.edit', $d) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('detail-transaksi.destroy', $d) }}" method="POST" style="display:inline">
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