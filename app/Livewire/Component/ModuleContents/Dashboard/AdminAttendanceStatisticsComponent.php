<?php

namespace App\Livewire\Component\ModuleContents\Dashboard;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdminAttendanceStatisticsComponent extends Component
{



    public function render()
    {

        $data = [];
        $data['companies'] = DB::table('companies')->get();
        // $data['users'] = DB::table('users')->get();


        return view('livewire.component.module-contents.dashboard.admin-attendance-statistics-component', $data);
    }
}
