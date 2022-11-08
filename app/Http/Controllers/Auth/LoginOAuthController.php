<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginOAuthController extends Controller
{
    /**
     * Redirecionar para mídia social para autenticar usuário
     *
     * @param  mixed $provider
     * @return void
     */
    public function login($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Fazer login do usuário após liberar o acesso oauth
     *
     * @param  mixed $provider
     * @return void
     */
    public function loginCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $usuario = User::where('email', $user->email)->first();

        if ($usuario != null) {
            Auth::login($usuario, true);
            return redirect()->route('painel-de-controle');
        } else {
            return redirect()->route('login')->withError('Usuário não encontrado.');
        }
    }
}
