<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\CategoryController;

use App\Http\Controllers\Admin\AuthController;

Route::get('/login', function () {
    return view('admin.login');
})->name('home');

Route::post('/login', [AuthController::class, 'login'])->name('admin.login');

Route::prefix('group')->group(function () {
    Route::get('/index', [GroupController::class, 'index'])->name('admin.group.index');
    Route::get('/groups-data', [GroupController::class, 'paginatedGroups'])->name('admin.group.groups.data');
    Route::post('/store', [GroupController::class, 'store'])->name('admin.group.groups.store');

    Route::get('/categories-group', [CategoryController::class, 'groupsByCategory'])->name('admin.categories.groups');
    Route::get('/categories-groups-data', [CategoryController::class, 'groupsByCategoryId'])->name('admin.categories.groups.byid');
});
