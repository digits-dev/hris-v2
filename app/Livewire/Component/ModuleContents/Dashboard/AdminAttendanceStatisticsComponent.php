<?php

namespace App\Livewire\Component\ModuleContents\Dashboard;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdminAttendanceStatisticsComponent extends Component
{

    public $date;
    public $company_id = 1;
    

    public function mount(){
        $this->date = date('Y-m-d');
    }


    public function render()
    {

        $data = [];
        $data['companies'] = DB::table('companies')->get();
        // $data['users'] = DB::table('users')->get();

        // Clocked In
        $data['clocked_in_count'] = DB::table('users')
        ->whereIn('employee_id', function($query) {
            $query->select('employee_id')
                ->from('filtered_employee_logs_view')
                ->whereDate('date_clocked_in', $this->date)
                ->whereNull('date_clocked_out')
                ->where('company_id', $this->company_id);
        })
        ->count();

        // Clocked Out
        $data['clocked_out_count'] = DB::table('users')
        ->whereIn('employee_id', function($query) {
            $query->select('employee_id')
                ->from('filtered_employee_logs_view')
                ->whereDate('date_clocked_in', $this->date);
        })


        ->whereIn('employee_id', function($query) {
            $query->select('employee_id')
                ->from('filtered_employee_logs_view')
                ->whereDate('date_clocked_out', $this->date)
                ->where('company_id', $this->company_id);
        })
        ->count();

        // Not Clocked In

        $data['not_clocked_in_count'] = DB::table('users')
        ->where('company_id', $this->company_id)
        ->whereNotIn('employee_id', function ($query) {
            $query->select('employee_id')
                ->from('employee_logs')
                ->whereDate('date_clocked_in', $this->date)
                ->whereNull('date_clocked_out');
        })
        ->whereNotIn('employee_id', function ($query) {
            $query->select('employee_id')
                ->from('employee_logs')
                ->whereDate('date_clocked_out', $this->date);
        })
        ->count();


        return view('livewire.component.module-contents.dashboard.admin-attendance-statistics-component', $data);
    }
}
