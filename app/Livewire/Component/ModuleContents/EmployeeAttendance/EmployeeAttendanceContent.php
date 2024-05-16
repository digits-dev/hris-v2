<?php

namespace App\Livewire\Component\ModuleContents\EmployeeAttendance;

use App\Models\Employee;
use App\Models\User;
use Livewire\Component;

class EmployeeAttendanceContent extends Component
{

    
    public $sortBy = "created_at";
    public $sortDir = 'DESC';

    public function setSortBy($fieldName){
        if($this->sortBy === $fieldName) {
            $this->sortDir = ($this->sortDir == "ASC") ? "DESC" : "ASC";
            return;
        }

        $this->sortBy = $fieldName;
        $this->sortDir = "DESC";
    }

    public function index()
    {
        return view('modules.employee-attendance.employee-attendance-module');
    }
    
    public function render()
    {
        return view('livewire.component.module-contents.employee-attendance.employee-attendance-content', 
        ['users' => Employee::orderBy($this->sortBy,$this->sortDir)->paginate(10)
    ]);
 
    }
}
