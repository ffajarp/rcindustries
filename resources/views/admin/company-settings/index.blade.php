@extends('layouts.admin')

@section('title', 'Company Settings')

@section('styles')
<style>
.logo-preview {
    max-width: 200px;
    max-height: 200px;
    object-fit: contain;
    border: 2px dashed #ddd;
    padding: 10px;
    border-radius: 8px;
}
</style>
@endsection

@section('content')
<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">Company Settings</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">Informasi Perusahaan</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->

<!-- [ Main Content ] start -->
<div class="row">
    <!-- Alert Messages -->
    @if(session('success'))
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="ti ti-check me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="ti ti-alert-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Setting Informasi Perusahaan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.company-settings.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <!-- Nama Perusahaan -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('nama_perusahaan') is-invalid @enderror" 
                                       name="nama_perusahaan" 
                                       value="{{ old('nama_perusahaan', $setting->nama_perusahaan ?? '') }}"
                                       placeholder="Masukkan nama perusahaan"
                                       required>
                                @error('nama_perusahaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Logo Perusahaan -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Logo Perusahaan</label>
                                <input type="file" 
                                       class="form-control @error('logo') is-invalid @enderror" 
                                       name="logo" 
                                       accept="image/*"
                                       onchange="previewLogo(event)">
                                <small class="text-muted">Format: JPG, PNG, SVG. Maksimal 2MB</small>
                                @error('logo')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                
                                <!-- Preview Logo -->
                                @if(isset($setting->logo) && $setting->logo)
                                    <div class="mt-3">
                                        <img src="{{ asset('storage/' . $setting->logo) }}" 
                                             alt="Logo" 
                                             class="logo-preview" 
                                             id="logo-preview">
                                    </div>
                                @else
                                    <div class="mt-3 d-none" id="logo-preview-container">
                                        <img src="" alt="Logo Preview" class="logo-preview" id="logo-preview">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Telepon/WhatsApp (Multiple) -->
                    <div class="mb-3">
                        <label class="form-label">Telepon / WhatsApp <span class="text-danger">*</span></label>
                        <div id="telepon-container">
                            @if(isset($setting->telepon) && is_array($setting->telepon))
                                @foreach($setting->telepon as $index => $telp)
                                    <div class="input-group mb-2 telepon-item">
                                        <span class="input-group-text"><i class="ti ti-phone"></i></span>
                                        <input type="text" 
                                               class="form-control" 
                                               name="telepon[]" 
                                               value="{{ $telp }}"
                                               placeholder="Contoh: 08123456789"
                                               required>
                                        @if($index > 0)
                                            <button type="button" class="btn btn-danger" onclick="removeField(this)">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="input-group mb-2 telepon-item">
                                    <span class="input-group-text"><i class="ti ti-phone"></i></span>
                                    <input type="text" 
                                           class="form-control" 
                                           name="telepon[]" 
                                           value="{{ old('telepon.0') }}"
                                           placeholder="Contoh: 08123456789"
                                           required>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addTelepon()">
                            <i class="ti ti-plus me-1"></i> Tambah Telepon
                        </button>
                    </div>

                    <!-- Alamat -->
                    <div class="mb-3">
                        <label class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                  name="alamat" 
                                  rows="3"
                                  placeholder="Masukkan alamat lengkap perusahaan"
                                  required>{{ old('alamat', $setting->alamat ?? '') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Rekening Bank (Multiple) -->
                    <div class="mb-3">
                        <label class="form-label">Nomor Rekening Bank <span class="text-danger">*</span></label>
                        <div id="rekening-container">
                            @if(isset($setting->rekening_bank) && is_array($setting->rekening_bank))
                                @foreach($setting->rekening_bank as $index => $rekening)
                                    <div class="input-group mb-2 rekening-item">
                                        <span class="input-group-text"><i class="ti ti-building-bank"></i></span>
                                        <input type="text" 
                                               class="form-control" 
                                               name="rekening_bank[]" 
                                               value="{{ $rekening }}"
                                               placeholder="Contoh: BCA - 1234567890 - PT RC Cloth"
                                               required>
                                        @if($index > 0)
                                            <button type="button" class="btn btn-danger" onclick="removeField(this)">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="input-group mb-2 rekening-item">
                                    <span class="input-group-text"><i class="ti ti-building-bank"></i></span>
                                    <input type="text" 
                                           class="form-control" 
                                           name="rekening_bank[]" 
                                           value="{{ old('rekening_bank.0') }}"
                                           placeholder="Contoh: BCA - 1234567890 - PT RC Cloth"
                                           required>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addRekening()">
                            <i class="ti ti-plus me-1"></i> Tambah Rekening
                        </button>
                    </div>

                    <!-- Template Pesan WhatsApp -->
                    <div class="mb-3">
                        <label class="form-label">Template Pesan WhatsApp</label>
                        <textarea class="form-control @error('template_wa') is-invalid @enderror" 
                                  name="template_wa" 
                                  rows="4"
                                  placeholder="Contoh: Halo {nama_pemesan}, terima kasih telah memesan di {nama_perusahaan}. Berikut invoice Anda: {link_invoice}">{{ old('template_wa', $setting->template_wa ?? '') }}</textarea>
                        <small class="text-muted">
                            <strong>Variabel yang bisa digunakan:</strong><br>
                            <code>{nama_pemesan}</code> - Nama pemesan<br>
                            <code>{nama_perusahaan}</code> - Nama perusahaan<br>
                            <code>{link_invoice}</code> - Link invoice order<br>
                            <code>{telepon}</code> - Nomor telepon pemesan
                        </small>
                        @error('template_wa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-device-floppy me-2"></i>Simpan Setting
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
@endsection

@section('scripts')
<script>
// Fungsi untuk menambah input telepon
function addTelepon() {
    const container = document.getElementById('telepon-container');
    const newField = `
        <div class="input-group mb-2 telepon-item">
            <span class="input-group-text"><i class="ti ti-phone"></i></span>
            <input type="text" 
                   class="form-control" 
                   name="telepon[]" 
                   placeholder="Contoh: 08123456789"
                   required>
            <button type="button" class="btn btn-danger" onclick="removeField(this)">
                <i class="ti ti-trash"></i>
            </button>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', newField);
}

// Fungsi untuk menambah input rekening bank
function addRekening() {
    const container = document.getElementById('rekening-container');
    const newField = `
        <div class="input-group mb-2 rekening-item">
            <span class="input-group-text"><i class="ti ti-building-bank"></i></span>
            <input type="text" 
                   class="form-control" 
                   name="rekening_bank[]" 
                   placeholder="Contoh: BCA - 1234567890 - PT RC Cloth"
                   required>
            <button type="button" class="btn btn-danger" onclick="removeField(this)">
                <i class="ti ti-trash"></i>
            </button>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', newField);
}

// Fungsi untuk menghapus field
function removeField(button) {
    button.closest('.input-group').remove();
}

// Preview logo sebelum upload
function previewLogo(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('logo-preview');
    const container = document.getElementById('logo-preview-container');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            if (container) {
                container.classList.remove('d-none');
            }
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection
