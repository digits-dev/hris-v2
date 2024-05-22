<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public function users(){
        return $this->hasMany(User::class, 'hire_location_id', 'id');
    }
    public function employees(){
        return $this->hasMany(User::class, 'hire_location_id', 'id');
    }
}
