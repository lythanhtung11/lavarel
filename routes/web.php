<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/list',function (){
    $users = DB::table('users')->get();
    return view('pages.users.list',['users'=>$users]);
});

Route::resource('users', UserController::class)->middleware(['role:admin','auth']);
Route::resource('profiles',ProfileController::class)->middleware(['role:admin,viewer,editor','auth']);
Route::resource('orders',OrderController::class)->middleware(['role:editor,admin','auth']);
Route::resource('products',ProductController::class)->middleware(['role:editor','auth']);;


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
