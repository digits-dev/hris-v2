<?php

namespace App\Imports;

use App\Models\Location;
use app\Helpers\CommonHelpers;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportLocations implements ToCollection, SkipsEmptyRows, WithHeadingRow,  WithValidation
{

    public function collection(Collection $rows)
    {
        foreach ($rows->toArray() as $key => $row) 
        {
            $row = (object) $row;

            Location::create([
                'location_name' => $row->location,
                'created_by' => CommonHelpers::myId(),
                'created_at' => now(),
            ]); 
        }
    }

    public function rules(): array
    {
        return [ 
            '*.location' => 'required',
        ];
    }


}
