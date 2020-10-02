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
        //  $textoArray = [ [$noticias,"Notícias"]];

        // $textoArray = [[$editais, "Editais e Seleções"]];

        $textoArray = [[$noticias,"Notícias"], [$comunicados, "Comunicados"], [$agenda, "Agenda"],
                         [$editais, "Editais e Seleções"], [$novas, "Páginas novas, atualizadas ou destaques"]];
        
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
        $html = curl_init($urlNoticias);
        curl_setopt($html, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($html, CURLOPT_BINARYTRANSFER, true);
        $conteudo = curl_exec($html);
        curl_close($html);

        $html =  str_get_html($conteudo);
        $content = $html->find('ul[class=slides]',0);

        $count = 0;
        foreach($content->children as $noticia){
            //dd($noticia);            

            $fieldTitle = $noticia->find('div[class=views-field views-field-title]',0);
            //dd($fieldTitle);
            $tituloSemTrim = $fieldTitle->innertext;

            $titulo = trim($tituloSemTrim);
            $titulo = str_replace('&quot;', '"', $titulo);
            //dd($titulo);            

            $fieldUrl = $noticia->find('div[class=field-content]',0);
            $urlNoticia = $urlBase . $fieldUrl->children[0]->href;
            //dd($urlNoticia);
            
            if(explode("/", $urlNoticia)[4] == "noticia"){
                //dd($urlNoticia);
                //$htmlNoticia = file_get_html($urlNoticia);
            
                $htmlNoticia = curl_init($urlNoticia);
                curl_setopt($htmlNoticia, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($htmlNoticia, CURLOPT_BINARYTRANSFER, true);
                $conteudo = curl_exec($htmlNoticia);
                curl_close($htmlNoticia);

                // dd($conteudo);
                $htmlNoticia =  str_get_html($conteudo);
                // dd($htmlNoticia);
                $contentClass = $htmlNoticia->find('span[class=submitted]',0);
                if($contentClass != null){
                    $innerText = $contentClass->find('text',0);
                    $dataPostagem = $innerText->innertext;
                }
                $pos = strpos($dataPostagem, '/');
                $dataString = substr($dataPostagem, $pos-2, 10);
                $data = date_create_from_format('j/m/Y H:i:s', $dataString . "00:00:00");  
                
                if($data >= $dataInicio && $data <= $dataFinal){
                    array_push($noticiasArray, [$titulo, $urlNoticia]);
                    $count++;
                }    
            }
        }

        $urlNoticias = 'http://ufape.edu.br/br/noticias';

        //$html = file_get_html($urlNoticias);
        
        $html = curl_init($urlNoticias);
        curl_setopt($html, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($html, CURLOPT_BINARYTRANSFER, true);
        $conteudo = curl_exec($html);
        curl_close($html);

        $html =  str_get_html($conteudo);
        
        //encontra div com conjunto de notícias
        $content = $html->find('div[class=view-content]',0);
        
        foreach($content->children as $noticia){
            //dd($noticia);
            $fieldTitle = $noticia->find('div[class=views-field views-field-title]',0);
            $titulo = $fieldTitle->children[0]->children[0]->innertext;
            $titulo = str_replace('&quot;', '"', $titulo);
            $url = $urlBase . $fieldTitle->children[0]->children[0]->href;

            $fieldData = $noticia->find('div[class=views-field views-field-created]',0);
            $dataComHora = $fieldData->children[0]->innertext;
            $dataString = substr($dataComHora, 0, 10);
            $data = date_create_from_format('j/m/Y H:i:s', ($dataString . "00:00:00"));  
           // dd($data, $dataInicio, $dataFinal);
            if($data >= $dataInicio && $data <= $dataFinal){
                array_push($noticiasArray, [$titulo, $url]);
                $count++;
            }           
        }

        //dd($noticiasArray);
        array_push($noticiasArray, $count);
        return $noticiasArray;
    }

    public function gerarComunicados($dataInicio, $dataFinal){
        $dataInicio = date_create_from_format('j/m/Y H:i:s', $dataInicio);
        $dataFinal = date_create_from_format('j/m/Y H:i:s', $dataFinal); 

        $urlBase = "http://ufape.edu.br";
        $urlComunicados = 'http://ufape.edu.br/br/comunicados';

        //$html = file_get_html($urlComunicados);
        $html = curl_init($urlComunicados);
        curl_setopt($html, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($html, CURLOPT_BINARYTRANSFER, true);
        $conteudo = curl_exec($html);
        curl_close($html);

        $html =  str_get_html($conteudo);
        
        //encontra div com conjunto de notícias
        $content = $html->find('div[class=view-content]',0);
        
        $comunicadosArray = [];
        $count = 0;
        foreach($content->children as $comunicado){
            //dd($comunicado);
            $fieldTitle = $comunicado->find('div[class=views-field views-field-title]',0);
            $titulo = $fieldTitle->children[0]->children[0]->innertext;
            $titulo = str_replace('&quot;', '"', $titulo);
            $url = $urlBase . $fieldTitle->children[0]->children[0]->href;

            $fieldData = $comunicado->find('div[class=views-field views-field-created]',0);
            $dataComHora = $fieldData->children[0]->innertext;
            $dataString = substr($dataComHora, 0, 10);
            $data = date_create_from_format('j/m/Y', $dataString);  
            
            if($data >= $dataInicio && $data <= $dataFinal){
                array_push($comunicadosArray, [$titulo, $url]);
                $count++;
            }           
            
        }
        array_push($comunicadosArray, $count);
        return $comunicadosArray;
    }

    public function gerarAgenda($dataInicio, $dataFinal){
        $dataInicio = date_create_from_format('j/m/Y H:i:s', $dataInicio);
        $dataFinal = date_create_from_format('j/m/Y H:i:s', $dataFinal); 

        $urlBase = "http://ufape.edu.br";
        $urlAgenda = 'http://ufape.edu.br/br/eventos';

        //$html = file_get_html($urlAgenda);
        
        $html = curl_init($urlAgenda);
        curl_setopt($html, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($html, CURLOPT_BINARYTRANSFER, true);
        $conteudo = curl_exec($html);
        curl_close($html);

        $html =  str_get_html($conteudo);
        
        //encontra div com conjunto de notícias
        $content = $html->find('div[class=item-list]',0);
        $lista = $content->children[0];
        
        $agendaArray = [];
        $count = 0;
        foreach($lista->children as $evento){
            //dd($evento);
            $dataField = $evento->find('div[class=views-field views-field-field-data]', 0);
            $dataEvento = $dataField->children[0]->children[0]->innertext;

            $fieldTitle = $evento->find('div[class=views-field views-field-title]',0);
            $titulo = $dataEvento . " - " . $fieldTitle->children[0]->children[0]->innertext;
            $titulo = str_replace('&quot;', '"', $titulo);
            $url = $urlBase . $fieldTitle->children[0]->children[0]->href;

            //$htmlEvento = file_get_html($url);
            $htmlEvento = curl_init($url);
            curl_setopt($htmlEvento, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($htmlEvento, CURLOPT_BINARYTRANSFER, true);
            $conteudo = curl_exec($htmlEvento);
            curl_close($htmlEvento);
    
            $htmlEvento =  str_get_html($conteudo);

            //encontra div com conjunto de notícias
            $contentEvento = $htmlEvento->find('div[class=field field-name-post-date field-type-ds field-label-hidden]',0);
            if(isset($contentEvento->children[0]->children[0])){
                $data = $contentEvento->children[0]->children[0];

                $data = explode(", ", $data->innertext);
                list($dia, $mesString) = explode(" ", $data[1]);
                $ano = substr($data[2], 0, 4);

                //dd($dia, $mes, $ano);

                $meses = array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");
                $mes = array_search($mesString, $meses)+1;
                
                $dataString = $dia . '/' . $mes . '/' . $ano;
            }
            // else{
            //     $dataString = '14/08/2020';
            // }
            $data = date_create_from_format('j/m/Y', $dataString); 
            //dd($data);
            
            if($data >= $dataInicio && $data <= $dataFinal){
                array_push($agendaArray, [$titulo, $url]);
                $count++;
            }           
            
        }
        array_push($agendaArray, $count);
        return $agendaArray;
    }

    public function gerarEditais($dataInicio, $dataFinal){
        $dataInicio = date_create_from_format('j/m/Y H:i:s', $dataInicio);
        $dataFinal = date_create_from_format('j/m/Y H:i:s', $dataFinal); 

        $urlBase = "http://ufape.edu.br";
        $urlComunicados = 'http://ufape.edu.br/br/editais-e-selecoes';

        //$html = file_get_html($urlComunicados);

        $html = curl_init($urlComunicados);
        curl_setopt($html, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($html, CURLOPT_BINARYTRANSFER, true);
        $conteudo = curl_exec($html);
        curl_close($html);

        $html =  str_get_html($conteudo);
        
        //encontra div com conjunto de notícias
        $content = $html->find('div[class=view-content]',0);
        
        $comunicadosArray = [];
        $count = 0;
        foreach($content->children as $comunicado){
            //dd($comunicado);
            $fieldTitle = $comunicado->find('div[class=views-field views-field-title]',0);
            $titulo = $fieldTitle->children[0]->children[0]->innertext;
            $titulo = str_replace('&quot;', '"', $titulo);
            $url = $urlBase . $fieldTitle->children[0]->children[0]->href;

            $fieldData = $comunicado->find('div[class=views-field views-field-created]',0);
            $dataComHora = $fieldData->children[0]->innertext;
            $dataString = substr($dataComHora, 0, 10);
            $data = date_create_from_format('j/m/Y', $dataString);  
            
            if($data >= $dataInicio && $data <= $dataFinal){
                array_push($comunicadosArray, [$titulo, $url]);
                $count++;
            }           
            
        }

        array_push($comunicadosArray, $count);
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