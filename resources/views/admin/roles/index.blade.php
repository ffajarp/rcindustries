@extends('layouts.admin')

@section('title', 'Role Management')

@section('content')
<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">Role Management</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">Role Management</h2>
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
                <h5>Daftar Role</h5>
                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus"></i> Tambah Role
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Role</th>
                                <th>Deskripsi</th>
                                <th>Jumlah User</th>
                                <th>Dibuat</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $index => $role)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avtar avtar-s bg-light-success">
                                                    <i class="ti ti-shield"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-0">{{ $role->nama_role }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $role->deskripsi ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-light-secondary">{{ $role->users_count }} user</span>
                                    </td>
                                    <td>{{ $role->created_at->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.roles.edit', $role->id) }}" 
                                               class="btn btn-icon btn-link-warning" 
                                               title="Edit">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            @if($role->users_count == 0)
                                                <button type="button" 
                                                        class="btn btn-icon btn-link-danger" 
                                                        title="Hapus"
                                                        onclick="confirmDelete({{ $role->id }})">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                                <form id="delete-form-{{ $role->id }}" 
                                                      action="{{ route('admin.roles.destroy', $role->id) }}" 
                                                      method="POST" 
                                                      class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @else
                                                <button class="btn btn-icon btn-link-secondary" 
                                                        disabled 
                                                        title="Tidak dapat dihapus (masih digunakan)">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        <i class="ti ti-shield-off f-40 d-block mb-2"></i>
                                        Belum ada data role
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
function confirmDelete(roleId) {
    if (confirm('Yakin ingin menghapus role ini?')) {
        document.getElementById('delete-form-' + roleId).submit();
    }
}
</script>
@endsection
