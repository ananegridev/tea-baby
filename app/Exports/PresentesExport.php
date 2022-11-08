<?php

namespace App\Exports;

use App\Models\CategoriaPresente;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PresentesExport implements FromArray, ShouldAutoSize, WithStyles
{

    protected $evento_id = null;

    public function __construct($evento_id)
    {
        $this->evento_id = $evento_id;
    }

    public function array(): array
    {
        $presentes = [];
        $categorias = CategoriaPresente::where('evento_id', $this->evento_id)
            ->where('user_id', auth()->user()->id)->get();

        foreach ($categorias as $key => $categoria) {
            $presentes[] = [
                [$categoria->nome],
                [
                    'Item',
                    'Qtd.'
                ],
            ];

            foreach ($categoria->presentes as $key => $presente) {
                $presentes[] = [
                    $presente->nome ?? '---',
                    ($presente->total == 0 || $presente->total == null ? '0' : $presente->total),
                ];
            }

            $presentes[] = [
                ['', ''],
                ['', ''],
            ];
        }

        return $presentes;
    }

    public function styles(Worksheet $sheet)
    {
    }
}
