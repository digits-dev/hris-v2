<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use CRUDBooster;
use App\Models\Location;

class EmployeeAttendanceSummary implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    use Exportable;
    private $userReport;
    public $query;

    public function __construct($query) {
        $this->query = $query;
    }

    public function headings(): array {
        $headers = [
                    'Employee ID',
                    'First Name',
                    'Middle Name',
                    'Last Name',
                    'Company',
                    'Hire Location',
                    'Time in/out Location/s',
                    'First Time in',
                    'Last Time out',
                    'Date',
                    'Day',
                    'Bio Duration',
                    'Filo Duration'
                    ];
        return $headers;

    }

    public function map($item): array {
        $currentLocationIdsIn = explode(",", $item->combined_terminal_in_ids);
        $currentLocationIdsOut = explode(",", $item->combined_terminal_out_ids);
        $allLocations = array_merge($currentLocationIdsIn, $currentLocationIdsOut);
        $timeInLocations = Location::whereIn('id', $allLocations)->get();
        $allLocations = [];

        foreach($timeInLocations as $loc){
            $allLocations[] = $loc->location_name;
        }

        $allLocationsString = implode(',', $allLocations);
        $employees = [
                        $item->employee_id,
                        $item->first_name,
                        $item->middle_name,
                        $item->last_name,
                        $item->company,
                        $item->hire_location,
                        $allLocationsString,
                        $item->first_time_in,
                        $item->last_time_out,
                        $item->date,
                        $item->day,
                        $item->bio_duration,
                        $item->filo_duration
                    ];

            return $employees;
    }

    public function query(){
        return $this->query;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],

            'A' => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT]],
        ];
    }
}
