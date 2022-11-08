<?php

namespace App\Exports;

use App\Models\Visitas;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TiposDeAcessoExport implements FromArray, ShouldAutoSize, WithStyles
{

    public function array(): array
    {
        $array = [];
        $array[] = ["Chrome", "Firefox", "Opera", "MSIE", "Safari", 'Outros'];
        $array[] = [
            Visitas::where('navegador', 'Chrome')->count() == 0 ? '0' : Visitas::where('navegador', 'Chrome')->count(),
            Visitas::where('navegador', 'Firefox')->count() == 0 ? '0' : Visitas::where('navegador', 'Firefox')->count(),
            Visitas::where('navegador', 'OPR')->count() == 0 ? '0' : Visitas::where('navegador', 'OPR')->count(),
            Visitas::where('navegador', 'MSIE')->count() == 0 ? '0' : Visitas::where('navegador', 'MSIE')->count(),
            Visitas::where('navegador', 'Safari')->count() == 0 ? '0' : Visitas::where('navegador', 'Safari')->count(),
            Visitas::where('navegador', null)->count() == 0 ? '0' : Visitas::where('navegador', null)->count(),
        ];
        return $array;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:F1')->getFill()->applyFromArray([
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
