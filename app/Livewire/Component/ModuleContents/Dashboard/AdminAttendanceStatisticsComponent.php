<?php

namespace App\Livewire\Component\ModuleContents\Dashboard;

use App\Models\Dashboard;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdminAttendanceStatisticsComponent extends Component
{

    public $date;
    public $company_id = 0;


    public function mount(){
        $this->date = date('Y-m-d');
    }


    public function render(Dashboard $dashboard)
    {

        $data = [];
        $data['companies'] = DB::table('companies')->get();

        $data['clocked_in_count'] = $dashboard->getClockedInCount($this->date, $this->company_id);
        $data['clocked_out_count'] = $dashboard->getClockedOutCount($this->date, $this->company_id);
        $data['not_clocked_in_count'] = $dashboard->getNotClockedInCount($this->date, $this->company_id);


        return view('livewire.component.module-contents.dashboard.admin-attendance-statistics-component', $data);
    }
}
