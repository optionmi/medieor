<?php

use App\Http\Controllers\Admin\TopicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\InfoPageController;
use App\Http\Controllers\Admin\CategoryPostController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\UserController;

Route::get('/login', function () {
    return view('admin.login');
})->name('home');

Route::post('/login', [AuthController::class, 'login'])->name('admin.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Categories
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.categories');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::get('/data', [CategoryController::class, 'datatable'])->name('admin.categories.data');
        Route::get('/topics/{category}', [CategoryController::class, 'getTopics'])->name('admin.category.topics');
    });

    // Events
    Route::group(['prefix' => 'events'], function () {
        Route::get('/', [EventController::class, 'index'])->name('admin.events');
        Route::post('/store', [EventController::class, 'store'])->name('admin.event.store');
        Route::get('/delete/{event}', [EventController::class, 'destroy'])->name('admin.event.destroy');
        Route::get('/data', [EventController::class, 'dataTable'])->name('admin.events.datatable');
    });

    // Donations
    Route::get('/donations', [DonationController::class, 'index'])->name('admin.donations');
    Route::get('/donations-datatable', [DonationController::class, 'datatable'])->name('admin.donations.datatable');


    // Users
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.users');
        Route::get('/users-datatable', [UserController::class, 'datatable'])->name('admin.users.datatable');
        Route::get('/delete-user/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
        Route::get('/reset-password/{user}', [UserController::class, 'resetPassword'])->name('admin.users.reset.password');
        Route::get('/mute-user/{user}', [UserController::class, 'mute'])->name('admin.user.mute');
        Route::get('/unmute-user/{user}', [UserController::class, 'unmute'])->name('admin.user.unmute');
    });


    // Info Pages
    Route::group(['prefix' => 'info-pages'], function () {
        Route::get('/aboutus', [InfoPageController::class, 'show_aboutus'])->name('admin.info-pages.aboutus');
        Route::post('/aboutus/update/{infoPage}', [InfoPageController::class, 'update'])->name('admin.info-pages.aboutus.update');

        Route::get('/ourpurpose', [InfoPageController::class, 'show_ourpurpose'])->name('admin.info-pages.ourpurpose');
        Route::post('/ourpurpose/update/{infoPage}', [InfoPageController::class, 'update'])->name('admin.info-pages.ourpurpose.update');

        Route::get('/contactus', [InfoPageController::class, 'show_contactus'])->name('admin.info-pages.contactus');
        Route::post('/contactus/update/{infoPage}', [InfoPageController::class, 'update'])->name('admin.info-pages.contactus.update');
    });

    // Category Posts
    Route::group(['prefix' => 'category-posts'], function () {
        Route::get('/', [CategoryPostController::class, 'index'])->name('admin.category.posts.index');
        Route::get('/category-posts-data', [CategoryPostController::class, 'dataTable'])->name('admin.category.posts.datatable');
        Route::post('/store', [CategoryPostController::class, 'store'])->name('admin.category.post.store');
        Route::get('/delete/{category_post}', [CategoryPostController::class, 'destroy'])->name('admin.category.post.destroy');

        // Topics
        Route::group(['prefix' => 'topics'], function () {
            Route::get('/', [TopicController::class, 'index'])->name('admin.topics.index');
            Route::get('/data', [TopicController::class, 'dataTable'])->name('admin.topics.datatable');
            Route::post('/store', [TopicController::class, 'store'])->name('admin.topics.store');
            Route::get('/delete/{topic}', [TopicController::class, 'destroy'])->name('admin.topic.destroy');
        });
    });

    // Groups
    Route::group(['prefix' => 'groups'], function () {
        Route::get('/all', [GroupController::class, 'index'])->name('admin.group.index');
        Route::get('/delete-group/{id}', [GroupController::class, 'destroy'])->name('admin.group.destroy');
        Route::post('/store', [GroupController::class, 'store'])->name('admin.group.store');

        Route::get('/group-members/{group}', [GroupController::class, 'members'])->name('admin.group.members');
        Route::get('/group-members-datatable/{group}', [GroupController::class, 'membersDatatable'])->name('admin.group.members.datatable');


        Route::get('/join-requests', [GroupController::class, 'joinRequest'])->name('admin.group.join.request');
        Route::get('/group-join-request-data', [GroupController::class, 'userJoinRequest'])->name('admin.group.join.request.data');
        Route::post('/toggle-join-request', [GroupController::class, 'toggleJoinRequest'])->name('admin.group.join.request.toggle');
    });
});

Route::middleware(['auth'])->prefix('group')->group(function () {


    // Route::get('/index', [GroupController::class, 'index'])->name('admin.group.index');
    Route::get('/groups-data', [GroupController::class, 'paginatedGroups'])->name('admin.group.groups.data');
    // Route::post('/store', [GroupController::class, 'store'])->name('admin.group.groups.store');


    // Route::get('/group-join-request', [GroupController::class, 'joinRequest'])->name('admin.group.join.request');
    // Route::get('/group-join-request-data', [GroupController::class, 'userJoinRequest'])->name('admin.group.join.request.data');
    // Route::post('/toggle-join-request', [GroupController::class, 'toggleJoinRequest'])->name('admin.group.join.request.toggle');

    Route::get('/categories-group', [CategoryController::class, 'groupsByCategory'])->name('admin.categories.groups');
    Route::get('/categories-groups-data', [CategoryController::class, 'groupsByCategoryId'])->name('admin.categories.groups.byid');
});

// Route::middleware(['auth'])->prefix('topic')->group(function () {
//     Route::get('/index', [CategoryPostController::class, 'index'])->name('admin.topic.index');
//     Route::get('/topic-data', [CategoryPostController::class, 'paginatedGroups'])->name('admin.topic.topics.data');
//     Route::post('/store', [CategoryPostController::class, 'store'])->name('admin.topic.topics.store');
// });
