<?php

namespace App\Livewire\Component\ModuleContents\EmployeeAccounts;

use App\Models\User;
use Livewire\Component;
use App\Helpers\CommonHelpers;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{

    public User $user;

    public $isLandscape;



    public function mount($userId){
        $this->user = User::findOrFail($userId);

        if($this->user->image){
            // Check if the profile image is landscape or portrait
            $profileImagePath = public_path('storage/' . $this->user->image);
            list($width, $height) = getimagesize($profileImagePath);
            $this->isLandscape = $width > $height;
        }
                
    }
    
    public function index($userId){
        if (!CommonHelpers::isRead()) {
            CommonHelpers::redirect(url('/employee-accounts'), trans("ad_default.denied_access"), "danger");
        }
        return view('modules.employee-accounts.employee-accounts-module', ['routeName'=>'show', 'userId' =>$userId]);
    } 

    public function render()
    {
        return view('livewire.component.module-contents.employee-accounts.show');
    }
}
