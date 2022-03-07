<?php

namespace App\Http\Controllers;

use App\Cartao;
use App\Image;
use Illuminate\Http\Request;

class CartaoController extends Controller
{

    // Criação de um novo cartão
    public function criar(Request $request){

        if($request->flag == "1"){
            return redirect()->route('image.update',
                ['eixo_x' =>  $request->eixo_x,
                    'eixo_y' =>  $request->eixo_y,
                    'size' =>  $request->size,
                    'font_id' =>  $request->font_id,
                    'image_id' =>  $request->image_id,
                    'texto' =>  $request->texto]);
        }

        $cartao = new Cartao();
        $cartao->texto = $request->texto;
        $cartao->eixo_x = $request->eixo_x;
        $cartao->eixo_y = $request->eixo_y;
        $cartao->tamanho = $request->size;
        $cartao->font_id = $request->font_id;
        $cartao->image_id = $request->image_id;

        $cartao->save();

        return redirect()->back();
    }

    // Atualizar dados de cartão já criado
    public function atualizar(Request $request){

        if($request->flag == "1"){
            return redirect()->route('image.update',
                ['eixo_x' =>  $request->eixo_x,
                'eixo_y' =>  $request->eixo_y,
                'size' =>  $request->size,
                'font_id' =>  $request->font_id,
                'image_id' =>  $request->image_id,
                'texto' =>  $request->texto]);
        }

        $cartao = Cartao::find($request->cartao_id);
        $cartao->texto = $request->texto;
        $cartao->eixo_x = $request->eixo_x;
        $cartao->eixo_y = $request->eixo_y;
        $cartao->tamanho = $request->size;
        $cartao->font_id = $request->font_id;
        $cartao->image_id = $request->image_id;

        $cartao->update();

        return redirect()->back();

    }

}
