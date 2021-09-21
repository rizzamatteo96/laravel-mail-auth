<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Controller per la gestione del lato guest

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('guest.welcome');
    }
}
