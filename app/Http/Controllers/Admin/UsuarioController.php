<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\UsuariosExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:admin_ou_funcionario']);
    }

    /**
     * Lista de usuários do sistema
     *
     * @param  mixed $request
     * @return void
     */
    public function usuarios(Request $request)
    {
        // Pesquisar usuário
        if ($request->p != null) {
            $nome = $request->p;
            $usuarios = User::where('name', 'like', "%$nome%")
                ->orderBy('created_at', 'desc')
                ->paginate(12);
        } else {
            $usuarios = User::orderBy('created_at', 'desc')
                ->paginate(15);
        }
        return view('admin.usuarios.usuarios', compact('usuarios'));
    }

    /**
     * Adicionar novo usuário
     *
     * @return void
     */
    public function novoUsuario()
    {
        return view('admin.usuarios.novo_usuario');
    }

    /**
     * Salvar novo usuário
     *
     * @param  mixed $request
     * @return void
     */
    public function salvarNovoUsuario(Request $request)
    {
        $this->autorizarApenasAdmin($request->conta);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'formato_cpf'],
            'dt_nasc' => ['required', 'date'],
            'conta' => ['required', 'in:admin,funcionario,usuario_comum'],
            'plano' => ['required', 'in:premium,gratuito'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ], [], [
            'dt_nasc' => 'data de nascimento'
        ]);

        $usuario = (new User)->fill($request->all());
        $usuario->password = bcrypt($request->password);
        $usuario->save();

        return redirect()->back()->withSuccess('Novo usuário criado com sucesso');
    }

    /**
     * Editar dados do usuário
     *
     * @param  mixed $user
     * @return void
     */
    public function configUsuario(User $user)
    {
        return view('admin.usuarios.config_usuario', compact('user'));
    }

    /**
     * Atualizar dados de usuário
     *
     * @param  mixed $request
     * @param  mixed $user
     * @return void
     */
    public function configUsuarioSalvar(Request $request, User $user)
    {
        // Bloquear ação se a modificação for para 'super admin'
        if ($user->conta == 'super_admin') {
            abort(403, 'Ação bloqueada');
        }

        $this->autorizarApenasAdmin($request->conta);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'formato_cpf'],
            'dt_nasc' => ['required', 'date'],
            'conta' => ['required', 'in:admin,funcionario,usuario_comum'],
            'plano' => ['required', 'in:premium,gratuito'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['required', 'string', 'min:8'],
        ], [], [
            'dt_nasc' => 'data de nascimento'
        ]);

        $usuario = $user->fill($request->all());
        $usuario->password = bcrypt($request->password);
        $usuario->save();

        return redirect()->back()->withSuccess('As alterações foram realizadas com sucesso');
    }

    /**
     * Excluir usuário
     *
     * @param  mixed $request
     * @return void
     */
    public function excluirUsuario(Request $request)
    {
        $user = User::find($request->user_id);

        // bloquear ação se a modificação for para 'super admin'
        if ($user == null || $user->conta == 'super_admin') {
            abort(403);
        }

        $this->autorizarApenasAdmin($user->conta);

        $user->delete();
        return redirect()->back()->withSuccess('Usuário excluído');
    }

    /**
     * Exportar usuários em excel
     *
     * @return void
     */
    public function excel()
    {
        return Excel::download(new UsuariosExport(), 'usuarios.xlsx');
    }

    /**
     * Apenas admin pode editar, criar ou deletaar conta de admin e funcionário
     *
     * @param  mixed $conta
     * @return void
     */
    public function autorizarApenasAdmin($conta)
    {
        if ($conta == 'admin' || $conta == 'funcionario') {
            if (auth()->user()->conta != 'admin' && auth()->user()->conta != 'super_admin') {
                echo 'Você só pode modificar contas de usuários comum';
                exit;
            }
            $this->authorize('admin');
        }
    }
}
