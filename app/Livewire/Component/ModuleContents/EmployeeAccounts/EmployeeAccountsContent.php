<?php

namespace App\Livewire\Component\ModuleContents\EmployeeAccounts;

use App\Models\User;
use Livewire\Component;
use App\Models\Location;
use App\Models\Position;
use App\ImportTemplates\UsersImportTemplate;
use App\Models\Companies;
use App\Imports\ImportUsers;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Traits\SortableTrait;
use Livewire\WithFileUploads;
use App\Helpers\CommonHelpers;
use App\Exports\EmployeesExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeAccountsContent extends Component
{
    use WithFileUploads;
    use WithPagination;
    use SortableTrait;

    public $userIds = [];

    public $selectedAll = false;

    // Filter Modal
    public $company_id;
    public $hire_location_id;
    public $status;
    public $position;
    public $date_from;
    public $date_to;

    //Export
    public $isFilterExportModalOpen = false;
    public $filename;
    public $file_import;
    public $filters = [];

    public function mount()
    {
        date_default_timezone_set('Asia/Manila');
        $this->filename = 'Export ' . CommonHelpers::getCurrentModule()->name . ' - ' . date('Y-m-d H:i:s');
        $this->filters  = [
            'company_id'       => '',
            'position'         => '',
            'hire_location_id' => '',
            'date_from'        => '',
            'date_to'          => '',
            'search'           => '',
            'status'           => ''
        ];
    }

    public function index()
    {
        if (!CommonHelpers::isView()) {
            CommonHelpers::redirect(url('/'), trans("ad_default.denied_access"), "danger");
        }
        return view('modules.employee-accounts.employee-accounts-module', [ 'routeName' => 'index' ]);
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
        $query = DB::table('users')
            ->leftJoin('companies', 'companies.id', 'users.company_id')
            ->leftJoin('locations as hire_location', 'hire_location.id', 'users.hire_location_id')
            ->leftJoin('positions', 'positions.id', 'users.position_id')
            ->leftJoin('departments', 'departments.id', 'users.department_id')
            ->select([
                'users.id',
                'users.first_name',
                'users.middle_name',
                'users.last_name',
                'users.employee_id',
                'users.email',
                'companies.company_name as company',
                'departments.department_name as department',
                'hire_location.location_name as hire_location',
                'users.hire_date',
                'positions.position_name as position',
                'users.status',
                'users.image',
                'users.created_at'
            ])->where('users.id_ad_privileges', '<>', 1);
        return $query;
    }

    public function generateFilterParams($request)
    {
        $request             = $request;
        $query_filter_params = [];
        $company             = array_filter((array) $request['company_id'] ?: []);
        $positions           = array_filter((array) $request['position'] ?: []);
        $hire_locations      = array_filter((array) $request['hire_location_id'] ?: []);
        $datefrom            = array_filter((array) $request['date_from'] ?: []);
        $dateto              = array_filter((array) $request['date_to'] ?: []);
        $status              = array_filter((array) $request['status'], function ($value) {
            return $value !== null && $value !== "";
        });

        if (sizeof($status)) {
            $query_filter_params[] = [
                'method' => 'where',
                'params' => [ 'users.status', $status ]
            ];
        }
        if (sizeof($company)) {
            $query_filter_params[] = [
                'method' => 'whereIn',
                'params' => [ 'company_id', $company ]
            ];
        }
        if (sizeof($positions)) {
            $query_filter_params[] = [
                'method' => 'whereIn',
                'params' => [ 'positions.id', $positions ]
            ];
        }
        if (sizeof($hire_locations)) {
            $query_filter_params[] = [
                'method' => 'whereIn',
                'params' => [ 'hire_location_id', $hire_locations ]
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

    //EXPORT FILTER
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
        return Excel::download(new EmployeesExport($result), $filename . '.xlsx');
    }

    public function import()
    {   
        $this->validate([
            'file_import' => 'required|file|mimes:xlsx,xls,csv|max:10240', // Adjust rules as needed
        ]);
        $path = $this->file_import->store('file_import');
        $excel_path = storage_path('app') . '/' . $path;
        try {
            Excel::import(new ImportUsers, $excel_path);	
            session()->flash('message', 'Upload success!');
            session()->flash('message_type', 'success');
            return redirect('/employee-accounts');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            
            $error = [];
            foreach ($failures as $failure) {
                $line = $failure->row();
                foreach ($failure->errors() as $err) {
                    $error[] = $err . " on line: " . $line; 
                }
            }
            
            $errors = collect($error)->unique()->toArray();
        }
            session()->flash('message',  $errors[0]);
            session()->flash('message_type', 'danger');
            return redirect(url('/employee-accounts'), $errors[0], "danger");
    }

   


    public function downloadTemplate()
    {
        $filename = "import-users-".date('Y-m-d').".xlsx";
        return Excel::download(new UsersImportTemplate, $filename);
    }

  
    // FOR BULK ACTIONS MODAL

    public function setStatus($status){
        $statusValue = ($status == 'active') ? 1 : 0;

        User::whereIn('id', $this->userIds)->update([ 'status' => $statusValue ]);
        $this->selectedAll = false;
        $this->userIds     = [];

    }

    public function updatedSelectedAll()
    {
        if (!$this->selectedAll) {
            $this->userIds = []; // Deselect all user IDs
        }
    }

    public function updatedPage()
    {
        $this->selectedAll = false;
        $this->userIds     = [];
    }

    public function resetUserIds($users)
    {
        $this->userIds = [];
    }

    public function getColumnsHeader($data)
    {
        $cols = [];

        if(is_object($data)){
            $keys              = array_keys(get_object_vars($data));
            $excludeAttributes = [ 'id', 'image', 'created_at' ];

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

        $data = [];

        $filterData = self::filterData();

        if ($filterData['isFilter'] == 0) {
            $users = self::getAllData()->orderBy($this->sortBy, $this->sortDir);
            $data['users']      = $users->paginate($this->perPage);
            $data['colHeaders'] = self::getColumnsHeader($users->first());

        } else {
            $data['isFilter']   = $filterData['isFilter'];
            $data['users']      = $filterData['datas']->paginate($this->perPage);
            $data['colHeaders'] = self::getColumnsHeader($data['users']->first());
        }

        $data['companies'] = Companies::get();
        $data['locations'] = Location::get();
        $data['positions'] = Position::get();

        if ($this->selectedAll) {
            $this->userIds = $data['users']->pluck('id')->toArray();
        }

        return view('livewire.component.module-contents.employee-accounts.employee-accounts-content', $data);
    }

}
