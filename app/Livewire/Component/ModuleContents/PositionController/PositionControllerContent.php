<?php
namespace App\Livewire\Component\ModuleContents\PositionController;
use Livewire\Component;
use App\Models\Position;
use Livewire\Attributes\Url;
use App\Helpers\CommonHelpers;
use Illuminate\Support\Facades\Auth;

class PositionControllerContent extends Component{

    #[Url(history:true)]
    public $search = null; 

    #[Url(as:'per-page')]
    public $perPage = 10;

    public $sortBy = "created_at";
    public $sortDir = 'DESC';

    public $position_id;
    public $position_name;
    public $status;


    public function setSortBy($fieldName){
        if($this->sortBy === $fieldName) {
            $this->sortDir = ($this->sortDir == "ASC") ? "DESC" : "ASC";
            return;
        }

        $this->sortBy = $fieldName;
        $this->sortDir = "DESC";
    }

    public function editForm($positionId) {
        $this->position_id = $positionId;

        $position = Position::findOrFail($positionId);

        $this->position_name = $position->position_name;
        $this->status = $position->status;
    }


    public function save(){
        
        if (!CommonHelpers::isCreate()) {
            CommonHelpers::redirect(url('/employee-accounts'), trans("ad_default.denied_access"), 'danger');
        }

        $this->validate([
            'position_name' => 'required|unique:positions,position_name'
        ]);

        Position::create([
            'position_name' => $this->position_name,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,

        ]);

        $this->reset('position_name');


        session()->flash('message', 'Created position successfully.');
        session()->flash('message_type', 'success');

        return  $this->redirect('/positions');
    }

    public function update(){
        
        if (!CommonHelpers::isUpdate()) {
            CommonHelpers::redirect(url('/employee-accounts'), trans("ad_default.denied_access"), 'danger');
        }

        $attribute = $this->validate([
            'position_name' => 'required|unique:positions,position_name,'. $this->position_id,
            'status' => 'required',
        ]);

        Position::find($this->position_id)->update([
            'position_name' => $this->position_name,
            'status' => $this->status,
            'updated_by' => Auth::user()->id,
        ]);

        $this->reset('position_name', 'status');


        session()->flash('message', 'Updated position successfully.');
        session()->flash('message_type', 'success');

        return  $this->redirect('/positions');
    }



    public function index(){
        if (!CommonHelpers::isView()) {
            CommonHelpers::redirect(url('/'), trans("ad_default.denied_access"), "danger");
        }
        return view("modules.position-controller.position-controller");
    }

   
    public function render(){
        $data = [];

        $data['positions'] = Position::search($this->search)->orderBy($this->sortBy, $this->sortDir)->paginate($this->perPage);

        return view("livewire.component.module-contents.position-controller.position-controller-content", $data);
    }
}