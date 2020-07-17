<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
include_once('simplehtmldom_1_9_1\simple_html_dom.php');

class ClippingController extends Controller

{
    public function create(){
    	return view('clipping.create');
    }

    public function gerar(Request $request){
        $dataInicio = $request->dataInicio . " 00:00:00"; 
        $dataFinal = $request->dataFinal . " 23:59:59";

        $noticias = $this->gerarNoticias($dataInicio, $dataFinal);
        $comunicados = $this->gerarComunicados($dataInicio, $dataFinal);
        $agenda = $this->gerarAgenda($dataInicio, $dataFinal);

        $textoArray = [[$noticias,"Notícias"], [$comunicados, "Comunicados"], [$agenda, "Agenda"]];

        return view('clipping.show', ['textoArray'  => $textoArray, 
                                       'dataInicio' => $request->dataInicio,
                                       'dataFinal'  => $request->dataFinal]);
    }

    public function gerarNoticias($dataInicio, $dataFinal){
        $dataInicio = date_create_from_format('j/m/Y H:i:s', $dataInicio);
        $dataFinal = date_create_from_format('j/m/Y H:i:s', $dataFinal); 

        $noticiasArray = [];

        $urlBase = "http://ufape.edu.br";

        // //notícias do carrossel
        $urlNoticias = "http://ufape.edu.br/br";
        $html = file_get_html($urlNoticias);

        $content = $html->find('ul[class=slides]',0);

        foreach($content->children as $noticia){
            //dd($noticia);
            $fieldTitle = $noticia->find('div[class=views-field views-field-title]',0);
            //dd($fieldTitle);
            $tituloSemTrim = $fieldTitle->innertext;

            $titulo = trim($tituloSemTrim);
            //dd($titulo);

            $fieldUrl = $noticia->find('div[class=field-content]',0);
            $urlNoticia = $urlBase . $fieldUrl->children[0]->href;
            $htmlNoticia = file_get_html($urlNoticia);

            $content = $htmlNoticia->find('span[class=submitted]',0);
            $dataPostagem = $content->innertext;
            $pos = strpos($dataPostagem, '/');
            $dataString = substr($dataPostagem, $pos-2, 10);
            $data = date_create_from_format('j/m/Y', $dataString);  
            
            if($data >= $dataInicio && $data <= $dataFinal){
                array_push($noticiasArray, [$titulo, $urlNoticia]);
            }    
                     
        }

        $urlNoticias = 'http://ufape.edu.br/br/noticias';

        $html = file_get_html($urlNoticias);
        
        //encontra div com conjunto de notícias
        $content = $html->find('div[class=view-content]',0);
        
        foreach($content->children as $noticia){
            //dd($noticia);
            $fieldTitle = $noticia->find('div[class=views-field views-field-title]',0);
            $titulo = $fieldTitle->children[0]->children[0]->innertext;
            $url = $urlBase . $fieldTitle->children[0]->children[0]->href;

            $fieldData = $noticia->find('div[class=views-field views-field-created]',0);
            $dataComHora = $fieldData->children[0]->innertext;
            $dataString = substr($dataComHora, 0, 10);
            $data = date_create_from_format('j/m/Y', $dataString);  
            
            if($data >= $dataInicio && $data <= $dataFinal){
                array_push($noticiasArray, [$titulo, $url]);
            }           
        }

        //dd($noticiasArray);

        return $noticiasArray;
    }

    public function gerarComunicados($dataInicio, $dataFinal){
        $dataInicio = date_create_from_format('j/m/Y H:i:s', $dataInicio);
        $dataFinal = date_create_from_format('j/m/Y H:i:s', $dataFinal); 

        $urlBase = "http://ufape.edu.br";
        $urlComunicados = 'http://ufape.edu.br/br/comunicados';

        $html = file_get_html($urlComunicados);
        
        //encontra div com conjunto de notícias
        $content = $html->find('div[class=view-content]',0);
        
        $comunicadosArray = [];
        foreach($content->children as $comunicado){
            //dd($comunicado);
            $fieldTitle = $comunicado->find('div[class=views-field views-field-title]',0);
            $titulo = $fieldTitle->children[0]->children[0]->innertext;
            $url = $urlBase . $fieldTitle->children[0]->children[0]->href;

            $fieldData = $comunicado->find('div[class=views-field views-field-created]',0);
            $dataComHora = $fieldData->children[0]->innertext;
            $dataString = substr($dataComHora, 0, 10);
            $data = date_create_from_format('j/m/Y', $dataString);  
            
            if($data >= $dataInicio && $data <= $dataFinal){
                array_push($comunicadosArray, [$titulo, $url]);
            }           
            
        }

        return $comunicadosArray;
    }

    public function gerarAgenda($dataInicio, $dataFinal){
        $dataInicio = date_create_from_format('j/m/Y H:i:s', $dataInicio);
        $dataFinal = date_create_from_format('j/m/Y H:i:s', $dataFinal); 

        $urlBase = "http://ufape.edu.br";
        $urlAgenda = 'http://ufape.edu.br/br/eventos';

        $html = file_get_html($urlAgenda);
        
        //encontra div com conjunto de notícias
        $content = $html->find('div[class=item-list]',0);
        $lista = $content->children[0];
        
        $agendaArray = [];
        foreach($lista->children as $evento){
            //dd($evento);
            $fieldTitle = $evento->find('div[class=views-field views-field-title]',0);
            $titulo = $fieldTitle->children[0]->children[0]->innertext;
            $url = $urlBase . $fieldTitle->children[0]->children[0]->href;

            $fieldData = $evento->find('div[class=views-field views-field-field-data]',0);            
            $dataString = $fieldData->children[0]->children[0]->innertext;            
            $data = date_create_from_format('j/m/Y', $dataString);  
            
            if($data >= $dataInicio && $data <= $dataFinal){
                array_push($agendaArray, [$titulo, $url]);
            }           
            
        }

        return $agendaArray;
    }

    public function formatarTexto($textoArray){
        $resultado = "";
        foreach($textoArray as $categoria){
            $resultado .= ("<h2>" . $categoria[1] . "</h2>");
            
            foreach($categoria[0] as $publicacao){
                $resultado .= ("<b>" . $publicacao[0] . '</b> - ');
                $resultado .= ("<a href='" . $publicacao[1] . "'>" . $publicacao[1] . '</a><br><br>');
            }
            
        }
        return $resultado;
    }
}
