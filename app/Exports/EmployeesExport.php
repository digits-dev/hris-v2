<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use CRUDBooster;

class EmployeesExport implements FromQuery, WithHeadings, WithMapping
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
                    "Last Name"
                    ];
        return $headers;

    }

    public function map($item): array {

       $employees = [
                    $item->first_name,
                    $item->last_name
                    ];
       
        return $employees;
    }

    public function query(){       
        return $this->query;
    }
}