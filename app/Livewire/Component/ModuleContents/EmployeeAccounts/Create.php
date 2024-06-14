<?php

namespace App\Livewire\Component\ModuleContents\EmployeeAccounts;
use App\Livewire\Forms\UserForm;
use App\Models\Companies;
use App\Models\Department;
use App\Models\Position;
use App\Models\Privileges;
use Livewire\Component;
use App\Models\Location;
use App\Helpers\CommonHelpers;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public UserForm $form;


    public function index()
    {
        if (!CommonHelpers::isCreate()) {
            CommonHelpers::redirect(CommonHelpers::getModulePath(), trans("ad_default.denied_access"), "danger");
        }

        return view('modules.employee-accounts.employee-accounts-module', [ 'routeName' => 'create' ]);

    }


    public function save()
    {
        $this->form->store();
        session()->flash('message', 'Created user successfully.');
        session()->flash('message_type', 'success');
        return $this->redirect('/employee-accounts');
    }

 

    public function render()
    {
        return view(
            'livewire.component.module-contents.employee-accounts.create',
            [
                'locations'  => Location::all(),
                'privileges' => Privileges::whereNot('id', 1)->get(),
                'companies'  => Companies::all(),
                'departments'  => Department::all(),
            ]
        );
    }
}
