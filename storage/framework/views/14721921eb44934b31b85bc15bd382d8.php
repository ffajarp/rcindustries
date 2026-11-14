<?php $__env->startSection('title', 'Edit Order'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo e(route('orders.index')); ?>">Data Order</a></li>
                    <li class="breadcrumb-item active">Edit Order</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Edit Order</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('orders.update', $order)); ?>" method="POST" id="orderForm">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Pemesan <span class="text-danger">*</span></label>
                                <input type="text" name="nama_pemesan" class="form-control <?php $__errorArgs = ['nama_pemesan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('nama_pemesan', $order->nama_pemesan)); ?>" required maxlength="255" minlength="3">
                                <?php $__errorArgs = ['nama_pemesan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">No. Telepon/WA <span class="text-danger">*</span></label>
                                <input type="tel" name="telepon" class="form-control <?php $__errorArgs = ['telepon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('telepon', $order->telepon)); ?>" required placeholder="08xxxxxxxxxx" pattern="[0-9]{10,16}" title="Nomor telepon harus 10-16 digit angka">
                                <?php $__errorArgs = ['telepon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <small class="text-muted">Format: 08xxxxxxxxxx (hanya angka, 10-16 digit)</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Brand</label>
                                <input type="text" name="brand" class="form-control <?php $__errorArgs = ['brand'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('brand', $order->brand)); ?>" maxlength="255">
                                <?php $__errorArgs = ['brand'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Jenis Makloon <span class="text-danger">*</span></label>
                                <select name="jenis_order_id" class="form-select <?php $__errorArgs = ['jenis_order_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                    <option value="">Pilih Jenis Makloon</option>
                                    <?php $__currentLoopData = $jenisOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($jenis->id); ?>" <?php echo e(old('jenis_order_id', $order->jenis_order_id) == $jenis->id ? 'selected' : ''); ?>>
                                            <?php echo e($jenis->nama_jenis); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['jenis_order_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Jumlah (pcs) <span class="text-danger">*</span></label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control <?php $__errorArgs = ['jumlah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('jumlah', $order->jumlah)); ?>" min="1" max="999999" required>
                                <?php $__errorArgs = ['jumlah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Harga Jual (/pcs) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="harga_jual" id="harga_jual" class="form-control <?php $__errorArgs = ['harga_jual'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('harga_jual', $order->harga_jual)); ?>" min="0" max="9999999999" step="1" required>
                                </div>
                                <?php $__errorArgs = ['harga_jual'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Estimasi Selesai</label>
                                <input type="date" name="estimasi_selesai" class="form-control <?php $__errorArgs = ['estimasi_selesai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('estimasi_selesai', $order->estimasi_selesai ? $order->estimasi_selesai->format('Y-m-d') : '')); ?>" min="<?php echo e(date('Y-m-d')); ?>">
                                <?php $__errorArgs = ['estimasi_selesai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3">Makloon apa saja?</h5>
                    <p class="text-muted mb-3">Centang item HPP yang akan dihitung</p>

                    <div class="row">
                        <?php $__currentLoopData = $hargaHpps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hpp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-3 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input makloon-checkbox" type="checkbox" name="makloon_items[]" value="<?php echo e($hpp->id); ?>" id="hpp_<?php echo e($hpp->id); ?>" data-harga="<?php echo e($hpp->harga); ?>" <?php echo e(in_array($hpp->id, old('makloon_items', $order->makloon_items ?? [])) ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="hpp_<?php echo e($hpp->id); ?>">
                                        <?php echo e($hpp->nama_hpp); ?> <span class="text-muted">(Rp <?php echo e(number_format($hpp->harga, 0, ',', '.')); ?>/pcs)</span>
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card border">
                                <div class="card-body">
                                    <h6 class="text-muted mb-2">Total Harga</h6>
                                    <h4 class="mb-0" id="displayTotalHarga">Rp 0</h4>
                                    <small class="text-muted">Jumlah × Harga Jual</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border">
                                <div class="card-body">
                                    <h6 class="text-muted mb-2">Total HPP</h6>
                                    <h4 class="mb-0" id="displayTotalHpp">Rp 0</h4>
                                    <small class="text-muted">Total Makloon yang dipilih</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border border-success">
                                <div class="card-body">
                                    <h6 class="text-muted mb-2">Laba Bersih</h6>
                                    <h4 class="mb-0 text-success" id="displayLabaBersih">Rp 0</h4>
                                    <small class="text-muted">Total Harga - Total HPP</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-device-floppy"></i> Update
                        </button>
                        <a href="<?php echo e(route('orders.index')); ?>" class="btn btn-secondary">
                            <i class="ti ti-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    function formatRupiah(angka) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);
    }

    function hitungTotal() {
        const jumlahInput = document.getElementById('jumlah');
        const hargaJualInput = document.getElementById('harga_jual');
        
        if (!jumlahInput || !hargaJualInput) {
            return;
        }
        
        const jumlah = parseFloat(jumlahInput.value) || 0;
        const hargaJual = parseFloat(hargaJualInput.value) || 0;
        
        // Hitung total harga
        const totalHarga = jumlah * hargaJual;
        document.getElementById('displayTotalHarga').textContent = formatRupiah(totalHarga);
        
        // Hitung total HPP
        let totalHpp = 0;
        const checkedBoxes = document.querySelectorAll('.makloon-checkbox:checked');
        
        checkedBoxes.forEach(checkbox => {
            const hargaHpp = parseFloat(checkbox.dataset.harga) || 0;
            totalHpp += (hargaHpp * jumlah);
        });
        document.getElementById('displayTotalHpp').textContent = formatRupiah(totalHpp);
        
        // Hitung laba bersih
        const labaBersih = totalHarga - totalHpp;
        document.getElementById('displayLabaBersih').textContent = formatRupiah(labaBersih);
    }

    // Event listeners
    const jumlahInput = document.getElementById('jumlah');
    const hargaJualInput = document.getElementById('harga_jual');
    
    if (jumlahInput && hargaJualInput) {
        jumlahInput.addEventListener('input', hitungTotal);
        hargaJualInput.addEventListener('input', hitungTotal);
        
        document.querySelectorAll('.makloon-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', hitungTotal);
        });
        
        // Initial calculation
        hitungTotal();
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\obrigado\Desktop\AC\rccloth\resources\views/orders/edit.blade.php ENDPATH**/ ?>