@extends('layouts.app')

@section('title', 'Edit Pegawai')

@section('content')
<div class="page-header">
    <div style="display: flex; align-items: center; gap: 16px;">
        <a href="{{ route('employees.index') }}" class="btn btn-secondary" style="padding: 8px 14px;">
            <i data-lucide="arrow-left" style="width: 16px;"></i> Kembali
        </a>
        <div>
            <p class="page-label">Manajemen</p>
            <h1 class="page-title">Edit Pegawai</h1>
            <p class="page-subtitle">{{ $employee->name }}</p>
        </div>
    </div>
</div>

<div class="card" style="max-width: 600px;">
    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $employee->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', $employee->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Role</label>
            <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                <option value="">-- Pilih Role --</option>
                <option value="pos" {{ old('role', $employee->role) === 'pos' ? 'selected' : '' }}>POS / Kasir</option>
                <option value="inventaris" {{ old('role', $employee->role) === 'inventaris' ? 'selected' : '' }}>Inventaris</option>
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Password Baru <span style="color: var(--outline); font-weight: 400;">(Kosongkan jika tidak ingin mengubah)</span></label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
            <small style="color: var(--outline); margin-top: 4px; display: block;">Minimal 8 karakter</small>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        @if (!empty(old('password')))
            <div class="form-group">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control">
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        @endif

        <div class="card-footer" style="display: flex; gap: 10px; padding: 16px 24px; background: var(--surface-container-low); border-top: 1px solid var(--outline-variant);">
            <button type="submit" class="btn btn-primary">
                <i data-lucide="save" style="width: 16px;"></i> Simpan Perubahan
            </button>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
