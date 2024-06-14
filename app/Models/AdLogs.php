<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class AdLogs extends Model
{
    use HasFactory;
    protected $table = 'ad_logs';
    public function scopeGetData($query){
        return $query->leftJoin('users','ad_logs.id_ad_users','users.id')
        ->select('ad_logs.*',
                DB::raw('CONCAT(users.first_name," ",users.middle_name," ",users.last_name) as fullname'))->latest()->get();
    }

}
