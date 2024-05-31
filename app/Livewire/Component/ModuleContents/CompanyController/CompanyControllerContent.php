<?php
namespace App\Livewire\Component\ModuleContents\CompanyController;
use Livewire\Component;
use App\Models\Companies;
use Livewire\Attributes\Url;
use App\Helpers\CommonHelpers;
use Illuminate\Support\Facades\Auth;

class CompanyControllerContent extends Component{

    
    #[Url(history:true)]
    public $search = null; 

    #[Url(as:'per-page')]
    public $perPage = 10;

    public $sortBy = "created_at";
    public $sortDir = 'DESC';

    public $company_id;
    public $company_name;
    public $status;


    public function setSortBy($fieldName){
        if($this->sortBy === $fieldName) {
            $this->sortDir = ($this->sortDir == "ASC") ? "DESC" : "ASC";
            return;
        }

        $this->sortBy = $fieldName;
        $this->sortDir = "DESC";
    }

    

    

    public function editForm($companyId) {
        $this->company_id = $companyId;

        $company = Companies::findOrFail($companyId);

        $this->company_name = $company->company_name;
        $this->status = $company->status;
    }


    public function save(){
        
        if (!CommonHelpers::isCreate()) {
            CommonHelpers::redirect(url('/employee-accounts'), trans("ad_default.denied_access"), 'danger');
        }

        $attribute = $this->validate([
            'company_name' => 'required|unique:companies,company_name'
        ]);

        Companies::create([
            'company_name' => $this->company_name,
            'created_by' => Auth::user()->id,
        ]);

        $this->reset('company_name');


        session()->flash('message', 'Created company successfully.');
        session()->flash('message_type', 'success');

        return  $this->redirect('/companies');
    }

    public function update(){
        
        if (!CommonHelpers::isUpdate()) {
            CommonHelpers::redirect(url('/employee-accounts'), trans("ad_default.denied_access"), 'danger');
        }

        $attribute = $this->validate([
            'company_name' => 'required|unique:companies,company_name,'. $this->company_id,
            'status' => 'required',
        ]);

        Companies::find($this->company_id)->update([
            'company_name' => $this->company_name,
            'status' => $this->status,
            'updated_by' => Auth::user()->id,
        ]);

        $this->reset('company_name', 'status');


        session()->flash('message', 'Updated company successfully.');
        session()->flash('message_type', 'success');

        return  $this->redirect('/companies');
    }



    public function index(){
        if (!CommonHelpers::isView()) {
            CommonHelpers::redirect(url('/'), trans("ad_default.denied_access"), "danger");
        }
        return view("modules.company-controller.company-controller");
    }

    public function render(){

        $data = [];

        $data['companies'] = Companies::search($this->search)->orderBy($this->sortBy, $this->sortDir)->paginate($this->perPage);

        return view("livewire.component.module-contents.company-controller.company-controller-content", $data);
    }
}