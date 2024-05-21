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
                     ->orWhere('location', 'like', "%$cleanVal%")
                     ->orWhere('current_location', 'like', "%$cleanVal%")
                     ->orWhere('time_in', 'like', "%$cleanVal%")
                     ->orWhere('time_out', 'like', "%$cleanVal%");
    }
}
