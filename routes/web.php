<?php

use App\Http\Controllers\Authentication\LoginAuthController;
use App\Livewire\Component\Backend\DashboardContent;
use App\Livewire\Component\Backend\EmployeeAccountsContent;
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

Route::get('/', [LoginAuthController::class, 'index']);
// Login
Route::get('login', [LoginAuthController::class, 'index']);
Route::post('login-account', [LoginAuthController::class, 'authenticate'])->name('login');
// Logout
Route::get('logout', [LoginAuthController::class, 'logout'])->name('logout');

// Backend
// Dashboard
Route::get('dashboard', [DashboardContent::class, 'index'])->name('dashboard');
// Employee Accounts
Route::get('employee-accounts', [EmployeeAccountsContent::class, 'index'])->name('employee-accounts');