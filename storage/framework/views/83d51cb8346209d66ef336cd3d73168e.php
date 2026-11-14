<?php $__env->startSection('title', 'Data Order'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Order</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Data Order</h5>
                <div>
                    <a href="<?php echo e(route('orders.export')); ?>?<?php echo e(http_build_query(request()->except('page'))); ?>" class="btn btn-success">
                        <i class="ti ti-file-spreadsheet"></i> Export Excel
                    </a>
                    <a href="<?php echo e(route('orders.create')); ?>" class="btn btn-primary">
                        <i class="ti ti-plus"></i> Tambah Order
                    </a>
                </div>
            </div>
            <div class="card-body">
                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Filter Form -->
                <div class="card mb-3 border">
                    <div class="card-body">
                        <form method="GET" action="<?php echo e(route('orders.index')); ?>" class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Status PO</label>
                                <select name="status" class="form-select">
                                    <option value="">Semua Status</option>
                                    <option value="0" <?php echo e(request('status') === '0' ? 'selected' : ''); ?>>Berjalan</option>
                                    <option value="1" <?php echo e(request('status') === '1' ? 'selected' : ''); ?>>Selesai</option>
                                </select>
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label">Status Pembayaran</label>
                                <select name="status_pembayaran" class="form-select">
                                    <option value="">Semua Pembayaran</option>
                                    <option value="lunas" <?php echo e(request('status_pembayaran') === 'lunas' ? 'selected' : ''); ?>>Lunas</option>
                                    <option value="dp" <?php echo e(request('status_pembayaran') === 'dp' ? 'selected' : ''); ?>>DP</option>
                                </select>
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label">Jenis Order</label>
                                <select name="jenis_order_id" class="form-select">
                                    <option value="">Semua Jenis</option>
                                    <?php $__currentLoopData = \App\Models\JenisOrder::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($jenis->id); ?>" <?php echo e(request('jenis_order_id') == $jenis->id ? 'selected' : ''); ?>>
                                            <?php echo e($jenis->nama_jenis); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label">Cari (Nama / Brand)</label>
                                <input type="text" name="search" class="form-control" value="<?php echo e(request('search')); ?>" placeholder="Cari nama pemesan atau brand...">
                            </div>
                            
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Filter Tanggal PO Masuk</label>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Dari Tanggal</label>
                                <input type="date" name="tanggal_dari" class="form-control" value="<?php echo e(request('tanggal_dari')); ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Sampai Tanggal</label>
                                <input type="date" name="tanggal_sampai" class="form-control" value="<?php echo e(request('tanggal_sampai')); ?>">
                            </div>
                            
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Filter Tanggal PO Selesai</label>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Dari Tanggal</label>
                                <input type="date" name="tanggal_selesai_dari" class="form-control" value="<?php echo e(request('tanggal_selesai_dari')); ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Sampai Tanggal</label>
                                <input type="date" name="tanggal_selesai_sampai" class="form-control" value="<?php echo e(request('tanggal_selesai_sampai')); ?>">
                            </div>
                            
                            <div class="col-md-12 d-flex align-items-end gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-filter"></i> Filter
                                </button>
                                <a href="<?php echo e(route('orders.index')); ?>" class="btn btn-secondary">
                                    <i class="ti ti-refresh"></i> Reset
                                </a>
                                <button type="button" class="btn btn-info ms-auto" onclick="batchInvoice()" id="batchInvoiceBtn" style="display:none;">
                                    <i class="ti ti-files"></i> Invoice Gabungan (<span id="selectedCount">0</span>)
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAll"></th>
                                <th>No PO</th>
                                <th>Tanggal</th>
                                <th>Customer</th>
                                <th>Jenis Order</th>
                                <th>Total Harga</th>
                                <th>Status Bayar</th>
                                <th>Status PO</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><input type="checkbox" class="order-checkbox" value="<?php echo e($order->id); ?>" data-customer="<?php echo e($order->nama_pemesan); ?>"></td>
                                    <td><strong><?php echo e($order->no_po ?? 'N/A'); ?></strong></td>
                                    <td><?php echo e($order->created_at->format('d/m/Y')); ?></td>
                                    <td>
                                        <div><strong><?php echo e($order->nama_pemesan); ?></strong></div>
                                        <small class="text-muted"><?php echo e($order->telepon); ?></small>
                                    </td>
                                    <td><?php echo e($order->jenisOrder->nama_jenis); ?></td>
                                    <td>
                                        <strong>Rp <?php echo e(number_format($order->total_harga, 0, ',', '.')); ?></strong>
                                        <br><small class="text-muted"><?php echo e(number_format($order->jumlah)); ?> pcs</small>
                                    </td>
                                    <td>
                                        <?php if($order->status_pembayaran == 'lunas'): ?>
                                            <span class="badge bg-success">Lunas</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning">DP</span>
                                            <br><small class="text-muted">Rp <?php echo e(number_format($order->jumlah_dp ?? 0, 0, ',', '.')); ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($order->status == 1): ?>
                                            <span class="badge bg-success">Selesai</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning">Berjalan</span>
                                            <?php if($order->isNearDeadline()): ?>
                                                <br><span class="badge bg-danger mt-1"><i class="ti ti-alert-triangle"></i> H-1</span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column gap-1">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="<?php echo e(route('orders.show', $order)); ?>" class="btn btn-info" title="Detail">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                                <a href="<?php echo e(route('orders.edit', $order)); ?>" class="btn btn-warning" title="Edit">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <a href="<?php echo e(route('orders.invoice', $order)); ?>" class="btn btn-success" title="Cetak Invoice" target="_blank">
                                                    <i class="ti ti-printer"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="https://wa.me/<?php echo e($order->telepon); ?>?text=<?php echo e(urlencode(\App\Helpers\CompanyHelper::getWhatsAppMessage($order))); ?>" class="btn btn-success" title="Kirim WA" target="_blank">
                                                    <i class="ti ti-brand-whatsapp"></i>
                                                </a>
                                                <?php if($order->status == 0): ?>
                                                    <button type="button" class="btn btn-primary" title="Selesaikan PO" onclick="finishOrder(<?php echo e($order->id); ?>)">
                                                        <i class="ti ti-check"></i>
                                                    </button>
                                                <?php endif; ?>
                                                <button type="button" class="btn btn-secondary" title="Revisi" onclick="reviseOrder(<?php echo e($order->id); ?>)">
                                                    <i class="ti ti-file-text"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="9" class="text-center">Tidak ada data order</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <?php echo e($orders->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Finish Order -->
<div class="modal fade" id="finishModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="finishForm" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <div class="modal-header">
                    <h5 class="modal-title">Selesaikan PO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menyelesaikan PO ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Ya, Selesaikan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Revisi -->
<div class="modal fade" id="revisiModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="revisiForm" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Revisi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Keterangan Revisi <span class="text-danger">*</span></label>
                        <textarea name="keterangan" class="form-control" rows="4" required placeholder="Jelaskan detail revisi yang diperlukan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Revisi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
function finishOrder(orderId) {
    const form = document.getElementById('finishForm');
    form.action = `/admin/orders/${orderId}/finish`;
    new bootstrap.Modal(document.getElementById('finishModal')).show();
}

function reviseOrder(orderId) {
    const form = document.getElementById('revisiForm');
    form.action = `/admin/orders/${orderId}/revise`;
    new bootstrap.Modal(document.getElementById('revisiModal')).show();
}

// Batch Invoice
let selectedOrders = [];

document.addEventListener('DOMContentLoaded', function() {
    // Select All
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.order-checkbox');
        checkboxes.forEach(cb => {
            cb.checked = this.checked;
        });
        updateBatchButton();
    });
    
    // Individual checkbox
    document.querySelectorAll('.order-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateBatchButton);
    });
});

