<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InicioController extends Controller
{    
    /**
     * Página inicial do site
     *
     * @return void
     */
    public function index()
    {
        return view('inicio');
    }
}
