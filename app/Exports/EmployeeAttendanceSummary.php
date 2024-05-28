<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use CRUDBooster;
use App\Models\Location;

class EmployeeAttendanceSummary implements FromQuery, WithHeadings, WithMapping
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
                    'Last Name',
                    'Company',
                    'Hire Location',
                    'Time in/out Location/s',
                    'First Time in',
                    'Last Time out',
                    'Date',
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
                        $item->last_name,
                        $item->company,
                        $item->hire_location,
                        $allLocationsString,
                        $item->first_clock_in,
                        $item->last_clock_out,
                        $item->date_clocked_in,
                        $item->total_time_bio_diff,
                        $item->total_time_filo_diff
                    ];
        
            return $employees;
    }

    public function query(){       
        return $this->query;
    }
}