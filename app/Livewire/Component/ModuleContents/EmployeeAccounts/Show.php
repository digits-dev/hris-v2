<?php

namespace App\Livewire\Component\ModuleContents\EmployeeAccounts;

use App\Models\User;
use Livewire\Component;

class Show extends Component
{

    public $user;

    public function mount($userId){
        $this->user = User::findOrFail($userId);
    }
    
    public function index($userId){
        return view('modules.employee-accounts.employee-accounts-module', ['routeName'=>'show', 'userId' =>$userId]);
    } 

    public function render()
    {
        return view('livewire.component.module-contents.employee-accounts.show');
    }
}
