@extends('layouts.admin')

@section('title', 'Edit Jenis Order')

@section('content')
<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Master Data</li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.jenis-order.index') }}">Jenis Order</a></li>
                    <li class="breadcrumb-item" aria-current="page">Edit</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">Edit Jenis Order</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->

<!-- [ Main Content ] start -->
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Form Edit Jenis Order</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.jenis-order.update', $jenisOrder->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Nama Jenis Order -->
                    <div class="mb-3">
                        <label class="form-label">Nama Jenis Order <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('nama_jenis') is-invalid @enderror" 
                               name="nama_jenis" 
                               value="{{ old('nama_jenis', $jenisOrder->nama_jenis) }}"
                               placeholder="Contoh: Full Order, Makloon Jahit, dll"
                               required>
                        @error('nama_jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-device-floppy me-2"></i>Update
                        </button>
                        <a href="{{ route('admin.jenis-order.index') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Info Card -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Informasi</h5>
            </div>
            <div class="card-body">
                <p class="text-sm mb-3">
                    Perubahan nama jenis order akan mempengaruhi semua order yang menggunakan jenis ini.
                </p>
                <hr>
                <p class="text-sm mb-0">
                    <strong>Catatan:</strong> Pastikan nama jenis order sesuai dengan standar yang digunakan.
                </p>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
@endsection
