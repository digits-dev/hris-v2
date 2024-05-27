<?php

namespace App\Livewire\Component\ModuleContents\EmployeeAccounts;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Helpers\CommonHelpers;
use App\Models\Companies;
use App\Models\Location;
use App\Models\Position;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\EmployeeLog;
use App\Exports\EmployeesExport;

class EmployeeAccountsContent extends Component
{
    use WithPagination;

    #[Url(history:true, as:'sort')]
    public $sortBy = "created_at";

    #[Url(history:true, as:'dir')]
    public $sortDir = 'DESC';

    #[Url(history:true)]
    public $search = ''; 

    #[Url(as:'per-page')]
    public $perPage = 10;

    public $userIds = [];

    public $selectedAll = false;

    public $isModalOpen = false;

    public $isFilterModalOpen = false;

    public $setTo = '';

    public $statusFnc = '';

    //Export
    public $isFilterExportModalOpen = false;
    public $filename;
    public $filters = [];

    public function mount()
    {
        $this->filename = 'Export '.CommonHelpers::getCurrentModule()->name.' - '.date('Y-m-d H:i:s');
        $this->filters =  ['company_id'=>2,
                           'position'=> '',
                           'hire_location_id'=>'',
                           'date_from'=>'',
                           'date_to'=>'',
                           'search' => ''];
    }
    
    public function index(){
        if (!CommonHelpers::isView()) {
            CommonHelpers::redirect(url('/employee-accounts'), trans("ad_default.denied_access"), "danger");
        }
        return view('modules.employee-accounts.employee-accounts-module', ['routeName' => 'index']);
    }

    // FOR FILTER MODAL

    public function openFilterModal(){
        $this->isFilterModalOpen = true;
    }

    public function closeFilterModal(){
        $this->isFilterModalOpen = false;
    }

    //EXPORT FILTER
    public function openFilterExportModal(){
        $this->isFilterExportModalOpen = true;
    }

    public function closeFilterExportModal(){
        $this->isFilterExportModalOpen = false;
    }
  
    // FOR BULK ACTIONS MODAL

    public function setToActive(){

        User::whereIn('id', $this->userIds)->update(['status' => 1]);
        $this->isModalOpen = false;
        $this->selectedAll = false;
        $this->userIds = [];

        // dd($this->userIds);
        
    }
    public function setToInactive(){
        User::whereIn('id', $this->userIds)->update(['status' => 0]);
        $this->isModalOpen = false;
        $this->selectedAll = false;
        $this->userIds = [];

        // dd($this->userIds);

    }


    public function openModal($status)
    {
        if($status == 'active'){
            $this->setTo = 'active';
            $this->statusFnc = 'setToActive';
        } else {
            $this->setTo = 'inactive';    
            $this->statusFnc = 'setToInactive';

        }

        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    
    public function setSortBy($fieldName){
        if($this->sortBy === $fieldName) {
            $this->sortDir = ($this->sortDir == "ASC") ? "DESC" : "ASC";
            return;
        }

        $this->sortBy = $fieldName;
        $this->sortDir = "DESC";
    }

    public function updatedSelectedAll()
    {
        if ($this->selectedAll) {
            $this->userIds = User::search($this->search)
                ->orderBy($this->sortBy, $this->sortDir)
                ->pluck('id')
                ->take($this->perPage)
                ->toArray(); // Select all user IDs
        } else {
            $this->userIds = []; // Deselect all user IDs
        }
    }

    public function updatedPage()
    {
        // Reset $selectedAll when navigating to a new page
        $this->selectedAll = false;
        $this->userIds = [];
    }

    public function updatedSearch(){
        $this->resetPage();
    }

    public function resetUserIds($users)
    {
        $this->userIds = [];
    }

    public function export(){
        $employee = new \App\Models\User();
        $filename = $this->filename;
        $requestFilters = $this->filters;  
        
        $query_filter_params = self::generateFilterParams($requestFilters);
        $filter_params = [
            'filters' => $query_filter_params,
            'search' => $requestFilters['search']
        ];
        $query = $employee->filterForReport($employee->generateReport(), $filter_params);
        return Excel::download(new EmployeesExport($query), $filename.'.xlsx');
    }

    public function generateFilterParams($request) {
        $request = $request;
        $query_filter_params = [];
        $company = array_filter((array)$request['company_id'] ?: []);
        $positions = array_filter((array)$request['position'] ?: []);
        $hire_locations = array_filter((array)$request['hire_location_id'] ?: []);
        $datefrom = array_filter((array)$request['date_from'] ?: []);
        $dateto = array_filter((array)$request['date_to'] ?: []);

        if (sizeof($company)) {
            $query_filter_params[] = [
                'method' => 'whereIn',
                'params' => ['company_id', $company]
            ];
        }
        if (sizeof($positions)) {
            $query_filter_params[] = [
                'method' => 'whereIn',
                'params' => ['position', $positions]
            ];
        }
        if (sizeof($hire_locations)) {
            $query_filter_params[] = [
                'method' => 'whereIn',
                'params' => ['hire_location_id', $hire_locations]
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

  
    public function render()
    {

        $data = [];
        $data['users'] =  User::search($this->search)->with(['company', 'hireLocation'])->orderBy($this->sortBy, $this->sortDir)->paginate($this->perPage);
        $data['companies'] = Companies::get();
        $data['locations'] = Location::get();
        $data['positions'] = Position::get();


   
        if ($this->selectedAll) {
            $this->userIds = $data['users']->pluck('id')->toArray();
        }

        return view('livewire.component.module-contents.employee-accounts.employee-accounts-content', $data);
    }

}
