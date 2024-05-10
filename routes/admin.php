<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GroupController;

use App\Http\Controllers\Admin\TopicController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InfoPageController;

Route::get('/login', function () {
    return view('admin.login');
})->name('home');

Route::post('/login', [AuthController::class, 'login'])->name('admin.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::post('/categories/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::get('/categories/data', [CategoryController::class, 'datatable'])->name('admin.categories.data');

    Route::group(['prefix' => 'info-pages'], function () {
        Route::get('/aboutus', [InfoPageController::class, 'show_aboutus'])->name('admin.info-pages.aboutus');
        Route::post('/aboutus/update/{infoPage}', [InfoPageController::class, 'update'])->name('admin.info-pages.aboutus.update');

        Route::get('/ourpurpose', [InfoPageController::class, 'show_ourpurpose'])->name('admin.info-pages.ourpurpose');
        Route::post('/ourpurpose/update/{id}', [InfoPageController::class, 'update'])->name('admin.info-pages.ourpurpose.update');

        Route::get('/contactus', [InfoPageController::class, 'show_contactus'])->name('admin.info-pages.contactus');
        Route::post('/contactus/update/{id}', [InfoPageController::class, 'update'])->name('admin.info-pages.contactus.update');
    });

    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
});

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
