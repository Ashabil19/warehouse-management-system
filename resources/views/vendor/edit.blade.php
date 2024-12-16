@extends('layouts.sidebar')

@section('title', 'Edit Vendor')

@section('content')
<div class="container">
    <h1>Edit Vendor</h1>

    <form action="{{ route('vendor.update', $vendor->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nama Vendor</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $vendor->name }}" required>
        </div>
        <div class="mb-3">
            <label for="contact_info" class="form-label">Informasi Kontak</label>
            <input type="text" class="form-control" id="contact_info" name="contact_info" value="{{ $vendor->contact_info }}">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $vendor->address }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('vendor.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
