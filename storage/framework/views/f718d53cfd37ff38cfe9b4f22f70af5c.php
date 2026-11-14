<!DOCTYPE html>
<html lang="id">
<head>
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> | <?php echo e(\App\Helpers\CompanyHelper::getName()); ?></title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <!-- [Favicon] icon -->
    <link rel="icon" href="<?php echo e(\App\Helpers\CompanyHelper::getLogo()); ?>" type="image/x-icon">
    
    <!-- [Font] Family -->
    <link rel="stylesheet" href="<?php echo e(asset('admin-assets/fonts/inter/inter.css')); ?>" id="main-font-link" />
    <!-- [Tabler Icons] -->
    <link rel="stylesheet" href="<?php echo e(asset('admin-assets/fonts/tabler-icons.min.css')); ?>">
    <!-- [Feather Icons] -->
    <link rel="stylesheet" href="<?php echo e(asset('admin-assets/fonts/feather.css')); ?>">
    <!-- [Font Awesome Icons] -->
    <link rel="stylesheet" href="<?php echo e(asset('admin-assets/fonts/fontawesome.css')); ?>">
    <!-- [Material Icons] -->
    <link rel="stylesheet" href="<?php echo e(asset('admin-assets/fonts/material.css')); ?>">
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="<?php echo e(asset('admin-assets/css/style.css')); ?>" id="main-style-link">
    <link rel="stylesheet" href="<?php echo e(asset('admin-assets/css/style-preset.css')); ?>">
    
    <?php echo $__env->yieldPushContent('styles'); ?>
    <?php echo $__env->yieldContent('styles'); ?>
</head>

<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-layout="vertical" data-pc-direction="ltr" data-pc-theme_contrast="" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    
    <!-- [ Sidebar Menu ] start -->
    <nav class="pc-sidebar">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="b-brand text-primary">
                    <img src="<?php echo e(\App\Helpers\CompanyHelper::getLogo()); ?>" class="img-fluid logo-lg" alt="<?php echo e(\App\Helpers\CompanyHelper::getName()); ?>" style="max-height: 40px;">
                </a>
            </div>
            <div class="navbar-content">
                <!-- User Card -->
                <div class="card pc-user-card">
                  
                </div>

                <!-- Menu Navigation -->
                <ul class="pc-navbar">
                    <!-- Dashboard Section -->
                    <?php if(Auth::user()->hasMenuAccess('Dashboard Penjualan')): ?>
                    <li class="pc-item pc-caption">
                        <label>Dashboard</label>
                    </li>

                    <!-- Dashboard -->
                    <li class="pc-item <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="pc-link">
                            <span class="pc-micon">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-status-up"></use>
                                </svg>
                            </span>
                            <span class="pc-mtext">Dashboard Penjualan</span>
                        </a>
                    </li>
                    <?php endif; ?>

                    <!-- Transaksi Section -->
                    <?php if(Auth::user()->hasMenuAccess('Order')): ?>
                    <li class="pc-item pc-caption">
                        <label>Transaksi</label>
                    </li>

                    <!-- Order -->
                    <li class="pc-item <?php echo e(request()->routeIs('orders.*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('orders.index')); ?>" class="pc-link">
                            <span class="pc-micon">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-shopping-bag"></use>
                                </svg>
                            </span>
                            <span class="pc-mtext">Order</span>
                        </a>
                    </li>
                    <?php endif; ?>

                    <!-- Master Data Section -->
                    <?php if(Auth::user()->hasMenuAccess('Jenis Order') || Auth::user()->hasMenuAccess('Harga HPP')): ?>
                    <li class="pc-item pc-caption">
                        <label>Master Data</label>
                    </li>

                    <?php if(Auth::user()->hasMenuAccess('Jenis Order')): ?>
                    <!-- Jenis Order -->
                    <li class="pc-item <?php echo e(request()->routeIs('admin.jenis-order.*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.jenis-order.index')); ?>" class="pc-link">
                            <span class="pc-micon">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-note-1"></use>
                                </svg>
                            </span>
                            <span class="pc-mtext">Jenis Order</span>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if(Auth::user()->hasMenuAccess('Harga HPP')): ?>
                    <!-- Harga HPP -->
                    <li class="pc-item <?php echo e(request()->routeIs('admin.harga-hpp.*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.harga-hpp.index')); ?>" class="pc-link">
                            <span class="pc-micon">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-dollar-square"></use>
                                </svg>
                            </span>
                            <span class="pc-mtext">Harga HPP</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php endif; ?>

                    <!-- Management Section -->
                    <?php if(Auth::user()->hasMenuAccess('User Management') || Auth::user()->hasMenuAccess('Role Management')): ?>
                    <li class="pc-item pc-caption">
                        <label>Management</label>
                    </li>

                    <?php if(Auth::user()->hasMenuAccess('User Management')): ?>
                    <!-- User Management -->
                    <li class="pc-item <?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.users.index')); ?>" class="pc-link">
                            <span class="pc-micon">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-user"></use>
                                </svg>
                            </span>
                            <span class="pc-mtext">User Management</span>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if(Auth::user()->hasMenuAccess('Role Management')): ?>
                    <!-- Role Management -->
                    <li class="pc-item <?php echo e(request()->routeIs('admin.roles.*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.roles.index')); ?>" class="pc-link">
                            <span class="pc-micon">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-shield"></use>
                                </svg>
                            </span>
                            <span class="pc-mtext">Role Management</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php endif; ?>

                    <!-- Settings Section -->
                    <?php if(Auth::user()->hasMenuAccess('Company Settings')): ?>
                    <li class="pc-item pc-caption">
                        <label>Pengaturan</label>
                    </li>

                    <!-- Company Settings -->
                    <li class="pc-item <?php echo e(request()->routeIs('admin.company-settings.*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.company-settings.index')); ?>" class="pc-link">
                            <span class="pc-micon">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-setting-2"></use>
                                </svg>
                            </span>
                            <span class="pc-mtext">Company Settings</span>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- [ Sidebar Menu ] end -->
    
    <!-- [ Header Topbar ] start -->
    <header class="pc-header">
        <div class="header-wrapper">
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled">
                    <li class="pc-h-item pc-sidebar-collapse">
                        <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    <li class="pc-h-item pc-sidebar-popup">
                        <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="ms-auto">
                <ul class="list-unstyled">
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-user"></use>
                            </svg>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <h5 class="m-0">Profile</h5>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="ti ti-user"></i>
                                <span><?php echo e(Auth::user()->nama); ?></span>
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="ti ti-shield"></i>
                                <span><?php echo e(Auth::user()->role->nama_role); ?></span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <form action="<?php echo e(route('admin.logout')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="dropdown-item">
                                    <i class="ti ti-power"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- [ Header Topbar ] end -->

    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- Required Js -->
    <script src="<?php echo e(asset('admin-assets/js/plugins/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin-assets/js/plugins/simplebar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin-assets/js/plugins/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin-assets/js/fonts/custom-font.js')); ?>"></script>
    <script src="<?php echo e(asset('admin-assets/js/script.js')); ?>"></script>
    <script src="<?php echo e(asset('admin-assets/js/theme.js')); ?>"></script>
    <script src="<?php echo e(asset('admin-assets/js/plugins/feather.min.js')); ?>"></script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\obrigado\Desktop\AC\rccloth\resources\views/layouts/admin.blade.php ENDPATH**/ ?>