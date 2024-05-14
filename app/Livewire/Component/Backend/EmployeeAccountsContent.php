<?php

namespace App\Livewire\Component\Backend;

use Livewire\Component;

class EmployeeAccountsContent extends Component
{
    public function index(){
        return view('backend_module.employee-accounts-module');
    }

    public function render()
    {
        return view('livewire.component.backend.employee-accounts-content');
    }
}
