<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
include_once('simplehtmldom_1_9_1/simple_html_dom.php');

class ClippingController extends Controller

{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create(){
    	return view('clipping.create');
    }

    public function gerar(Request $request){
        //dd($request);
        $request->validate([
            'dataInicio'       => ['required', 'date_format:d/m/Y'],
            'dataFinal'        => ['required', 'date_format:d/m/Y'],
            'titulo.*'         => ['required_with:link.*'],
            'link.*'           => ['required_with:titulo.*'],
        ]);
  
        $dataInicio = $request->dataInicio . " 00:00:00"; 
        $dataFinal = $request->dataFinal . " 23:59:59";

        $noticias = $this->gerarNoticias($dataInicio, $dataFinal);
        $comunicados = $this->gerarComunicados($dataInicio, $dataFinal);
        $agenda = $this->gerarAgenda($dataInicio, $dataFinal);
        $editais = $this->gerarEditais($dataInicio, $dataFinal);
        $novas = $this->gerarNovas($request->titulo, $request->link);
        // $textoArray = [ [$novas, "Páginas novas, atualizadas ou destaques"]];

        if(count($novas) > 0){
            $textoArray = [[$noticias,"Notícias"], [$comunicados, "Comunicados"], [$agenda, "Agenda"],
                         [$editais, "Editais e Seleções"], [$novas, "Páginas novas, atualizadas ou destaques"]];
        }else{
            $textoArray = [[$noticias,"Notícias"], [$comunicados, "Comunicados"], [$agenda, "Agenda"],
                         [$editais, "Editais e Seleções"]];
        }
        
        return view('clipping.show', ['textoArray'  => $textoArray, 
                                       'dataInicio' => $request->dataInicio,
                                       'dataFinal'  => $request->dataFinal,
                                       'countCampos'  => $request->countCampos,
                                       'titulo'     => $request->titulo,
                                       'link'       => $request->link]);
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
            $data = date_create_from_format('j/m/Y H:i:s', $dataString . "00:00:00");  
            
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
            $data = date_create_from_format('j/m/Y H:i:s', ($dataString . "00:00:00"));  
           // dd($data, $dataInicio, $dataFinal);
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
            $dataField = $evento->find('div[class=views-field views-field-field-data]', 0);
            $dataEvento = $dataField->children[0]->children[0]->innertext;

            $fieldTitle = $evento->find('div[class=views-field views-field-title]',0);
            $titulo = $dataEvento . " às " . $fieldTitle->children[0]->children[0]->innertext;
            $url = $urlBase . $fieldTitle->children[0]->children[0]->href;

            $htmlEvento = file_get_html($url);
            //encontra div com conjunto de notícias
            $contentEvento = $htmlEvento->find('div[class=field field-name-post-date field-type-ds field-label-hidden]',0);
            $data = $contentEvento->children[0]->children[0];

            $data = explode(", ", $data->innertext);
            list($dia, $mesString) = explode(" ", $data[1]);
            $ano = substr($data[2], 0, 4);

            //dd($dia, $mes, $ano);

            $meses = array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");
            $mes = array_search($mesString, $meses)+1;
            
            $dataString = $dia . '/' . $mes . '/' . $ano;
            $data = date_create_from_format('j/m/Y', $dataString); 
            //dd($data);
            
            if($data >= $dataInicio && $data <= $dataFinal){
                array_push($agendaArray, [$titulo, $url]);
            }           
            
        }

        return $agendaArray;
    }

    public function gerarEditais($dataInicio, $dataFinal){
        $dataInicio = date_create_from_format('j/m/Y H:i:s', $dataInicio);
        $dataFinal = date_create_from_format('j/m/Y H:i:s', $dataFinal); 

        $urlBase = "http://ufape.edu.br";
        $urlComunicados = 'http://ufape.edu.br/br/editais-e-selecoes';

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

    public function gerarNovas($titulo, $link){
        $novasArray = [];
        
        for($i = 0; $i < sizeof($titulo); $i++){
            if($titulo[$i] !== '' && $link[$i]){
                array_push($novasArray, [$titulo[$i], $link[$i]]);
            }
        }

        return $novasArray;
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
