<?php

use App\Http\Controllers\Authentication\LoginAuthController;
use App\Http\Controllers\Admin\PrivilegesController;
use App\Livewire\Component\ModuleContents\Dashboard\AdminAttendanceStatisticsComponent;
use App\Livewire\Component\ModuleContents\Dashboard\DashboardContent;
use App\Livewire\Component\ModuleContents\EmployeeAccounts\Create as CreateEmployeeAccount;
use App\Livewire\Component\ModuleContents\EmployeeAccounts\Show as ShowEmployeeAccount;
use App\Livewire\Component\ModuleContents\EmployeeAccounts\Edit as EditEmployeeAccount;
use App\Livewire\Component\ModuleContents\EmployeeAccounts\EmployeeAccountsContent;

use App\Livewire\Component\ModuleContents\EmployeeAttendance\EmployeeAttendanceContent;
use App\Livewire\Component\ModuleContents\LogUserAccess\LogUserAccessContent;
use Illuminate\Support\Facades\Route;
use App\Helpers\CommonHelpers;

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
Route::get('login', [LoginAuthController::class, 'index'])->name('login_page');
// Contact Us
Route::get('contact-us', function(){return view('authentication.contact-us');})->name('contact-us');

Route::post('login-account', [LoginAuthController::class, 'authenticate'])->name('login');

Route::group(['middleware' => ['web']], function() {
    // Login
 
    // Logout
    Route::get('logout', [LoginAuthController::class, 'logout'])->name('logout');
    // Backend
    // Dashboard
    Route::get('dashboard', [DashboardContent::class, 'index'])->middleware('auth')->name('dashboard');

    Route::get('employee-accounts/create', [CreateEmployeeAccount::class, 'index'])->middleware('auth')->name('employee.create');
    Route::get('employee-accounts/{userId}', [ShowEmployeeAccount::class, 'index'])->middleware('auth')->name('employee.show');
    Route::get('employee-accounts/{userId}/edit', [EditEmployeeAccount::class, 'index'])->middleware('auth')->name('employee.edit');

    Route::get('log-user-access', [LogUserAccessContent::class, 'index'])->middleware('auth')->name('log-user-access');

    //ADMIN
    Route::get(config('ad_url.ADMIN_PATH').'/create-privilege', [PrivilegesController::class, 'getCreate'])->middleware('auth')->name('create-privilege');
    Route::post(config('ad_url.ADMIN_PATH').'/save-privilege', [PrivilegesController::class, 'postAddSave'])->middleware('auth')->name('save-privilege');
});

    //ADMIN ROUTE
    Route::group([
        'middleware' => ['web'],
        'prefix' => config('ad_url.ADMIN_PATH'),
        'namespace' => 'App\Http\Controllers\Admin',
    ], function () {
       
        // Todo: change table
        if (request()->is(config('ad_url.ADMIN_PATH'))) {
            $menus = DB::table('ad_menuses')->where('is_dashboard', 1)->first();
            if ($menus) {
                Route::get('/', 'StatisticBuilderController@getDashboard');
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
    });

    //USERS ROUTE
    Route::group([
        'middleware' => ['web'],
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
    });

