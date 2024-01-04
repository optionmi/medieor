<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\GroupController;
use App\Http\Controllers\CategoryController;

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


Route::get('/space', function () {
    return view('space');
})->name('web.space');

Route::get('/fire', function () {
    return view('fire');
})->name('web.fire');

Route::get('/water', function () {
    return view('water');
})->name('web.water');

Route::get('/soil', function () {
    return view('soil');
})->name('web.soil');

Route::get('/air', function () {
    return view('air');
})->name('web.air');


Route::get('/space/groups', [GroupController::class, 'index'])->name('web.space.groups');
Route::get('/fire/groups', [GroupController::class, 'index'])->name('web.fire.groups');
Route::get('/water/groups', [GroupController::class, 'index'])->name('web.water.groups');
Route::get('/soil/groups', [GroupController::class, 'index'])->name('web.soil.groups');
Route::get('/air/groups', [GroupController::class, 'index'])->name('web.air.groups');

Route::get('/category/{id}', [CategoryController::class, 'detail'])->name('category.detail');

Route::get('/group-join-requests', [GroupController::class, 'joinRequest'])->name('web.group.join.requests');

Route::middleware(['auth'])->group(function () {
    Route::post('/create-group', [GroupController::class, 'create'])->name('web.create.group');
    Route::post('/join-group', [GroupController::class, 'join'])->name('web.join.group');

    Route::post('/confirm-group-join-request', [GroupController::class, 'confirmJoinRequest'])->name('confirm.group.join.request');
});
