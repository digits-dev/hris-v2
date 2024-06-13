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
            if(!$location){
                session()->flash('message', 'Location not exist.');
                session()->flash('message_type', 'danger');
                return $this->redirect('/employee-accounts');
            }
            if(!$company){
                session()->flash('message', 'Company not exist.');
                session()->flash('message_type', 'danger');
                return $this->redirect('/employee-accounts');
            }
            if(!$department){
                session()->flash('message', 'Department not exist.');
                session()->flash('message_type', 'danger');
                return $this->redirect('/employee-accounts');
            }

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

    public function rules(): array
    {
        return [ 
            '*.first_name' => 'required|numeric',
        ];
    }
}