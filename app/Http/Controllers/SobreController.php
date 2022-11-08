<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SobreController extends Controller
{    
    /**
     * Sobre
     *
     * @return void
     */
    public function index()
    {
        return view('sobre');
    }
}
