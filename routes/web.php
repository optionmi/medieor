<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\GroupController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentReplyController;
use App\Http\Controllers\TopicController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('home');
})->name('web.home');

Route::get('/groups/{cat_id}', [GroupController::class, 'index'])->name('web.groups');

Route::get('/category/{id}', [CategoryController::class, 'detail'])->name('category.detail');


Route::get('/group-join-requests', [GroupController::class, 'joinRequest'])->name('web.group.join.requests');



Route::middleware(['auth'])->group(function () {

    Route::get('/my-groups', [GroupController::class, 'myGroups'])->name('web.my.groups');
    
    Route::get('/my-groups/{id}', [GroupController::class, 'groupDetail'])->name('web.group.detail');

    Route::post('/create-group', [GroupController::class, 'create'])->name('web.create.group');
    Route::post('/join-group', [GroupController::class, 'join'])->name('web.join.group');

    Route::get('/group-join-requests', [GroupController::class, 'joinRequest'])->name('web.group.join.requests');

    Route::post('/confirm-group-join-request', [GroupController::class, 'confirmJoinRequest'])->name('confirm.group.join.request');
    Route::get('/air/groups', [GroupController::class, 'index'])->name('web.air.groups');

    Route::post('/save-post/{group_id}', [PostController::class, 'store'])->name('web.save.post');

    Route::post('/post-list', [PostController::class, 'postList'])->name('web.post.list');


    Route::prefix('comment')->group(function () {
        Route::post('/save', [CommentController::class, 'store'])->name('web.comment.save');
        Route::post('/post-comments', [CommentController::class, 'comments'])->name('web.post.comments');
        Route::post('/update/{id}', [CommentController::class, 'update'])->name('web.comment.update');
    });

    Route::prefix('like')->group(function () {
        Route::post('/toggle', [LikeController::class, 'toggleLike'])->name('web.like.toggle');
        Route::post('/delete', [LikeController::class, 'destroy'])->name('web.like.delete');
    });

    Route::prefix('comment-reply')->group(function () {
        Route::post('/save', [CommentReplyController::class, 'store'])->name('web.comment.reply.save');
        Route::put('/update-comment/{id}', [CommentReplyController::class, 'update'])->name('web.comment.reply.update');
    });

    Route::prefix('topic')->group(function () {
        Route::get('/all/{category_id}', [TopicController::class, 'index'])->name('topic.all');
    });
});
