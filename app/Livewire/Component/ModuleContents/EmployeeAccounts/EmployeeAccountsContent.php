<?php

namespace App\Livewire\Component\ModuleContents\EmployeeAccounts;

use App\Models\User;
use Livewire\Component;

class EmployeeAccountsContent extends Component
{
    public function index(){
        return view('modules.employee-accounts.employee-accounts-module', ['routeName' => 'index']);
    }

    public function render()
    {
        return view('livewire.component.module-contents.employee-accounts.employee-accounts-content', ['users' => User::paginate(10)
        ]);
    }
}
