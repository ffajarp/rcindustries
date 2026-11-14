<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\CompanySettingController;
use App\Http\Controllers\Admin\JenisOrderController;
use App\Http\Controllers\Admin\HargaHppController;
use App\Http\Controllers\OrderController;

// Halaman utama redirect ke login admin
Route::get('/', function () {
    return redirect()->route('admin.login');
});

/**
 * Route untuk login (tanpa middleware auth)
 */
Route::prefix('admin')->group(function () {
    // Halaman login
    Route::get('login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('login', [AuthController::class, 'login'])->name('admin.login.submit');
});

/**
 * Route admin yang dilindungi middleware 'admin'
 * Hanya user yang sudah login yang bisa akses
 */
Route::prefix('admin')->middleware('admin')->group(function () {
    
    // Dashboard (Hanya Admin & Owner)
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->middleware('role:Admin,Owner')
        ->name('admin.dashboard');
    
    // Logout
    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');
    
    /**
     * User Management CRUD
     */
    Route::prefix('users')->name('admin.users.')->group(function () {
        // List semua user (semua admin bisa akses)
        Route::get('/', [UserController::class, 'index'])->name('index');
        
        // Tambah user baru (hanya admin super)
        Route::get('create', [UserController::class, 'create'])
            ->middleware('superadmin')
            ->name('create');
        Route::post('store', [UserController::class, 'store'])
            ->middleware('superadmin')
            ->name('store');
        
        // Edit & Delete user (semua admin bisa, tapi ada validasi di controller untuk admin super)
        Route::get('{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('{id}', [UserController::class, 'update'])->name('update');
        Route::delete('{id}', [UserController::class, 'destroy'])->name('destroy');
        
        // Setting menu per user
        Route::get('{id}/menu-setting', [UserController::class, 'menuSetting'])->name('menu-setting');
        Route::post('{id}/menu-setting', [UserController::class, 'updateMenuSetting'])->name('menu-setting.update');
    });
    
    /**
     * Role Management CRUD
     */
    Route::prefix('roles')->name('admin.roles.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('create', [RoleController::class, 'create'])->name('create');
        Route::post('store', [RoleController::class, 'store'])->name('store');
        Route::get('{id}/edit', [RoleController::class, 'edit'])->name('edit');
        Route::put('{id}', [RoleController::class, 'update'])->name('update');
        Route::delete('{id}', [RoleController::class, 'destroy'])->name('destroy');
    });
    
    /**
     * Company Settings
     */
    Route::prefix('company-settings')->name('admin.company-settings.')->group(function () {
        Route::get('/', [CompanySettingController::class, 'index'])->name('index');
        Route::post('store', [CompanySettingController::class, 'store'])->name('store');
    });
    
    /**
     * Master Data - Jenis Order CRUD
     */
    Route::prefix('master-data/jenis-order')->name('admin.jenis-order.')->group(function () {
        Route::get('/', [JenisOrderController::class, 'index'])->name('index');
        Route::get('create', [JenisOrderController::class, 'create'])->name('create');
        Route::post('store', [JenisOrderController::class, 'store'])->name('store');
        Route::get('{id}/edit', [JenisOrderController::class, 'edit'])->name('edit');
        Route::put('{id}', [JenisOrderController::class, 'update'])->name('update');
        Route::delete('{id}', [JenisOrderController::class, 'destroy'])->name('destroy');
    });
    
    /**
     * Master Data - Harga HPP CRUD
     */
    Route::prefix('master-data/harga-hpp')->name('admin.harga-hpp.')->group(function () {
        Route::get('/', [HargaHppController::class, 'index'])->name('index');
        Route::get('create', [HargaHppController::class, 'create'])->name('create');
        Route::post('store', [HargaHppController::class, 'store'])->name('store');
        Route::get('{id}/edit', [HargaHppController::class, 'edit'])->name('edit');
        Route::put('{id}', [HargaHppController::class, 'update'])->name('update');
        Route::delete('{id}', [HargaHppController::class, 'destroy'])->name('destroy');
    });
    
    /**
     * Order Management
     */
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('export', [OrderController::class, 'export'])->name('export');
        Route::get('batch-invoice', [OrderController::class, 'batchInvoice'])->name('batch-invoice');
        Route::get('create', [OrderController::class, 'create'])->name('create');
        Route::post('/', [OrderController::class, 'store'])->name('store');
        Route::get('{order}', [OrderController::class, 'show'])->name('show');
        Route::get('{order}/edit', [OrderController::class, 'edit'])->name('edit');
        Route::put('{order}', [OrderController::class, 'update'])->name('update');
        Route::delete('{order}', [OrderController::class, 'destroy'])->name('destroy');
        Route::patch('{order}/finish', [OrderController::class, 'finish'])->name('finish');
        Route::post('{order}/revise', [OrderController::class, 'revise'])->name('revise');
        Route::get('{order}/invoice', [OrderController::class, 'invoice'])->name('invoice');
    });
});
