<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configuracao;
use Illuminate\Http\Request;

class ConfiguracaoController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Página de configurações
     *
     * @return void
     */
    public function config()
    {
        $this->authorize('admin');
        return view('admin.configuracoes.configuracoes');
    }

    /**
     * Alterar status de manutenção do site.
     * As landing pages de painel do usuário irá exiber uma msg de manutenção
     *
     * @param  mixed $request
     * @return void
     */
    public function alterarStatusManutencao(Request $request)
    {
        $this->authorize('admin');
        $config = Configuracao::first();
        if ($config) {
            $config->status_manutencao = $request->status == null ? 'off' : 'on';
            $config->save();
        } else {
            $config = Configuracao::create([
                'status_manutencao' => $request->status == null ? 'off' : 'on'
            ]);
        }
        return redirect()->back()->withSuccess('Status do sistema alterado com sucesso');
    }

    /**
     * Página com mensagem que o ste está em manutenção
     *
     * @return void
     */
    public function manutencao()
    {
        return view('admin.configuracoes.manutencao');
    }
}
