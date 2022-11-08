<?php

namespace App\Http\Controllers;

use App\Models\Visitas;
use Illuminate\Http\Request;

class VisitasController extends Controller
{
    /**
     * Inserir registro de visita ao site
     *
     * @return void
     */
    public function inserirVisita()
    {
        Visitas::create([
            'navegador' => $this->navegdorUsado()
        ]);
        return response()->json(true);
    }

    /**
     * Obter o navegador utilizado
     *
     * @return void
     */
    public function navegdorUsado()
    {
        $listaNavegadores = array("MSIE", "Firefox", "Chrome", "Safari", "OPR");
        $userAgent = $_SERVER["HTTP_USER_AGENT"];
        $navegadorUsado = null;

        foreach ($listaNavegadores as $key => $navegador) {
            if (strpos($userAgent, $navegador)) {
                $navegadorUsado = $navegador;
                break;
            }
        }

        return $navegadorUsado;
    }
}
