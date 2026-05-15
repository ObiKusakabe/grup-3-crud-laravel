@extends('layouts.app')

@section('title', 'Edit Ukuran')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title"><i data-lucide="ruler" style="width: 24px; vertical-align: middle; margin-right: 8px;"></i> Edit Ukuran</h1>
        <a href="{{ route('ukuran.index') }}" class="btn btn-primary"><i data-lucide="arrow-left" style="width: 18px; margin-right: 6px;"></i> Kembali</a>
    </div>

    <form action="{{ route('ukuran.update', $ukuran) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $ukuran->nama }}" required>
        </div>
        <button type="submit" class="btn btn-success"><i data-lucide="save" style="width: 18px; margin-right: 6px;"></i> Update</button>
    </form>
</div>
@endsection