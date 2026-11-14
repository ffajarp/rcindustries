@extends('layouts.admin')

@section('title', 'Edit Role')

@section('content')
<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Role Management</a></li>
                    <li class="breadcrumb-item" aria-current="page">Edit Role</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">Edit Role</h2>
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
                <h5>Form Edit Role</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Nama Role -->
                    <div class="mb-3">
                        <label class="form-label">Nama Role <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('nama_role') is-invalid @enderror" 
                               name="nama_role" 
                               value="{{ old('nama_role', $role->nama_role) }}"
                               placeholder="Contoh: Manager, Kasir, dll"
                               required>
                        @error('nama_role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                  name="deskripsi" 
                                  rows="4"
                                  placeholder="Deskripsi singkat tentang role ini (opsional)">{{ old('deskripsi', $role->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Info -->
                    <div class="alert alert-info" role="alert">
                        <i class="ti ti-info-circle me-2"></i>
                        Role ini saat ini digunakan oleh <strong>{{ $role->users()->count() }} user</strong>.
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-device-floppy me-2"></i>Update
                        </button>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
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
                    Perubahan nama role akan mempengaruhi semua user yang memiliki role ini.
                </p>
                <hr>
                <p class="text-sm mb-0">
                    <strong>Catatan:</strong> Role yang masih digunakan oleh user tidak dapat dihapus.
                </p>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
@endsection
