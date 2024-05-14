<?php

namespace App\Livewire\Component\Backend;

use Livewire\Component;

class DashboardContent extends Component
{
    public function index(){
        return view('backend_module.dashboard-module');
    }

    public function render()
    {
        return view('livewire.component.backend.dashboard-content');
    }
}
