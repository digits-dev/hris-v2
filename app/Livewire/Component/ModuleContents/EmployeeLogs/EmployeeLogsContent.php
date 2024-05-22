<?php

namespace App\Livewire\Component\ModuleContents\EmployeeLogs;

use App\Models\User;
use Livewire\Component;
use App\Models\Employee;
use Livewire\WithPagination;

class EmployeeLogsContent extends Component
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
        return view('modules.employee-logs.employee-logs-module');
    }
    
    public function render()
    {

        $users = Employee::search($this->search)->with([ 'hireLocation', 'currentLocation'])->orderBy($this->sortBy, $this->sortDir)->paginate($this->perPage);

        return view('livewire.component.module-contents.employee-logs.employee-logs-content', 
        ['users' => $users]);
 
    }
}
