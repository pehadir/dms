<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BranchController;

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
Route::get('/login', [AuthenticationController::class, 'loginView'])
        ->name('login.view');
        // ->middleware('checkUserIfLogin');
    Route::post('/login', [AuthenticationController::class, 'login'])->name('login');
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');
    Route::group(['middleware' => 'auth'], function () {
    Route::get('/',[DashboardController::class,'index'])->name('dashboard');
    Route::get('plan_menpower',[DashboardController::class,'index'])->name('plan_menpower');
    Route::post('search',[DashboardController::class,'search'])->name('search');
    Route::resource('branches', BranchController::class);
    Route::post('get-branch-data', [BranchController::class,'get_data'])->name('get-branch-data');
    Route::get('edit-branch', [BranchController::class,'edit'])->name('edit-branch');
    Route::post('update-branch', [BranchController::class,'update'])->name('update-branch');
    Route::post('delete-branch', [BranchController::class,'destroy'])->name('delete-branch');
    // user
    Route::get('user',[UserController::class,'index'])->name('user');
    Route::post('get-user',[UserController::class,'get_user'])->name('get-user');
    Route::post('store-user',[UserController::class,'store'])->name('store-user');
    Route::post('edit-user',[UserController::class,'edit'])->name('edit-user');
    Route::post('update-user',[UserController::class,'update'])->name('update-user');
    Route::post('delete-user',[UserController::class,'destroy'])->name('delete-user');
    
    // employee 
    Route::get('employee',[EmployeesController::class,'index'])->name('employee');
    Route::post('get-employee',[EmployeesController::class,'get_data'])->name('get-employee');
    Route::get('create-employee',[EmployeesController::class,'create'])->name('create-employee');
    Route::post('save-employee',[EmployeesController::class,'store'])->name('save-employee');
    Route::get('edit-employee/{id}',[EmployeesController::class,'edit']);
    Route::post('update-employee',[EmployeesController::class,'update'])->name('update-employee');
    Route::post('delete-employee',[EmployeesController::class,'destroy'])->name('delete-employee');
    Route::post('delete-file',[EmployeesController::class,'delete_file'])->name('delete-file');
    // attechment 
    Route::post('get_attechment',[EmployeesController::class,'get_attechment'])->name('get_attechment');
    // my profile
    Route::get('get-my-profile',[EmployeeController::class,'my_profile'])->name('get-my-profile');
    Route::post('change-profile',[EmployeeController::class,'change_profile'])->name('change-profile');
    Route::get('change_password',[UserController::class,'change_pass'])->name('change_password');
    Route::post('change-password-new',[UserController::class,'change_password_new'])->name('change-password-new');
    Route::post('change_store',[UserController::class,'change_store'])->name('change_store');
    

});
Route::fallback(function () {
    abort(404);
});