@extends('layouts.app')

@section('title', 'Edit Status')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">🛒 Edit Status</h1>
        <a href="{{ route('transaksi.index') }}" class="btn btn-primary">← Kembali</a>
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
                <option value="Pending" {{ $transaksi->status=='Pending'?'selected':'' }}>⏳ Pending</option>
                <option value="Selesai" {{ $transaksi->status=='Selesai'?'selected':'' }}>✅ Selesai</option>
                <option value="Batal" {{ $transaksi->status=='Batal'?'selected':'' }}>❌ Batal</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">💾 Update</button>
    </form>
</div>
@endsection