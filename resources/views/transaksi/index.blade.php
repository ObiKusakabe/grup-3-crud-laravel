@extends('layouts.app')

@section('title', 'Transaksi')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title"><i data-lucide="shopping-cart" style="width: 24px; vertical-align: middle; margin-right: 8px;"></i> Transaksi</h1>
        <a href="{{ route('transaksi.create') }}" class="btn btn-success"><i data-lucide="plus" style="width: 18px; margin-right: 6px;"></i> Transaksi Baru</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Tanggal</th>
                <th>Kasir</th>
                <th>Total</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $t)
            <tr>
                <td>{{ $t->kode_transaksi }}</td>
                <td>{{ $t->tanggal }}</td>
                <td>{{ $t->kasir }}</td>
                <td>Rp {{ number_format($t->total_akhir, 0, ',', '.') }}</td>
                <td>
                    @if($t->status == 'Pending')
                        <span class="badge badge-warning">{{ $t->status }}</span>
                    @elseif($t->status == 'Selesai')
                        <span class="badge badge-success">{{ $t->status }}</span>
                    @else
                        <span class="badge badge-danger">{{ $t->status }}</span>
                    @endif
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('transaksi.show', $t) }}" class="btn btn-sm btn-primary"><i data-lucide="eye" style="width: 16px;"></i></a>
                        <a href="{{ route('transaksi.edit', $t) }}" class="btn btn-sm btn-warning"><i data-lucide="edit" style="width: 16px;"></i></a>
                        <form action="{{ route('transaksi.destroy', $t) }}" method="POST" onsubmit="return confirm('Yakin? Stok kembali!')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i data-lucide="trash-2" style="width: 16px;"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center">Belum ada transaksi</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection