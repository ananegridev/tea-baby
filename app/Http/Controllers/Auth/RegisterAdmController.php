<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegisterAdmController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Formulário para fazer o cadastro do administrador
     *
     * @return void
     */
    public function index()
    {
        $this->existeSuperAdm();
        return view('auth.cadastro_adm');
    }

    /**
     * Salvar o cadastro
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $this->existeSuperAdm();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Criar usuário
        $adm = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'conta' => 'super_admin',
        ]);

        // Fazer Login
        Auth::login($adm, true);

        return redirect()->route('painel-de-controle');
    }

    /**
     * Consultar se existe super_admin cadastrado no sistema
     *
     * @return void
     */
    public function existeSuperAdm()
    {
        if (User::where('conta', 'super_admin')->exists()) {
            // Se existir super_admin retorna erro 403
            abort(403);
        }

        return true;
    }
}
