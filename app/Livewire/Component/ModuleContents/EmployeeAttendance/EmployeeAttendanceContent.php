<?php

namespace App\Livewire\Component\ModuleContents\EmployeeAttendance;

use Livewire\Component;

class EmployeeAttendanceContent extends Component
{

    public function index()
    {
        return view('modules.employee-attendance.employee-attendance-module');
    }
    
    public function render()
    {
        return view('livewire.component.module-contents.employee-attendance.employee-attendance-content');
    }
}
