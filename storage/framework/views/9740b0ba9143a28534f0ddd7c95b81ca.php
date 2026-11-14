<?php $__env->startSection('title', 'Company Settings'); ?>

<?php $__env->startSection('styles'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
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

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Setting Informasi Perusahaan</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.company-settings.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    
                    <div class="row">
                        <!-- Nama Perusahaan -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control <?php $__errorArgs = ['nama_perusahaan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       name="nama_perusahaan" 
                                       value="<?php echo e(old('nama_perusahaan', $setting->nama_perusahaan ?? '')); ?>"
                                       placeholder="Masukkan nama perusahaan"
                                       required>
                                <?php $__errorArgs = ['nama_perusahaan'];
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

                        <!-- Logo Perusahaan -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Logo Perusahaan</label>
                                <input type="file" 
                                       class="form-control <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       name="logo" 
                                       accept="image/*"
                                       onchange="previewLogo(event)">
                                <small class="text-muted">Format: JPG, PNG, SVG. Maksimal 2MB</small>
                                <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                
                                <!-- Preview Logo -->
                                <?php if(isset($setting->logo) && $setting->logo): ?>
                                    <div class="mt-3">
                                        <img src="<?php echo e(asset('storage/' . $setting->logo)); ?>" 
                                             alt="Logo" 
                                             class="logo-preview" 
                                             id="logo-preview">
                                    </div>
                                <?php else: ?>
                                    <div class="mt-3 d-none" id="logo-preview-container">
                                        <img src="" alt="Logo Preview" class="logo-preview" id="logo-preview">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Telepon/WhatsApp (Multiple) -->
                    <div class="mb-3">
                        <label class="form-label">Telepon / WhatsApp <span class="text-danger">*</span></label>
                        <div id="telepon-container">
                            <?php if(isset($setting->telepon) && is_array($setting->telepon)): ?>
                                <?php $__currentLoopData = $setting->telepon; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $telp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="input-group mb-2 telepon-item">
                                        <span class="input-group-text"><i class="ti ti-phone"></i></span>
                                        <input type="text" 
                                               class="form-control" 
                                               name="telepon[]" 
                                               value="<?php echo e($telp); ?>"
                                               placeholder="Contoh: 08123456789"
                                               required>
                                        <?php if($index > 0): ?>
                                            <button type="button" class="btn btn-danger" onclick="removeField(this)">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="input-group mb-2 telepon-item">
                                    <span class="input-group-text"><i class="ti ti-phone"></i></span>
                                    <input type="text" 
                                           class="form-control" 
                                           name="telepon[]" 
                                           value="<?php echo e(old('telepon.0')); ?>"
                                           placeholder="Contoh: 08123456789"
                                           required>
                                </div>
                            <?php endif; ?>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addTelepon()">
                            <i class="ti ti-plus me-1"></i> Tambah Telepon
                        </button>
                    </div>

                    <!-- Alamat -->
                    <div class="mb-3">
                        <label class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                  name="alamat" 
                                  rows="3"
                                  placeholder="Masukkan alamat lengkap perusahaan"
                                  required><?php echo e(old('alamat', $setting->alamat ?? '')); ?></textarea>
                        <?php $__errorArgs = ['alamat'];
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

                    <!-- Rekening Bank (Multiple) -->
                    <div class="mb-3">
                        <label class="form-label">Nomor Rekening Bank <span class="text-danger">*</span></label>
                        <div id="rekening-container">
                            <?php if(isset($setting->rekening_bank) && is_array($setting->rekening_bank)): ?>
                                <?php $__currentLoopData = $setting->rekening_bank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $rekening): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="input-group mb-2 rekening-item">
                                        <span class="input-group-text"><i class="ti ti-building-bank"></i></span>
                                        <input type="text" 
                                               class="form-control" 
                                               name="rekening_bank[]" 
                                               value="<?php echo e($rekening); ?>"
                                               placeholder="Contoh: BCA - 1234567890 - PT RC Cloth"
                                               required>
                                        <?php if($index > 0): ?>
                                            <button type="button" class="btn btn-danger" onclick="removeField(this)">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="input-group mb-2 rekening-item">
                                    <span class="input-group-text"><i class="ti ti-building-bank"></i></span>
                                    <input type="text" 
                                           class="form-control" 
                                           name="rekening_bank[]" 
                                           value="<?php echo e(old('rekening_bank.0')); ?>"
                                           placeholder="Contoh: BCA - 1234567890 - PT RC Cloth"
                                           required>
                                </div>
                            <?php endif; ?>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addRekening()">
                            <i class="ti ti-plus me-1"></i> Tambah Rekening
                        </button>
                    </div>

                    <!-- Template Pesan WhatsApp -->
                    <div class="mb-3">
                        <label class="form-label">Template Pesan WhatsApp</label>
                        <textarea class="form-control <?php $__errorArgs = ['template_wa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                  name="template_wa" 
                                  rows="4"
                                  placeholder="Contoh: Halo {nama_pemesan}, terima kasih telah memesan di {nama_perusahaan}. Berikut invoice Anda: {link_invoice}"><?php echo e(old('template_wa', $setting->template_wa ?? '')); ?></textarea>
                        <small class="text-muted">
                            <strong>Variabel yang bisa digunakan:</strong><br>
                            <code>{nama_pemesan}</code> - Nama pemesan<br>
                            <code>{nama_perusahaan}</code> - Nama perusahaan<br>
                            <code>{link_invoice}</code> - Link invoice order<br>
                            <code>{telepon}</code> - Nomor telepon pemesan
                        </small>
                        <?php $__errorArgs = ['template_wa'];
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

                    <!-- Submit Button -->
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-device-floppy me-2"></i>Simpan Setting
                        </button>
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-secondary">
                            <i class="ti ti-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\obrigado\Desktop\AC\rccloth\resources\views/admin/company-settings/index.blade.php ENDPATH**/ ?>