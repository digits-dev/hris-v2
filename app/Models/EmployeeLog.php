<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLog extends Model
{
    use HasFactory;

    protected $table = "employee_logs";

    public function scopeSearch($query, $value){
        // search for name, fullname
        return $query->whereHas('user', function ($userQuery) use ($value) {
            $cleanVal = trim($value);
            $userQuery->whereRaw("CONCAT(first_name, ' ', middle_name, ' ', last_name) LIKE '%$cleanVal%'");
        });

        // search for all columns;

        // $cleanVal = trim($value);

        // return $query->where(function ($query) use ($value) {
        //     $cleanVal = trim($value);
        //     $query->whereHas('user', function ($userQuery) use ($cleanVal) {
        //         $userQuery->whereRaw("CONCAT(first_name, ' ', middle_name, ' ', last_name) LIKE '%$cleanVal%'")
        //             ->orWhereHas('hireLocation', function ($locationQuery) use ($cleanVal) {
        //                 $locationQuery->where('location_name', 'like', "%$cleanVal%");
        //         });
        //     })
        //     ->orWhereHas('currentLocation', function ($locationQuery) use ($cleanVal) {
        //         $locationQuery->where('location_name', 'like', "%$cleanVal%");
        //     });
        // })
        // ->orWhere('date_clocked_in', 'like', "%$cleanVal%")
        // ->orWhere('date_clocked_out', 'like', "%$cleanVal%");
    }

    
    public function user(){
        return $this->belongsTo(User::class, 'employee_id', 'employee_id');
    }

    public function getHireLocationIdAttribute()
    {
        return $this->user->hire_location_id;
    }

    public function getFullnameAttribute()
    {
        return "{$this->user->first_name} {$this->user->middle_name} {$this->user->last_name}";
    }

    public function hireLocation()
    {
        return $this->belongsTo(Location::class, 'hire_location_id', 'id');
    }

    public function currentLocation(){
        return $this->belongsTo(Location::class, 'clock_in_terminal_id', 'id');
    }

    public function getCompanyIdAttribute()
    {
        return $this->user->company_id;
    }

    public function company(){
        return $this->belongsTo(Companies::class, 'company_id', 'id');
    }

}
