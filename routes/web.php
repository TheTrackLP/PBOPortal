<?php

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