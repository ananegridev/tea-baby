<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PixAdmin;
use Illuminate\Support\Facades\Storage;

class UsuarioPremiumController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:admin']);
    }

    /**
     * Lista de usuáios Premium
     *
     * @return void
     */
    public function usuarios()
    {
        $usuarios = User::where('plano', 'premium')->orderBy('status_pagamento', 'desc')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.usuarios_premium.usuario_premium', compact('usuarios'));
    }

    /**
     * Aprovar pagamento de conta premium
     *
     * @param  mixed $user
     * @return void
     */
    public function aprovarPagamento(User $user)
    {
        $user->status_pagamento = 'aprovado';
        $user->save();
        return redirect()->back()->withSuccess('Pagamento aprovado e conta premium ativada para o usuário');
    }

    /**
     * Negar pagamento de conta premium
     *
     * @param  mixed $user
     * @return void
     */
    public function negarPagamento(User $user)
    {
        $user->status_pagamento = 'negado';
        $user->plano = 'gratuito';
        $user->save();
        return redirect()->back()->withSuccess('Pagamento negado, e assinatura do usuário foi adicionada como gratuita');
    }

    /**
     * Salvar dados de PIX para pagamento de conta premium
     *
     * @param  mixed $request
     * @return void
     */
    public function salvarPix(Request $request)
    {

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

        $dadosPix = PixAdmin::first();

        // Se já tem um registro com dados
        if ($dadosPix) {
            if ($dadosPix->qrcode != 'img/qrcode.png')
                Storage::disk('local')->delete($dadosPix->qrcode);
            $dadosPix = $dadosPix->fill($request->all());
        } else {
            $dadosPix = (new PixAdmin)->fill($request->all());
        }

        $dadosPix->qrcode = $request->file('qrcode')->store('img/qrcode');
        $dadosPix->save();

        return redirect()->back()->withSuccess('Dados do PIX salvo com sucesso');
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
