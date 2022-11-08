<?php

namespace App\Http\Controllers;

// use \PDF;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Evento;
use App\Models\Presente;
use App\Models\Convidado;
use Illuminate\Http\Request;
use App\Exports\ConvidadosExport;
use App\Models\CategoriaPresente;
use Maatwebsite\Excel\Facades\Excel;

class ConvidadoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:usuario', 'check.manutencao']);
    }

    /**
     * Lista de convidados para o usuário visualizar
     *
     * @param  mixed $evento
     * @return void
     */
    public function listaConvidados(Evento $evento)
    {
        // bloquear acess se o evento não for do usuário
        if ($evento->user_id != auth()->user()->id) {
            abort(403);
        }
        $convidados = $evento->convidados()->orderBy('created_at', 'desc')->paginate('12');
        $categorias = CategoriaPresente::where('evento_id', $evento->id)->where('user_id', auth()->user()->id)->get();
        return view('convidados.convidados', compact('convidados', 'categorias', 'evento'));
    }

    /**
     * Selecionar o evento para ver a lista
     *
     * @return void
     */
    public function selecionarEvento()
    {
        $eventos = Evento::where('user_id', auth()->user()->id)->get();
        return view('convidados.convidados_selecionar_evento', compact('eventos'));
    }

    /**
     * Aceita pedido de convite
     *
     * @param  mixed $convidado
     * @return void
     */
    public function aceitarPedidoConvite(Convidado $convidado)
    {
        if ($convidado->status == 'negado') {
            abort(403);
        }

        // bloquear acesso se o evento não for do usuário
        if (Evento::find($convidado->evento_id)->user_id != auth()->user()->id) {
            abort(403);
        }

        // Se for usuário premium e se tiver feito o pagamento
        if (auth()->user()->plano == 'premium' && auth()->user()->status_pagamento == 'aprovado') {
            // Pode aprovar quantos convidados quiser
        } else {
            $evento = Evento::find($convidado->evento_id);
            // Se tiver 15 ou mais convidados, impedi de aprovar mais
            if ($evento->convidados->count() >= 15) {
                return redirect()->back()->withSuccess('Você não pode aprovar mais convidados, mude sua conta para premium.');
            }
        }

        $convidado->status = 'aceito';
        $convidado->save();
        return redirect()->back()->withSuccess('Pedido de convite aceito');
    }

    /**
     * Negar pedido de convite
     *
     * @param  mixed $convidado
     * @return void
     */
    public function negarPedidoConvite(Convidado $convidado)
    {
        if ($convidado->status == 'negado') {
            abort(403);
        }

        // bloquear acesso se o evento não for do usuário
        if (Evento::find($convidado->evento_id)->user_id != auth()->user()->id) {
            abort(403);
        }

        $convidado->status = 'negado';
        $convidado->save();

        // atualizar quantidade de presentes quando o pedido de convite é negado
        $convidado->presente->total += $convidado->qtd_presente;
        $convidado->presente->save();

        return redirect()->back()->withSuccess('Pedido de convite negado');
    }

    /**
     * Remover convidado
     *
     * @param  mixed $request
     * @return void
     */
    public function removerConvidado(Request $request)
    {
        $convidado = Convidado::find($request->convidado_id);

        // bloquear acesso se o evento não for do usuário
        if (Evento::find($convidado->evento_id)->user_id != auth()->user()->id) {
            abort(403);
        }

        // se ainda não foi negao o pedido, precisa atualizar a qtd de presentes novamente
        if ($convidado->status != 'negado') {
            // atualizar somando a quantidade de presentes novamente quando o convidado é removido
            $convidado->presente->total += $convidado->qtd_presente;
            $convidado->presente->save();
        }

        $convidado->delete();
        return redirect()->back()->withSuccess('Convidado removido');
    }

    /**
     * Adicionar novo convidado
     *
     * @param  mixed $request
     * @param  mixed $evento
     * @return void
     */
    public function adicionarConvidado(Request $request, Evento $evento)
    {
        if ($evento->user_id != auth()->user()->id) {
            abort(403);
        }

        $request->validate([
            'nome' => ['required', 'max:255'],
            'telefone' => ['required', 'celular_com_ddd', 'max:255'],
            'cod_convite' => ['required', 'unique:convidados,cod_convite', 'max:20'],
            'presenca' => ['required', 'in:sim,nao,talvez'],
            'qtd_presente' => ['required', 'numeric'],
            'presente_id' => ['required', 'exists:presentes,id'],
        ], [], [
            'cod_convite' => 'código do convite',
            'presenca' => 'presença',
            'presente_id' => 'presente',
        ]);

        // salvar dados do convidado
        $convidado = (new Convidado)->fill($request->all());
        $convidado->evento_id = $evento->id;
        $convidado->tipo_convite = 'convidado';
        $convidado->status = 'aceito';
        $convidado->save();

        //Atualizar total de presentes
        $presente = Presente::find($request->presente_id);
        $presente->total -= $request->qtd_presente;
        $presente->save();

        return redirect()->back()->withSuccess('Convidado adicionado com sucesso');
    }

    /**
     * Exportar convidados em excel
     *
     * @return void
     */
    public function excel($evento_id)
    {
        // bloquear acesso se o evento não for do usuário
        if (Evento::find($evento_id)->user_id != auth()->user()->id) {
            abort(403);
        }

        return Excel::download(new ConvidadosExport($evento_id), 'lista-de-convidados.xlsx');
    }

    /**
     * Exportar convidados em PDF
     *
     * @return void
     */
    public function pdf(Evento $evento)
    {
        if ($evento->user_id != auth()->user()->id) {
            abort(403);
        }

        $convidados = $evento->convidados()->orderBy('created_at', 'desc')->get();
        $pdf = PDF::loadView('convidados.pdf_lista_convidados', compact('convidados'));
        return $pdf->download('lista-de-convidados.pdf');
    }
}
