@extends('layouts.sidebar')

@section('title', 'Tambah Vendor')

@section('content')
<div class="container">
    <h1>Tambah Vendor</h1>

    <form action="{{ route('vendor.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Vendor</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="contact_info" class="form-label">Informasi Kontak</label>
            <input type="text" class="form-control" id="contact_info" name="contact_info">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="address" name="address">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('vendor.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
