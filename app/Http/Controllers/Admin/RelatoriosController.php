<?php

namespace App\Http\Controllers\Admin;

use App\Models\Visitas;
use Illuminate\Http\Request;
use App\Models\CategoriaEvento;
use App\Exports\VisitasTotalExport;
use App\Exports\TiposDeAcessoExport;
use App\Exports\VisitasPorDiaExport;
use App\Exports\VisitasPorMesExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EventosMaisEscolhidosExport;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class RelatoriosController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'can:admin']);
    }

    /**
     * Relatórios do sistema
     *
     * @return void
     */
    public function relatorios()
    {
        return view('admin.relatorios.relatorios', [
            'dadosVisitasTotal' => json_encode($this->visitasTotal()),
            'dadosVisitasPorMes' => json_encode($this->visitasPorMes()),
            'dadosVisitasPorDia' => json_encode($this->visitasPorDia()),
            'tiposDeAcesso' => $this->tiposDeAcesso(),
            'eventosMaisEscolhidos' => $this->eventosMaisEscolhidos(),
        ]);
    }

    /**
     * Dados de visitas totais nos últimos 6 anos
     *
     * @return void
     */
    public function visitasTotal()
    {
        // Visitas nos útimos 6 anos
        $dadosArray = [
            'ano' => [],
            'visitas' => []
        ];
        for ($i = 0; $i <= 5; $i++) {
            $ano = date('Y', strtotime(" - $i years"));
            array_unshift($dadosArray['ano'], $ano);
            array_unshift($dadosArray['visitas'], Visitas::whereYear('data', $ano)->count());
        }
        return $dadosArray;
    }

    /**
     * Dados de vistas por mês
     *
     * @return void
     */
    public function visitasPorMes()
    {
        $dadosArray = [
            'mes' => [],
            'visitas' => []
        ];
        for ($i = 0; $i <= 11; $i++) {
            $ano = date('Y', strtotime(date('Y-m-05') . " - $i months"));
            $mes = date('m', strtotime(date('Y-m-05') . " - $i months"));
            array_unshift($dadosArray['mes'], $mes . '/' . $ano);
            array_unshift($dadosArray['visitas'], Visitas::whereYear('data', $ano)->whereMonth('data', $mes)->count());
        }
        return $dadosArray;
    }

    /**
     * Dados de visitas por dia
     *
     * @return void
     */
    public function visitasPorDia()
    {
        $dadosArray = [
            'dia' => [],
            'visitas' => []
        ];
        for ($i = 0; $i <= 30; $i++) {
            $mes = date('m', strtotime(" - $i days"));
            $dia = date('d', strtotime(" - $i days"));
            array_unshift($dadosArray['dia'], $dia . '/' . $mes);
            array_unshift($dadosArray['visitas'], Visitas::whereDay('data', $dia)->count());
        }
        return $dadosArray;
    }

    /**
     * Dados de tipos de acessos por navegadores
     *
     * @return void
     */
    public function tiposDeAcesso()
    {
        $array = array("MSIE", "Firefox", "Chrome", "Safari", "Opera", 'Outros');

        $array['MSIE'] = Visitas::where('navegador', 'MSIE')->count();
        $array['Firefox'] = Visitas::where('navegador', 'Firefox')->count();
        $array['Chrome'] = Visitas::where('navegador', 'Chrome')->count();
        $array['Safari'] = Visitas::where('navegador', 'Safari')->count();
        $array['Opera'] = Visitas::where('navegador', 'OPR')->count();
        $array['Outros'] = Visitas::where('navegador', null)->count();

        return $array;
    }

    /**
     * Dados de categoria de eventos mais escolhidos
     *
     * @return void
     */
    public function eventosMaisEscolhidos()
    {
        $eventos = CategoriaEvento::get()->sortByDesc(function ($query, $key) {
            return $query->eventos->count();
        });

        $arrayEventos = [];

        foreach ($eventos as $key => $value) {
            $arrayEventos[] = [
                'nome' => $value->nome,
                'total_eventos' => $value->eventos->count(),
            ];
        }

        return $arrayEventos;
    }

    /**
     * Exportar visitas total em excel
     *
     * @return void
     */
    public function exportarVisitasTotalExcel()
    {
        return Excel::download(new VisitasTotalExport(), 'visitas-total.xlsx');
    }

    /**
     * Exportar visitas mês em excel
     *
     * @return void
     */
    public function exportarVisitasPorMesExcel()
    {
        return Excel::download(new VisitasPorMesExport(), 'visitas-por-mes.xlsx');
    }

    /**
     * Exportar visitas por dia em excel
     *
     * @return void
     */
    public function exportarVisitasPorDiaExcel()
    {
        return Excel::download(new VisitasPorDiaExport(), 'visitas-por-dia.xlsx');
    }

    /**
     * Exportar tipos de acessos em excel
     *
     * @return void
     */
    public function exportarTiposDeAcessoExcel()
    {
        return Excel::download(new TiposDeAcessoExport(), 'tipo-de-acesso.xlsx');
    }

    /**
     * Exportar categorias de eventos mais escolhidas em excel
     *
     * @return void
     */
    public function exportarEventosMaisEscolhidosExcel()
    {
        return Excel::download(new EventosMaisEscolhidosExport(), 'eventos-mais-escolhidos.xlsx');
    }

    /**
     * Exportar PDF de visitas total
     *
     * @return void
     */
    public function pdfVisitasTotal()
    {
        $pdf = PDF::loadView('admin.relatorios.pdf_visitas_total');
        return $pdf->download('visitas-total.pdf');
    }

    /**
     * Exportar PDF de visitas por mês
     *
     * @return void
     */
    public function pdfVisitasPorMes()
    {
        $pdf = PDF::loadView('admin.relatorios.pdf_visitas_mes');
        return $pdf->download('visitas-por-mes.pdf');
    }

    /**
     * Exportar PDF de visitas por dia
     *
     * @return void
     */
    public function pdfVisitasPorDia()
    {
        $pdf = PDF::loadView('admin.relatorios.pdf_visitas_dia');
        return $pdf->download('visitas-por-dia.pdf');
    }

    /**
     * Esprtar PDF de tipos de acesso
     *
     * @return void
     */
    public function pdfTiposAcesso()
    {
        $tiposDeAcesso =  $this->tiposDeAcesso();
        $pdf = PDF::loadView('admin.relatorios.pdf_tipos_acesso', compact('tiposDeAcesso'));
        return $pdf->download('tipos-de-acesso.pdf');
    }

    /**
     * Exportar PDF de categorias de eventos mais escolhidas
     *
     * @return void
     */
    public function pdfEventosMaisEscolhidos()
    {
        $eventosMaisEscolhidos = $this->eventosMaisEscolhidos();
        $pdf = PDF::loadView('admin.relatorios.pdf_eventos_mais_escolhidos', compact('eventosMaisEscolhidos'));
        return $pdf->download('eventos-mais-escolhidos.pdf');
    }
}
