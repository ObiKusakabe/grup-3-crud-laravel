@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('content')
<div class="page-header">
    <div>
        <p class="page-label">Inventaris</p>
        <h1 class="page-title">Daftar Barang</h1>
        <p class="page-subtitle">Kelola seluruh produk dan barang yang tersedia</p>
    </div>
    <a href="{{ route('barang.create') }}" class="btn btn-success">
        <i data-lucide="plus" style="width: 16px;"></i> Tambah Barang
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga Jual</th>
                    <th>Stok (Cabang Aktif)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barang as $b)
                <tr>
                    <td style="width: 70px;">
                        @if($b->foto)
                            <img src="{{ asset('storage/' . $b->foto) }}" alt="{{ $b->nama }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;">
                        @else
                            <div style="width: 50px; height: 50px; background: #f8f9fa; border-radius: 4px; border: 1px dashed #ddd; display: flex; align-items: center; justify-content: center;">
                                <i data-lucide="image" style="width: 20px; color: #bbb;"></i>
                            </div>
                        @endif
                    </td>
                    <td>{{ $b->kode_barang }}</td>
                    <td>{{ $b->nama }}</td>
                    <td>{{ $b->kategori->nama ?? '-' }}</td>
                    <td>Rp {{ number_format($b->harga_jual, 0, ',', '.') }}</td>
                    <td>
                        @php $stock = $b->getStockForBranch(session('active_branch_id', 1)); @endphp
                        @if($stock <= 5)
                            <span class="badge badge-danger">{{ $stock }}</span>
                        @else
                            <span class="badge badge-success">{{ $stock }}</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('barang.show', $b) }}" class="btn btn-sm btn-primary"><i data-lucide="eye" style="width: 16px;"></i></a>
                            <a href="{{ route('barang.edit', $b) }}" class="btn btn-sm btn-warning"><i data-lucide="edit" style="width: 16px;"></i></a>
                            <form action="{{ route('barang.destroy', $b) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i data-lucide="trash-2" style="width: 16px;"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center" style="padding: 32px; color: var(--outline);">Belum ada barang</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection