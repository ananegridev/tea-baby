<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Evento;
use App\Models\Presente;
use Illuminate\Http\Request;
use App\Exports\PresentesExport;
use App\Models\CategoriaPresente;
use Maatwebsite\Excel\Facades\Excel;

class PresenteController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:usuario', 'check.manutencao']);
    }

    /**
     * Lista Presentes
     *
     * @return void
     */
    public function listaPresentes(Evento $evento)
    {
        $totalPresentes = Presente::where('nome', '!=', null)->whereHas('categoria', function ($query) use ($evento) {
            return $query->where('evento_id', $evento->id)->where('user_id', auth()->user()->id);
        })->count();

        $categorias = CategoriaPresente::where('evento_id', $evento->id)->where('user_id', auth()->user()->id)->get();
        return view('presentes.recebidos', compact('categorias', 'totalPresentes', 'evento'));
    }

    /**
     * Selecionar evento para visualizar lista de presentes
     *
     * @return void
     */
    public function selecionarEvento()
    {
        $eventos = Evento::where('user_id', auth()->user()->id)->get();
        return view('presentes.presentes_selecionar_evento', compact('eventos'));
    }

    /**
     * Salvar lista
     *
     * @param  mixed $request
     * @return void
     */
    public function salvarLista(Request $request, Evento $evento)
    {
        $request->validate([
            'adicionar_categoria' => ['required', 'unique:categoria_presentes,nome', 'max:255'],
            'items_adicionar' => ['required'],
        ], [], [
            'adicionar_categoria' => 'categoria'
        ]);

        // Adicionar categoria
        $categoria = CategoriaPresente::create([
            'nome' => $request->adicionar_categoria,
            'user_id' => auth()->user()->id,
            'evento_id' => $evento->id,
        ],);

        // Adicionar presentes
        foreach ($request->items_adicionar as $key => $item) {
            Presente::create([
                'nome' => $item['nome'],
                'total' => $item['total'],
                'categoria_presente_id' => $categoria->id,
            ]);
        }

        return redirect()->back()->withSuccess('Lista salva com sucesso');
    }

    /**
     * Atualizar lista de presentes
     *
     * @param  mixed $request
     * @return void
     */
    public function atualizarLista(Request $request)
    {
        $categoria = CategoriaPresente::find($request->categoria_id);

        // bloquear acesso se o evento não for do usuário
        if (Evento::find($categoria->evento_id)->user_id != auth()->user()->id) {
            abort(403);
        }

        $request->validate([
            'atualizar_categoria' => ['required', 'max:255', 'unique:categoria_presentes,nome,' .  $categoria->id],
            'items_atualizar' => ['required'],
            'categoria_id' => ['required'],
        ], [], [
            'atualizar_categoria' => 'categoria'
        ]);

        // Atualizar categoria
        $nomeCat = array_values($request->atualizar_categoria)[0];
        $categoria->nome = $nomeCat;
        $categoria->save();

        // Atualizar presentes
        $presentes = array_values($request->items_atualizar)[0];
        foreach ($presentes as $key => $item) {
            $presente = Presente::find($item['presente_id']);

            if ($presente) {
                $presente->nome = $item['nome'];
                $presente->total = $item['total'];
                $presente->save();
            }
        }

        return redirect()->back()->withSuccess('Lista atualizada com sucesso');
    }

    /**
     * Exportar presentes em excel
     *
     * @return void
     */
    public function excel($evento_id)
    {
        return Excel::download(new PresentesExport($evento_id), 'lista-de-presentes.xlsx');
    }

    /**
     * Exportar presentes em PDF
     *
     * @return void
     */
    public function pdf($evento_id)
    {
        $categorias = CategoriaPresente::where('evento_id', $evento_id)->where('user_id', auth()->user()->id)->get();
        $pdf = PDF::loadView('presentes.pdf_lista_presentes', compact('categorias'));
        return $pdf->download('presentes.lista-de-presentes.pdf');
    }
}
