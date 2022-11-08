<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsuariosOnlineController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:admin_ou_funcionario']);
    }

    /**
     * Lista de usuários online
     *
     * @return void
     */
    public function usuariosOnline()
    {
        $users = User::select("*")
            ->whereNotNull('last_seen')
            ->orderBy('last_seen', 'DESC')
            ->paginate(15);

        return view('admin.usuarios_online', compact('users'));
    }
}
