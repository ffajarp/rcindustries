@extends('layouts.admin')

@section('title', 'Edit Harga HPP')

@section('content')
<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Master Data</li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.harga-hpp.index') }}">Harga HPP</a></li>
                    <li class="breadcrumb-item" aria-current="page">Edit</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">Edit Harga HPP</h2>
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
                <h5>Form Edit Harga HPP</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.harga-hpp.update', $hargaHpp->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Nama HPP -->
                    <div class="mb-3">
                        <label class="form-label">Nama HPP <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('nama_hpp') is-invalid @enderror" 
                               name="nama_hpp" 
                               value="{{ old('nama_hpp', $hargaHpp->nama_hpp) }}"
                               placeholder="Contoh: Kain Cotton, Benang, Kancing, dll"
                               required>
                        @error('nama_hpp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Harga -->
                    <div class="mb-3">
                        <label class="form-label">Harga (/pcs) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" 
                                   class="form-control @error('harga') is-invalid @enderror" 
                                   name="harga" 
                                   value="{{ old('harga', $hargaHpp->harga) }}"
                                   placeholder="Contoh: 5000"
                                   step="0.01"
                                   min="0"
                                   required>
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="text-muted">Harga dalam satuan per pieces (pcs)</small>
                    </div>

                    <!-- Info Alert -->
                    <div class="alert alert-info" role="alert">
                        <i class="ti ti-info-circle me-2"></i>
                        <strong>Catatan:</strong> Semua harga HPP dihitung dalam satuan <strong>/pcs</strong>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-device-floppy me-2"></i>Update
                        </button>
                        <a href="{{ route('admin.harga-hpp.index') }}" class="btn btn-secondary">
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
                    Perubahan harga HPP akan mempengaruhi kalkulasi biaya produksi untuk order baru.
                </p>
                <hr>
                <p class="text-sm mb-0">
                    <strong>Catatan:</strong> Pastikan harga HPP sesuai dengan harga pasar terkini.
                </p>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
@endsection
