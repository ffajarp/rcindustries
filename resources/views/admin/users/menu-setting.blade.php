@extends('layouts.admin')

@section('title', 'Setting Menu User')

@section('content')
<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">User Management</a></li>
                    <li class="breadcrumb-item" aria-current="page">Setting Menu</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">Setting Menu User</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->

<!-- [ Main Content ] start -->
<div class="row">
    <!-- User Info Card -->
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header">
                <h5>Informasi User</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Username:</strong> {{ $user->username }}</p>
                        <p class="mb-2"><strong>Nama:</strong> {{ $user->nama }}</p>
                        <p class="mb-0"><strong>Role:</strong> <span class="badge bg-light-info">{{ $user->role->nama_role }}</span></p>
                    </div>
                </div>

                @if($user->is_super_admin)
                    <div class="alert alert-info mt-3 mb-0" role="alert">
                        <i class="ti ti-info-circle me-2"></i>
                        <strong>Admin Super</strong> memiliki akses penuh ke semua menu secara otomatis.
                        Setting menu tidak berlaku untuk Admin Super.
                    </div>
                @endif
            </div>
        </div>

        <!-- Menu Setting Form -->
        <div class="card">
            <div class="card-header">
                <h5>Pilih Menu yang Dapat Diakses</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.menu-setting.update', $user->id) }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        @foreach($availableMenus as $menu)
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input input-primary" 
                                           type="checkbox" 
                                           name="menus[]" 
                                           value="{{ $menu }}" 
                                           id="menu-{{ $loop->index }}"
                                           {{ in_array($menu, $userMenus) ? 'checked' : '' }}
                                           {{ $user->is_super_admin ? 'disabled' : '' }}>
                                    <label class="form-check-label" for="menu-{{ $loop->index }}">
                                        <i class="ti ti-layout-dashboard me-2"></i>{{ $menu }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if(!$user->is_super_admin)
                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy me-2"></i>Simpan Setting
                            </button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                <i class="ti ti-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    @else
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mt-4">
                            <i class="ti ti-arrow-left me-2"></i>Kembali
                        </a>
                    @endif
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
                    Menu yang dicentang akan dapat diakses oleh user ini. 
                    Menu yang tidak dicentang akan disembunyikan dari user.
                </p>
                <hr>
                <p class="text-sm mb-0">
                    <strong>Catatan:</strong> Admin Super selalu memiliki akses penuh ke semua menu.
                </p>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
@endsection
