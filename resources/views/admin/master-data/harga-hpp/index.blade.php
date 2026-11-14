@extends('layouts.admin')

@section('title', 'Harga HPP')

@section('content')
<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Master Data</li>
                    <li class="breadcrumb-item" aria-current="page">Harga HPP</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">Master Data Harga HPP</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->

<!-- Info Alert -->
<div class="row">
    <div class="col-12">
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="ti ti-info-circle me-2"></i>
            <strong>Keterangan:</strong> Semua harga HPP dalam satuan <strong>/pcs</strong> (per pieces)
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
</div>

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

    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5>Daftar Harga HPP</h5>
                <a href="{{ route('admin.harga-hpp.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus"></i> Tambah HPP
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="10%">No</th>
                                <th>Nama HPP</th>
                                <th width="20%">Harga (/pcs)</th>
                                <th width="15%">Dibuat</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($hargaHpps as $index => $hpp)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avtar avtar-s bg-light-success">
                                                    <i class="ti ti-currency-dollar"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-0">{{ $hpp->nama_hpp }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-primary">
                                            Rp {{ number_format($hpp->harga, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td>{{ $hpp->created_at->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.harga-hpp.edit', $hpp->id) }}" 
                                               class="btn btn-icon btn-link-warning" 
                                               title="Edit">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-icon btn-link-danger" 
                                                    title="Hapus"
                                                    onclick="confirmDelete({{ $hpp->id }})">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                            <form id="delete-form-{{ $hpp->id }}" 
                                                  action="{{ route('admin.harga-hpp.destroy', $hpp->id) }}" 
                                                  method="POST" 
                                                  class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="ti ti-currency-off f-40 d-block mb-2"></i>
                                        Belum ada data harga HPP
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
@endsection

@section('scripts')
<script>
function confirmDelete(id) {
    if (confirm('Yakin ingin menghapus harga HPP ini?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endsection
