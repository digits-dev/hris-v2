<?php

namespace App\Livewire\Component\ModuleContents\EmployeeAccounts;

use Livewire\Component;
use App\Helpers\CommonHelpers;

class Create extends Component
{
    public function index(){
        if (!CommonHelpers::isCreate()) {
            CommonHelpers::redirect(url('/employee-accounts'), "You don't have privileges to access this area", 'error');
        }
        return view('modules.employee-accounts.employee-accounts-module', ['routeName'=>'create']);
        
    }

    
    public function save(){
        if (!CommonHelpers::isCreate()) {
            echo 'error';
        }
        return  $this->redirect('/employee-accounts', navigate:true);
     }

    public function render()
    {
        return view('livewire.component.module-contents.employee-accounts.create', );
    }
}
