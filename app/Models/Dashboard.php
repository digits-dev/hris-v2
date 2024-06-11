<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dashboard extends Model
{
    use HasFactory;


    public function getClockedInCount($date, $companyId)
    {
        return DB::table('users')
            ->whereIn('employee_id', function ($query) use ($date, $companyId) {
                $query->select('employee_id')
                    ->from('filtered_employee_logs_view')
                    ->whereDate('date_clocked_in', $date)
                    ->whereNull('date_clocked_out')
                    ->when($companyId != 0, function ($query) use ($companyId) {
                        $query->where('company_id', $companyId);
                    });
            })
            ->count();
    }

    public function getClockedOutCount($date, $companyId)
    {
        return DB::table('users')
            ->whereIn('employee_id', function ($query) use ($date) {
                $query->select('employee_id')
                    ->from('filtered_employee_logs_view')
                    ->whereDate('date_clocked_in', $date);
            })
            ->whereIn('employee_id', function ($query) use ($date, $companyId) {
                $query->select('employee_id')
                    ->from('filtered_employee_logs_view')
                    ->whereDate('date_clocked_out', $date)
                    ->when($companyId != 0, function ($query) use ($companyId) {
                        $query->where('company_id', $companyId);
                    });
            })
            ->count();
    }

    public function getNotClockedInCount($date, $companyId)
    {
        return DB::table('users')
            ->when($companyId != 0, function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })
            ->whereNotIn('employee_id', function ($query) use ($date) {
                $query->select('employee_id')
                    ->from('employee_logs')
                    ->whereDate('date_clocked_in', $date)
                    ->whereNull('date_clocked_out');
            })
            ->whereNotIn('employee_id', function ($query) use ($date) {
                $query->select('employee_id')
                    ->from('employee_logs')
                    ->whereDate('date_clocked_out', $date);
            })
            ->count();
    }

}
