<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = "employee_logs";

    public function scopeSearch($query, $value){

        $cleanVal = trim($value);

        return $query->where('first_name', 'like', "%$cleanVal%")
                     ->orWhere('middle_name', 'like', "%$cleanVal%")
                     ->orWhere('last_name', 'like', "%$cleanVal%")
                     ->orWhere('hire_location_id', 'like', "%$cleanVal%")
                     ->orWhere('current_location_id', 'like', "%$cleanVal%")
                     ->orWhere('time_in', 'like', "%$cleanVal%")
                     ->orWhere('time_out', 'like', "%$cleanVal%");
    }

    public function company(){
        return $this->belongsTo(Companies::class, 'company_id', 'id');
    }

    public function hireLocation(){
        return $this->belongsTo(Location::class, 'hire_location_id', 'id');
    }
    public function currentLocation(){
        return $this->belongsTo(Location::class, 'current_location_id', 'id');
    }

    public function filterForReport($query, $filters = [], $is_upload = false) {
        $search = $filters['search'];
        if ($filters['datefrom'] && $filters['dateto']) {
            $query->whereBetween('employee_logs.created_at', [$filters['datefrom'], $filters['dateto']]);
        }
       
        if ($search)  {
            $search_filter = "
                employee_logs.first_name LIKE '%$search%' OR
                employee_logs.last_name LIKE '%$search%'
            ";
            $query->whereRaw("($search_filter)");
        }
        return $query;
    }

    public function generateReport($ids = null) {
        $query = Employee::select(
            'employee_logs.id',
            'employee_logs.first_name',
            'employee_logs.last_name',
        );

        if (isset($ids)) {
            $query->whereIn('employee_logs.id', $ids);
        }
        return $query;
    }
}
