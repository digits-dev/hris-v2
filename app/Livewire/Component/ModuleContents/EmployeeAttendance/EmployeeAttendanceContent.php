<?php

namespace App\Livewire\Component\ModuleContents\EmployeeAttendance;
use Livewire\Component;
use App\Models\Location;
use App\Models\Companies;
use App\Models\EmployeeLog;
use Livewire\WithPagination;
use App\Helpers\CommonHelpers;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeeAttendanceSummary;

class EmployeeAttendanceContent extends Component{

    use WithPagination;
    public $isFilterExportModalOpen = false;
    // #[Url(history:true)]
    public $sortBy = "date_clocked_in";
    // #[Url(history:true)]
    public $sortDir = 'DESC';
    // #[Url(history:true)]
    public $search = ''; 
    // #[Url()]
    public $perPage = 10;
    public $isFilterModalOpen = false;
    public $filters = [];
    public $company_id;
    public $hire_location;
    public $time_in_location;
    public $date_from;
    public $date_to;
    public $isFilter = false;
    public $filename;
    protected $listeners = ['toggleFilterExportModal', 'toggleFilterModal'];

    public function mount(){
        date_default_timezone_set('Asia/Manila');
        $this->filename = 'Export '.CommonHelpers::getCurrentModule()->name.' - '.date('Y-m-d H:i:s');
    }

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
        $this->emit('toggleFilterModal', true);
    }

    public function closeFilterModal(){
        $this->emit('toggleFilterModal', false);
    }

     //EXPORT FILTER
     public function openFilterExportModal(){
        $this->emit('toggleFilterExportModal', true);
    }

    public function closeFilterExportModal(){
        $this->emit('toggleFilterExportModal', false);
    }
    
    public function index(){
        if (!CommonHelpers::isView()) {
            CommonHelpers::redirect(url('/'), trans("ad_default.denied_access"), "danger");
        }
        return view("modules.employee-attendance.employee-attendance", ['routeName' => 'index']);

    }

    public function filterData(){
        $data = [];
        $requestFilters = $this->all();
        $query_filter_params = self::generateFilterParams($requestFilters);
        $filter_params = [
            'filters' => $query_filter_params,
            'search'  => $this->search
        ];
        $isFilter = 0;
        if(sizeof($query_filter_params) || $this->search){
            $isFilter = 1;
        }
        $alldatas = self::getAllData();
        $result = self::filteredData($alldatas, $filter_params)->orderBy($this->sortBy, $this->sortDir)->paginate($this->perPage);
        $data = ['isFilter' => $isFilter,
                 'datas' => $result,
                ];
        return $data;
      
    }

    public function updatedSearch(){
        self::filterData();
    }

    public function generateFilterParams($request) {
        $request = $request;
        $query_filter_params = [];
        $company = array_filter((array)$request['company_id'] ?: []);
        $hire_locations = array_filter((array)$request['hire_location'] ?: []);
        $time_in_location = array_filter((array)$request['time_in_location'] ?: []);
        $datefrom = array_filter((array)$request['date_from'] ?: []);
        $dateto = array_filter((array)$request['date_to'] ?: []);

        if (sizeof($company)) {
            $query_filter_params[] = [
                'method' => 'whereIn',
                'params' => ['company_id', $company]
            ];
        }
        if (sizeof($hire_locations)) {
            $query_filter_params[] = [
                'method' => 'whereIn',
                'params' => ['hire_location_id', $hire_locations]
            ];
        }
        if (sizeof($time_in_location)) {
            $query_filter_params[] = [
                'method' => 'whereIn',
                'params' => ['hire_location_id', $time_in_location]
            ];
        }
        if (sizeof($datefrom) && sizeof($dateto)) {
            $query_filter_params[] = [
                'method' => 'whereBetween',
                'params' => ['hire_date', [$datefrom,$dateto]]
            ];
        }
        return $query_filter_params;
    }

    public function getAllData(){
        $query = DB::table('employee_total_logs_duration_view as logs_duration')
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
            'logs_duration.first_clock_in',
            'logs_duration.last_clock_out',
            DB::raw('DATE(logs_duration.first_clock_in) as date'),
            DB::raw('DATE_FORMAT(logs_duration.first_clock_in, "%a") as day'),
            'logs_duration.total_time_bio_diff',
            'logs_duration.total_time_filo_diff',
            'users.hire_date',
            'users.company_id',            
            'logs_duration.combined_terminal_in_ids',
            'logs_duration.combined_terminal_out_ids'
        ]);
        return $query;
    }

    public function filteredData($query, $params){
        $filters = $params['filters'];
        $search =  $params['search'] ?? '';

        foreach ($filters as $filter) {
            $query->{$filter['method']}(...$filter['params']);
        }

        if ($search)  {
            $search_filter = "
                users.first_name LIKE '%$search%' OR
                users.last_name LIKE '%$search%'
            ";
            $query->whereRaw("($search_filter)");
        }
        
        return $query;
    }

    public function exportFilter(){
        $filename = $this->filename;
        $requestFilters = $this->all();
        $query_filter_params = self::generateFilterParams($requestFilters);
        $filter_params = [
            'filters' => $query_filter_params,
            'search'  => $this->search
        ];
        $isFilter = 0;
        if(sizeof($query_filter_params) || $this->search){
            $isFilter = 1;
        }
        $alldatas = self::getAllData();
        $result = self::filteredData($alldatas, $filter_params)->orderBy($this->sortBy, $this->sortDir);
        return Excel::download(new EmployeeAttendanceSummary($result), $filename.'.xlsx');
    }

    public function render(){
        $data = [];
        $filterData = self::filterData();
  
        if($filterData['isFilter'] == 0){
            $data['employeeLogs'] =  self::getAllData()->orderBy($this->sortBy, $this->sortDir)->paginate($this->perPage);
        }else{
            $data['isFilter'] = $filterData['isFilter'];
            $data['employeeLogs'] =  $filterData['datas'];
        }
        $data['companies'] = Companies::get();
        $data['locations'] = Location::get();

        return view("livewire.component.module-contents.employee-attendance.employee-attendance-content", $data);
    }

} 


