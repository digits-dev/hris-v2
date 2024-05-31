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

class EmployeesExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    use Exportable;
    private $userReport;
    public $query;

    public function __construct($query) {
        $this->query = $query;
    }

    public function headings(): array {
        $headers = [
                    "Employee Id",
                    "First Name",
                    "Middle Name",
                    "Last Name",
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
                    $item->employee_id,
                    $item->first_name,
                    $item->middle_name,
                    $item->last_name,
                    $item->email,
                    $item->company,
                    $item->hire_location,
                    $item->hire_date,
                    $item->position,
                    $item->status ? "Active" : "Inactive",
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