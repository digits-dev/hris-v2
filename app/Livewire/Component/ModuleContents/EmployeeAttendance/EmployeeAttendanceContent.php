<?php

namespace App\Livewire\Component\ModuleContents\EmployeeAttendance;
use Livewire\Component;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Companies;
use Livewire\WithPagination;
use App\Helpers\CommonHelpers;
    
class EmployeeAttendanceContent extends Component{

    use WithPagination;

    // #[Url(history:true)]
    public $sortBy = "created_at";
    // #[Url(history:true)]
    public $sortDir = 'DESC';
    // #[Url(history:true)]
    public $search = ''; 
    // #[Url()]
    public $perPage = 10;

    public $isFilterModalOpen = false;

    public function setSortBy($fieldName){
        if($this->sortBy === $fieldName) {
            $this->sortDir = ($this->sortDir == "ASC") ? "DESC" : "ASC";
            return;
        }

        $this->sortBy = $fieldName;
        $this->sortDir = "DESC";
    }

   
    public function index(){
        if (!CommonHelpers::isView()) {
            CommonHelpers::redirect(url('/employee-accounts'), trans("ad_default.denied_access"), "danger");
        }
        return view("modules.employee-attendance.employee-attendance", ['routeName' => 'index']);

    }


    public function render(){

        $data = [];
        $data['users'] = Employee::search($this->search)->with(['company', 'hireLocation', 'currentLocation'])->orderBy($this->sortBy, $this->sortDir)->paginate($this->perPage);
        $data['companies'] = Companies::get();
        $data['locations'] = Location::get();

        return view("livewire.component.module-contents.employee-attendance.employee-attendance-content", $data);
    }
} 


