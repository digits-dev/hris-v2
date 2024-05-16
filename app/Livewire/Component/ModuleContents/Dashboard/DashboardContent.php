<?php

namespace App\Livewire\Component\ModuleContents\Dashboard;

use Livewire\Component;

class DashboardContent extends Component
{

    public function index(){
        return view('modules.dashboard.dashboard-module', ['routeName' => 'index']);
    }

}