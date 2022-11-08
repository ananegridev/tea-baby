<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class SuperAdminVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!User::where('conta', 'super_admin')->exists() && !Route::is('auth.cadastro-adm')) {
            // Se existir super_admin vai para a rota de cadastro;
            return redirect()->route('auth.cadastro-adm');
        }
        return $next($request);
    }
}
