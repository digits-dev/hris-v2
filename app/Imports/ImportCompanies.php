<?php

namespace App\Imports;

use App\Models\Companies;
use app\Helpers\CommonHelpers;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportCompanies implements ToCollection, SkipsEmptyRows, WithHeadingRow,  WithValidation
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows->toArray() as $key => $row) 
        {
            $row = (object) $row;

            Companies::create([
                'company_name' => $row->company_name,
                'created_by' => CommonHelpers::myId(),
                'created_at' => now(),
            ]); 
        }
    }

    public function rules(): array
    {
        return [ 
            '*.company_name' => 'required',
        ];
    }
}


