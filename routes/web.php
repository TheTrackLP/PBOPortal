<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\DivisionController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\StaffController as BackendStaffController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\StaffController;
use App\Http\Controllers\Frontend\ContactController;
use Illuminate\Support\Facades\Route;

Route::group([], function() {
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/about', [AboutController::class, 'AboutIndex'])->name('about');
    Route::get('/staff', [StaffController::class, 'StaffIndex'])->name('staff');
    Route::get('/contact-us', [ContactController::class, 'ContactIndex'])->name('contact');
});

Route::group([], function(){
    Route::get('/admin', [AdminController::class, 'AdminDashboard'])->name('admin.dash');
    Route::controller(BackendStaffController::class)->group(function(){
        Route::get('/admin/staff', 'BackStaffIndex')->name('admin.staff');
        Route::post('/admin/staff/add', 'AddStaff')->name('staff.store');
        Route::post('/admin/staff/update/{id}', 'UpdateStaff')->name('staff.update');
        Route::post('/admin/staff/order/update', 'staffOrder')->name('staff.update.order');
        Route::post('/admin/staff/status-update/{id}', 'changeStaffStatus')->name('staff.status');
    });

    Route::controller(DivisionController::class)->group(function(){
        Route::get('/admin/division', 'divisionIndex')->name('admin.div');
        Route::post('/admin/division/add', 'divisionAdd')->name('div.add');
    });

    Route::controller(SettingsController::class)->group(function(){
        Route::get('/admin/settings', 'indexSettings')->name('admin.settings');
        Route::post('/admin/settings/update', 'settingsUpdate')->name('settings.update');
    });
});