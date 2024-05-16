<?php

namespace App\Livewire\Component\ModuleContents\EmployeeAccounts;

use App\Models\User;
use Livewire\Component;

class EmployeeAccountsContent extends Component
{
    public $sortBy = "created_at";
    public $sortDir = 'DESC';


    public function index(){
        return view('modules.employee-accounts.employee-accounts-module', ['routeName' => 'index']);
    }


    public function setSortBy($fieldName){
        if($this->sortBy === $fieldName) {
            $this->sortDir = ($this->sortDir == "ASC") ? "DESC" : "ASC";
            return;
        }

        $this->sortBy = $fieldName;
        $this->sortDir = "DESC";
    }

    public function render()
    {
        return view('livewire.component.module-contents.employee-accounts.employee-accounts-content', 
        ['users' => User::orderBy($this->sortBy,$this->sortDir)->paginate(10)]);
    }

}
