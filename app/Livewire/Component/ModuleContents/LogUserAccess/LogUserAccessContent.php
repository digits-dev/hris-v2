<?php

namespace App\Livewire\Component\ModuleContents\LogUserAccess;

use Livewire\Component;

class LogUserAccessContent extends Component
{

    public function index()
    {
        return view('modules.log-user-access.log-user-access-module');
    }

    public function render()
    {
        return view('livewire.component.module-contents.log-user-access.log-user-access-content');
    }
}
