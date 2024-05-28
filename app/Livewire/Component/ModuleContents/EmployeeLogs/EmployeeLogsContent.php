<?php

namespace App\Livewire\Component\ModuleContents\EmployeeLogs;

use App\Models\User;
use Livewire\Component;
use App\Models\Location;
use App\Models\EmployeeLog;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeeLogs;
use app\Helpers\CommonHelpers;
use Illuminate\Support\Facades\DB;
use App\Helpers\CommonHelpers as CM;

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

    public $isFilterModalOpen = false;

    // Filter Modal 
    public $current_location_id;
    public $hire_location_id;
    public $date_from;
    public $date_to;

    
    //Export
    public $isFilterExportModalOpen = false;
    public $filename;
    public $filters = [];

    public function mount()
    {
        $this->filename = 'Export '.CommonHelpers::getCurrentModule()->name.' - '.date('Y-m-d H:i:s');
        $this->filters =  ['current_location_id'=>'',
                           'hire_location_id'=>'',
                           'date_from'=>'',
                           'date_to'=>''];
    }

  

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

    

    
    // FOR FILTER MODAL

    public function filterData(){
        $data = [];
        $requestFilters = $this->all();

        $query_filter_params = self::generateFilterParams($requestFilters);

        $filter_params = [
            'filters' => $query_filter_params
        ];

        $isFilter = 0;

        if(sizeof($query_filter_params)){
            $isFilter = 1;
        }

        $alldatas = self::getAllData();

        $result = self::filteredData($alldatas, $filter_params)->orderBy($this->sortBy, $this->sortDir)->paginate($this->perPage);

        $data = ['isFilter' => $isFilter,
                 'datas' => $result,
                ];

        return $data;
      
    }

    public function filteredData($query, $params){
        $filters = $params['filters'];

        if($filters){
            foreach ($filters as $filter) {
                $query->{$filter['method']}(...$filter['params']);
            }
        }
        
        return $query;
    }


    public function getAllData(){
        $query = DB::table('employee_logs as logs')
        ->leftJoin('users', 'users.employee_id', 'logs.employee_id')
        ->leftJoin('locations as hire_location', 'hire_location.id', 'users.hire_location_id')
        ->leftJoin('locations as current_location', 'current_location.id', 'logs.clock_in_terminal_id')
        ->select([
            'users.first_name',
            'users.middle_name',
            'users.last_name',
            'hire_location.location_name as hire_location',
            'current_location.location_name as current_location',
            'logs.date_clocked_in',
            'logs.date_clocked_out',
            'logs.created_at'
        ]);
        return $query;
    }

    public function generateFilterParams($request) {
        $request = $request;
        $query_filter_params = [];
        $hire_locations = array_filter((array)$request['hire_location_id'] ?: []);
        $current_locations = array_filter((array)$request['current_location_id'] ?: []);
        $datefrom = array_filter((array)$request['date_from'] ?: []);
        $dateto = array_filter((array)$request['date_to'] ?: []);
       

  
        if (sizeof($hire_locations)) {
            $query_filter_params[] = [
                'method' => 'whereIn',
                'params' => ['hire_location.id', $hire_locations]
            ];
        }
  
        if (sizeof($current_locations)) {
            $query_filter_params[] = [
                'method' => 'whereIn',
                'params' => ['current_location.id', $current_locations]
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

    //export file

    public function export(){
    
        $filename = $this->filename;
        $requestFilters = $this->all();
        $query_filter_params = self::generateFilterParams($requestFilters);
        $filter_params = [
            'filters' => $query_filter_params
        ];
        $isFilter = 0;
        if(sizeof($query_filter_params)){
            $isFilter = 1;
        }
        $alldatas = self::getAllData();
        $result = self::filteredData($alldatas, $filter_params)->orderBy($this->sortBy, $this->sortDir);
        return Excel::download(new EmployeeLogs($result), $filename.'.xlsx');
    }


    public function render()
    {
        $data = [];
     
        if($this->search){
            $data['users'] =  User::search($this->search)
            ->leftJoin('employee_logs as logs', 'users.employee_id', 'logs.employee_id')
            ->leftJoin('locations as hire_location', 'hire_location.id', 'users.hire_location_id')
            ->leftJoin('locations as current_location', 'current_location.id', 'logs.clock_in_terminal_id')
            ->select([
                'users.first_name',
                'users.middle_name',
                'users.last_name',
                'hire_location.location_name as hire_location',
                'current_location.location_name as current_location',
                'logs.date_clocked_in',
                'logs.date_clocked_out',
                'logs.created_at'
                ])
            ->orderBy($this->sortBy, $this->sortDir)->paginate($this->perPage);
    
            } else{
                $filterData = self::filterData();

                if($filterData['isFilter'] == 0){
                    $data['employeeLogs'] =  self::getAllData()->orderBy($this->sortBy, $this->sortDir)->paginate($this->perPage);
                }else{
                    $data['isFilter'] = $filterData['isFilter'];
                    $data['employeeLogs'] =  $filterData['datas'];
                }
            }


        $data['locations'] = Location::get();

        return view('livewire.component.module-contents.employee-logs.employee-logs-content', $data);
 
    }
}
