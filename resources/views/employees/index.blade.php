@extends('layouts.app')

@section('title', 'Kelola Akun Pegawai')

@section('content')
<div class="page-header">
    <div>
        <p class="page-label">Manajemen</p>
        <h1 class="page-title">Kelola Akun Pegawai</h1>
        <p class="page-subtitle">Manajemen akun pegawai perusahaan anda</p>
    </div>
    <a href="{{ route('employees.create') }}" class="btn btn-success">
        <i data-lucide="plus" style="width: 16px;"></i> Tambah Pegawai
    </a>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($employees as $employee)
                    <tr>
                        <td>
                            <strong>{{ $employee->name }}</strong>
                        </td>
                        <td>{{ $employee->email }}</td>
                        <td>
                            <span style="
                                display: inline-block;
                                padding: 4px 12px;
                                border-radius: 4px;
                                font-size: 12px;
                                font-weight: 600;
                                @if($employee->role === 'admin')
                                    background-color: #e8f5e9;
                                    color: #2e7d32;
                                @elseif($employee->role === 'pos')
                                    background-color: #e3f2fd;
                                    color: #1565c0;
                                @else
                                    background-color: #fff3e0;
                                    color: #e65100;
                                @endif
                            ">
                                {{ ucfirst($employee->role) }}
                            </span>
                        </td>
                        <td>
                            <span style="
                                display: inline-block;
                                padding: 4px 12px;
                                border-radius: 4px;
                                font-size: 12px;
                                background-color: #e8f5e9;
                                color: #2e7d32;
                            ">
                                Aktif
                            </span>
                        </td>
                        <td>{{ $employee->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-warning">
                                    <i data-lucide="edit" style="width: 16px;"></i>
                                </a>
                                @if ($employee->id !== auth()->id())
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus pegawai ini?');">
                                            <i data-lucide="trash-2" style="width: 16px;"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center" style="padding: 32px; color: var(--outline);">
                            Belum ada pegawai. <a href="{{ route('employees.create') }}">Tambah pegawai</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
