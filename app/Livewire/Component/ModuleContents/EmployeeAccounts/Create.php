<?php

namespace App\Livewire\Component\ModuleContents\EmployeeAccounts;

use App\Models\Companies;
use App\Models\Privileges;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\Location;
use App\Helpers\CommonHelpers;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    #[Validate('required')]
    public $first_name;

    #[Validate('required')]
    public $middle_name;

    #[Validate('required')]
    public $last_name;

    #[Validate('nullable|image', as: 'profile picture')]
    public $profileImage;

    #[Validate('required')]
    public $employee_id;

    #[Validate('required')]
    public $location;

    #[Validate('required|email')]
    public $email;

    #[Validate('required', as:'company')]
    public $company_id;

    #[Validate('required')]
    public $position;

    #[Validate('required', as:'system privilege')]
    public $privilege_id;

    #[Validate('required|date')]
    public $hire_date;

    public $isLandscape = false;

    public $skipValidation = false;


    public function index(){
        if (!CommonHelpers::isCreate()) {
            CommonHelpers::redirect(url('/employee-accounts'), trans("ad_default.denied_access"));
        }
        return view('modules.employee-accounts.employee-accounts-module', ['routeName'=>'create']);
        
    }

    
    public function save(){

        if (!CommonHelpers::isCreate()) {
            CommonHelpers::redirect(url('/employee-accounts'), trans("ad_default.denied_access"), 'danger');
        }

        $this->validate();

        $photo = $this->profileImage->store('photos', 'public');

        $user = User::create([
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'employee_id' => $this->employee_id,
            'email' => $this->email,
            'hire_location_id' => $this->location,
            'company_id' => $this->company_id,
            'position' => $this->position,
            'id_ad_privileges' => $this->privilege_id,
            'hire_date' => $this->hire_date,
            'image' => $photo,
            'password' => 'qwerty'
        ]);

        session()->flash('message', 'Created user successfully.');
        session()->flash('message_type', 'success');

        return  $this->redirect('/employee-accounts', navigate:true);
     }

     public function updatedProfileImage()
     {
        $this->resetErrorBag();

        $this->validate(['profileImage' => 'nullable|image']);




        // list($width, $height) = getimagesize($this->profileImage->temporaryUrl());

        // if($width > $height) {
        //    $this->isLandscape = true;
        // } else{
        //     $this->isLandscape = false;
        // }


          // Check if a file is uploaded
          if ($this->profileImage) {
            // Get the MIME type of the uploaded file
            $mime = $this->profileImage->getMimeType();
            
            // Check if the MIME type indicates an image
            if (strpos($mime, 'image/') === 0) {
                // If it's an image, proceed with further logic
                list($width, $height) = getimagesize($this->profileImage->temporaryUrl());
                if ($width > $height) {
                    $this->isLandscape = true;
                }
            } else {
                // If it's not an image, reset the property or handle accordingly
                $this->profileImage = null;
                // Optionally, you can log an error or display a message to the user
                // Log::error('Uploaded file is not an image');
                // session()->flash('error', 'Uploaded file is not an image');
            }
        }
     }

    
    public function render()
    {
        return view('livewire.component.module-contents.employee-accounts.create', 
        ['locations' => Location::all(), 
         'privileges' => Privileges::all(),
         'companies' => Companies::all()]);
    }
}
