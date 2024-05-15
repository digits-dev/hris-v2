<?php

namespace App\Livewire\Component\ModuleContents\Dashboard;
use App\Helpers\CommonHelpers;
use Livewire\Component;

class DashboardContent extends Component
{
    public function index(){
        return view('modules.dashboard.dashboard-module');
    }

    public function render()
    {
        return view('livewire.component.module-contents.dashboard.dashboard-content');
    }
}
