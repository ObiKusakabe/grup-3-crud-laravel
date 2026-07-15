@extends('layouts.app')

@section('title', 'Edit Cabang')

@section('content')
<div class="page-header">
    <div style="display: flex; align-items: center; gap: 16px;">
        <a href="{{ route('branches.index') }}" class="btn btn-secondary" style="padding: 8px 14px;">
            <i data-lucide="arrow-left" style="width: 16px;"></i> Kembali
        </a>
        <div>
            <h1 class="page-title">Edit Cabang</h1>
            <p class="page-subtitle">{{ $branch->name }} ({{ $branch->code }})</p>
        </div>
    </div>
</div>

<div class="card" style="max-width: 600px;">
    <form action="{{ route('branches.update', $branch->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label">Nama Cabang</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $branch->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Kode Cabang</label>
            <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                   value="{{ old('code', $branch->code) }}" required>
            @error('code')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label d-block">Status Aktif</label>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" name="is_active"
                       id="flexSwitchCheckChecked" value="1"
                       {{ old('is_active', $branch->is_active) ? 'checked' : '' }} style="cursor: pointer;">
                <label class="form-check-label" for="flexSwitchCheckChecked" style="cursor: pointer;">
                    Cabang ini aktif beroperasi
                </label>
            </div>
        </div>

        <div class="card-footer" style="display: flex; gap: 10px; padding: 16px 24px; background: var(--surface-container-low); border-top: 1px solid var(--outline-variant);">
            <button type="submit" class="btn btn-primary">
                <i data-lucide="save" style="width: 16px;"></i> Simpan Perubahan
            </button>
            <a href="{{ route('branches.index') }}" class="btn btn-secondary">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection