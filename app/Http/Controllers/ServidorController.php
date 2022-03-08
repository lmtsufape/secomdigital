<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servidor;
use App\Http\Requests\ServidorRequest;
use App\Mail\CartaoServidor;
use Illuminate\Support\Facades\Mail;
use App\Image as Imagem;
use App\Font;

class ServidorController extends Controller
{
    public function index(){

      $servidores = Servidor::paginate(10);

      return view('servidor.index', compact('servidores'));
    }

    public function create(){

      return view('servidor.create');
    }

    public function store(ServidorRequest $request){

      $data = $request->all();
      $servidor = Servidor::create($data);

      return redirect()->route('servidor.index')->with(['mensagem'=>"Servidor cadastrado com sucesso!"]);
    }
    public function edit($id)
    {
        $servidor = Servidor::findOrFail($id);

        return view('servidor.edit', compact('servidor'));
    }

    public function update(ServidorRequest $request, $id)
    {

        $data = $request->all();
        $servidor = Servidor::find($id);
        $servidor->update($data);

        return redirect()->route('servidor.index')->with(['mensagem'=>"Servidor atualizado com sucesso!"]);
    }

    public function destroy($id)
    {
        $servidor = Servidor::find($id);
        $servidor->delete();

        return redirect()->route('servidor.index')->with(['mensagem'=>"Servidor excluído com sucesso!"]);
    }

    public function enviarEmail(Request $request){
      $imagemOriginal = Imagem::find($request->id);
      $fonts = Font::all();
      //dd($request->id);
      $subject = "Evento Criado";
      $path = $request->image;
      Mail::to($request->email)
          ->send(new CartaoServidor($path));
    }
}
