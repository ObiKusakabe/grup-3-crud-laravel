@extends('layouts.app')

@section('title', 'Tambah Cabang')

@section('content')
<div class="page-header">
    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('branches.index') }}" class="btn btn-secondary btn-icon" title="Kembali">
            <i data-lucide="arrow-left" style="width: 16px;"></i> Kembali
        </a>
        <div>
            <h1 class="page-title">Tambah Cabang</h1>
            <p class="page-subtitle">Buat data cabang baru</p>
        </div>
    </div>
</div>

<div class="card" style="max-width: 600px; padding: 24px;">
    <form action="{{ route('branches.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label class="form-label">Nama Cabang</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Kode Cabang</label>
            <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}" required>
            @error('code')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label d-block">Status Aktif</label>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" name="is_active" id="flexSwitchCheckChecked" checked value="1" style="cursor: pointer;">
                <label class="form-check-label" for="flexSwitchCheckChecked" style="cursor: pointer;">Cabang ini aktif beroperasi</label>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2 mt-4">
            <a href="{{ route('branches.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-success fw-bold">Simpan Cabang</button>
        </div>
    </form>
</div>
@endsection
