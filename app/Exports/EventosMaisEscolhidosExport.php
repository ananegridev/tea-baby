<?php

namespace App\Exports;

use App\Models\CategoriaEvento;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EventosMaisEscolhidosExport implements FromArray, ShouldAutoSize, WithStyles
{
    public function array(): array
    {
        $eventos = CategoriaEvento::get()->sortByDesc(function ($query, $key) {
            return $query->eventos->count();
        });

        $array = [['Nome', 'Eventos']];

        foreach ($eventos as $key => $value) {
            array_push($array, [$value->nome, ($value->eventos->count() == 0 ? '0' : $value->eventos->count())]);
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
