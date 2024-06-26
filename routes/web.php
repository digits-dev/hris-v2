<?php

use App\Helpers\CommonHelpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ModulsController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\PrivilegesController;
use App\Http\Controllers\Admin\MenusController;
use App\Http\Controllers\Authentication\LoginAuthController;
use App\Livewire\Component\ModuleContents\Dashboard\DashboardContent;
use App\Livewire\Component\ModuleContents\LogUserAccess\LogUserAccessContent;
use App\Livewire\Component\ModuleContents\EmployeeAccounts\Edit as EditEmployeeAccount;
use App\Livewire\Component\ModuleContents\EmployeeAccounts\Show as ShowEmployeeAccount;
use App\Livewire\Component\ModuleContents\EmployeeAttendance\Show as ShowEmployeeAttendance;
use App\Livewire\Component\ModuleContents\EmployeeAccounts\Create as CreateEmployeeAccount;


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
 // Login
 Route::get('/', [LoginAuthController::class, 'index']);
 // Login
 Route::get('login', [LoginAuthController::class, 'index'])->name('login_page');
 // Contact Us
 Route::get('contact-us', function(){return view('authentication.contact-us');})->name('contact-us');
 
 Route::post('login-account', [LoginAuthController::class, 'authenticate'])->name('login');

 Route::middleware(['auth'])->group(function () {
   
    // Logout
    Route::get('logout', [LoginAuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('dashboard', [DashboardContent::class, 'index']);
    // Employee Accounts
    Route::get('employee-accounts/create', [CreateEmployeeAccount::class, 'index'])->middleware('auth')->name('employee.create');
    Route::get('employee-accounts/{userId}', [ShowEmployeeAccount::class, 'index'])->middleware('auth')->name('employee.show');
    Route::get('employee-accounts/{userId}/edit', [EditEmployeeAccount::class, 'index'])->middleware('auth')->name('employee.edit');
    //Employee changes password

    // Employee Attendance Summary
    Route::get('employee-attendance/{employeeId}', [ShowEmployeeAttendance::class, 'index'])->middleware('auth')->name('employee-attendance.show');

    Route::get('log-user-access', [LogUserAccessContent::class, 'index'])->middleware('auth')->name('log-user-access');

    //ADMIN PRIVILEGES
    Route::get(config('ad_url.ADMIN_PATH').'/privileges/create-privilege', [PrivilegesController::class, 'getCreate'])->middleware('auth')->name('create-privilege');
    Route::post(config('ad_url.ADMIN_PATH').'/privileges/save-privilege', [PrivilegesController::class, 'postAddSave'])->middleware('auth')->name('save-privilege');
    Route::get(config('ad_url.ADMIN_PATH').'/privileges/edit-privilege/{id}', [PrivilegesController::class, 'getEdit'])->middleware('auth')->name('edit-privilege');
    Route::post(config('ad_url.ADMIN_PATH').'/privileges/edit-privilege-save/{id}', [PrivilegesController::class, 'postEditSave'])->middleware('auth')->name('edit-privilege-save');
    //USERS MANAGEMENT
    Route::get(config('ad_url.ADMIN_PATH').'/users/add-user', [AdminUsersController::class, 'getAddUser'])->middleware('auth')->name('add-user');
    Route::get(config('ad_url.ADMIN_PATH').'/users/edit-user/{id}', [AdminUsersController::class, 'getEditUser'])->middleware('auth')->name('edit-user');
    Route::get('change-password', [AdminUsersController::class, 'getChangePasswordView'])->middleware('auth')->name('change-password');
    Route::post('change-password', [AdminUsersController::class, 'postUpdatePassword'])->name('update_password');
    Route::get('profile', [AdminUsersController::class, 'getProfileUser'])->name('profile');
    Route::post(config('ad_url.ADMIN_PATH').'/users/save-users', [AdminUsersController::class, 'postAddSave'])->middleware('auth')->name('save-user');
    Route::post(config('ad_url.ADMIN_PATH').'/users/save-edit-user', [AdminUsersController::class, 'postEditSave'])->middleware('auth')->name('save-edit-user');
    Route::post(config('ad_url.ADMIN_PATH').'/users/set-status', [AdminUsersController::class, 'setStatus'])->middleware('auth')->name('set-status');

    //MODULES
    Route::get(config('ad_url.ADMIN_PATH').'/module_generator/create-modules', [ModulsController::class, 'getAddModuls'])->middleware('auth')->name('add-modules');
    Route::post(config('ad_url.ADMIN_PATH').'/module_generator/save-module', [ModulsController::class, 'postAddSave'])->middleware('auth')->name('save-module');
    //MENUS
    Route::post(config('ad_url.ADMIN_PATH').'/menu_management/delete', [MenusController::class, 'postDeleteSave'])->middleware('auth')->name('MenusControllerGetDelete');
    Route::get(config('ad_url.ADMIN_PATH').'/menu_management/edit/{id}', [MenusController::class, 'getEdit'])->middleware('auth')->name('MenusControllerGetEdit');
    Route::post(config('ad_url.ADMIN_PATH').'/menu_management/add', [MenusController::class, 'postAddSave'])->middleware('auth')->name('MenusControllerPostSaveMenu');
    Route::post(config('ad_url.ADMIN_PATH').'/menu_management/edit-menu-save/{id}', [MenusController::class, 'postEditSave'])->middleware('auth')->name('edit-menus-save');

 });

    //ADMIN ROUTE
    Route::group([
        'middleware' => ['auth'],
        'prefix' => config('ad_url.ADMIN_PATH'),
        'namespace' => 'App\Http\Controllers\Admin',
    ], function () {
       
        // Todo: change table
        if (request()->is(config('ad_url.ADMIN_PATH'))) {
            $menus = DB::table('ad_menuses')->where('is_dashboard', 1)->first();
            if ($menus) {
                Route::get('/', 'Dashboard\DashboardContentGetIndex');
            } else {
                CommonHelpers::routeController('/', 'AdminController', 'App\Http\Controllers\Admin');
            }
        }

        // Todo: change table
        $modules = [];
        try {
            $modules = DB::table('ad_modules')->whereIn('controller', CommonHelpers::getMainControllerFiles())->get();
        } catch (\Exception $e) {
            Log::error("Load ad moduls is failed. Caused = " . $e->getMessage());
        }

        foreach ($modules as $v) {
            if (@$v->path && @$v->controller) {
                try {
                    CommonHelpers::routeController($v->path, $v->controller, 'app\Http\Controllers\Admin');
                } catch (\Exception $e) {
                    Log::error("Path = ".$v->path."\nController = ".$v->controller."\nError = ".$e->getMessage());
                }
            }
        }
    })->middleware('auth');

    //OTHERS ROUTE
    Route::group([
        'middleware' => ['auth'],
        'prefix' => config('ad_url.ADMIN_PATH'),
        'namespace' => 'App\Http\Controllers',
    ], function () {
       
        // Todo: change table
        if (request()->is(config('ad_url.ADMIN_PATH'))) {
            $menus = DB::table('ad_menuses')->where('is_dashboard', 1)->first();
            if ($menus) {
                Route::get('/', 'StatisticBuilderController@getDashboard');
            } else {
                CommonHelpers::routeController('/', 'AdminController', 'App\Http\Controllers');
            }
        }

        // Todo: change table
        $modules = [];
        try {
            $modules = DB::table('ad_modules')->whereIn('controller', CommonHelpers::getOthersControllerFiles())->get();
        } catch (\Exception $e) {
            Log::error("Load ad moduls is failed. Caused = " . $e->getMessage());
        }

        foreach ($modules as $v) {
            if (@$v->path && @$v->controller) {
                try {
                    CommonHelpers::routeController($v->path, $v->controller, 'app\Http\Controllers');
                } catch (\Exception $e) {
                    Log::error("Path = ".$v->path."\nController = ".$v->controller."\nError = ".$e->getMessage());
                }
            }
        }
    })->middleware('auth');

    //USERS ROUTE
    Route::group([
        'middleware' => ['auth'],
        'prefix' => '',
        'namespace' => 'App\Livewire\Component\ModuleContents',
    ], function () {
     
        // Todo: change table
        $modules = [];
        try {
            $modules = DB::table('ad_modules')->whereIn('controller', CommonHelpers::getLivewireControllerFiles())->get();
        } catch (\Exception $e) {
            Log::error("Load ad moduls is failed. Caused = " . $e->getMessage());
        }

        foreach ($modules as $v) {
            if (@$v->path && @$v->controller) {
                try {
                    CommonHelpers::routeLivewireController($v->path, $v->controller, 'app\Livewire\Component\ModuleContents');
                } catch (\Exception $e) {
                    Log::error("Path = ".$v->path."\nController = ".$v->controller."\nError = ".$e->getMessage());
                }
            }
        }
    })->middleware('auth');

