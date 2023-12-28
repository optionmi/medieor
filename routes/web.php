<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\GroupController;

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
    return view('soil');
})->name('web.home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
});


Route::get('/groups', [GroupController::class, 'index'])->name('web.groups');


Route::middleware(['auth'])->group(function () {
    Route::post('/create-group', [GroupController::class, 'create'])->name('web.create.group');
    Route::post('/join-group', [GroupController::class, 'join'])->name('web.join.group');
});
