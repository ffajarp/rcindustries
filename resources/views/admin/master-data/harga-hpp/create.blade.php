@extends('layouts.admin')

@section('title', 'Tambah Harga HPP')

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
                    <li class="breadcrumb-item" aria-current="page">Tambah</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">Tambah Harga HPP</h2>
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
                <h5>Form Tambah Harga HPP</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.harga-hpp.store') }}" method="POST">
                    @csrf
                    
                    <!-- Nama HPP -->
                    <div class="mb-3">
                        <label class="form-label">Nama HPP <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('nama_hpp') is-invalid @enderror" 
                               name="nama_hpp" 
                               value="{{ old('nama_hpp') }}"
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
                                   value="{{ old('harga') }}"
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
                            <i class="ti ti-device-floppy me-2"></i>Simpan
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
                    HPP (Harga Pokok Penjualan) adalah biaya yang dikeluarkan untuk memproduksi satu unit produk.
                </p>
                <hr>
                <p class="text-sm mb-2">
                    <strong>Contoh HPP:</strong>
                </p>
                <ul class="text-sm">
                    <li>Kain Cotton - Rp 15.000/pcs</li>
                    <li>Benang - Rp 500/pcs</li>
                    <li>Kancing - Rp 200/pcs</li>
                    <li>Label Merk - Rp 1.000/pcs</li>
                    <li>Biaya Jahit - Rp 5.000/pcs</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
@endsection
