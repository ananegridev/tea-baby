<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\PixUsuario;
use Illuminate\Http\Request;
use App\Models\ColaboradorPix;
use Illuminate\Support\Facades\Storage;

class PixUsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:usuario', 'check.manutencao']);
    }

    /**
     * Página com formulário para o usuário configurar os dados do PIX
     *
     * @return void
     */
    public function painelPix()
    {
        return view('painel-pix');
    }

    /**
     * Lista de colaboradores que enviar PIX pela landing page
     *
     * @return void
     */
    public function colaboradores()
    {
        $colaboradores = ColaboradorPix::whereHas('evento', function ($query) {
            return $query->where('user_id', auth()->user()->id);
        })->orderBy('created_at', 'desc')->paginate(12);

        return view('colaboradores_pix', compact('colaboradores'));
    }

    /**
     * Aprovar pagamento feito pelo colaborador
     *
     * @param  mixed $colaboradorpix
     * @return void
     */
    public function aprovar(ColaboradorPix $colaboradorpix)
    {
        // bloquear acesso se o evento não for do usuário
        if (Evento::find($colaboradorpix->evento_id)->user_id != auth()->user()->id) {
            abort(403);
        }

        $colaboradorpix->status = 'aprovado';
        $colaboradorpix->save();
        return redirect()->back()->withSuccess('Colaborador aprovado');
    }

    /**
     * Negar pagamento feito pelo colaborador
     *
     * @param  mixed $colaboradorpix
     * @return void
     */
    public function negar(ColaboradorPix $colaboradorpix)
    {
        // bloquear acesso se o evento não for do usuário
        if (Evento::find($colaboradorpix->evento_id)->user_id != auth()->user()->id) {
            abort(403);
        }

        $colaboradorpix->status = 'negado';
        $colaboradorpix->save();
        return redirect()->back()->withSuccess('Colaborador negado');
    }

    /**
     * Excluir colaborador
     *
     * @param  mixed $request
     * @return void
     */
    public function deletar(Request $request)
    {
        $colaborador = ColaboradorPix::find($request->colaborador_id);

        // bloquear acesso se o evento não for do usuário
        if (Evento::find($colaborador->evento_id)->user_id != auth()->user()->id) {
            abort(403);
        }

        if ($colaborador) {
            $colaborador->delete();
            return redirect()->back()->withSuccess('Colaborador removido');
        }
    }

    /**
     * Salvar dados de PIX
     *
     * @param  mixed $request
     * @return void
     */
    public function salvarPix(Request $request)
    {
        // Se for usuário premium e se tiver feito o pagamento
        if (auth()->user()->plano == 'premium' && auth()->user()->status_pagamento == 'aprovado') {
            // Pode salvar dados do PIX
        } else {
            return redirect()->back()->withSuccess('Você não pode adicionar dados do PIX, mude sua conta para premium.');
        }

        $request['valor'] = $this->fmtNumero($request->valor);
        $request->validate([
            'tipo_chave'   => ['required', 'max:255'],
            'chave'   => ['required', 'max:255'],
            'valor'   => ['required', 'numeric', 'max:9999999'],
            'qrcode'   => ['required', 'image', 'max:2048'],
        ], [], [
            'chave' => 'chave PIX',
            'tipo_chave' => 'tipo de chave',
            'qrcode' => 'QRCODE'
        ]);

        // Se já tem um registro com dados
        if (auth()->user()->pixUsuario) {

            if (auth()->user()->pixUsuario->qrcode != 'img/qrcode.png')
                Storage::disk('local')->delete(auth()->user()->pixUsuario->qrcode);

            $dadosPix = auth()->user()->pixUsuario->fill($request->all());
        } else {
            $dadosPix = (new PixUsuario)->fill($request->all());
        }
        $dadosPix->qrcode = $request->file('qrcode')->store('img/qrcode');
        $dadosPix->user_id = auth()->user()->id;
        $dadosPix->save();

        return redirect()->back()->withSuccess('Salvo com sucesso');
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
