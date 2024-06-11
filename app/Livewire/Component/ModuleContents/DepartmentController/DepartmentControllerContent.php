<?php
namespace App\Livewire\Component\ModuleContents\DepartmentController;

use App\Traits\SortableTrait;
use Livewire\Component;
use App\Models\Companies;
use Livewire\Attributes\Url;
use App\Helpers\CommonHelpers;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;

class DepartmentControllerContent extends Component{

    use SortableTrait;

    public $department_id;
    public $department_name;
    public $status;


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