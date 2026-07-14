@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="page-header">
    <div>
        <p class="page-label">Penjualan</p>
        <h1 class="page-title">Riwayat Transaksi</h1>
        <p class="page-subtitle">Lihat seluruh riwayat transaksi penjualan</p>
    </div>
    <a href="{{ route('transaksi.create') }}" class="btn btn-success">
        <i data-lucide="plus" style="width: 16px;"></i> Transaksi Baru
    </a>
</div>

<div class="card">
    <div class="table-responsive">
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
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('transaksi.edit', $t) }}" class="btn btn-sm btn-warning"><i data-lucide="edit" style="width: 16px;"></i></a>
                                <form action="{{ route('transaksi.destroy', $t) }}" method="POST" onsubmit="return confirm('Yakin? Stok kembali!')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i data-lucide="trash-2" style="width: 16px;"></i></button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center" style="padding: 32px; color: var(--outline);">Belum ada transaksi</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection