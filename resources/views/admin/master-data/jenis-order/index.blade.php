@extends('layouts.admin')

@section('title', 'Jenis Order')

@section('content')
<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Master Data</li>
                    <li class="breadcrumb-item" aria-current="page">Jenis Order</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">Master Data Jenis Order</h2>
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

    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5>Daftar Jenis Order</h5>
                <a href="{{ route('admin.jenis-order.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus"></i> Tambah Jenis Order
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="10%">No</th>
                                <th>Nama Jenis Order</th>
                                <th width="15%">Dibuat</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jenisOrders as $index => $jenisOrder)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avtar avtar-s bg-light-primary">
                                                    <i class="ti ti-file-invoice"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-0">{{ $jenisOrder->nama_jenis }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $jenisOrder->created_at->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.jenis-order.edit', $jenisOrder->id) }}" 
                                               class="btn btn-icon btn-link-warning" 
                                               title="Edit">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-icon btn-link-danger" 
                                                    title="Hapus"
                                                    onclick="confirmDelete({{ $jenisOrder->id }})">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                            <form id="delete-form-{{ $jenisOrder->id }}" 
                                                  action="{{ route('admin.jenis-order.destroy', $jenisOrder->id) }}" 
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
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        <i class="ti ti-file-off f-40 d-block mb-2"></i>
                                        Belum ada data jenis order
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
    if (confirm('Yakin ingin menghapus jenis order ini?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endsection
