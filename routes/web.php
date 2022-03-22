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

    //User Routes
    Route::get('/user', [App\Http\Controllers\HomeController::class, 'users'])->name('users');
    Route::get('/add/user', [App\Http\Controllers\UserController::class, 'addUser'])->name('add-user');
    Route::get('/user/permission/{id}', [App\Http\Controllers\UserController::class, 'permission'])->name('permission');


    //Master Routes
    Route::get('/master/project-stages', function () {
        return view('masters.project_stage');
    })->name('projectStages');

    Route::get('/master/business-group', function () {
        return view('masters.business_group');
    })->name('businessGroup');

    Route::get('/master/project-type', function () {
        return view('masters.project_type');
    })->name('projectType');

    Route::get('/master/department', function () {
        return view('masters.department');
    })->name('department');

    Route::get('/master/ministry', function () {
        return view('masters.ministry');
    })->name('ministry');

    Route::get('/master/instrument-type', function () {
        return view('masters.instrument_type');
    })->name('instrumentType');

    Route::get('/master/instrument-purpose', function () {
        return view('masters.instrument_purpose');
    })->name('instrumentPurpose');

    Route::get('/master/master/work-order-type', function () {
        return view('masters.work_order_type');
    })->name('work_orderType');

    Route::get('/master/billing-type', function () {
        return view('masters.billing_type');
    })->name('billingType');

    Route::get('/master/employee-list', function () {
        return view('masters.employee_list');
    })->name('employeeList');

    //Project Routes
    Route::get('/project', [App\Http\Controllers\HomeController::class, 'project'])->name('projects');
    Route::get('/project/add', [App\Http\Controllers\ProjectController::class, 'addProject'])->name('add-project');
    Route::get('/project/edit/{id}', [App\Http\Controllers\ProjectController::class, 'editProject'])->name('edit-project');

    //Instrument Routes
    Route::get('/instrument', [App\Http\Controllers\HomeController::class, 'instrument'])->name('instruments');
    Route::get('/instrument/add', [App\Http\Controllers\InstrumentController::class, 'addInstrument'])->name('add-instrument');
    Route::get('/instrument/add/{id}', [App\Http\Controllers\InstrumentController::class, 'addInstrument'])->name('add-ins-by-project');
    Route::get('/instrument/edit/{id}', [App\Http\Controllers\InstrumentController::class, 'editInstrument'])->name('edit-instrument');



    Route::get('/logout','App\Http\Controllers\Controller@logout')->name('logout');
    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
});


// Auth::routes();
Route::group(["middleware" => ["islogout"]], function(){
Route::get('/login','App\Http\Controllers\Controller@index')->name('login');
Route::get('/register','App\Http\Controllers\Controller@register')->name('register');
Route::get('/set-session','App\Http\Controllers\Controller@setSession')->name('setSession');

});

