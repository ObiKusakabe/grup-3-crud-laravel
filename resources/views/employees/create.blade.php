@extends('layouts.app')

@section('title', 'Tambah Pegawai')

@section('content')
<div class="page-header">
    <div style="display: flex; align-items: center; gap: 16px;">
        <a href="{{ route('employees.index') }}" class="btn btn-secondary" style="padding: 8px 14px;">
            <i data-lucide="arrow-left" style="width: 16px;"></i> Kembali
        </a>
        <div>
            <p class="page-label">Manajemen</p>
            <h1 class="page-title">Tambah Pegawai</h1>
            <p class="page-subtitle">Buat akun baru untuk pegawai</p>
        </div>
    </div>
</div>

<div class="card" style="max-width: 600px;">
    <form action="{{ route('employees.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Role</label>
            <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                <option value="">-- Pilih Role --</option>
                <option value="pos" {{ old('role') === 'pos' ? 'selected' : '' }}>POS / Kasir</option>
                <option value="inventaris" {{ old('role') === 'inventaris' ? 'selected' : '' }}>Inventaris</option>
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
            <small style="color: var(--outline); margin-top: 4px; display: block;">Minimal 8 karakter</small>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="card-footer" style="display: flex; gap: 10px; padding: 16px 24px; background: var(--surface-container-low); border-top: 1px solid var(--outline-variant);">
            <button type="submit" class="btn btn-primary">
                <i data-lucide="user-plus" style="width: 16px;"></i> Tambah Pegawai
            </button>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
