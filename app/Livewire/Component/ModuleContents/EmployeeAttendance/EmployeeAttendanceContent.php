<?php

namespace App\Livewire\Component\ModuleContents\EmployeeAttendance;

use App\Models\Employee;
use App\Models\User;
use Livewire\Component;

class EmployeeAttendanceContent extends Component
{

    public function index()
    {
        return view('modules.employee-attendance.employee-attendance-module');
    }
    
    public function render()
    {
        return view('livewire.component.module-contents.employee-attendance.employee-attendance-content', ['users' => Employee::paginate(10)
    ]);
    }
}
