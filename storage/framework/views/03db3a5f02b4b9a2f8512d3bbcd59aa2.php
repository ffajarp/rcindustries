<?php $__env->startSection('title', 'User Management'); ?>

<?php $__env->startSection('content'); ?>
<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">User Management</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">User Management</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->

<!-- [ Main Content ] start -->
<div class="row">
    <!-- Alert Messages -->
    <?php if(session('success')): ?>
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="ti ti-check me-2"></i><?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="ti ti-alert-circle me-2"></i><?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    <?php endif; ?>

    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5>Daftar User</h5>
                <?php if(Auth::user()->is_super_admin): ?>
                    <a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-primary">
                        <i class="ti ti-plus"></i> Tambah User
                    </a>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avtar avtar-s bg-light-primary">
                                                    <i class="ti ti-user"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-0"><?php echo e($user->username); ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo e($user->nama); ?></td>
                                    <td><?php echo e($user->telp); ?></td>
                                    <td>
                                        <span class="badge bg-light-info"><?php echo e($user->role->nama_role); ?></span>
                                    </td>
                                    <td>
                                        <?php if($user->is_super_admin): ?>
                                            <span class="badge bg-danger">Admin Super</span>
                                        <?php else: ?>
                                            <span class="badge bg-success">User Biasa</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" 
                                               class="btn btn-icon btn-link-warning" 
                                               title="Edit">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <a href="<?php echo e(route('admin.users.menu-setting', $user->id)); ?>" 
                                               class="btn btn-icon btn-link-info" 
                                               title="Setting Menu">
                                                <i class="ti ti-settings"></i>
                                            </a>
                                            <?php if(!$user->is_super_admin): ?>
                                                <button type="button" 
                                                        class="btn btn-icon btn-link-danger" 
                                                        title="Hapus"
                                                        onclick="confirmDelete(<?php echo e($user->id); ?>)">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                                <form id="delete-form-<?php echo e($user->id); ?>" 
                                                      action="<?php echo e(route('admin.users.destroy', $user->id)); ?>" 
                                                      method="POST" 
                                                      class="d-none">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        <i class="ti ti-user-off f-40 d-block mb-2"></i>
                                        Belum ada data user
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
function confirmDelete(userId) {
    if (confirm('Yakin ingin menghapus user ini?')) {
        document.getElementById('delete-form-' + userId).submit();
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\obrigado\Desktop\AC\rccloth\resources\views/admin/users/index.blade.php ENDPATH**/ ?>