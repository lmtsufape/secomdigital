<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image as Imagem;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
//use Intervention\Image\ImageManager;

class ImageController extends Controller
{
    public function index(){
    	$images = Imagem::orderBy('created_at', 'desc')->get();
    	//dd($images);
    	return view('home', compact('images'));
    }
    public function store(Request $request){
    	$request->validate([
    		 'filename'		=> 'image | mimes:jpg,jpeg,png,gif,bmp',

    	]);
    	
    	$image = new Imagem();
    	$image->title = $request->title;
    	$image->file = $this->uploadFile($request);
    	$image->save();

    	return redirect('/home')->with('message', 'Sua imagem foi adicionada com sucesso!');
    }

    public function uploadFile($request){

    	if($request->hasFile('filename')){
    		$image 				= $request->file('filename');
    		$filename 		= $image->getClientOriginalName();
    		$destination 	= storage_path('app/public');

    		if($image->move($destination, $filename)){
    			return $filename;
    		}

    		//Outra abordagem de upload de imagem
    		//return $image->store('public');
    		//return $image->storeAs('public', $filename);
    	}
    	return null;

    }

    public function destroy(Request $request){
    	$image = Imagem::find($request->id);
    	$image->delete();
			//dd(Storage::delete($image->file));
			Storage::delete($image->file);
    	return redirect()->back();
    }

    public function edit($id){
    	$imagemGerada = Imagem::find($id);
    	
    	return view('imagem.edit', compact('imagemGerada'));
    }

    public function update(Request $request){

    	$image = Imagem::find($request->image_id);
    	
	  	$img = Image::make(storage_path('app/public/').$image->file);  
	    
	    $img->text($request->nome,1110,100, function($font) {
	    	$font->file(public_path("font/OpenSans-Italic.ttf")); 
			  
			  $font->size(50); //defininindo o tamanho como 20
			  //dd($font);
			  $font->color('#ffffff'); //definindo a cor como branco

			  $font->align('right'); //definindo o alinhamento como centralizado

			});

			$imagemGerada = new Imagem();
			$imagemGerada->title = $image->title."-"."copia";
	    $imagemGerada->file = $img->filename."copia".'.'.$img->extension;
	    $imagemGerada->save();
	    $img->save(storage_path('app/public/').$imagemGerada->file);
	    
	    //return redirect()->back();
     	//return redirect()->route('image.baixar', ['id'=>$imagemGerada->id]); 
     	return view('imagem.edit', compact('imagemGerada'));
    }

    public function baixar($id){

    	$imagem = Imagem::find($id);
    	return view('imagem.baixar', compact('imagem'));
    }
    public function baixarImagem(Request $request){  

      return response()->download(storage_path('app/public/' . $request->file));
  	}

}
