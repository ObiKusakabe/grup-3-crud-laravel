@extends('layouts.app')

@section('title', 'Stok Masuk')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title"><i data-lucide="plus" style="width: 24px; vertical-align: middle; margin-right: 8px;"></i> Stok Masuk</h1>
        <a href="{{ route('stock-management.index') }}" class="btn btn-primary"><i data-lucide="arrow-left" style="width: 18px; margin-right: 6px;"></i> Kembali</a>
    </div>

    <form action="{{ route('stock-management.store-in') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label">Cabang</label>
            <select name="branch_id" class="form-select" required>
                <option value="">-- Pilih Cabang --</option>
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}" {{ $branch->id == $activeBranchId ? 'selected' : '' }}>
                        {{ $branch->name }} ({{ $branch->code }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Barang</label>
            <select name="product_id" class="form-select" required>
                <option value="">-- Pilih Barang --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->nama }} ({{ $product->kode_barang }})</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Jumlah</label>
            <input type="number" name="qty" class="form-control" min="1" required>
        </div>
        <div class="form-group">
            <label class="form-label">Alasan</label>
            <input type="text" name="reason" class="form-control" placeholder="Contoh: Pembelian dari supplier">
        </div>
        <div class="form-group">
            <label class="form-label">Catatan</label>
            <textarea name="note" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-success"><i data-lucide="save" style="width: 18px; margin-right: 6px;"></i> Simpan Stok Masuk</button>
    </form>
</div>
@endsection
