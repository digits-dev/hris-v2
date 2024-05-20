<?php

namespace App\Livewire\Component\ModuleContents\EmployeeAccounts;

use App\Models\User;
use Livewire\Component;
use App\Helpers\CommonHelpers;
class Show extends Component
{

    public $user;

    public function mount($userId){
        $this->user = User::findOrFail($userId);
    }
    
    public function index($userId){
        if (!CommonHelpers::isView()) {
            CommonHelpers::redirect(CommonHelpers::adminPath(), trans("ad_default.denied_access"));
        }
        return view('modules.employee-accounts.employee-accounts-module', ['routeName'=>'show', 'userId' =>$userId]);
    } 

    public function render()
    {
        return view('livewire.component.module-contents.employee-accounts.show');
    }
}
