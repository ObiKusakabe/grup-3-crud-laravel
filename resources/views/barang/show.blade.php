@extends('layouts.app')

@section('title', 'Detail Barang')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Detail Barang</h1>
        <p class="page-subtitle">SKU: {{ $barang->kode_barang }}</p>
    </div>
    <a href="{{ route('barang.index') }}" class="btn btn-secondary" style="display: inline-flex; align-items: center; gap: 8px;">
        <i data-lucide="arrow-left" style="width: 16px;"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title" style="display: inline-flex; align-items: center; gap: 8px;">
            <i data-lucide="package" style="width: 20px; color: var(--on-surface-variant);"></i>
            Spesifikasi Produk
        </h2>
    </div>

    <div class="card-body" style="padding: 28px;">
        <div style="display: flex; flex-wrap: wrap; gap: 32px; align-items: flex-start;">
            
            <!-- Left Side: Image Presentation -->
            <div style="flex: 1; min-width: 240px; max-width: 280px;">
                @if($barang->foto)
                    <div style="border: 1px solid var(--outline-variant); border-radius: 12px; overflow: hidden; background: var(--surface-container-low); box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                        <img src="{{ asset('storage/' . $barang->foto) }}" alt="{{ $barang->nama }}" style="width: 100%; height: auto; display: block; object-fit: cover;">
                    </div>
                @else
                    <div style="border: 2px dashed var(--outline-variant); border-radius: 12px; height: 260px; background: var(--surface-container-low); display: flex; flex-direction: column; align-items: center; justify-content: center; color: var(--on-surface-variant); gap: 12px;">
                        <i data-lucide="image" style="width: 48px; height: 48px; stroke-width: 1.5; opacity: 0.6;"></i>
                        <span style="font-size: 13px; font-weight: 500;">Tidak ada foto produk</span>
                    </div>
                @endif
            </div>

            <!-- Right Side: Details Information -->
            <div style="flex: 2; min-width: 300px;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px 32px; margin-bottom: 32px;">
                    <div>
                        <p style="font-size: 11px; font-weight: 600; color: var(--on-surface-variant); text-transform: uppercase; margin-bottom: 4px; letter-spacing: 0.05em;">SKU</p>
                        <p style="font-family: var(--font-heading); font-size: 15px; font-weight: 700; color: var(--primary); margin: 0; letter-spacing: 0.5px;">{{ $barang->kode_barang }}</p>
                    </div>
                    <div>
                        <p style="font-size: 11px; font-weight: 600; color: var(--on-surface-variant); text-transform: uppercase; margin-bottom: 4px; letter-spacing: 0.05em;">Nama Produk</p>
                        <p style="font-size: 14px; font-weight: 600; color: var(--on-surface); margin: 0;">{{ $barang->nama }}</p>
                    </div>
                    <div>
                        <p style="font-size: 11px; font-weight: 600; color: var(--on-surface-variant); text-transform: uppercase; margin-bottom: 4px; letter-spacing: 0.05em;">Kategori</p>
                        <p style="font-size: 14px; font-weight: 500; color: var(--on-surface); margin: 0;">{{ $barang->kategori->nama ?? '-' }}</p>
                    </div>
                    <div>
                        <p style="font-size: 11px; font-weight: 600; color: var(--on-surface-variant); text-transform: uppercase; margin-bottom: 4px; letter-spacing: 0.05em;">Ukuran</p>
                        <p style="font-size: 14px; font-weight: 600; color: var(--on-surface); margin: 0;">{{ $barang->ukuran ?: '-' }}</p>
                    </div>
                    <div>
                        <p style="font-size: 11px; font-weight: 600; color: var(--on-surface-variant); text-transform: uppercase; margin-bottom: 4px; letter-spacing: 0.05em;">Harga Beli</p>
                        <p style="font-size: 14px; font-weight: 500; color: var(--on-surface); margin: 0;">Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p style="font-size: 11px; font-weight: 600; color: var(--on-surface-variant); text-transform: uppercase; margin-bottom: 4px; letter-spacing: 0.05em;">Harga Jual</p>
                        <p style="font-size: 14px; font-weight: 600; color: var(--on-surface); margin: 0;">Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</p>
                    </div>
                    <div style="grid-column: span 2; padding-top: 16px; border-top: 1px solid var(--outline-variant);">
                        <p style="font-size: 11px; font-weight: 600; color: var(--on-surface-variant); text-transform: uppercase; margin-bottom: 6px; letter-spacing: 0.05em;">Stok Saat Ini (Cabang Aktif)</p>
                        @php $stock = $barang->getStockForBranch(session('active_branch_id', 1)); @endphp
                        @if($stock <= 5)
                            <span class="badge badge-danger" style="font-size: 13px; padding: 6px 12px; font-weight: 600;">{{ $stock }} Pcs (Stok Menipis)</span>
                        @else
                            <span class="badge badge-success" style="font-size: 13px; padding: 6px 12px; font-weight: 600;">{{ $stock }} Pcs (Tersedia)</span>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div style="display: flex; gap: 12px; align-items: center;">
                    <a href="{{ route('barang.edit', $barang) }}" class="btn btn-warning" style="display: inline-flex; align-items: center; gap: 8px;">
                        <i data-lucide="edit" style="width: 16px;"></i> Edit Produk
                    </a>
                    <form action="{{ route('barang.destroy', $barang) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')" style="margin: 0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="display: inline-flex; align-items: center; gap: 8px;">
                            <i data-lucide="trash-2" style="width: 16px;"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection