<?php

namespace App\Imports;

use App\Models\Location;
use app\Helpers\CommonHelpers;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportLocations implements ToModel, SkipsEmptyRows, WithHeadingRow,  WithValidation
{

    public function model(array $row)
    {

        $exists = DB::table('locations')->where('location_name', $row['location'])->first();

        if($exists) {
            return null;
        }

        return new Location([
            'location_name' => $row['location'],
            'created_by' => CommonHelpers::myId(),
            'created_at' => now(),
        ]);

    }

    public function rules(): array
    {
        return [ 
            '*.location' => 'required',
        ];
    }


}
