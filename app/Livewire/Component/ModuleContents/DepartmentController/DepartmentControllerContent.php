<?php
namespace App\Livewire\Component\ModuleContents\DepartmentController;

use App\ImportTemplates\DepartmentImportTemplate;
use Livewire\Component;
use App\Models\Companies;
use App\Models\Department;
use Livewire\Attributes\Url;
use App\Traits\SortableTrait;
use App\Helpers\CommonHelpers;
use App\Imports\ImportDepartments;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class DepartmentControllerContent extends Component{

    use SortableTrait;
    use WithFileUploads;

    public $department_id;
    public $department_name;
    public $status;
    public $file_import;


    public function editForm($department_id)
    {
        $this->department_id = $department_id;

        $department = Department::findOrFail($department_id);

        $this->department_name = $department->department_name;
        $this->status = $department->status;
    }


    public function save()
    {

        if (!CommonHelpers::isCreate()) {
            CommonHelpers::redirect(url('/employee-accounts'), trans("ad_default.denied_access"), 'danger');
        }

        $attribute = $this->validate([
            'department_name' => 'required|unique:departments,department_name'
        ]);

        Department::create([
            'department_name' => $this->department_name,
            'created_by'   => Auth::user()->id,
        ]);

        $this->reset('department_name');


        session()->flash('message', 'Created Deparment successfully.');
        session()->flash('message_type', 'success');

        return $this->redirect('/department');
    }

    public function update()
    {

        // if (!CommonHelpers::isUpdate()) {
        //     CommonHelpers::redirect(url('/employee-accounts'), trans("ad_default.denied_access"), 'danger');
        // }

        $attribute = $this->validate([
            'department_name' => 'required|unique:departments,department_name,' . $this->department_id,
            'status'       => 'required',
        ]);

        Department::find($this->department_id)->update([
            'department_name' => $this->department_name,
            'status'       => $this->status,
            'updated_by'   => Auth::user()->id,
        ]);

        $this->reset('department_name', 'status');


        session()->flash('message', 'Updated Department successfully.');
        session()->flash('message_type', 'success');

        return $this->redirect('/department');
    }

    
    public function import()
    {   
        $this->validate([
            'file_import' => 'required|file|mimes:xlsx,xls,csv|max:10240'
        ]);
        
        $path = $this->file_import->store('file_import');
        $excel_path = storage_path('app') . '/' . $path;

        try {
            Excel::import(new ImportDepartments, $excel_path);	

            session()->flash('message', 'Upload Success!');
            session()->flash('message_type', 'success');
      
            return $this->redirect('/department');
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
        return $this->redirect('/employee-accounts');
    }

    
    public function downloadTemplate()
    {
        $filename = "import-departments-".date('Y-m-d').".xlsx";
        return Excel::download(new DepartmentImportTemplate, $filename);
    }


    public function index(){
        if (!CommonHelpers::isView()) {
            CommonHelpers::redirect(url('/'), trans("ad_default.denied_access"), "danger");
        }
        return view('modules.department-controller.department-controller');
    }


    public function render(){
        
        $data = [];

        $data['departments'] = Department::search($this->search)->orderBy($this->sortBy, $this->sortDir)->paginate($this->perPage);

        return view('livewire.component.module-contents.department-controller.department-controller-content', $data);
    }

}