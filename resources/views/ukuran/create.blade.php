@extends('layouts.app')

@section('title', 'Tambah Ukuran')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title"><i data-lucide="ruler" style="width: 24px; vertical-align: middle; margin-right: 8px;"></i> Tambah Ukuran</h1>
        <a href="{{ route('ukuran.index') }}" class="btn btn-primary"><i data-lucide="arrow-left" style="width: 18px; margin-right: 6px;"></i> Kembali</a>
    </div>

    <form action="{{ route('ukuran.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label">Nama Ukuran</label>
            <input type="text" name="nama" class="form-control" placeholder="S, M, L, XL, XXL" required>
        </div>
        <button type="submit" class="btn btn-success"><i data-lucide="save" style="width: 18px; margin-right: 6px;"></i> Simpan</button>
    </form>
</div>
@endsection