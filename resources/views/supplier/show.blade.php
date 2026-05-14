@extends('layouts.app')
@section('title', 'Detail Supplier')
@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Detail Supplier</h2>
        <a href="{{ route('supplier.index') }}" class="btn btn-warning">Kembali</a>
    </div>
    <p><strong>Nama:</strong> {{ $supplier->nama }}</p>
    <p><strong>Telepon:</strong> {{ $supplier->telepon ?? '-' }}</p>
    <p><strong>Alamat:</strong> {{ $supplier->alamat ?? '-' }}</p>
</div>
@endsection