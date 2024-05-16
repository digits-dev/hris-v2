<?php

namespace App\Livewire\Component\ModuleContents\EmployeeAttendance;

use App\Models\User;
use Livewire\Component;
use App\Models\Employee;
use Livewire\WithPagination;

class EmployeeAttendanceContent extends Component
{

    use WithPagination;

    // #[Url(history:true)]
    public $sortBy = "created_at";
    // #[Url(history:true)]
    public $sortDir = 'DESC';
    // #[Url(history:true)]
    public $search = ''; 
    // #[Url()]
    public $perPage = 10;


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
        ['users' => Employee::search($this->search)->orderBy($this->sortBy,$this->sortDir)->paginate($this->perPage)
    ]);
 
    }
}
