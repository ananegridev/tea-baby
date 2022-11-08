<?php

namespace App\Http\Controllers;

use App\Models\CategoriaEvento;
use App\Models\Evento;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:usuario', 'check.manutencao']);
    }

    /**
     * Lista de eventos cadastrados
     *
     * @return void
     */
    public function listaEventos()
    {
        $eventos = Evento::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(12);
        return view('eventos.lista_de_eventos', compact('eventos'));
    }

    /**
     * Página para ir criar o evento
     *
     * @return void
     */
    public function painelEvento()
    {
        return view('eventos.painel-evento');
    }

    /**
     * Formulário para criar novo evento
     *
     * @return void
     */
    public function create()
    {
        // Se a conta do usuário for premium ou gratuita exibe categorias premium
        if (auth()->user()->plano == 'gratuito' || auth()->user()->plano == null) {
            $categoriaEventos = CategoriaEvento::where('assinatura', 'gratuito')->get()->chunk(3);
        }
        if (auth()->user()->plano == 'premium') {
            $categoriaEventos = CategoriaEvento::all()->chunk(3);
        }

        return view('eventos.cadastro-evento', compact('categoriaEventos'));
    }

    /**
     * Salvar dados do evento
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $request['link_pagina'] = Str::slug($request->link_pagina);
        $request->validate([
            'mes_gestacao' => ['required', 'max:255'],
            'sexo_bebe' => ['required', 'max:255'],
            'data_evento' => ['required', 'date'],
            'nome_baby' => ['required', 'max:255'],
            'link_pagina' => ['required', 'unique:eventos,link_pagina', 'max:255'],
            'titulo' => ['required', 'max:255'],
            'sobre' => ['required'],
            'celular' => ['required', 'celular_com_ddd'],
            'cep' => ['required', 'formato_cep'],
            'endereco' => ['required', 'max:255'],
            'numero_endereco' => ['required', 'numeric', 'max:999999999'],
            'complemento' => ['required', 'max:255'],
            'cidade' => ['required', 'max:255'],
            'estado' => ['required', 'max:255'],
            'ponto_referencia' => ['required', 'max:255'],

            'categoria_evento_id' => ['required', 'exists:categoria_eventos,id'],
        ], [], [
            'mes_gestacao' => 'mês previsto',
            'sexo_bebe' => 'sexo do bebê',
            'data_evento' => 'data do evento',
            'nome_baby' => 'nome do baby',
            'link_pagina' => 'link da página',
            'sobre' => 'sobre o evento',
            'celular' => 'celular',
            'cep' => 'CEP',
            'endereco' => 'endereço',
            'numero_endereco' => 'número de endereço',
            'ponto_referencia' => 'ponto de referência',
        ]);

        $evento = (new Evento)->fill($request->all());
        $evento->user_id = auth()->user()->id;

        // Se for usuário premium e se tiver feito o pagamento 
        if (auth()->user()->plano == 'premium' && auth()->user()->status_pagamento == 'aprovado') {
            // Pode add quantos eventos quiser
        } else {
            // Pode add só 1 evento se já tiver adicionado
            if (Evento::where('user_id', auth()->user()->id)->first()) {
                return redirect()->back()->withSuccess('Você não pode adicionar mais eventos, mude sua conta para premium.');
            }
        }

        $evento->save();
        return redirect()->route('painel-de-controle')->with('evento_criado', true);
    }

    /**
     * Seleciona evento para editar
     *
     * @return void
     */
    public function selecionarEventoEditar()
    {
        $eventos = Evento::where('user_id', auth()->user()->id)->get();
        return view('eventos.editar_evento_selecionar', compact('eventos'));
    }

    /**
     * Formulário para editar evento
     *
     * @param  mixed $evento
     * @return void
     */
    public function edit(Evento $evento)
    {
        // Se a conta do usuário for premium ou gratuita exibe categorias premium
        if (auth()->user()->plano == 'gratuito' || auth()->user()->plano == null) {
            $categoriaEventos = CategoriaEvento::where('assinatura', 'gratuito')->get()->chunk(3);
        }
        if (auth()->user()->plano == 'premium') {
            $categoriaEventos = CategoriaEvento::all()->chunk(3);
        }

        // bloquear acesso se o evento não for do usuário
        if ($evento->user_id != auth()->user()->id) {
            abort(403);
        }

        return view('eventos.edit_evento', compact('evento', 'categoriaEventos'));
    }

    /**
     * Atualizar dados do evento
     *
     * @param  mixed $request
     * @param  mixed $evento
     * @return void
     */
    public function update(Request $request, Evento $evento)
    {
        $request['link_pagina'] = Str::slug($request->link_pagina);
        $request->validate([
            'mes_gestacao' => ['required', 'max:255'],
            'sexo_bebe' => ['required', 'max:255'],
            'data_evento' => ['required', 'date'],
            'nome_baby' => ['required', 'max:255'],
            'link_pagina' => ['required', 'unique:eventos,link_pagina,' . $evento->id, 'max:255'],
            'titulo' => ['required', 'max:255'],
            'sobre' => ['required'],
            'celular' => ['required', 'celular_com_ddd'],
            'cep' => ['required', 'formato_cep'],
            'endereco' => ['required', 'max:255'],
            'numero_endereco' => ['required', 'numeric', 'max:999999999'],
            'complemento' => ['required', 'max:255'],
            'cidade' => ['required', 'max:255'],
            'estado' => ['required', 'max:255'],
            'ponto_referencia' => ['required', 'max:255'],

            'categoria_evento_id' => ['required', 'exists:categoria_eventos,id'],
        ], [], [
            'mes_gestacao' => 'mês previsto',
            'sexo_bebe' => 'sexo do bebê',
            'data_evento' => 'data do evento',
            'nome_baby' => 'nome do baby',
            'link_pagina' => 'link da página',
            'sobre' => 'sobre o evento',
            'celular' => 'celular',
            'cep' => 'CEP',
            'endereco' => 'endereço',
            'numero_endereco' => 'número de endereço',
            'ponto_referencia' => 'ponto de referência',
        ]);

        // bloquear acesso se o evento não for do usuário
        if ($evento->user_id != auth()->user()->id) {
            abort(403);
        }

        $evento = $evento->fill($request->all());
        $evento->save();

        return redirect()->back()->withSuccess('Evento editado com sucesso');
    }

    /**
     * Excluir evento
     *
     * @param  mixed $request
     * @return void
     */
    public function destroy(Request $request)
    {
        $evento = Evento::find($request->evento_id);

        if ($evento) {

            // bloquear acesso se o evento não for do usuário
            if ($evento->user_id != auth()->user()->id) {
                abort(403);
            }

            $evento->delete();
            return redirect()->back()->withSuccess('Evento removido');
        } else {
            abort(404);
        }
    }
}
