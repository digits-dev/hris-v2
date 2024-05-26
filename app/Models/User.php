<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    protected $table = 'users';
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function scopeSearch($query, $value){

        $cleanVal = trim($value);

        return $query->whereRaw("CONCAT(first_name, ' ', middle_name, ' ', last_name) LIKE '%$cleanVal%'")
                     ->orWhere('employee_id', 'like', "%$cleanVal%")
                     ->orWhere('email', 'like', "%$cleanVal%")
                     ->orWhere('hire_location_id', 'like', "%$cleanVal%")
                     ->orWhere('company_id', 'like', "%$cleanVal%");

    }

    public function scopeGetData($query){
        return $query->leftJoin('ad_privileges','users.id_ad_privileges','ad_privileges.id')
            ->leftJoin('departments','users.department_id','departments.id')
            ->select('users.*',
                    'users.id as u_id',
                    'ad_privileges.*',
                    'ad_privileges.name as privilege_name',
                    'departments.department_name',
                    'users.status as u_status')->get();
    }


    public function company(){
        return $this->belongsTo(Companies::class, 'company_id', 'id');
    }

    public function hireLocation(){
        return $this->belongsTo(Location::class, 'hire_location_id', 'id');
    }

    public function getFullnameAttribute(){
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";
    }

    public function employeeLogs(){
        return $this->hasMany(EmployeeLog::class, 'employee_id', 'employee_id');
    }

    public function filterForReport($query, $filters=[]) {
        $search = $filters['search'] ?? '';
        $dataFrom = $filters['datefrom'] ?? '';
        $dateTo = $filters['dateto'] ?? '';
        if ($dataFrom && $dateTo) {
            $query->whereBetween('users.created_at', [$dataFrom, $dateTo]);
        }
       
        if ($search)  {
            $search_filter = "
                users.first_name LIKE '%$search%' OR
                users.last_name LIKE '%$search%'
            ";
            $query->whereRaw("($search_filter)");
        }
        
        return $query;
    }
    

    public function generateReport($ids = null) {
        $query = User::select(
            'users.id',
            'users.first_name',
            'users.last_name',
            'created_at'
        );

        if (isset($ids)) {
            $query->whereIn('users.id', $ids);
        }
        return $query;
    }
}