function updateBatchButton() {
    const checkboxes = document.querySelectorAll('.order-checkbox:checked');
    selectedOrders = Array.from(checkboxes).map(cb => cb.value);
    
    const btn = document.getElementById('batchInvoiceBtn');
    const countSpan = document.getElementById('selectedCount');
    
    if (selectedOrders.length > 0) {
        countSpan.textContent = selectedOrders.length;
        btn.style.display = 'inline-block';
    } else {
        btn.style.display = 'none';
    }
}

function batchInvoice() {
    if (selectedOrders.length === 0) {
        alert('Pilih minimal 1 order');
        return;
    }
    
    const url = '<?php echo e(route("orders.batch-invoice")); ?>?order_ids=' + selectedOrders.join(',');
    window.open(url, '_blank');
}
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
<style>
/* Custom scrollbar untuk kolom makloon */
.table td > div[style*="overflow-y"] {
    scrollbar-width: thin;
    scrollbar-color: #888 #f1f1f1;
}

.table td > div[style*="overflow-y"]::-webkit-scrollbar {
    width: 6px;
}

.table td > div[style*="overflow-y"]::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.table td > div[style*="overflow-y"]::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

.table td > div[style*="overflow-y"]::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\obrigado\Desktop\AC\rccloth\resources\views/orders/index.blade.php ENDPATH**/ ?>