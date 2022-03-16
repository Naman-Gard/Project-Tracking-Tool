<?php

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
Route::group(["middleware" => ["islogin"]], function(){
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/table', [App\Http\Controllers\HomeController::class, 'table'])->name('table');
    Route::get('/users', [App\Http\Controllers\HomeController::class, 'users'])->name('users');
    Route::get('/add/user', [App\Http\Controllers\UserController::class, 'addUser'])->name('add-user');
    Route::get('/logout','App\Http\Controllers\Controller@logout')->name('logout');
    Route::get('/permission/{id}', [App\Http\Controllers\UserController::class, 'permission'])->name('permission');
    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
});
// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();
Route::group(["middleware" => ["islogout"]], function(){
Route::get('/login','App\Http\Controllers\Controller@index')->name('login');
Route::get('/register','App\Http\Controllers\Controller@register')->name('register');
Route::get('/set-session','App\Http\Controllers\Controller@setSession')->name('setSession');
});

