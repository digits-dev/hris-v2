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
use App\Helpers\CommonHelpers;
class ImportUsers implements ToCollection, SkipsEmptyRows, WithHeadingRow, WithValidation
{

    public function collection(Collection $rows){
        foreach ($rows->toArray() as $key => $row){
            $row = (object) $row;
            $location  = DB::table('locations')->where(DB::raw('LOWER(TRIM(location_name))'),strtolower(trim($row->hire_location)))->first();
            $company  = DB::table('companies')->where(DB::raw('LOWER(TRIM(company_name))'),strtolower(trim($row->company)))->first();
            $department  = DB::table('departments')->where(DB::raw('LOWER(TRIM(department_name))'),strtolower(trim($row->department)))->first();

            User::create([
                'first_name'       => $row->first_name,
                'middle_name'      => $row->middle_name,
                'last_name'        => $row->last_name,
                'email'            => $row->email,
                'employee_id'      => $row->employee_id,
                'hire_location_id' => $location->id,
                'company_id'       => $company->id,
                'department_id'    => $department->id,
                'hire_date'        => $row->hire_date,
                'password'         => 'qwerty',
                'position_id'      => $row->position,
                'created_by'	   => CommonHelpers::myId()
            ]); 
        }
    }

    public function prepareForValidation($data, $index)
    {
        //LOCATION
        $data['location_exist']['check'] = false;
        $checkRowDbName = DB::table('locations')->select(DB::raw('LOWER(TRIM(location_name)) as location_name'))->get()->toArray();
        $checkRowDbNameColumn = array_column($checkRowDbName, 'location_name');
        $data['location_exist']['code'] = $data['hire_location'];
        if(!empty($data['hire_location'])){
            if(in_array(strtolower(trim($data['hire_location'])), $checkRowDbNameColumn)){
                $data['location_exist']['check'] = true;
            }
        }else{
            $data['location_exist']['check'] = true;
        }

        //COMPANY
        $data['company_exist']['check'] = false;
        $checkRowDbCompany = DB::table('companies')->select(DB::raw('LOWER(TRIM(company_name)) as company_name'))->get()->toArray();
        $checkRowDbCompanyColumn = array_column($checkRowDbCompany, 'company_name');
        $data['company_exist']['code'] = $data['company'];
        if(!empty($data['company'])){
            if(in_array(strtolower(trim($data['company'])), $checkRowDbCompanyColumn)){
                $data['company_exist']['check'] = true;
            }
        }else{
            $data['company_exist']['check'] = true;
        }

        //DEPARTMENT
        $data['department_exist']['check'] = false;
        $checkRowDbDepartment = DB::table('departments')->select(DB::raw('LOWER(TRIM(department_name)) as department_name'))->get()->toArray();
        $checkRowDbDepartmentColumn = array_column($checkRowDbDepartment, 'department_name');
        $data['department_exist']['code'] = $data['department'];
        if(!empty($data['department'])){
            if(in_array(strtolower(trim($data['department'])), $checkRowDbDepartmentColumn)){
                $data['department_exist']['check'] = true;
            }
        }else{
            $data['department_exist']['check'] = true;
        }

        //EMAIL EXIST
        $data['is_email_exist']['check'] = false;
        $checkRowDbEmail = DB::table('users')->select(DB::raw('TRIM(email) as email'))->get()->toArray();
        $data['is_email_exist']['email'] = $data['email'];
        $checkRowDbColumnEmail = array_column($checkRowDbEmail, 'email');
        if(!empty($data['email'])){
            if(in_array(trim($data['email']), $checkRowDbColumnEmail)){
                $data['is_email_exist']['check'] = true;
            }else{
                $data['is_email_exist']['check'] = false;
            }
        }

        return $data;
    }

    public function rules(): array
    {
        return [ 
            '*.location_exist' => function($attribute, $value, $onFailure) {
                if ($value['check'] === false) {
                    $onFailure('Location not exist in Submaster Location List!');
                }
            },
            '*.company_exist' => function($attribute, $value, $onFailure) {
                if ($value['check'] === false) {
                    $onFailure('Company not exist in Submaster Company List!');
                }
            },
            '*.department_exist' => function($attribute, $value, $onFailure) {
                if ($value['check'] === false) {
                    $onFailure('Department not exist in Submaster Department List!');
                }
            },
            '*.is_email_exist' => function($attribute, $value, $onFailure) {
                if ($value['check'] === true) {
                    $onFailure('Email '.$value['email'].' Exist!');
                }
            },
            '*.first_name' => 'required',
            '*.last_name' => 'required',
            '*.department' => 'required',
            '*.email' => 'required',
            '*.employee_id' => 'required',
            '*.hire_location' => 'required',
            '*.company' => 'required',
            '*.hire_date' => 'required',
            '*.position' => 'required'
        ];
    }
}