<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image as Imagem;
use App\File;
use Illuminate\Support\Facades\Storage;

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
        Storage::disk('public')->delete('temp.jpeg');
        Imagem::where('title','temp')->delete();
        $images = Imagem::orderBy('created_at', 'desc')->get();
        
        return view('home', compact('images'));
    }
}
