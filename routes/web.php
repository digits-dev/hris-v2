<?php

use App\Http\Controllers\Authentication\LoginAuthController;
use App\Http\Controllers\Admin\AdPrivilegeController;
use App\Livewire\Component\ModuleContents\Dashboard\DashboardContent;
use App\Livewire\Component\ModuleContents\EmployeeAccounts\Create as CreateEmployeeAccount;
use App\Livewire\Component\ModuleContents\EmployeeAccounts\Show as ShowEmployeeAccount;
use App\Livewire\Component\ModuleContents\EmployeeAccounts\Edit as EditEmployeeAccount;
use App\Livewire\Component\ModuleContents\EmployeeAccounts\EmployeeAccountsContent;

use App\Livewire\Component\ModuleContents\EmployeeAttendance\EmployeeAttendanceContent;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['web']], function() {

    // Route::get('/', [LoginAuthController::class, 'index']);
    // Login
    Route::get('login', [LoginAuthController::class, 'index'])->name('login_page');
    Route::post('login-account', [LoginAuthController::class, 'authenticate'])->name('login');
    // Logout
    Route::get('logout', [LoginAuthController::class, 'logout'])->name('logout');

    // Backend
    
// Dashboard
    Route::get('dashboard', [DashboardContent::class, 'index'])->middleware('auth')->name('dashboard');
    // Employee Accounts
    Route::get('employee-accounts', [EmployeeAccountsContent::class, 'index'])->middleware('auth')->name('employee-accounts');
    Route::get('employee-accounts/create', [CreateEmployeeAccount::class, 'index'])->middleware('auth')->name('employee.create');
    Route::get('employee-accounts/{userId}', [ShowEmployeeAccount::class, 'index'])->middleware('auth')->name('employee.show');
    Route::get('employee-accounts/{userId}/edit', [EditEmployeeAccount::class, 'index'])->middleware('auth')->name('employee.edit');
    //Employee Attendance
    Route::get('employee-attendance', [EmployeeAttendanceContent::class, 'index'])->middleware('auth')->name('employee-attendance');

    //Employee Attendance
    Route::get('ad-privilege', [AdPrivilegeController::class, 'index'])->middleware('auth')->name('ad-privilege');


});