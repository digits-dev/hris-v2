<?php

namespace App\Livewire\Component\ModuleContents\EmployeeAttendance;

use Livewire\Component;
use App\Models\EmployeeLog;
use app\Helpers\CommonHelpers;

class Show extends Component
{

    
    public EmployeeLog $employee;


    public function mount($employeeId){
        $this->employee = EmployeeLog::findOrFail($employeeId);
    }

    public function index($employeeId){
        if (!CommonHelpers::isView()) {
            CommonHelpers::redirect(CommonHelpers::adminPath(), trans("ad_default.denied_access"));
        }
        return view('modules.employee-attendance.employee-attendance', ['routeName'=>'show', 'employeeId' =>$employeeId]);
    } 

    public function render()
    {
        return view('livewire.component.module-contents.employee-attendance.show', ['employee'=>$this->employee]);
    }
}
