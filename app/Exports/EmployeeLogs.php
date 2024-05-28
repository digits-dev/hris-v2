<?php

namespace App\Exports;

use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EmployeeLogs implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;
    public $query;

    public function __construct($query) {
        $this->query = $query;
    }

    public function headings(): array {
        $headers = [
                    "First Name",
                    "Middle Name",
                    "Last Name",
                    "Location",
                    "Current Location",
                    "Time In",
                    "Time Out",
                    "Date",
                    "Bio Duration",
                    ];
        return $headers;

    }



    public function map($item): array {

        $date = Carbon::parse($item->date_clocked_in)->format('Y-m-d');
        $timeDifference = Carbon::parse($item->date_clocked_in)->diff(Carbon::parse($item->date_clocked_out))->format('%H:%I:%S');

        $employees = [
                        $item->first_name,
                        $item->middle_name,
                        $item->last_name,
                        $item->hire_location,
                        $item->current_location,
                        $item->date_clocked_in,
                        $item->date_clocked_out,
                        $date,
                        $timeDifference
                        ];
        
        return $employees;
    }

    public function query(){       
        return $this->query;
    }
}
