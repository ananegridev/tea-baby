<?php

namespace App\Exports;

use App\Models\Visitas;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class VisitasPorMesExport implements FromArray, ShouldAutoSize, WithStyles
{

    public function array(): array
    {
        $array = [[
            'Mês',
            'Visitas'
        ]];

        for ($i = 0; $i <= 11; $i++) {
            $ano = date('Y', strtotime(date('Y-m-05') . " - $i months"));
            $mes = date('m', strtotime(date('Y-m-05') . " - $i months"));
            $visitas = Visitas::whereYear('data', $ano)->whereMonth('data', $mes)->count();
            array_push($array, [$mes . '/' . $ano, ($visitas == 0 ? '0' : $visitas)]);
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
