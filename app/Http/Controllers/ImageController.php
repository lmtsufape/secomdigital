<?php

namespace App\Http\Controllers;

use App\Mail\CartaoServidor;
use App\Servidor;
use App\Cartao;
use Illuminate\Http\Request;
use App\Image as Imagem;
use App\Font;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

//use Intervention\Image\ImageManager;

class ImageController extends Controller
{

    // public function index(){

    // 	$images = Imagem::orderBy('created_at', 'desc')->get();
    // 	//dd($images);
    // 	return view('home', compact('images'));
    // }

    public function imagem()
    {
       // $images = Imagem::orderBy('created_at', 'desc')->get();
          $images = Imagem::where('title', 'cartaobackground')->get();

        return view('imagem.imagem', compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'filename' => 'required | image | mimes:jpg,jpeg,png,gif,bmp',
        ]);

        $imagens = \App\Image::all();

        foreach ($imagens as $imagem) {
            if ($imagem->title == $request->title) {
                return redirect(route('imagem'))->with('fail', 'Já existe uma imagem cadastrada, apague a imagem para poder cadastrar outra.');
            }
        }

        $image = new Imagem();
        $image->title = $request->title;
        $image->file = $this->uploadFile($request);
        $image->save();

        return redirect(route('imagem'))->with('message', 'Sua imagem foi adicionada com sucesso!');
    }

    public function gerarImagem($texto)
    {
        $cartao = Cartao::all()->first();
        if ($cartao != null) {
            $fonte = Font::find($cartao->font_id);
            $image = Imagem::find($cartao->image_id);
            $img = Image::make(storage_path('app/public/') . $image->file);
            $path = public_path("font/") . $fonte->font_name . ".ttf";
            $eixoX = $cartao->eixo_x;
            $eixoY = $cartao->eixo_y;
            $size = $cartao->tamanho;

            $img->text($texto, $eixoX, $eixoY, function ($font) use ($path, $size) {
                $font->file($path);
                //dd($path);
                $font->size($size); //defininindo o tamanho como 20
                //dd($font);
                $font->color('#ffffff'); //definindo a cor como branco

                $font->align('left'); //definindo o alinhamento como centralizado

            });
        }


        $imagemGerada = new Imagem();
        $imagemGerada->title = 'temp';
        $imagemGerada->file = 'temp' . '.' . 'jpg';
        $img->save(storage_path('app/public/') . $imagemGerada->file);
        $imagemGerada->path = storage_path('app/public/') . $imagemGerada->file;
        return $imagemGerada->path;
    }

    public function envioAutomaticoCartao()
    {
        $servidores = Servidor::all();
        $hoje = date('d-m', strtotime(today()));
        //$aniver = date('d-m', strtotime('1973-05-13'));
        //$imagemOriginal = Imagem::where('title', 'cartaobackground')->first();
        foreach ($servidores as $servidor) {
            $nomes = explode(" ", $servidor->nome);
            $servidorAniver = date('d-m', strtotime($servidor->data_nascimento));
            if ($hoje == $servidorAniver) {
                $path = $this->gerarImagem($nomes[0]);
                Mail::to($servidor->email)
                    ->send(new CartaoServidor($path));
            }
        }
    }

    public function uploadFile($request)
    {
        if ($request->hasFile('filename')) {
            $image = $request->file('filename');
            $filename = $request->title . '.' . 'jpg';
            $destination = storage_path('app/public');

            if ($image->move($destination, $filename)) {
                return $filename;
            }

            //Outra abordagem de upload de imagem
            //return $image->store('public');
            //return $image->storeAs('public', $filename);
        }
        return null;

    }

    public function destroy(Request $request)
    {
        $image = Imagem::find($request->id);
        $image->delete();
        //dd(Storage::delete($image->file));
        Storage::delete($image->file);
        return redirect()->back()->with(['message' => "Imagem apagada com sucesso!"]);
    }

    public function edit($id)
    {
        $imagemOriginal = Imagem::find($id);
        $fonts = Font::all();
        $cartao = Cartao::where('image_id', $id)->first();
        //dd($fonts);
        return view('imagem.edit', ['imagemOriginal' => $imagemOriginal, 'fonts' => $fonts, 'cartao' => $cartao]);
    }

    public function definirFont()
    {

    }


    public function update(Request $request)
    {
        $image = Imagem::find($request->image_id);
        $cartao = Cartao::where('image_id', $request->image_id)->first();
        $fonte = Font::find($request->font_id);
        $fontes = Font::all();
        $img = Image::make(storage_path('app/public/') . $image->file);
        $path = public_path("font/") . $fonte->font_name . ".ttf";
        $eixoX = is_null($request->eixo_x) ? 4100 : $request->eixo_x;
        $eixoY = is_null($request->eixo_y) ? 400 : $request->eixo_y;
        $size = is_null($request->size) ? 250 : $request->size;


        //dd($path);
        $img->text($request->texto, $eixoX, $eixoY, function ($font) use ($path, $size) {
            $font->file($path);
            //dd($path);
            $font->size($size);
            //dd($font);
            $font->color('#ffffff');

            $font->align('left');

        });

        $imgTemp = Imagem::where('title', 'temp')->first();
        $imagemGerada = new Imagem();
        $imagemGerada->title = 'temp';
        $imagemGerada->file = 'temp' . '.' . 'jpg';
        if ($imgTemp == null) {
            $imagemGerada->save();
        }
        $imagemGerada->path = storage_path('app/public/') . $imagemGerada->file;
        $img->save(storage_path('app/public/') . $imagemGerada->file);

        //return redirect()->back();
        //return redirect()->route('image.baixar', ['id'=>$imagemGerada->id]);
        return view('imagem.edit', [
            'imagemOriginal' => $image,
            'imagemGerada' => $imagemGerada,
            'fonts' => $fontes,
            'fontTestada' => $fonte,
            'eixo_x' => $eixoX,
            'eixo_y' => $eixoY,
            'size' => $size,
            'fonte' => $request->font_id,
            'texto' => $request->texto,
            'cartao' => $cartao
        ])->with(['message' => 'Cartão gerado com sucesso!']);
    }

    public function baixar($id)
    {

        $imagem = Imagem::find($id);
        return view('imagem.baixar', compact('imagem'));
    }

    public function baixarImagem(Request $request)
    {

        return response()->download(storage_path('app/public/' . $request->file));
    }


}
