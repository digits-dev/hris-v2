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
}
