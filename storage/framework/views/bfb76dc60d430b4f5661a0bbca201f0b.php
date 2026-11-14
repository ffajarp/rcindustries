<?php $__env->startSection('title', 'Tambah Order'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo e(route('orders.index')); ?>">Data Order</a></li>
                    <li class="breadcrumb-item active">Tambah Order</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Form Order</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('orders.store')); ?>" method="POST" id="orderForm" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

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
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('nama_pemesan')); ?>" required maxlength="255" minlength="3">
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
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('telepon')); ?>" required placeholder="08xxxxxxxxxx" pattern="[0-9]{10,16}" title="Nomor telepon harus 10-16 digit angka">
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
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('brand')); ?>" maxlength="255">
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
                                <label class="form-label">Upload Gambar Design</label>
                                <input type="file" name="gambar_design" class="form-control <?php $__errorArgs = ['gambar_design'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept="image/jpeg,image/jpg,image/png">
                                <?php $__errorArgs = ['gambar_design'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <small class="text-muted">Format: JPG, JPEG, PNG. Max: 5MB</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
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
                                        <option value="<?php echo e($jenis->id); ?>" <?php echo e(old('jenis_order_id') == $jenis->id ? 'selected' : ''); ?>>
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

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Estimasi Selesai</label>
                                <input type="date" name="estimasi_selesai" class="form-control <?php $__errorArgs = ['estimasi_selesai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('estimasi_selesai')); ?>">
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
                                <small class="text-muted">Opsional, bisa dikosongkan</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Jumlah (pcs) <span class="text-danger">*</span></label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control <?php $__errorArgs = ['jumlah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('jumlah')); ?>" min="1" max="999999" required>
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

                        <div class="col-md-6">
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
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('harga_jual')); ?>" min="0" max="9999999999" step="1" required>
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
                    </div>

                    <!-- Notes -->
                    <div class="mb-3">
                        <label class="form-label">Catatan</label>
                        <textarea name="notes" class="form-control <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="3" placeholder="Catatan tambahan tentang order ini (opsional)"><?php echo e(old('notes')); ?></textarea>
                        <?php $__errorArgs = ['notes'];
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

                    <hr class="my-4">

                    <h5 class="mb-3">Makloon apa saja?</h5>
                    <p class="text-muted mb-3">Centang item HPP yang akan dihitung</p>

                    <div class="row">
                        <?php $__currentLoopData = $hargaHpps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hpp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-3 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input makloon-checkbox" type="checkbox" name="makloon_items[]" value="<?php echo e($hpp->id); ?>" id="hpp_<?php echo e($hpp->id); ?>" data-harga="<?php echo e($hpp->harga); ?>" <?php echo e(in_array($hpp->id, old('makloon_items', [])) ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="hpp_<?php echo e($hpp->id); ?>">
                                        <?php echo e($hpp->nama_hpp); ?> <span class="text-muted">(Rp <?php echo e(number_format($hpp->harga, 0, ',', '.')); ?>/pcs)</span>
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <hr class="my-4">

                    <!-- Status Pembayaran -->
                    <h5 class="mb-3">Status Pembayaran</h5>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_pembayaran" id="pembayaran_lunas" value="lunas" <?php echo e(old('status_pembayaran', 'lunas') == 'lunas' ? 'checked' : ''); ?> required>
                                    <label class="form-check-label" for="pembayaran_lunas">
                                        <strong>Lunas</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_pembayaran" id="pembayaran_dp" value="dp" <?php echo e(old('status_pembayaran') == 'dp' ? 'checked' : ''); ?> required>
                                    <label class="form-check-label" for="pembayaran_dp">
                                        <strong>DP (Down Payment)</strong>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <?php $__errorArgs = ['status_pembayaran'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Input DP (Hidden by default) -->
                    <div id="dp_section" style="display: none;">
                        <div class="card border-warning mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Jumlah DP <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" name="jumlah_dp" id="jumlah_dp" class="form-control <?php $__errorArgs = ['jumlah_dp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('jumlah_dp')); ?>" min="0" step="1">
                                            </div>
                                            <?php $__errorArgs = ['jumlah_dp'];
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
                                            <label class="form-label">Persentase DP</label>
                                            <input type="text" id="persentase_dp" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-info mb-0">
                                    <small>
                                        <strong>Sisa Pembayaran:</strong> <span id="sisa_pembayaran">Rp 0</span>
                                    </small>
                                </div>
                            </div>
                        </div>
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
                            <i class="ti ti-device-floppy"></i> Simpan
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
    console.log('Script loaded');
    
    function formatRupiah(angka) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);
    }

    function hitungTotal() {
        const jumlahInput = document.getElementById('jumlah');
        const hargaJualInput = document.getElementById('harga_jual');
        
        if (!jumlahInput || !hargaJualInput) {
            console.error('Input tidak ditemukan');
            return;
        }
        
        const jumlah = parseFloat(jumlahInput.value) || 0;
        const hargaJual = parseFloat(hargaJualInput.value) || 0;
        
        console.log('Jumlah:', jumlah, 'Harga Jual:', hargaJual);
        
        // Hitung total harga
        const totalHarga = jumlah * hargaJual;
        document.getElementById('displayTotalHarga').textContent = formatRupiah(totalHarga);
        
        // Hitung total HPP
        let totalHpp = 0;
        const checkedBoxes = document.querySelectorAll('.makloon-checkbox:checked');
        console.log('Checkbox checked:', checkedBoxes.length);
        
        checkedBoxes.forEach(checkbox => {
            const hargaHpp = parseFloat(checkbox.dataset.harga) || 0;
            console.log('HPP:', checkbox.dataset.harga);
            totalHpp += (hargaHpp * jumlah);
        });
        document.getElementById('displayTotalHpp').textContent = formatRupiah(totalHpp);
        
        // Hitung laba bersih
        const labaBersih = totalHarga - totalHpp;
        document.getElementById('displayLabaBersih').textContent = formatRupiah(labaBersih);
        
        console.log('Total Harga:', totalHarga, 'Total HPP:', totalHpp, 'Laba:', labaBersih);

        // Hitung DP jika section DP visible
        hitungDP();
    }

    function hitungDP() {
        const jumlahInput = document.getElementById('jumlah');
        const hargaJualInput = document.getElementById('harga_jual');
        const jumlahDpInput = document.getElementById('jumlah_dp');
        const dpSection = document.getElementById('dp_section');

        if (dpSection.style.display === 'none') return;

        const jumlah = parseFloat(jumlahInput.value) || 0;
        const hargaJual = parseFloat(hargaJualInput.value) || 0;
        const totalHarga = jumlah * hargaJual;
        const jumlahDp = parseFloat(jumlahDpInput.value) || 0;

        // Hitung persentase
        const persentase = totalHarga > 0 ? (jumlahDp / totalHarga * 100).toFixed(2) : 0;
        document.getElementById('persentase_dp').value = persentase + '%';

        // Hitung sisa
        const sisa = totalHarga - jumlahDp;
        document.getElementById('sisa_pembayaran').textContent = formatRupiah(sisa);
    }

    // Event listeners
    const jumlahInput = document.getElementById('jumlah');
    const hargaJualInput = document.getElementById('harga_jual');
    const jumlahDpInput = document.getElementById('jumlah_dp');
    
    if (jumlahInput && hargaJualInput) {
        jumlahInput.addEventListener('input', hitungTotal);
        hargaJualInput.addEventListener('input', hitungTotal);
        
        if (jumlahDpInput) {
            jumlahDpInput.addEventListener('input', hitungDP);
        }
        
        document.querySelectorAll('.makloon-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', hitungTotal);
        });
        
        // Initial calculation
        hitungTotal();
        console.log('Event listeners attached');
    } else {
        console.error('Input elements not found');
    }

    // Handle show/hide DP section
    const radioLunas = document.getElementById('pembayaran_lunas');
    const radioDp = document.getElementById('pembayaran_dp');
    const dpSection = document.getElementById('dp_section');

    function toggleDPSection() {
        if (radioDp.checked) {
            dpSection.style.display = 'block';
            jumlahDpInput.required = true;
        } else {
            dpSection.style.display = 'none';
            jumlahDpInput.required = false;
            jumlahDpInput.value = '';
            hitungDP();
        }
    }

    radioLunas.addEventListener('change', toggleDPSection);
    radioDp.addEventListener('change', toggleDPSection);

    // Check on load
    toggleDPSection();
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\obrigado\Desktop\AC\rccloth\resources\views/orders/create.blade.php ENDPATH**/ ?>