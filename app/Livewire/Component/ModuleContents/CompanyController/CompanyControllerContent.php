<?php
namespace App\Livewire\Component\ModuleContents\CompanyController;

use App\ImportTemplates\CompaniesImportTemplate;
use Livewire\Component;
use App\Models\Companies;
use Livewire\Attributes\Url;
use App\Traits\SortableTrait;
use App\Helpers\CommonHelpers;
use App\Imports\ImportCompanies;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class CompanyControllerContent extends Component
{

    use SortableTrait;
    use WithFileUploads;

    public $company_id;
    public $company_name;
    public $status;
    public $file_import;


    public function editForm($companyId)
    {
        $this->company_id = $companyId;

        $company = Companies::findOrFail($companyId);

        $this->company_name = $company->company_name;
        $this->status       = $company->status;
    }


    public function save()
    {

  
        $attribute = $this->validate([
            'company_name' => 'required|unique:companies,company_name'
        ]);

        Companies::create([
            'company_name' => $this->company_name,
            'created_by'   => Auth::user()->id,
        ]);

        $this->reset('company_name');


        session()->flash('message', 'Created company successfully.');
        session()->flash('message_type', 'success');

        return $this->redirect('/companies');
    }

    public function update()
    {

        $attribute = $this->validate([
            'company_name' => 'required|unique:companies,company_name,' . $this->company_id,
            'status'       => 'required',
        ]);

        Companies::find($this->company_id)->update([
            'company_name' => $this->company_name,
            'status'       => $this->status,
            'updated_by'   => Auth::user()->id,
        ]);

        $this->reset('company_name', 'status');


        session()->flash('message', 'Updated company successfully.');
        session()->flash('message_type', 'success');

        return $this->redirect('/companies');
    }

    public function import()
    {   
        $this->validate([
            'file_import' => 'required|file|mimes:xlsx,xls,csv|max:10240'
        ]);
        
        $path = $this->file_import->store('file_import');
        $excel_path = storage_path('app') . '/' . $path;

        try {
            Excel::import(new ImportCompanies, $excel_path);	

            session()->flash('message', 'Upload Success!');
            session()->flash('message_type', 'success');
      
            return $this->redirect('/companies');
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
        return $this->redirect('/companies');
    }

    public function downloadTemplate()
    {
        $filename = "import-companies-".date('Y-m-d').".xlsx";
        return Excel::download(new CompaniesImportTemplate, $filename);
    }

    public function index()
    {
        if (!CommonHelpers::isView()) {
            CommonHelpers::redirect(url('/'), trans("ad_default.denied_access"), "danger");
        }
        return view("modules.company-controller.company-controller");
    }

    public function render()
    {

        $data = [];

        $data['companies'] = Companies::search($this->search)->orderBy($this->sortBy, $this->sortDir)->paginate($this->perPage);

        return view("livewire.component.module-contents.company-controller.company-controller-content", $data);
    }
}
