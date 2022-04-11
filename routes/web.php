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
    Route::get('/edit/user/permission/{id}', [App\Http\Controllers\UserController::class, 'permission'])->name('permission');


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

    Route::get('/master/work-order-type', function () {
        return view('masters.work_order_type');
    })->name('work_orderType');

    Route::get('/master/billing-type', function () {
        return view('masters.billing_type');
    })->name('billingType');

    Route::get('/master/employee-list', function () {
        return view('masters.employee_list');
    })->name('employeeList');

    //Upload Excel File
    Route::get('/upload/employee', function () {
        return view('upload_file');
    })->name('upload-employee');

    Route::get('/master/role-type', function () {
        return view('masters.role_type');
    })->name('roleType');

    // Route::get('/employee/list', function () {
    //     return view('view_employee');
    // })->name('all-employee');

    Route::post('/upload/employee/csv', [App\Http\Controllers\EmployeeController::class, 'store'])->name('upload-employee-csv');

    //Project Routes
    Route::get('/project', [App\Http\Controllers\HomeController::class, 'project'])->name('projects');
    Route::get('/project/add', [App\Http\Controllers\ProjectController::class, 'addProject'])->name('add-project');
    Route::get('/project/edit/{id}', [App\Http\Controllers\ProjectController::class, 'editProject'])->name('edit-project');
    Route::get('/project/manage/docs/{id}', [App\Http\Controllers\ProjectController::class, 'manageDocs'])->name('docs-by-project');

    //Instrument Routes
    Route::get('/instrument', [App\Http\Controllers\HomeController::class, 'instrument'])->name('instruments');
    Route::get('/instrument/add', [App\Http\Controllers\InstrumentController::class, 'addInstrument'])->name('add-instrument');
    Route::get('/instrument/add/{id}', [App\Http\Controllers\InstrumentController::class, 'addInstrument'])->name('add-ins-by-project');
    Route::get('/instrument/edit/{id}', [App\Http\Controllers\InstrumentController::class, 'editInstrument'])->name('edit-instrument');

    //Work Order Routes
    Route::get('/work/order', [App\Http\Controllers\HomeController::class, 'workOrder'])->name('work-orders');
    Route::get('/work/order/add', [App\Http\Controllers\OrderController::class, 'addWorkOrder'])->name('add-work-order');
    Route::get('/work/order/add/{id}', [App\Http\Controllers\OrderController::class, 'addWorkOrder'])->name('add-work-by-project');
    Route::get('/work/order/edit/{id}', [App\Http\Controllers\OrderController::class, 'editWorkOrder'])->name('edit-work-order');


    //Invoice Routes
    Route::get('/invoice', [App\Http\Controllers\HomeController::class, 'invoice'])->name('invoices');
    Route::get('/invoice/add', [App\Http\Controllers\InvoiceController::class, 'addInvoice'])->name('add-invoice');
    Route::get('/invoice/add/{id}', [App\Http\Controllers\InvoiceController::class, 'addInvoice'])->name('add-invoice-by-project');
    Route::get('/invoice/edit/{id}', [App\Http\Controllers\InvoiceController::class, 'editInvoice'])->name('edit-invoice');
    
    //Team Routes
    Route::get('team/manage/{id}', [App\Http\Controllers\TeamController::class, 'addTeam'])->name('add-team-by-project');
    Route::get('team/manage', [App\Http\Controllers\HomeController::class, 'team'])->name('team');


    Route::get('/logout','App\Http\Controllers\Controller@logout')->name('logout');
    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
});


// Auth::routes();
Route::group(["middleware" => ["islogout"]], function(){
Route::get('/login','App\Http\Controllers\Controller@index')->name('login');
Route::get('/register','App\Http\Controllers\Controller@register')->name('register');
Route::get('/set-session','App\Http\Controllers\Controller@setSession')->name('setSession');

});

