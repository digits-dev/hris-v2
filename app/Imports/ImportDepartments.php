<?php

namespace App\Imports;

use app\Helpers\CommonHelpers;
use App\Models\Department;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportDepartments implements ToCollection,  SkipsEmptyRows, WithHeadingRow,  WithValidation
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows->toArray() as $key => $row) 
        {
            $row = (object) $row;

            Department::create([
                'department_name' => $row->department_name,
                'coa_id' => $row->coa_id,
                'created_by' => CommonHelpers::myId(),
                'created_at' => now(),
            ]); 
        }
    }

    public function rules(): array
    {
        return [ 
            '*.department_name' => 'required',
            '*.coa_id' => 'required',
        ];
    }

}
