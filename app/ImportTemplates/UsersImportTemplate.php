<?php 

namespace App\ImportTemplates;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;

class UsersImportTemplate implements FromArray, WithHeadings, ShouldAutoSize, WithStyles
{
    public function headings(): array
    {
        return [
            'First Name',
            'Middle Name',
            'Last Name',
            'Employee Id',
            'Email',
            'Company',
            'Department',
            'Hire Location',
            'Hire Date',
            'Position',
        ];
    }

    public function array(): array
    {
        return [
            [
                'John',
                'Doe',
                'Dela Cruz',
                '1234567890',
                'johndoe@gmail.com',
                'Digits Trading Corporation',
                'BPG',
                'Digits Headquarters',
                '2024-06-01',
                'Software Developer'
            ],
            [
                'Jane',
                'Smith',
                'Cruz',
                '1234567890',
                'janesmith@gmail.com',
                'Digits Trading Corporation',
                'BPG',
                'Digits Headquarters',
                '2024-06-01',
                'IT Specialist'
            ],
        ];
    }

    
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1:1')->getFont()->setBold(true);
        $sheet->getStyle($sheet->calculateWorksheetDimension())->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
    }
}
