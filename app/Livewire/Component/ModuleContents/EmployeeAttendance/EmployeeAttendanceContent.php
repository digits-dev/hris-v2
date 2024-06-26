<?php

namespace App\Livewire\Component\ModuleContents\EmployeeAttendance;

use App\Traits\SortableTrait;
use Livewire\Component;
use App\Models\Location;
use App\Models\Companies;
use App\Models\EmployeeLog;
use Livewire\WithPagination;
use App\Helpers\CommonHelpers;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeeAttendanceSummary;

class EmployeeAttendanceContent extends Component
{

    use WithPagination;
    use SortableTrait;

    public $isFilterExportModalOpen = false;
    public $isFilterModalOpen = false;
    public $filters = [];
    public $company_id;
    public $hire_location;
    public $time_in_location;
    public $date_from;
    public $date_to;
    public $isFilter = false;
    public $filename;
    protected $listeners = [ 'toggleFilterExportModal', 'toggleFilterModal' ];

    public function mount()
    {
        $this->setSortByField('first_time_in');

        date_default_timezone_set('Asia/Manila');
        $this->filename = 'Export ' . CommonHelpers::getCurrentModule()->name . ' - ' . date('Y-m-d H:i:s');
    }

    // FOR FILTER MODAL

    public function openFilterModal()
    {
        $this->emit('toggleFilterModal', true);
    }

    public function closeFilterModal()
    {
        $this->emit('toggleFilterModal', false);
    }

    //EXPORT FILTER
    public function openFilterExportModal()
    {
        $this->emit('toggleFilterExportModal', true);
    }

    public function closeFilterExportModal()
    {
        $this->emit('toggleFilterExportModal', false);
    }

    public function index()
    {
        if (!CommonHelpers::isView()) {
            session()->flash('message', trans("ad_default.denied_access", ['module' => 'Employee Attendance']));
            session()->flash('message_type', 'danger');
    
            return redirect(url('dashboard'));
        }
        
        return view("modules.employee-attendance.employee-attendance", [ 'routeName' => 'index' ]);

    }

    public function filterData()
    {
        $data                = [];
        $requestFilters      = $this->all();
        $query_filter_params = self::generateFilterParams($requestFilters);
        $filter_params       = [
            'filters' => $query_filter_params,
            'search'  => $this->search
        ];
        $isFilter            = 0;
        if (sizeof($query_filter_params) || $this->search) {
            $isFilter = 1;
        }
        $alldatas = self::getAllData();
        $result   = self::filteredData($alldatas, $filter_params)->orderBy($this->sortBy, $this->sortDir);
        $data     = [
            'isFilter' => $isFilter,
            'datas'    => $result,
        ];
        return $data;

    }

    public function updatedSearch()
    {
        self::filterData();
    }

    public function generateFilterParams($request)
    {
        $request             = $request;
        $query_filter_params = [];
        $company             = array_filter((array) $request['company_id'] ?: []);
        $hire_locations      = array_filter((array) $request['hire_location'] ?: []);
        $time_in_location    = array_filter((array) $request['time_in_location'] ?: []);
        $datefrom            = array_filter((array) $request['date_from'] ?: []);
        $dateto              = array_filter((array) $request['date_to'] ?: []);

        if (sizeof($company)) {
            $query_filter_params[] = [
                'method' => 'whereIn',
                'params' => [ 'company_id', $company ]
            ];
        }
        if (sizeof($hire_locations)) {
            $query_filter_params[] = [
                'method' => 'whereIn',
                'params' => [ 'hire_location_id', $hire_locations ]
            ];
        }
        if (sizeof($time_in_location)) {
            $query_filter_params[] = [
                'method' => 'whereIn',
                'params' => [ 'hire_location_id', $time_in_location ]
            ];
        }
        if (sizeof($datefrom) && sizeof($dateto)) {
            $query_filter_params[] = [
                'method' => 'whereBetween',
                'params' => [ 'hire_date', [ $datefrom, $dateto ] ]
            ];
        }
        return $query_filter_params;
    }

    public function getAllData()
    {
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
                'logs_duration.combined_terminal_in_ids',
                'logs_duration.combined_terminal_out_ids',
                'logs_duration.first_clock_in as first_time_in',
                'logs_duration.last_clock_out as last_time_out',
                DB::raw('DATE(logs_duration.first_clock_in) as date'),
                DB::raw('DATE_FORMAT(logs_duration.first_clock_in, "%a") as day'),
                'logs_duration.total_time_bio_diff as bio_duration',
                'logs_duration.total_time_filo_diff as filo_duration',
                'users.hire_date',
                'users.company_id',
            ]);
        return $query;
    }

    public function filteredData($query, $params)
    {
        $filters = $params['filters'];
        $search  = $params['search'] ?? '';

        foreach ($filters as $filter) {
            $query->{$filter['method']}(...$filter['params']);
        }

        if ($search) {
            $search_filter = "
                users.first_name LIKE '%$search%' OR
                users.last_name LIKE '%$search%'
            ";
            $query->whereRaw("($search_filter)");
        }

        return $query;
    }

    public function exportFilter()
    {
        $filename            = $this->filename;
        $requestFilters      = $this->all();
        $query_filter_params = self::generateFilterParams($requestFilters);
        $filter_params       = [
            'filters' => $query_filter_params,
            'search'  => $this->search
        ];
        $isFilter            = 0;
        if (sizeof($query_filter_params) || $this->search) {
            $isFilter = 1;
        }
        $alldatas = self::getAllData();
        $result   = self::filteredData($alldatas, $filter_params)->orderBy($this->sortBy, $this->sortDir);
        return Excel::download(new EmployeeAttendanceSummary($result), $filename . '.xlsx');
    }

    public function getColumnsHeader($data)
    {
        $cols = [];

         if(is_object($data)){

            $keys              = array_keys(get_object_vars($data));
            $excludeAttributes = [ 'employee_id', 'hire_date', 'day', 'company_id', 'combined_terminal_out_ids' ];

            // dump($keys);

            foreach ($keys as $key) {
                if (!in_array($key, $excludeAttributes)) {
                    $cols[] = [
                        'class'       => (str_replace('_', '-', $key)) . '-col',
                        'colName'     => $key,
                        'displayName' => ucwords(str_replace('_', ' ', $key))
                    ];
                }
            }
        }

        // dump($cols);

        return $cols;
    }

    public function render()
    {
        $data       = [];
        $filterData = self::filterData();

        if ($filterData['isFilter'] == 0) {
            $logs = self::getAllData()->orderBy($this->sortBy, $this->sortDir);
            $data['employeeLogs'] = $logs->paginate($this->perPage);
            $data['colHeaders']   = self::getColumnsHeader($logs->first());
        } else {
            $data['isFilter']     = $filterData['isFilter'];
            $data['employeeLogs'] = $filterData['datas']->paginate($this->perPage);
            $data['colHeaders']   = self::getColumnsHeader($data['employeeLogs']->first());
        }

        $data['companies'] = Companies::get();
        $data['locations'] = Location::get();

        return view("livewire.component.module-contents.employee-attendance.employee-attendance-content", $data);
    }

}


