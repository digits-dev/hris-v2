<?php

namespace App\Imports;

use App\Models\Companies;
use app\Helpers\CommonHelpers;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportCompanies implements ToModel, SkipsEmptyRows, WithHeadingRow,  WithValidation
{

    public function model(array $row)
    {

        $exists = DB::table('companies')->where('company_name', $row['company'])->first();

        if($exists) {
            return null;
        }

        return new Companies([
            'company_name' => $row['company'],
            'created_by' => CommonHelpers::myId(),
            'created_at' => now(),
        ]);

    }


    public function rules(): array
    {
        return [ 
            '*.company' => 'required',
        ];
    }
}


