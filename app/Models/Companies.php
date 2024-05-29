<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users(){
        return $this->hasMany(User::class, 'company_id', 'id');
    }

    public function scopeSearch($query, $value){

        $cleanVal = trim($value);

        return $query->where('company_name', 'like', "%$cleanVal%");
    }

}
