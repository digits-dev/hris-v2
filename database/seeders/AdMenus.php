<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdMenus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        self::submasterMenu();
        self::mainMenu();
    }

    public function submasterMenu() {
        DB::table('ad_menuses')->updateOrInsert(
            [
                'name'              => 'Employee',
            ],
            [
                'name'              => 'Employee',
                'type'              => 'URL',
                'path'              => '#',
                'slug'              => NULL,
                'color'             => NULL,
                'icon'              => 'images/navigation/menu-icon.png',
                'parent_id'         => 0,
                'is_active'         => 1,
                'is_dashboard'      => 0,
                'id_ad_privileges'  => 1,
                'sorting'           => 2
            ]
        );

        DB::table('ad_menuses')->updateOrInsert(
            [
                'name'              => 'Sub Master',
            ],
            [
                'name'              => 'Sub Master',
                'type'              => 'URL',
                'path'              => '#',
                'slug'              => NULL,
                'color'             => NULL,
                'icon'              => 'images/navigation/menu-icon.png',
                'parent_id'         => 0,
                'is_active'         => 1,
                'is_dashboard'      => 0,
                'id_ad_privileges'  => 1,
                'sorting'           => 3
            ]
        );
    }

    public function mainMenu() {
        DB::table('ad_menuses')->updateOrInsert(
            [
                'name'              => 'Dashboard',
            ],
            [
                'name'              => 'Dashboard',
                'type'              => 'Route',
                'path'              => 'Dashboard\DashboardContentGetIndex',
                'slug'              => 'dashboard',
                'color'             => NULL,
                'icon'              => 'images/navigation/dashboard-icon.png',
                'parent_id'         => 0,
                'is_active'         => 1,
                'is_dashboard'      => 1,
                'id_ad_privileges'  => 1,
                'sorting'           => 1
            ]
        );

        DB::table('ad_menuses')->updateOrInsert(
            [
                'name'              => 'Employee Accounts',
            ],
            [
                'name'              => 'Employee Accounts',
                'type'              => 'Route',
                'path'              => 'EmployeeAccounts\EmployeeAccountsContentGetIndex',
                'slug'              => 'employee_accounts',
                'color'             => NULL,
                'icon'              => 'images/navigation/user-accounts-icon.png',
                'parent_id'         => 1,
                'is_active'         => 1,
                'is_dashboard'      => 0,
                'id_ad_privileges'  => 1,
                'sorting'           => 1
            ]
        );

        DB::table('ad_menuses')->updateOrInsert(
            [
                'name'              => 'Employee Attendance',
            ],
            [
                'name'              => 'Employee Attendance',
                'type'              => 'Route',
                'path'              => 'EmployeeAttendance\EmployeeAttendanceContentGetIndex',
                'slug'              => 'employee_attendance',
                'color'             => NULL,
                'icon'              => 'images/navigation/employee-attendance-icon.png',
                'parent_id'         => 1,
                'is_active'         => 1,
                'is_dashboard'      => 0,
                'id_ad_privileges'  => 1,
                'sorting'           => 2
            ]
        );

        DB::table('ad_menuses')->updateOrInsert(
            [
                'name'              => 'Employee Logs',
            ],
            [
                'name'              => 'Employee Logs',
                'type'              => 'Route',
                'path'              => 'EmployeeLogs\EmployeeLogsContentGetIndex',
                'slug'              => 'employee_logs',
                'color'             => NULL,
                'icon'              => 'images/navigation/employee-logs-icon.png',
                'parent_id'         => 1,
                'is_active'         => 1,
                'is_dashboard'      => 0,
                'id_ad_privileges'  => 1,
                'sorting'           => 3
            ]
        );

        DB::table('ad_menuses')->updateOrInsert(
            [
                'name'              => 'Company',
            ],
            [
                'name'              => 'Company',
                'type'              => 'Route',
                'path'              => 'CompanyController\CompanyControllerContentGetIndex',
                'slug'              => 'companies',
                'color'             => NULL,
                'icon'              => 'images/navigation/company-icon.png',
                'parent_id'         => 2,
                'is_active'         => 1,
                'is_dashboard'      => 0,
                'id_ad_privileges'  => 1,
                'sorting'           => 1
            ]
        );

        DB::table('ad_menuses')->updateOrInsert(
            [
                'name'              => 'Location',
            ],
            [
                'name'              => 'Location',
                'type'              => 'Route',
                'path'              => 'LocationController\LocationControllerContentGetIndex',
                'slug'              => 'locations',
                'color'             => NULL,
                'icon'              => 'images/navigation/location-icon.png',
                'parent_id'         => 2,
                'is_active'         => 1,
                'is_dashboard'      => 0,
                'id_ad_privileges'  => 1,
                'sorting'           => 3
            ]
        );

        DB::table('ad_menuses')->updateOrInsert(
            [
                'name'              => 'Position',
            ],
            [
                'name'              => 'Position',
                'type'              => 'Route',
                'path'              => 'PositionController\PositionControllerContentGetIndex',
                'slug'              => 'positions',
                'color'             => NULL,
                'icon'              => 'images/navigation/position-icon.png',
                'parent_id'         => 2,
                'is_active'         => 1,
                'is_dashboard'      => 0,
                'id_ad_privileges'  => 1,
                'sorting'           => 4
            ]
        );

        DB::table('ad_menuses')->updateOrInsert(
            [
                'name'              => 'Department',
            ],
            [
                'name'              => 'Department',
                'type'              => 'Route',
                'path'              => 'DepartmentController\DepartmentControllerContentGetIndex',
                'slug'              => 'department',
                'color'             => NULL,
                'icon'              => 'images/navigation/department-icon.png',
                'parent_id'         => 2,
                'is_active'         => 1,
                'is_dashboard'      => 0,
                'id_ad_privileges'  => 1,
                'sorting'           => 2
            ]
        );

 
    }

}