<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Models\Admin;

Route::get('/', function(){
    return 'Api';
});

Route::prefix('v1')->group(function(){
    Route::apiResource('admin', AdminController::class);
    Route::post('/login', [AdminController::class, 'adminLogin'])->name('admin.login');
    Route::post('/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::post('/admin/forgot-password', [AdminController::class, 'forgotPassword'])->name('admin.forgotPassword');
    Route::post('/admin/reset-password', [AdminController::class, 'resetPassword'])->name('admin.resetPassword');
});
