<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class EditarCadastroUsuario extends Controller
{
    /**
     * Página para editar dados do usuário
     *
     * @return void
     */
    public function editar()
    {
        return view('auth.editar_registro');
    }

    /**
     * Salvar alterações dos dados do usuário
     *
     * @param  mixed $request
     * @return void
     */
    public function salvar(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'formato_cpf'],
            'dt_nasc' => ['required', 'date'],
            'plano' => ['required', 'in:premium,gratuito'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->user()->id],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [], [
            'dt_nasc' => 'data de nascimento'
        ]);

        $usuario = User::find(auth()->user()->id);
        $planoUsuarioAntes = $usuario->plano;
        $usuario->fill($request->all());
        $usuario->password = Hash::make($request->password);
        $usuario->save();
        $planoUsuarioDepois = $usuario->plano;

        if ($planoUsuarioAntes == 'gratuito' && $planoUsuarioDepois == 'premium') {
            return redirect()->route('pagamento-premium');
        }
        return redirect()->back()->withSuccess('Cadastro atualizado');
    }

    /**
     * Excluir conta de usuário
     *
     * @return void
     */
    public function excluir()
    {
        $usuario = User::find(auth()->user()->id);
        $usuario->delete();
        return redirect()->route('index-home');
    }
}
