<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use CRUDBooster;

class EmployeesExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;
    private $userReport;
    public $query;

    public function __construct($query) {
        $this->query = $query;
    }

    public function headings(): array {
        $headers = [
                    "First Name",
                    "Middle Name",
                    "Last Name",
                    "Employee Id",
                    "Email Address",
                    "Company",
                    "Hire Location",
                    "Hire Date",
                    "Position",
                    "Status"
                    
                    ];
        return $headers;

    }

    public function map($item): array {

       $employees = [
                    $item->first_name,
                    $item->middle_name,
                    $item->last_name,
                    $item->employee_id,
                    $item->email,
                    $item->company,
                    $item->hire_location,
                    $item->hire_date,
                    // $item->position,
                    'Employee',
                    $item->status ? "Active" : "Inactive",
                    ];
       
        return $employees;
    }

    public function query(){       
        return $this->query;
    }
}