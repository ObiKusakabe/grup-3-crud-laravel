@extends('layouts.app')

@section('title', 'Edit Status')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title"><i data-lucide="shopping-cart" style="width: 24px; vertical-align: middle; margin-right: 8px;"></i> Edit Status</h1>
        <a href="{{ route('transaksi.index') }}" class="btn btn-primary"><i data-lucide="arrow-left" style="width: 18px; margin-right: 6px;"></i> Kembali</a>
    </div>

    <p>Kode: <strong>{{ $transaksi->kode_transaksi }}</strong></p>
    <p>Total: Rp {{ number_format($transaksi->total_akhir, 0, ',', '.') }}</p>
    <p>Status: <span class="badge badge-warning">{{ $transaksi->status }}</span></p>

    <form action="{{ route('transaksi.update', $transaksi) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-label">Ubah Status</label>
            <select name="status" class="form-select" required>
                <option value="Pending" {{ $transaksi->status=='Pending'?'selected':'' }}><i data-lucide="clock" style="width: 16px; vertical-align: middle; margin-right: 4px;"></i> Pending</option>
                <option value="Selesai" {{ $transaksi->status=='Selesai'?'selected':'' }}><i data-lucide="check-circle" style="width: 16px; vertical-align: middle; margin-right: 4px;"></i> Selesai</option>
                <option value="Batal" {{ $transaksi->status=='Batal'?'selected':'' }}><i data-lucide="x-circle" style="width: 16px; vertical-align: middle; margin-right: 4px;"></i> Batal</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success"><i data-lucide="save" style="width: 18px; margin-right: 6px;"></i> Update</button>
    </form>
</div>
@endsection