<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Presente;
use App\Models\Convidado;
use Illuminate\Http\Request;
use App\Models\CategoriaPresente;
use App\Models\ColaboradorPix;

class LandingPageEventosController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.manutencao');
    }

    /**
     * Landing page 1 com dados do evento
     *
     * @param  mixed $slug
     * @return void
     */
    public function landingPage1($slug)
    {
        $evento = Evento::where('link_pagina', $slug)->first();
        if ($evento == null) {
            abort(404);
        }

        $categorias = CategoriaPresente::where('evento_id', $evento->id)->where('user_id', $evento->user_id)->get();
        return view('land1', compact('evento', 'categorias'));
    }

    /**
     * Landing page 2 com dados do evento
     *
     * @param  mixed $slug
     * @return void
     */
    public function landingPage2($slug)
    {
        $evento = Evento::where('link_pagina', $slug)->first();
        if ($evento == null) {
            abort(404);
        }

        $categorias = CategoriaPresente::where('evento_id', $evento->id)->where('user_id', $evento->user_id)->get();
        return view('land2', compact('evento', 'categorias'));
    }

    /**
     * Landing page 3 com dados do evento
     *
     * @param  mixed $slug
     * @return void
     */
    public function landingPage3($slug)
    {
        $evento = Evento::where('link_pagina', $slug)->first();
        if ($evento == null) {
            abort(404);
        }

        $categorias = CategoriaPresente::where('evento_id', $evento->id)->where('user_id', $evento->user_id)->get();

        return view('land3', compact('evento', 'categorias'));
    }

    /**
     * Presentear e confirmar presença no evento. Vai criar um registro em 'convidados'
     *
     * @param  mixed $request
     * @return void
     */
    public function presentear(Request $request, Evento $evento)
    {
        $request->validate([
            'nome' => ['required', 'max:255'],
            'telefone' => ['required', 'celular_com_ddd', 'max:255'],
            'cod_convite' => ['required', 'unique:convidados,cod_convite', 'max:20'],
            'presenca' => ['required', 'in:sim,nao,talvez'],
            'qtd_presente' => ['required', 'numeric'],
            'presente_id' => ['required', 'exists:presentes,id'],
        ], [], [
            'cod_convite' => 'código do convite',
            'presenca' => 'presença'
        ]);

        // Salvar dados do convidado
        $convidado = (new Convidado)->fill($request->all());
        $convidado->evento_id = $evento->id;
        $convidado->tipo_convite = 'enviado';
        $convidado->save();

        // Atualizar total de presentes
        $presente = Presente::find($request->presente_id);
        $presente->total -= $request->qtd_presente;
        $presente->save();

        return redirect()->back()->withSuccess('Solicitação de convite enviada sucesso');
    }
    
    /**
     * Salvar colaboração com PIX
     *
     * @param  mixed $request
     * @param  mixed $evento
     * @return void
     */
    public function colaborarPix(Request $request, Evento $evento)
    {
        $request['valor'] = $this->fmtNumero($request->valor);
        $request->validate([
            'nome_pix' => ['required', 'max:255'],
            'valor' => ['required', 'numeric', 'min:' . $evento->user->pixUsuario->valor, 'max:99999999'],
        ], [], [
            'nome_pix' => 'nome'
        ]);

        $colaborador = (new ColaboradorPix)->fill($request->all());
        $colaborador->evento_id = $evento->id;
        $colaborador->save();

        return redirect()->back()->withSuccess('Solicitação para colaborador enviada');
    }

    /**
     * Formatar string com valor monetário para número
     *
     * @param  mixed $valor
     * @return void
     */
    public function fmtNumero($valor)
    {
        $num = str_replace(['R$', ' ', '.', ','], ['', '', '', '.'], $valor);
        return $num;
    }
}
