<?php

namespace App\Livewire\Component\ModuleContents\EmployeeAttendance;
use Livewire\Component;
use App\Models\EmployeeLog;
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

        // FOR FILTER MODAL

        public function openFilterModal(){
            $this->isFilterModalOpen = true;
        }
    
        public function closeFilterModal(){
            $this->isFilterModalOpen = false;
        }

   
    public function index(){
        if (!CommonHelpers::isView()) {
            CommonHelpers::redirect(url('/employee-accounts'), trans("ad_default.denied_access"), "danger");
        }
        return view("modules.employee-attendance.employee-attendance", ['routeName' => 'index']);

    }


    public function render(){

        $data = [];
        $data['employeeLogs'] = EmployeeLog::search($this->search)
        ->select(['id', 'employee_id', 'time_entry_id', 'date_clocked_in', 'date_clocked_out','clock_in_terminal_id','clock_out_terminal_id'])
        ->with([
            'hireLocation' => function ($query) {
                $query->select('id', 'location_name');
            },
            'currentLocation' => function ($query) {
                $query->select('id', 'location_name');
            },
            'user' => function ($query) {
                $query->select('employee_id', 'first_name', 'middle_name', 'last_name','company_id');
            },
            'company' => function ($query) {
                $query->select('id', 'company_name');
            }
        ])
        ->orderBy($this->sortBy, $this->sortDir)->paginate($this->perPage);

        
        $data['companies'] = Companies::get();
        $data['locations'] = Location::get();

        return view("livewire.component.module-contents.employee-attendance.employee-attendance-content", $data);
    }
} 


