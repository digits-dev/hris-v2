<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use CRUDBooster;

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
                    'Time in Location/s'
                    ];
        return $headers;

    }

    public function map($item): array {
       $timeInLocations = 
       $employees = [
                    $item->employee_id,
                    $item->first_name,
                    $item->last_name,
                    $item->company,
                    $item->hire_location,
                    ];
       
        return $employees;
    }

    public function query(){       
        return $this->query;
    }
}