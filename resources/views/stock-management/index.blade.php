@extends('layouts.app')

@section('title', 'Manajemen Stok')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title"><i data-lucide="inbox" style="width: 24px; vertical-align: middle; margin-right: 8px;"></i> Manajemen Stok</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('stock-management.create-in') }}" class="btn btn-success"><i data-lucide="plus" style="width: 18px; margin-right: 6px;"></i> Stok Masuk</a>
            <a href="{{ route('stock-management.create-out') }}" class="btn btn-warning"><i data-lucide="minus" style="width: 18px; margin-right: 6px;"></i> Stok Keluar</a>
        </div>
    </div>

    <div class="card-body" style="margin-bottom: 20px;">
        <form action="{{ route('stock-management.set-branch') }}" method="POST">
            @csrf
            <div class="d-flex align-center gap-2">
                <label>Cabang Aktif:</label>
                <select name="branch_id" class="form-select" style="width: auto;">
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}" {{ $branch->id == $activeBranchId ? 'selected' : '' }}>
                            {{ $branch->name }} ({{ $branch->code }})
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary btn-sm">Ubah</button>
            </div>
        </form>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Barang</th>
                <th>Cabang</th>
                <th>Tipe</th>
                <th>Jumlah</th>
                <th>Alasan</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($movements as $movement)
            <tr>
                <td>{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $movement->product->nama }}</td>
                <td>{{ $movement->branch->name }}</td>
                <td>
                    @if($movement->type == 'IN')
                        <span class="badge badge-success">MASUK</span>
                    @else
                        <span class="badge badge-danger">KELUAR</span>
                    @endif
                </td>
                <td>{{ $movement->qty }}</td>
                <td>{{ $movement->reason ?: '-' }}</td>
                <td>{{ $movement->note ?: '-' }}</td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center">Belum ada pergerakan stok</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $movements->links() }}
</div>
@endsection
