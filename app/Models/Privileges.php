<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privileges extends Model
{
    use HasFactory;
    protected $table = 'ad_privileges';

    protected $fillable = [
        'name', 
        'is_superadmin', 
        'created_at	',
        'updated_at'
    ];

    public function scopeGetData($query){
        return $query->select('*')->get();
    }
}
