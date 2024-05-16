<?php

namespace App\Livewire\Component\ModuleContents\EmployeeAccounts;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class EmployeeAccountsContent extends Component
{
    use WithPagination;

    // #[Url(history:true)]
    public $sortBy = "created_at";
    // #[Url(history:true)]
    public $sortDir = 'DESC';
    // #[Url(history:true)]
    public $search = ''; 
    // #[Url()]
    public $perPage = 10;

    
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
        ['users' => User::search($this->search)->orderBy($this->sortBy,$this->sortDir)->paginate($this->perPage)]);
    }

}
