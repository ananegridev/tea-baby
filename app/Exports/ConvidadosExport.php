<?php

namespace App\Exports;

use App\Models\Evento;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ConvidadosExport implements FromArray, ShouldAutoSize, WithStyles
{

    protected $evento_id = null;

    public function __construct($evento_id)
    {
        $this->evento_id = $evento_id;
    }

    public function array(): array
    {
        $dadosConvidados = [];
        $evento = Evento::find($this->evento_id);
        $convidados = $evento->convidados()->orderBy('created_at', 'desc')->get();

        $dadosConvidados[] = [
            [
                'Convidado',
                'Telefone',
                'Código',
                'Presente',
                'Presença',
                'Status',
            ],
        ];
        foreach ($convidados as $key => $convidado) {

            $presenca = null;
            switch ($convidado->presenca) {
                case 'sim':
                    $presenca = 'Sim';
                    break;
                case 'nao':
                    $presenca = 'Não';
                    break;
                default:
                    $presenca = 'Talvez';
                    break;
            }

            $dadosConvidados[] = [
                [
                    $convidado->nome,
                    $convidado->telefone,
                    $convidado->cod_convite,
                    '(' . $convidado->qtd_presente . ') ' . $convidado->presente->nome,
                    $presenca,
                    ucfirst($convidado->status)
                ],
            ];
        }

        return $dadosConvidados;
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
            // ->setSize(14)
            ->getColor()
            ->setRGB('FFFFFF');
    }
}
