<?php

namespace App\Livewire\Component\ModuleContents\Dashboard;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdminAttendanceStatisticsComponent extends Component
{

    public function render()
    {
        $companies = DB::table('companies')->get();

        return view('livewire.component.module-contents.dashboard.admin-attendance-statistics-component', ['companies' => $companies]);
    }
}
