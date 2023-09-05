<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostScreenController;
use App\Http\Controllers\DiaryController;

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

// ログインコントローラー
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('diary/logged', [LoginController::class, 'loggedIn'])->name('login.loggedIn');

Route::get('newcreate', [UserController::class, 'create']);
Route::post('newcreate/post', [PostScreenController::class, 'store'])->name('posted');

// diaryコントローラー
Route::get('diary/logOut', [DiaryController::class, 'logOut'])->name('logOut');
Route::get('diary/timeline', [DiaryController::class, 'index'])->name('diary.timeline');
Route::get('diary/mylist', [DiaryController::class, 'mylist'])->name('diary.mylist');
Route::post('diary/search', [DiaryController::class, 'search'])->name('diary.search');

Route::middleware(['checkAccess'])->group(function () {
    Route::get('diary', [DiaryController::class, 'index'])->name('diary.index');
    Route::get('postScreen', [PostScreenController::class, 'index'])->name('postScreen');    
});


// model
Route::get('admin/blog/show',[BlogController::class,'index']);
Route::get('admin/blog/create',[BlogController::class,'create']);
Route::post('admin/blog/store',[UserController::class,'store'])->name('admin.user.store');