<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\CategoriaEvento;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoriaEventoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:admin_ou_funcionario']);
    }
    
    /**
     * Categorias de eventos
     *
     * @return void
     */
    public function eventos()
    {
        $eventos = CategoriaEvento::orderBy('created_at', 'desc')->paginate(9);
        return view('admin.eventos.eventos', compact('eventos'));
    }
    
    /**
     * Adicionar categoria de evento
     *
     * @return void
     */
    public function novoEvento()
    {
        return view('admin.eventos.novo_evento');
    }
    
    /**
     * Salvar novo evento
     *
     * @param  mixed $request
     * @return void
     */
    public function salvarNovoEvento(Request $request)
    {
        $request->validate([
            'nome' => ['required', 'max:255', 'unique:categoria_eventos,nome'],
            'descricao' => ['required'],
            'icone' => ['required', 'image', 'max:2048'],
            'assinatura' => ['required', 'in:premium,gratuito'],
        ], [], [
            'descricao' => 'descrição',
            'icone' => 'ícone'
        ]);

        $categoria = (new CategoriaEvento)->fill($request->all());
        $categoria->icone = $request->file('icone')->store('img/icones-eventos');
        $categoria->save();

        return redirect()->route('admin.eventos')->withSuccess('Novo evento criado com sucesso');
    }
    
    /**
     * Editar categoria de evento
     *
     * @param  mixed $categoria_evento
     * @return void
     */
    public function editarEvento(CategoriaEvento $categoria_evento)
    {
        $evento = $categoria_evento;
        return view('admin.eventos.config_evento', compact('evento'));
    }
    
    /**
     * Atualizar evento
     *
     * @param  mixed $request
     * @param  mixed $categoria_evento
     * @return void
     */
    public function salvarEditarEvento(Request $request, CategoriaEvento $categoria_evento)
    {
        $request->validate([
            'nome' => ['required', 'max:255', 'unique:categoria_eventos,nome,' . $categoria_evento->id],
            'descricao' => ['required'],
            'icone' => ['image', 'max:2048'],
            'assinatura' => ['required', 'in:premium,gratuito'],
        ], [], [
            'descricao' => 'descrição',
            'icone' => 'ícone'
        ]);

        $imgAnterior = $categoria_evento->icone;
        $categoria = $categoria_evento->fill($request->all());
        
        // Remover imagem do evento
        if ($request->icone != null) {
            if ($imgAnterior != 'img/tree.png')
                Storage::disk('local')->delete($imgAnterior);
            $categoria->icone = $request->file('icone')->store('img/icones-eventos');
        }
        $categoria->save();

        return redirect()->back()->withSuccess('As alterações foram realizadas com sucesso');
    }
    
    /**
     * Excluir categoria de evento
     *
     * @param  mixed $request
     * @return void
     */
    public function excluir(Request $request)
    {
        $evento = CategoriaEvento::find($request->categoria_evento_id);
        if ($evento)
            $evento->delete();
        return redirect()->back()->withSuccess('Evento excluído com sucesso');
    }
}
