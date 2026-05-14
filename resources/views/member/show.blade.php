@extends('layouts.app')
@section('title', 'Detail Member')
@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Detail Member</h2>
        <a href="{{ route('member.index') }}" class="btn btn-warning">Kembali</a>
    </div>
    <p><strong>Nama:</strong> {{ $member->nama }}</p>
    <p><strong>Telepon:</strong> {{ $member->telepon ?? '-' }}</p>
    <p><strong>Alamat:</strong> {{ $member->alamat ?? '-' }}</p>
    <p><strong>Diskon:</strong> {{ $member->diskon_persen }}%</p>
</div>
@endsection