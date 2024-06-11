<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use DB;
use CommonHelpers;
class ImportUsers implements ToCollection, SkipsEmptyRows, WithHeadingRow, WithValidation
{

    public function collection(Collection $rows){
        foreach ($rows->toArray() as $key => $row){
            $location  = DB::table('locations')->where(DB::raw('LOWER(TRIM(location_name))'),strtolower(trim($row['hire_location'])))->first();
            $company  = DB::table('companies')->where(DB::raw('LOWER(TRIM(company_name))'),strtolower(trim($row['company'])))->first();
            $department  = DB::table('departments')->where(DB::raw('LOWER(TRIM(department_name))'),strtolower(trim($row['department'])))->first();
            
            User::create([
                'first_name'       => $row->first_name,
                'middle_name'      => $row->middle_name,
                'last_name'        => $row->last_name,
                'email'            => $row->email,
                'employee_id'      => $row->employee_id,
                'hire_location_id' => $row->location->id,
                'company_id'       => $row->company->id,
                'department_id'    => $row->department->id,
                'hire_date'        => $row->hire_date,
                'position_id'      => $row->position,
                'created_by'	   => CommonHelpers::myId()
            ]); 
        }
    }

    public function prepareForValidation($data, $index)
    {
        //DIGITS CODE
        $data['digits_code_exist']['check'] = false;
        $checkRowDbCode = DB::table('assets')->select("digits_code AS digits_code")->get()->toArray();
        $checkRowDbCodeColumn = array_column($checkRowDbCode, 'digits_code');
        $data['digits_code_exist']['code'] = $data['digits_code'];
        if(!empty($data['digits_code'])){
            if(in_array(preg_replace('/\s+/', '', $data['digits_code']), $checkRowDbCodeColumn)){
                $data['digits_code_exist']['check'] = true;
            }
        }else{
            $data['digits_code_exist']['check'] = true;
        }

        return $data;
    }

    public function rules(): array
    {
       
        return [
            '*.employee_exist' => function($attribute, $value, $onFailure) {
                if ($value['check'] === false) {
                    $onFailure('Employee Email not exist in Users List!');
                }
            },
           
        ];
    }
}