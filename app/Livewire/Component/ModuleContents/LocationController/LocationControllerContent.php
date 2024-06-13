<?php
namespace App\Livewire\Component\ModuleContents\LocationController;

use App\ImportTemplates\LocationImportTemplate;
use Livewire\Component;
use App\Models\Location;
use Livewire\Attributes\Url;
use App\Traits\SortableTrait;
use App\Helpers\CommonHelpers;
use App\Imports\ImportLocations;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class LocationControllerContent extends Component
{

    use SortableTrait;
    use WithFileUploads;

    public $location_id;
    public $location_name;
    public $status;
    public $file_import;


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

    public function import()
    {   
        $this->validate([
            'file_import' => 'required|file|mimes:xlsx,xls,csv|max:10240'
        ]);
        $path = $this->file_import->store('file_import');
        $excel_path = storage_path('app') . '/' . $path;
        try {
            Excel::import(new ImportLocations, $excel_path);	

            session()->flash('message', 'Upload Success!');
            session()->flash('message_type', 'success');
      
            return $this->redirect('/locations');
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
        return $this->redirect('/locations');
    }

    public function downloadTemplate()
    {
        $filename = "import-locations-".date('Y-m-d').".xlsx";
        return Excel::download(new LocationImportTemplate, $filename);
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
