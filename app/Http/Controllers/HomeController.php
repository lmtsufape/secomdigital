<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image as Imagem;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $images = Imagem::orderBy('created_at', 'desc')->get();
        //dd($images);
        return view('home', compact('images'));
    }
}
