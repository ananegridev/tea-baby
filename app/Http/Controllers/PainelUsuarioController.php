<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Configuracao;
use Illuminate\Http\Request;
use App\Models\ColaboradorPix;
use App\Models\CategoriaPresente;

class PainelUsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Painel de controle
     *
     * @return void
     */
    public function painel()
    {
        // Redirecionar se usuário for admin ou funcionário
        if (auth()->user()->conta == 'super_admin' || auth()->user()->conta == 'funcionario' || auth()->user()->conta == 'admin') {
            return redirect()->route('admin');
        }

        // Se tiver em manutenção
        $config = Configuracao::first();
        if ($config && $config->status_manutencao == 'on')
            return redirect()->route('configuracoes.manutencao');

        $eventos = Evento::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();

        /* Dados Convidados */
        $convidadosConfirmados = 0;
        $convidadosTalvez = 0;
        $convidadosNaoCompareceram = 0;
        /* Dados presentes */
        $totalPresentes = 0;
        /* Dados de valores */
        $valoresRecebidos = 0;
        $valoresParaReceber = 0;

        foreach ($eventos as $key => $evento) {
            $convidadosConfirmados += $evento->convidados()->where('status', 'aceito')->where('presenca', 'sim')->count();
            $convidadosTalvez += $evento->convidados()->where('status', 'aceito')->where('presenca', 'talvez')->count();
            $convidadosNaoCompareceram += $evento->convidados()->where('status', 'aceito')->where('presenca', 'nao')->count();
            /* Dados presentes */
            $totalPresentes += $evento->convidados()->where('status', 'aceito')->sum('qtd_presente');
            /* Dados de valores */
            $valoresRecebidos += ColaboradorPix::where('evento_id', $evento->id)->where('status', 'aprovado')->sum('valor');
            $valoresParaReceber += ColaboradorPix::where('evento_id', $evento->id)->where('status', 'pendente')->sum('valor');
        }

        $dados = [
            'eventos' => $eventos,
            'convidadosConfirmados' => $convidadosConfirmados,
            'convidadosTalvez' => $convidadosTalvez,
            'convidadosNaoCompareceram' => $convidadosNaoCompareceram,
            'totalPresentes' => $totalPresentes,
            'valoresRecebidos' => $valoresRecebidos,
            'valoresParaReceber' => $valoresParaReceber,
        ];
        return view('painel-de-controle', $dados);
    }
}
