<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;


class UsersExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithColumnFormatting
{
    /**
     * The query to be executed to fetch records
     */
    public function query()
    {
        return User::query()
            ->with('lastLogin')
            ->orderBy('created_at', 'desc');
    }

    /**
     * Column headings
     */
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Role',
            'Last Login',
            'Registered On',
            'Status'
        ];
    }

    /**
     * Map and format each user record
     */
    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->is_admin ? 'Admin' : 'User',
            $user->lastLogin?->created_at?->format('Y-m-d H:i:s') ?? 'Never',
            $user->created_at->format('Y-m-d'),
            $user->deleted_at ? 'Inactive' : 'Active'
        ];
    }

    /**
     * Apply styles to the spreadsheet
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row (headings)
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['rgb' => '3490DC']
                ]
            ],
            
            // Style date columns
            'E' => [
                'numberFormat' => [
                    'formatCode' => 'yyyy-mm-dd hh:mm:ss'
                ]
            ],
            'F' => [
                'numberFormat' => [
                    'formatCode' => 'yyyy-mm-dd'
                ]
            ]
        ];
    }
    
}