<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login',[LoginController::class, 'show']);
Route::post('diary',[LoginController::class, 'loggedIn'])->name('user.loggedIn');
Route::get('newcreate',[UserController::class, 'create']);
Route::get('diary',fn()=>view("diary"));

// model
Route::get('admin/blog/show',[BlogController::class,'index']);
Route::get('admin/blog/create',[BlogController::class,'create']);
Route::post('admin/blog/store',[UserController::class,'store'])->name('admin.user.store');