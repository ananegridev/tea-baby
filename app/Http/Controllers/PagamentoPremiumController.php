<?php

namespace App\Http\Controllers;

use App\Models\PixAdmin;
use Illuminate\Http\Request;

class PagamentoPremiumController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:usuario', 'check.manutencao']);
    }

    /**
     * Página para realizar o pagamento da assinatura premium
     *
     * @return void
     */
    public function realizarPagamento()
    {
        $dadosPix = PixAdmin::first();
        return view('pagamento-premium', compact('dadosPix'));
    }

    /**
     * Confirmar pagamento concluído 
     * (Apenas para exibir uma mensagem de q o pedido foi solicitados, apenas o admin pode autorizar o acesso premium)
     *
     * @return void
     */
    public function pagamentoConcluido()
    {
        return redirect()->route('painel-de-controle')->with('pagamento_premium', 'aguardando');
    }
}
