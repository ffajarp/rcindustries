<?php $__env->startSection('title', 'Harga HPP'); ?>

<?php $__env->startSection('content'); ?>
<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
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
                <h5>Daftar Harga HPP</h5>
                <a href="<?php echo e(route('admin.harga-hpp.create')); ?>" class="btn btn-primary">
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
                            <?php $__empty_1 = true; $__currentLoopData = $hargaHpps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $hpp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avtar avtar-s bg-light-success">
                                                    <i class="ti ti-currency-dollar"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-0"><?php echo e($hpp->nama_hpp); ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-primary">
                                            Rp <?php echo e(number_format($hpp->harga, 0, ',', '.')); ?>

                                        </span>
                                    </td>
                                    <td><?php echo e($hpp->created_at->format('d M Y')); ?></td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="<?php echo e(route('admin.harga-hpp.edit', $hpp->id)); ?>" 
                                               class="btn btn-icon btn-link-warning" 
                                               title="Edit">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-icon btn-link-danger" 
                                                    title="Hapus"
                                                    onclick="confirmDelete(<?php echo e($hpp->id); ?>)">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                            <form id="delete-form-<?php echo e($hpp->id); ?>" 
                                                  action="<?php echo e(route('admin.harga-hpp.destroy', $hpp->id)); ?>" 
                                                  method="POST" 
                                                  class="d-none">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="ti ti-currency-off f-40 d-block mb-2"></i>
                                        Belum ada data harga HPP
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
function confirmDelete(id) {
    if (confirm('Yakin ingin menghapus harga HPP ini?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\obrigado\Desktop\AC\rccloth\resources\views/admin/master-data/harga-hpp/index.blade.php ENDPATH**/ ?>