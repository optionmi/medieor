<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TopicController;

use App\Http\Controllers\Admin\AuthController;

Route::get('/login', function () {
    return view('admin.login');
})->name('home');

Route::post('/login', [AuthController::class, 'login'])->name('admin.login');

Route::middleware(['auth'])->prefix('group')->group(function () {
    Route::get('/index', [GroupController::class, 'index'])->name('admin.group.index');
    Route::get('/groups-data', [GroupController::class, 'paginatedGroups'])->name('admin.group.groups.data');
    Route::post('/store', [GroupController::class, 'store'])->name('admin.group.groups.store');

    Route::get('/group-join-request', [GroupController::class, 'joinRequest'])->name('admin.group.join.request');
    Route::get('/group-join-request-data', [GroupController::class, 'userJoinRequest'])->name('admin.group.join.request.data');
    Route::post('/toggle-join-request', [GroupController::class, 'toggleJoinRequest'])->name('admin.group.join.request.toggle');
    
    Route::get('/categories-group', [CategoryController::class, 'groupsByCategory'])->name('admin.categories.groups');
    Route::get('/categories-groups-data', [CategoryController::class, 'groupsByCategoryId'])->name('admin.categories.groups.byid');
});

Route::middleware(['auth'])->prefix('topic')->group(function () {
    Route::get('/index', [TopicController::class, 'index'])->name('admin.topic.index');
    Route::get('/topic-data', [TopicController::class, 'paginatedGroups'])->name('admin.topic.topics.data');
    Route::post('/store', [TopicController::class, 'store'])->name('admin.topic.topics.store');
});
