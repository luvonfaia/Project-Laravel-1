<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Homepage extends Controller
{
    public function homepage() //metoda creata pentru pagina principala Home
    {
        return view('homepage');
    }


    public function about() //metoda creata pentru pagina principala About cu o singura postare ca exemplu
    {
        return view('single-post');
    }

}
