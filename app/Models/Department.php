<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function scopeSearch($query, $value){

        $cleanVal = trim($value);

        return $query->where('department_name', 'like', "%$cleanVal%");
    }
}
