<?php

namespace App\Livewire\Component\ModuleContents\EmployeeLogs;

use App\Models\User;
use App\Traits\SortableTrait;
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
    use SortableTrait;


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
        date_default_timezone_set('Asia/Manila');
        $this->filename = 'Export ' . CommonHelpers::getCurrentModule()->name . ' - ' . date('Y-m-d H:i:s');

        $this->filters = [
            'current_location_id' => '',
            'hire_location_id'    => '',
            'date_from'           => '',
            'date_to'             => ''
        ];
    }


    public function index()
    {
        if (!CommonHelpers::isView()) {
            CommonHelpers::redirect(url('/'), trans("ad_default.denied_access"), "danger");
        }

        return view('modules.employee-logs.employee-logs-module');
    }


    // FOR FILTER MODAL


    public function updatedSearch()
    {
        self::filterData();
        $this->resetPage();
    }

    public function filterData()
    {
        $data           = [];
        $requestFilters = $this->all();

        $query_filter_params = self::generateFilterParams($requestFilters);

        $filter_params = [
            'filters' => $query_filter_params,
            'search'  => $this->search
        ];

        $isFilter = 0;

        if (sizeof($query_filter_params) || $this->search) {
            $isFilter = 1;
        }

        $alldatas = self::getAllData();

        $result = self::filteredData($alldatas, $filter_params)->orderBy($this->sortBy, $this->sortDir);

        $data = [
            'isFilter' => $isFilter,
            'datas'    => $result,
        ];

        return $data;

    }

    public function filteredData($query, $params)
    {
        $filters = $params['filters'];
        $search  = $params['search'] ?? '';


        if ($filters) {
            foreach ($filters as $filter) {
                $query->{$filter['method']}(...$filter['params']);
            }
        }

        if ($search) {
            $cleanVal = trim($search);
            $query->whereRaw("CONCAT(users.first_name, ' ', users.middle_name, ' ', users.last_name) LIKE '%$cleanVal%'");
        }


        return $query;
    }


    public function getAllData()
    {
        $query = DB::table('employee_logs as logs')
            ->leftJoin('users', 'users.employee_id', 'logs.employee_id')
            ->leftJoin('locations as hire_location', 'hire_location.id', 'users.hire_location_id')
            ->leftJoin('locations as current_location', 'current_location.id', 'logs.clock_in_terminal_id')
            ->select([
                'logs.employee_id',
                'users.first_name',
                'users.middle_name',
                'users.last_name',
                'hire_location.location_name as location',
                'current_location.location_name as current_location',
                'logs.date_clocked_in as time_in',
                'logs.date_clocked_out as time_out',
                DB::raw('DATE(logs.date_clocked_in) as date'),
                DB::raw('DATE_FORMAT(logs.date_clocked_in, "%a") as day'),
                DB::raw('TIMEDIFF(logs.date_clocked_out, logs.date_clocked_in) as bio_duration'),
                'logs.created_at',
            ]);
        return $query;
    }

    public function generateFilterParams($request)
    {
        $request             = $request;
        $query_filter_params = [];
        $hire_locations      = array_filter((array) $request['hire_location_id'] ?: []);
        $current_locations   = array_filter((array) $request['current_location_id'] ?: []);
        $datefrom            = array_filter((array) $request['date_from'] ?: []);
        $dateto              = array_filter((array) $request['date_to'] ?: []);



        if (sizeof($hire_locations)) {
            $query_filter_params[] = [
                'method' => 'whereIn',
                'params' => [ 'hire_location.id', $hire_locations ]
            ];
        }

        if (sizeof($current_locations)) {
            $query_filter_params[] = [
                'method' => 'whereIn',
                'params' => [ 'current_location.id', $current_locations ]
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

    //export file

    public function export()
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
        return Excel::download(new EmployeeLogs($result), $filename . '.xlsx');
    }

    public function getColumnsHeader($data)
    {
        $cols = [];

        if(is_object($data)){

            $keys              = array_keys(get_object_vars($data));
            $excludeAttributes = [ 'employee_id', 'day', 'created_at' ];

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
        };

        // dump($cols);

        return $cols;
    }

    public function render()
    {

        $data = [];

        $filterData = self::filterData();

        if ($filterData['isFilter'] == 0) {
            $logs                 = self::getAllData()->orderBy($this->sortBy, $this->sortDir);
            $data['employeeLogs'] = $logs->paginate($this->perPage);
            $data['colHeaders']   = self::getColumnsHeader($logs->first());
        } else {
            $data['isFilter']     = $filterData['isFilter'];
            $data['employeeLogs'] = $filterData['datas']->paginate($this->perPage);
            $data['colHeaders']   = self::getColumnsHeader($data['employeeLogs']->first());
        }


        $data['locations'] = Location::get();

        return view('livewire.component.module-contents.employee-logs.employee-logs-content', $data);

    }
}
