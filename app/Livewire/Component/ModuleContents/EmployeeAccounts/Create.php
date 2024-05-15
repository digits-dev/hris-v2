<?php

namespace App\Livewire\Component\ModuleContents\EmployeeAccounts;

use Livewire\Component;

class Create extends Component
{
    public function index(){
        return view('modules.employee-accounts.employee-accounts-module', ['routeName'=>'create']);
    }

    
    public function save(){
        return  $this->redirect('/employee-accounts', navigate:true);
     }

    public function render()
    {
        return view('livewire.component.module-contents.employee-accounts.create', );
    }
}
