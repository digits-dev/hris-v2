<?php

namespace App\Imports;

use App\Models\Department;
use app\Helpers\CommonHelpers;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportDepartments implements ToModel,  SkipsEmptyRows, WithHeadingRow,  WithValidation
{

    public function model(array $row)
    {

        $exists = DB::table('departments')->where('department_name', $row['department'])->first();

        if($exists) {
            return null;
        }

        return new Department([
            'department_name' => $row['department'],
            'coa_id' => $row['coa_id'] ?? null,
            'created_by' => CommonHelpers::myId(),
            'created_at' => now(),
        ]);

    }

    public function rules(): array
    {
        return [ 
            '*.department' => 'required',
            // '*.coa_id' => 'required',
        ];
    }

}
