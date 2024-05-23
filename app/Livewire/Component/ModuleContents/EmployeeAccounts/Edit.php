<?php

namespace App\Livewire\Component\ModuleContents\EmployeeAccounts;

use App\Models\User;
use Livewire\Component;
use App\Models\Location;
use App\Models\Companies;
use App\Models\Privileges;
use Livewire\WithFileUploads;
use app\Helpers\CommonHelpers;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;


class Edit extends Component
{

    use WithFileUploads;

    public User $user;

    #[Validate('required')]
    public $first_name;

    #[Validate('required')]
    public $middle_name;

    #[Validate('required')]
    public $last_name;

    #[Validate('nullable|image', as: 'profile picture')]
    public $profileImage;

    public $profileImagePath;

    #[Validate('required')]
    public $employee_id;

    #[Validate('required')]
    public $location_id;

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

    #[Validate('required')]
    public $status;

    public $isLandscape = false;

    public $skipValidation = false;

    public $currentImage = true;
    
    public function mount($userId){
        $this->user = User::findOrFail($userId);

        $this->first_name = $this->user->first_name;
        $this->middle_name = $this->user->middle_name;
        $this->last_name = $this->user->last_name;
        $this->employee_id = $this->user->employee_id;
        $this->location_id = $this->user->hire_location_id;
        $this->email = $this->user->email;
        $this->company_id = $this->user->company_id;
        $this->position = $this->user->position;
        $this->privilege_id = $this->user->id_ad_privileges;
        $this->hire_date = date('Y-m-d', strtotime($this->user->hire_date)) ;
        $this->status = $this->user->status;

        if($this->user->image){
            // Get the URL to the profile image
            $this->profileImagePath = Storage::url($this->user->image);

            // Check if the profile image is landscape or portrait
            $profileImagePath = public_path('storage/' . $this->user->image);
            list($width, $height) = getimagesize($profileImagePath);
            $this->isLandscape = $width > $height;
        }
       
            
        
    }
    
    public function index($userId){
        return view('modules.employee-accounts.employee-accounts-module', ['routeName'=>'edit', 'userId' =>$userId]);
    } 


    public function save(){

        if (!CommonHelpers::isUpdate()) {
            CommonHelpers::redirect(url('/employee-accounts'), trans("ad_default.denied_access"), 'danger');
        }

        $this->validate();

        $this->user->update([
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'employee_id' => $this->employee_id,
            'email' => $this->email,
            'hire_location_id' => $this->location_id,
            'company_id' => $this->company_id,
            'position' => $this->position,
            'id_ad_privileges' => $this->privilege_id,
            'hire_date' => $this->hire_date,
        ]);

     
        // Delete the existing profile image if it exists and update user profile image if a new image is uploaded
        if ($this->profileImage) {
            if ($this->user->image) {
                Storage::delete($this->user->image);
            }

            $this->user->image = $this->profileImage->store('photos', 'public');
            $this->user->save();
        }


        session()->flash('message', 'Updated user successfully.');
        session()->flash('message_type', 'success');

        return  $this->redirect('/employee-accounts', navigate:true);
     }

     public function updatedProfileImage()
     {
        $this->resetErrorBag();

        $this->validate(['profileImage' => 'nullable|image']);

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
            }
        }
     }

     
    public function render()
    {
        return view('livewire.component.module-contents.employee-accounts.edit',
        [
        'locations' => Location::all(), 
        'privileges' => Privileges::all(),
        'companies' => Companies::all()
        ]
        );
    }
}
