<?php

namespace App\Exports;

use App\Models\Visitas;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class VisitasTotalExport implements FromArray, ShouldAutoSize, WithStyles
{

    public function array(): array
    {
        $array = [[
            'Ano',
            'Visitas'
        ]];

        for ($i = 0; $i <= 5; $i++) {
            $ano = date('Y', strtotime(" - $i years"));
            $visitas = Visitas::whereYear('data', $ano)->count();
            array_push($array, [$ano, ($visitas == 0 ? '0' : $visitas)]);
        }

        return $array;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:B1')->getFill()->applyFromArray([
            'fillType' => 'solid',
            'rotation' => 0,
            'color' => ['rgb' => '333333'],
        ]);

        $sheet->getStyle("A1:F1")
            ->getFont()
            ->setBold(true)
            ->setName('Arial')
            ->getColor()
            ->setRGB('FFFFFF');
    }
}
