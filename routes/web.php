<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GreetingController;

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

Route::get('login',[GreetingController::class, 'greeting']);
Route::post('diary',[GreetingController::class, 'posting']);
Route::get('newcreate',fn()=>view("NewCreate"));
Route::get('diary',fn()=>view("diary"));

// tesut