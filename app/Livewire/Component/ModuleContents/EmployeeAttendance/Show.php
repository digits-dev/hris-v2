<?php

namespace App\Livewire\Component\ModuleContents\EmployeeAttendance;

use Livewire\Component;
use App\Models\Location;
use App\Models\EmployeeLog;
use app\Helpers\CommonHelpers;
use Illuminate\Support\Facades\DB;

class Show extends Component
{

    
    public $employeeId;


    public function mount($employeeId){
        $this->employeeId = $employeeId;
    }

    public function index($employeeId){
        if (!CommonHelpers::isRead()) {
            CommonHelpers::redirect(CommonHelpers::getModulePath(), trans("ad_default.denied_access"), "danger");
        }

        return view('modules.employee-attendance.employee-attendance', ['routeName'=>'show', 'employeeId' => $employeeId]);
    } 

    public function render()
    {

        
        $data = [];

        $data['employeeData'] =  DB::table('employee_total_logs_duration_view as logs_duration')
        ->leftJoin('users', 'users.employee_id', 'logs_duration.emp_id')
        ->leftJoin('companies', 'companies.id', 'users.company_id')
        ->leftJoin('locations as hire_location', 'hire_location.id', 'users.hire_location_id')
        ->select([
            'users.employee_id',
            'users.first_name',
            'users.middle_name',
            'users.last_name',
            'companies.company_name as company',
            'hire_location.location_name as hire_location',
            'logs_duration.date_clocked_in',
            'logs_duration.first_clock_in',
            'logs_duration.last_clock_out',
            'logs_duration.total_time_bio_diff',
            'logs_duration.total_time_filo_diff',
            'logs_duration.total_time_filo_diff',
            'logs_duration.combined_terminal_in_ids',
            'logs_duration.combined_terminal_out_ids',

        ])
        ->where('users.employee_id', $this->employeeId)->first();


        $data['locations'] = Location::get();


        return view('livewire.component.module-contents.employee-attendance.show', 
        ['employeeData'=>$data['employeeData'], 'locations' => $data['locations']]);
    }
}
