<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsuariosExport implements FromArray, ShouldAutoSize, WithStyles
{

    public function array(): array
    {
        $usuarios = [];
        $usuariosModel = User::orderBy('created_at', 'desc')->get();

        $usuarios[] = [
            [
                'Nome Completo',
                'E-mail',
                'CPF',
                'Dt. de nasc.',
                'Permissão',
                'Assinatura',
            ],
        ];
        foreach ($usuariosModel as $key => $user) {

            $permissao = null;
            switch ($user->conta) {
                case 'super_admin':
                    $permissao = 'Super Admin';
                    break;
                case 'admin':
                    $permissao = 'Admin';
                    break;
                case 'funcionario':
                    $permissao = 'Funcionário';
                    break;
                case 'usuario_comum':
                    $permissao = 'Usuário comum';
                    break;
                default:
                    break;
            }

            $usuarios[] = [
                [
                    $user->name,
                    $user->email,
                    $user->cpf,
                    date('d/m/Y', strtotime($user->dt_nasc)),
                    $permissao,
                    ucfirst($user->plano),
                ],
            ];
        }

        return $usuarios;
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
