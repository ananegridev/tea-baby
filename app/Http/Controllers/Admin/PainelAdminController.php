<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\RelatoriosController;

class PainelAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:admin_ou_funcionario']);
    }

    /**
     * Painel de controle do admin e furncionário
     *
     * @return void
     */
    public function painel()
    {
        return view('admin.index', [
            'dadosVisitasPorDia' => json_encode((new RelatoriosController)->visitasPorDia()),
            'eventosMaisEscolhidos' => (new RelatoriosController)->eventosMaisEscolhidos(),
        ]);
    }
}
