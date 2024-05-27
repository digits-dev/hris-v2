<?php

namespace App\Livewire\Component\ModuleContents\EmployeeAttendance;
use Livewire\Component;
use App\Models\Location;
use App\Models\Companies;
use App\Models\EmployeeLog;
use Livewire\WithPagination;
use App\Helpers\CommonHelpers;
use Illuminate\Support\Facades\DB;
    
class EmployeeAttendanceContent extends Component{

    use WithPagination;

    // #[Url(history:true)]
    public $sortBy = "date_clocked_in";
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
   
        $data['employeeLogs'] =  DB::table('employee_total_logs_duration_view as logs_duration')
        ->leftJoin('users', 'users.employee_id', 'logs_duration.emp_id')
        ->leftJoin('companies', 'companies.id', 'users.company_id')
        ->leftJoin('locations as hire_location', 'hire_location.id', 'users.hire_location_id')
        ->leftJoin('locations as current_location', 'current_location.id', 'logs_duration.clock_in_terminal_id')
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
            'current_location.location_name as current_location',
            'logs_duration.total_time_bio_diff',
            'logs_duration.total_time_filo_diff',

        ])
        ->orderBy($this->sortBy, $this->sortDir)
        ->paginate($this->perPage);

        // dd($data['employeeLogs']);


        $data['companies'] = Companies::get();
        $data['locations'] = Location::get();

        return view("livewire.component.module-contents.employee-attendance.employee-attendance-content", $data);
    }
} 


