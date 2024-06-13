<?php

namespace App\Livewire\Component\ModuleContents\EmployeeAccounts;

use App\Models\User;
use Livewire\Component;
use App\Models\Location;
use App\Models\Position;
use App\Models\Companies;
use App\Models\Privileges;
use Livewire\WithFileUploads;
use app\Helpers\CommonHelpers;
use App\Livewire\Forms\UserForm;


class Edit extends Component
{

    use WithFileUploads;
    public UserForm $form;


    public function mount($userId)
    {
        $user = User::findOrFail($userId);

        $this->form->setForm($user);

    }

    public function index($userId)
    {
        return view('modules.employee-accounts.employee-accounts-module', [ 'routeName' => 'edit', 'userId' => $userId ]);
    }


    public function save()
    {
        $this->form->update();

        session()->flash('message', 'Updated user successfully.');
        session()->flash('message_type', 'success');

        return $this->redirect('/employee-accounts');
    }


    public function render()
    {
        return view(
            'livewire.component.module-contents.employee-accounts.edit',
            [
                'locations'  => Location::all(),
                'privileges' => Privileges::all(),
                'companies'  => Companies::all(),
                'positions'  => Position::all()
            ]
        );
    }
}
