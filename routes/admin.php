<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\TopicController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\InfoPageController;
use App\Http\Controllers\Admin\CPCommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GroupPostController;
use App\Http\Controllers\Superadmin\AdminController;
use App\Http\Controllers\Admin\CategoryPostController;
use App\Http\Controllers\Superadmin\SuperAdminController;

Route::get('/login', function () {
    return view('admin.login');
})->name('home');

Route::post('/login', [AuthController::class, 'login'])->name('admin.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Categories
    Route::middleware(['permission:can_manage_categories'])
        ->name('admin.categories.')
        ->prefix('categories')
        ->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update');
            Route::get('/data', [CategoryController::class, 'datatable'])->name('data');
            Route::get('/topics/{category}', [CategoryController::class, 'getTopics'])->name('topics');
        });

    // Events
    Route::middleware(['permission:can_manage_events'])
        ->prefix('events')
        ->group(function () {
            Route::get('/', [EventController::class, 'index'])->name('admin.events');
            Route::post('/store', [EventController::class, 'store'])->name('admin.event.store');
            Route::delete('/delete/{event}', [EventController::class, 'destroy'])->name('admin.event.destroy');
            Route::get('/data', [EventController::class, 'dataTable'])->name('admin.events.datatable');
        });

    // Articles
    Route::middleware(['permission:can_manage_articles'])
        ->prefix('articles')
        ->group(function () {
            Route::get('/', [ArticleController::class, 'index'])->name('admin.articles');
            Route::post('/store', [ArticleController::class, 'store'])->name('admin.article.store');
            Route::delete('/delete/{article}', [ArticleController::class, 'destroy'])->name('admin.article.destroy');
            Route::get('/data', [ArticleController::class, 'dataTable'])->name('admin.articles.datatable');
        });

    // Donations
    Route::middleware(['permission:can_manage_donations'])
        ->group(function () {
            Route::get('/donations', [DonationController::class, 'index'])->name('admin.donations');
            Route::get('/donations-datatable', [DonationController::class, 'datatable'])->name('admin.donations.datatable');
        });


    // Users
    Route::middleware(['permission:can_manage_users'])
        ->prefix('users')
        ->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('admin.users');
            Route::get('/users-datatable', [UserController::class, 'datatable'])->name('admin.users.datatable');
            Route::delete('/delete-user/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
            Route::get('/reset-password/{user}', [UserController::class, 'resetPassword'])->name('admin.users.reset.password');
            Route::get('/mute-user/{user}', [UserController::class, 'mute'])->name('admin.user.mute');
            Route::get('/unmute-user/{user}', [UserController::class, 'unmute'])->name('admin.user.unmute');
        });


    // Info Pages
    Route::middleware(['permission:can_manage_infopages'])
        ->prefix('info-pages')
        ->group(function () {
            Route::get('/aboutus', [InfoPageController::class, 'show_aboutus'])->name('admin.info-pages.aboutus');
            Route::post('/aboutus/update/{infoPage}', [InfoPageController::class, 'update'])->name('admin.info-pages.aboutus.update');

            Route::get('/ourpurpose', [InfoPageController::class, 'show_ourpurpose'])->name('admin.info-pages.ourpurpose');
            Route::post('/ourpurpose/update/{infoPage}', [InfoPageController::class, 'update'])->name('admin.info-pages.ourpurpose.update');

            Route::get('/contactus', [InfoPageController::class, 'show_contactus'])->name('admin.info-pages.contactus');
            Route::post('/contactus/update/{infoPage}', [InfoPageController::class, 'update'])->name('admin.info-pages.contactus.update');
        });

    // Category Posts
    Route::prefix('category-posts')
        ->group(function () {
            Route::middleware(['permission:can_manage_category_posts'])
                ->group(function () {
                    Route::get('/', [CategoryPostController::class, 'index'])->name('admin.category.posts.index');
                    Route::get('/category-posts-data', [CategoryPostController::class, 'dataTable'])->name('admin.category.posts.datatable');
                    Route::post('/store', [CategoryPostController::class, 'store'])->name('admin.category.post.store');
                    Route::delete('/delete/{category_post}', [CategoryPostController::class, 'destroy'])->name('admin.category.post.destroy');
                });

            // Topics
            Route::middleware(['permission:can_manage_category_topics'])
                ->prefix('topics')
                ->group(function () {
                    Route::get('/', [TopicController::class, 'index'])->name('admin.topics.index');
                    Route::get('/data', [TopicController::class, 'dataTable'])->name('admin.topics.datatable');
                    Route::post('/store', [TopicController::class, 'store'])->name('admin.topics.store');
                    Route::delete('/delete/{topic}', [TopicController::class, 'destroy'])->name('admin.topic.destroy');
                });

            // Comments
            Route::middleware(['permission:can_manage_category_comments'])
                ->group(function () {
                    Route::get('/comments', [CPCommentController::class, 'index'])->name('admin.category.posts.comments');
                    Route::get('/data', [CPCommentController::class, 'dataTable'])->name('admin.category.posts.comments.datatable');
                });
        });

    // Groups
    Route::prefix('groups')
        ->group(function () {
            Route::middleware(['permission:can_manage_groups'])
                ->group(function () {
                    Route::get('/all', [GroupController::class, 'index'])->name('admin.group.index');
                    Route::delete('/delete-group/{id}', [GroupController::class, 'destroy'])->name('admin.group.destroy');
                    Route::post('/store', [GroupController::class, 'store'])->name('admin.group.store');

                    Route::get('/group-members/{group}', [GroupController::class, 'members'])->name('admin.group.members');
                    Route::get('/group-members-datatable/{group}', [GroupController::class, 'membersDatatable'])->name('admin.group.members.datatable');


                    Route::get('/join-requests', [GroupController::class, 'joinRequest'])->name('admin.group.join.request');
                    Route::get('/group-join-request-data', [GroupController::class, 'userJoinRequest'])->name('admin.group.join.request.data');
                    Route::post('/toggle-join-request', [GroupController::class, 'toggleJoinRequest'])->name('admin.group.join.request.toggle');


                    Route::get('/groups-data', [GroupController::class, 'paginatedGroups'])->name('admin.group.groups.data');
                    Route::get('/categories-group', [CategoryController::class, 'groupsByCategory'])->name('admin.categories.groups');
                    Route::get('/categories-groups-data', [CategoryController::class, 'groupsByCategoryId'])->name('admin.categories.groups.byid');
                });

            // Posts
            Route::middleware(['permission:can_manage_group_posts'])
                ->group(function () {
                    Route::get('/posts', [GroupPostController::class, 'index'])->name('admin.group.posts');
                    Route::get('/posts-data', [GroupPostController::class, 'dataTable'])->name('admin.group.posts.datatable');
                    Route::delete('/post/{post}', [GroupPostController::class, 'destroy'])->name('admin.group.post.destroy');
                });

            // Comments
            Route::middleware(['permission:can_manage_group_comments'])
                ->group(function () {
                    Route::get('/comments', [CommentController::class, 'index'])->name('admin.group.comments');
                    Route::get('/data', [CommentController::class, 'dataTable'])->name('admin.group.comments.datatable');
                });
        });

    // Super Admin
    Route::middleware(['auth', 'role:superadmin'])
        ->prefix('superadmin')
        ->name('superadmin.')
        ->group(function () {
            // Superadmins
            Route::get('/superadmins', [SuperAdminController::class, 'index'])->name('superadmins.index');
            Route::get('/superadmins-datatable', [SuperAdminController::class, 'datatable'])->name('superadmins.datatable');

            // Admins
            Route::get('/admins', [AdminController::class, 'index'])->name('admins.index');
            Route::get('/admins-datatable', [AdminController::class, 'datatable'])->name('admins.datatable');
            Route::delete('/remove-admin/{user}', [AdminController::class, 'removeAdmin'])->name('admin.remove.admin');
            Route::get('/make-superadmin/{user}', [AdminController::class, 'makeSuperAdmin'])->name('admin.make.superadmin');

            // Users
            Route::get('/users', [App\Http\Controllers\Superadmin\UserController::class, 'index'])->name('users.index');
            Route::get('/users-datatable', [App\Http\Controllers\Superadmin\UserController::class, 'datatable'])->name('users.datatable');
            Route::post('/make-admin/{user}', [App\Http\Controllers\Superadmin\UserController::class, 'makeAdmin'])->name('user.make.admin');
        });
});
