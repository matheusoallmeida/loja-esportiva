<?php

namespace App\Http\Controllers;

use App\Models\Produto;

class WelcomeController extends Controller
{
    public function index()
    {
        $produtos = Produto::latest()->take(4)->get();

        return view('welcome', compact('produtos'));
    }
}