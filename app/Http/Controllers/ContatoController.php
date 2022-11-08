<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:admin_ou_funcionario'])->except(['contato', 'enviarContato',]);
    }

    /**
     * Lista de contatos para admin e funcionário visualizar
     *
     * @return void
     */
    public function listaContatos()
    {
        $contatos = Contato::orderBy('created_at', 'desc')->paginate(12);
        return view('admin.contatos.contatos', compact('contatos'));
    }

    /**
     * Formulário para enviar mensagem de contato
     *
     * @return void
     */
    public function contato()
    {
        return view('contato');
    }

    /**
     * Salvar dados de contato enviado
     *
     * @param  mixed $request
     * @return void
     */
    public function enviarContato(Request $request)
    {
        $request->validate([
            'nome' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'conteudo' => ['required', 'max:1000'],
        ], [], [
            'conteudo' => 'conteúdo'
        ]);

        // Armazenar contato
        $con = (new Contato)->fill($request->all());
        $con->save();

        return redirect()->back()->withSuccess('Sua mensagem foi enviada com sucesso, aguarde o retorno.');
    }

    /**
     * Excluir contato
     *
     * @param  mixed $contato
     * @return void
     */
    public function excluir(Request $request)
    {
        $contato = Contato::find($request->contato_id);
        if ($contato)
            $contato->delete();

        return redirect()->back()->withSuccess('Contato excluído com sucesso.');
    }
}
