@extends('layouts.app')

@section('title', 'Tambah Member')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title"><i data-lucide="users" style="width: 24px; vertical-align: middle; margin-right: 8px;"></i> Tambah Member</h1>
        <a href="{{ route('member.index') }}" class="btn btn-primary"><i data-lucide="arrow-left" style="width: 18px; margin-right: 6px;"></i> Kembali</a>
    </div>

    <form action="{{ route('member.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Telepon</label>
            <input type="text" name="telepon" class="form-control">
        </div>
        <div class="form-group">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="2"></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Diskon (%)</label>
            <input type="number" name="diskon_persen" class="form-control" value="0" min="0" max="100" step="0.01">
        </div>
        <button type="submit" class="btn btn-success"><i data-lucide="save" style="width: 18px; margin-right: 6px;"></i> Simpan</button>
    </form>
</div>
@endsection