<?php $__env->startSection('title', 'Dashboard Penjualan'); ?>

<?php $__env->startSection('styles'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">Dashboard Penjualan</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">Dashboard Penjualan</h2>
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

    <!-- PO Masuk Card -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s bg-light-warning">
                            <i class="ti ti-file-invoice f-20"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">PO Masuk</h6>
                    </div>
                </div>
                <div class="bg-body p-3 mt-3 rounded">
                    <div class="mt-3 row align-items-center">
                        <div class="col-7">
                            <p class="text-muted mb-0">Total PO Masuk</p>
                        </div>
                        <div class="col-5 text-end">
                            <h4 class="mb-0 text-warning"><?php echo e($data['po_masuk']); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PO Selesai Card -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s bg-light-success">
                            <i class="ti ti-file-check f-20"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">PO Selesai</h6>
                    </div>
                </div>
                <div class="bg-body p-3 mt-3 rounded">
                    <div class="mt-3 row align-items-center">
                        <div class="col-7">
                            <p class="text-muted mb-0">Total PO Selesai</p>
                        </div>
                        <div class="col-5 text-end">
                            <h4 class="mb-0 text-success"><?php echo e($data['po_selesai']); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress PO Card -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s bg-light-info">
                            <i class="ti ti-progress f-20"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Persentase</h6>
                    </div>
                </div>
                <div class="bg-body p-3 mt-3 rounded">
                    <div class="mt-3 row align-items-center">
                        <div class="col-7">
                            <p class="text-muted mb-0">Progress Selesai</p>
                        </div>
                        <div class="col-5 text-end">
                            <h4 class="mb-0 text-info"><?php echo e($data['persentase']); ?>%</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pemasukan Card -->
    <div class="col-md-4">
        <div class="card bg-light-primary">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s bg-primary">
                            <i class="ti ti-wallet f-20 text-white"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Pemasukan</h6>
                    </div>
                </div>
                <div class="mt-3">
                    <h3 class="mb-0 text-primary">Rp <?php echo e(number_format($data['total_pemasukan'], 0, ',', '.')); ?></h3>
                    <p class="text-muted mb-0 mt-1"><small>Total revenue</small></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Total HPP Card -->
    <div class="col-md-4">
        <div class="card bg-light-danger">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s bg-danger">
                            <i class="ti ti-receipt f-20 text-white"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">HPP</h6>
                    </div>
                </div>
                <div class="mt-3">
                    <h3 class="mb-0 text-danger">Rp <?php echo e(number_format($data['total_hpp'], 0, ',', '.')); ?></h3>
                    <p class="text-muted mb-0 mt-1"><small>Harga Pokok Penjualan</small></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Laba Bersih Card -->
    <div class="col-md-4">
        <div class="card bg-light-success">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s bg-success">
                            <i class="ti ti-trending-up f-20 text-white"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Laba Bersih</h6>
                    </div>
                </div>
                <div class="mt-3">
                    <h3 class="mb-0 text-success">Rp <?php echo e(number_format($data['laba_bersih'], 0, ',', '.')); ?></h3>
                    <p class="text-muted mb-0 mt-1"><small>Net profit</small></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Penjualan -->
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Grafik Penjualan 
                    <span class="badge bg-light-primary ms-2">
                        <?php if($filter == 'hari'): ?> 7 Hari Terakhir
                        <?php elseif($filter == 'minggu'): ?> 4 Minggu Terakhir
                        <?php else: ?> 12 Bulan Terakhir
                        <?php endif; ?>
                    </span>
                </h5>
                <div class="btn-group" role="group">
                    <a href="<?php echo e(route('admin.dashboard', ['filter' => 'hari'])); ?>" 
                       class="btn btn-sm <?php echo e($filter == 'hari' ? 'btn-primary' : 'btn-outline-secondary'); ?>">
                        <i class="ti ti-calendar-time me-1"></i> Per Hari
                    </a>
                    <a href="<?php echo e(route('admin.dashboard', ['filter' => 'minggu'])); ?>" 
                       class="btn btn-sm <?php echo e($filter == 'minggu' ? 'btn-primary' : 'btn-outline-secondary'); ?>">
                        <i class="ti ti-calendar-week me-1"></i> Per Minggu
                    </a>
                    <a href="<?php echo e(route('admin.dashboard', ['filter' => 'bulan'])); ?>" 
                       class="btn btn-sm <?php echo e($filter == 'bulan' ? 'btn-primary' : 'btn-outline-secondary'); ?>">
                        <i class="ti ti-calendar-month me-1"></i> Per Bulan
                    </a>
                </div>
            </div>
            <div class="card-body">
                <canvas id="salesChart" height="100"></canvas>
            </div>
        </div>
    </div>

    <!-- Summary Table -->
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>Summary Penjualan</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Keterangan</th>
                                <th class="text-end">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><i class="ti ti-file-invoice me-2 text-warning"></i>Total PO Masuk</td>
                                <td class="text-end"><strong><?php echo e($data['po_masuk']); ?> PO</strong></td>
                            </tr>
                            <tr>
                                <td><i class="ti ti-file-check me-2 text-success"></i>Total PO Selesai</td>
                                <td class="text-end"><strong><?php echo e($data['po_selesai']); ?> PO</strong></td>
                            </tr>
                            <tr>
                                <td><i class="ti ti-clock me-2 text-info"></i>PO Dalam Proses</td>
                                <td class="text-end"><strong><?php echo e($data['po_masuk'] - $data['po_selesai']); ?> PO</strong></td>
                            </tr>
                            <tr class="table-active">
                                <td><i class="ti ti-wallet me-2 text-primary"></i><strong>Total Pemasukan</strong></td>
                                <td class="text-end"><strong class="text-primary">Rp <?php echo e(number_format($data['total_pemasukan'], 0, ',', '.')); ?></strong></td>
                            </tr>
                            <tr class="table-active">
                                <td><i class="ti ti-receipt me-2 text-danger"></i><strong>Total HPP</strong></td>
                                <td class="text-end"><strong class="text-danger">Rp <?php echo e(number_format($data['total_hpp'], 0, ',', '.')); ?></strong></td>
                            </tr>
                            <tr class="table-success">
                                <td><i class="ti ti-trending-up me-2 text-success"></i><strong>Laba Bersih</strong></td>
                                <td class="text-end"><strong class="text-success">Rp <?php echo e(number_format($data['laba_bersih'], 0, ',', '.')); ?></strong></td>
                            </tr>
                            <tr>
                                <td><i class="ti ti-percentage me-2 text-info"></i>Margin Keuntungan</td>
                                <td class="text-end"><strong><?php echo e(number_format(($data['laba_bersih'] / $data['total_pemasukan']) * 100, 2)); ?>%</strong></td>
                            </tr>
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
// Data dari controller
const chartLabels = <?php echo json_encode($chartData['labels'], 15, 512) ?>;
const chartData = <?php echo json_encode($chartData['data'], 15, 512) ?>;

// Konfigurasi chart
const ctx = document.getElementById('salesChart').getContext('2d');
const salesChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: chartLabels,
        datasets: [{
            label: 'Penjualan (Rp)',
            data: chartData,
            borderColor: 'rgb(70, 128, 255)',
            backgroundColor: 'rgba(70, 128, 255, 0.1)',
            tension: 0.4,
            fill: true,
            pointRadius: 5,
            pointHoverRadius: 7,
            pointBackgroundColor: 'rgb(70, 128, 255)',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                display: true,
                position: 'top',
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let label = context.dataset.label || '';
                        if (label) {
                            label += ': ';
                        }
                        if (context.parsed.y !== null) {
                            label += 'Rp ' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
                        }
                        return label;
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value, index, ticks) {
                        return 'Rp ' + new Intl.NumberFormat('id-ID', { 
                            notation: "compact", 
                            compactDisplay: "short" 
                        }).format(value);
                    }
                }
            }
        }
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\obrigado\Desktop\AC\rccloth\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>