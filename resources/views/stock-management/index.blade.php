@extends('layouts.app')

@section('title', 'Manajemen Stok')

@section('content')
<div class="page-header">
    <div>
        <p class="page-label">Inventaris</p>
        <h1 class="page-title">Manajemen Stok</h1>
        <p class="page-subtitle">Pantau dan perbarui stok barang per cabang</p>
    </div>
</div>

<div class="card">

    <!-- Search and Branch Filter -->
    <div class="card-body" style="padding-bottom: 0;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-bottom: 20px;">
            <!-- Search bar -->
            <form action="{{ route('stock-management.index') }}" method="GET" style="display: flex; gap: 8px; flex: 1; max-width: 400px; margin: 0;">
                <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-secondary btn-icon" title="Cari">
                    <i data-lucide="search" style="width: 18px;"></i>
                </button>
            </form>

            <!-- Branch selector -->
            <form action="{{ route('stock-management.set-branch') }}" method="POST" style="margin: 0;">
                @csrf
                <div class="d-flex align-center gap-2">
                    <label class="form-label" style="margin: 0; white-space: nowrap;">Cabang Aktif:</label>
                    <select name="branch_id" class="form-select" style="width: auto;" onchange="this.form.submit()">
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" {{ $branch->id == $activeBranchId ? 'selected' : '' }}>
                                {{ $branch->name }} ({{ $branch->code }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Produk</th>
                    <th>Cabang</th>
                    <th>Stok</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $activeBranch = $branches->firstWhere('id', $activeBranchId);
                @endphp
                @forelse($products as $product)
                <tr>
                    <td style="width: 70px;">
                        @if($product->foto)
                            <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;">
                        @else
                            <div style="width: 50px; height: 50px; background: #f8f9fa; border-radius: 4px; border: 1px dashed #ddd; display: flex; align-items: center; justify-content: center;">
                                <i data-lucide="image" style="width: 20px; color: #bbb;"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <strong style="color: var(--primary);">{{ $product->nama }}</strong>
                        <div style="font-size: 12px; color: var(--outline);">{{ $product->kode_barang }}</div>
                    </td>
                    <td>
                        <span>{{ $activeBranch?->name ?? '-' }}</span>
                        <div style="font-size: 12px; color: var(--outline);">{{ $activeBranch?->code ?? '-' }}</div>
                    </td>
                    <td>
                        @php
                            $stock = $product->getStockForBranch($activeBranchId);
                        @endphp
                        @if($stock <= 5)
                            <span class="badge badge-danger">{{ $stock }}</span>
                        @else
                            <span class="badge badge-success">{{ $stock }}</span>
                        @endif
                    </td>
                    <td class="text-right">
                        <button type="button" class="btn btn-secondary btn-sm" onclick="openUpdateModal({{ $product->id }}, '{{ addslashes($product->nama) }}', {{ $stock }})">
                            <i data-lucide="plus" style="width: 14px; margin-right: 4px;"></i> Update
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center" style="padding: 32px; color: var(--outline);">
                        Belum ada barang terdaftar
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="padding: 16px 24px;">
        {{ $products->appends(request()->query())->links() }}
    </div>
</div>

<!-- ===== UPDATE STOCK MODAL ===== -->
<div class="modal-backdrop" id="updateModalBackdrop" onclick="closeUpdateModal()"></div>
<div class="card modal-box" id="updateModalBox" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1000; width: 90%; max-width: 480px; box-shadow: 0 10px 25px rgba(0,0,0,0.15);">
    <div class="card-header">
        <h3 class="card-title">Update Stok</h3>
        <button type="button" class="btn btn-icon btn-sm" onclick="closeUpdateModal()" style="border: none; background: none;">✕</button>
    </div>
    <form action="{{ route('stock-management.update-stock') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" id="modal_product_id">
        
        <div class="card-body">
            <!-- Product Information -->
            <div style="background: var(--surface-container-low); padding: 12px; border-radius: 6px; margin-bottom: 16px;">
                <div style="font-size: 12px; color: var(--on-surface-variant); margin-bottom: 2px;">Barang</div>
                <strong id="modal_product_name" style="font-size: 15px; color: var(--primary);"></strong>
                <div style="font-size: 13px; color: var(--on-surface-variant); margin-top: 4px;">
                    Stok Saat Ini: <span id="modal_current_stock" style="font-weight: 600;"></span> Pcs
                </div>
            </div>

            <!-- Tipe Perubahan -->
            <div class="form-group" style="margin: 0 0 16px 0;">
                <label class="form-label">Tipe Perubahan</label>
                <div style="display: flex; gap: 16px; margin-top: 4px;">
                    <label style="display: inline-flex; align-items: center; gap: 6px; cursor: pointer;">
                        <input type="radio" name="type" value="IN" checked>
                        <span>Tambah (+ Stok Masuk)</span>
                    </label>
                    <label style="display: inline-flex; align-items: center; gap: 6px; cursor: pointer;">
                        <input type="radio" name="type" value="OUT">
                        <span>Kurang (- Stok Keluar)</span>
                    </label>
                </div>
            </div>

            <!-- Jumlah -->
            <div class="form-group" style="margin: 0 0 16px 0;">
                <label class="form-label" for="modal_qty">Jumlah Pcs</label>
                <input type="number" name="qty" id="modal_qty" class="form-control" min="1" value="1" required>
            </div>

            <!-- Alasan -->
            <div class="form-group" style="margin: 0 0 16px 0;">
                <label class="form-label" for="modal_reason">Alasan Perubahan</label>
                <select name="reason" id="modal_reason" class="form-select" required>
                    <option value="">-- Pilih Alasan --</option>
                    <option value="Restock">Restock / Pembelian</option>
                    <option value="Penyesuaian Stok">Penyesuaian Stok Opname</option>
                    <option value="Barang Rusak">Barang Rusak / Cacat</option>
                    <option value="Retur">Retur Penjualan / Supplier</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <!-- Catatan -->
            <div class="form-group" style="margin: 0;">
                <label class="form-label" for="modal_note">Catatan Tambahan (Opsional)</label>
                <textarea name="note" id="modal_note" class="form-control" rows="2" placeholder="Masukkan catatan..."></textarea>
            </div>
        </div>

        <div class="card-footer" style="display: flex; justify-content: flex-end; gap: 8px; background: var(--surface-container-low); padding: 12px 24px;">
            <button type="button" class="btn btn-secondary" onclick="closeUpdateModal()">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>

<!-- Modal CSS Backdrop -->
<style>
    .modal-backdrop {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.4);
        z-index: 999;
    }
    .modal-backdrop.active {
        display: block;
    }
</style>

<script>
    function openUpdateModal(productId, productName, currentStock) {
        document.getElementById('modal_product_id').value = productId;
        document.getElementById('modal_product_name').textContent = productName;
        document.getElementById('modal_current_stock').textContent = currentStock;
        document.getElementById('modal_qty').value = 1;
        document.getElementById('modal_reason').value = '';
        document.getElementById('modal_note').value = '';
        
        // Show modal
        document.getElementById('updateModalBackdrop').classList.add('active');
        document.getElementById('updateModalBox').style.display = 'block';
    }

    function closeUpdateModal() {
        document.getElementById('updateModalBackdrop').classList.remove('active');
        document.getElementById('updateModalBox').style.display = 'none';
    }
</script>
@endsection
