<?php
namespace App\Livewire\Component\ModuleContents\LocationController;

use App\Traits\SortableTrait;
use Livewire\Component;
use App\Models\Location;
use Livewire\Attributes\Url;
use App\Helpers\CommonHelpers;
use Illuminate\Support\Facades\Auth;

class LocationControllerContent extends Component
{

    use SortableTrait;

    public $location_id;
    public $location_name;
    public $status;


    public function editForm($locationId)
    {
        $this->location_id = $locationId;

        $location = Location::findOrFail($locationId);

        $this->location_name = $location->location_name;
        $this->status        = $location->status;
    }


    public function save()
    {

        if (!CommonHelpers::isCreate()) {
            CommonHelpers::redirect(url('/employee-accounts'), trans("ad_default.denied_access"), 'danger');
        }

        $attribute = $this->validate([
            'location_name' => 'required|unique:locations,location_name'
        ]);

        Location::create([
            'location_name' => $this->location_name,
            'created_by'    => Auth::user()->id,
            'updated_by'    => Auth::user()->id,

        ]);

        $this->reset('location_name');


        session()->flash('message', 'Created location successfully.');
        session()->flash('message_type', 'success');

        return $this->redirect('/locations');
    }

    public function update()
    {

        if (!CommonHelpers::isUpdate()) {
            CommonHelpers::redirect(url('/employee-accounts'), trans("ad_default.denied_access"), 'danger');
        }

        $attribute = $this->validate([
            'location_name' => 'required|unique:locations,location_name,' . $this->location_id,
            'status'        => 'required',
        ]);

        Location::find($this->location_id)->update([
            'location_name' => $this->location_name,
            'status'        => $this->status,
            'updated_by'    => Auth::user()->id,
        ]);

        $this->reset('location_name', 'status');


        session()->flash('message', 'Updated location successfully.');
        session()->flash('message_type', 'success');

        return $this->redirect('/locations');
    }



    public function index()
    {
        if (!CommonHelpers::isView()) {
            CommonHelpers::redirect(url('/'), trans("ad_default.denied_access"), "danger");
        }
        return view("modules.location-controller.location-controller");
    }

    public function render()
    {

        $data = [];

        $data['locations'] = Location::search($this->search)->orderBy($this->sortBy, $this->sortDir)->paginate($this->perPage);

        return view("livewire.component.module-contents.location-controller.location-controller-content", $data);
    }
}
