@extends('layouts.app')

@section('style')
<link href="{{ asset('css/clipping.create.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Geração de clipping da UFAPE</h5>
                <p class="card-text">Digite abaixo as datas para filtrar as publicações.</p>

                <form method="post" action="{{ route('clipping.gerar') }}">
                    @csrf
                    <div>
                      <label>Data Inicial</label>
                      <input name="dataInicio" placeholder="dd/mm/aaaa">

                      <label>Data Final</label>
                      <input name="dataFinal" placeholder="dd/mm/aaaa">
                    </div>
                    
                    <br>

                    <div id="paginasNovas">
                      <div class="campo">
                        <p><b>"Páginas novas, atualizadas ou destaques"</b></p>
                        <label>Título da postagem</label>
                        <input name="titulo[]">
                        <label>Link</label>
                        <input name="link[]">
                        <img src="{{asset('img/x-circle.svg')}}" onclick="removerCampo(this)">
                        <br>
                      </div>
                    </div>
                      <a href="#" onclick="addCampo()" class="btn btn-primary" id="addCoautor">Adicionar campo</a>
                     
                      <button type="submit" class="btn btn-primary">Gerar Clipping</button>
                </form>
              </div>
            </div>
          </div>          
        </div> 
</div>
@endsection

@section('javascript')
<script type="text/javascript">
  
  function addCampo(){
    paginasNovas = document.getElementById('paginasNovas');
    
    divCampo = document.createElement("div");
    divCampo.setAttribute('class', 'campo');

    titulo = document.createElement("LABEL");
    titulo.innerHTML = "Título da postagem";
    tituloInput = document.createElement("INPUT");
    tituloInput.setAttribute('name', 'titulo[]');
    link = document.createElement("LABEL");
    link.innerHTML = "Link";
    linkInput = document.createElement("INPUT")
    linkInput.setAttribute('name', 'link[]');
    img = document.createElement("IMG");
    img.setAttribute('src', "{{asset('img/x-circle.svg')}}");
    img.setAttribute('onclick', "removerCampo(this)");
    br = document.createElement("BR");

    divCampo.appendChild(titulo);
    divCampo.appendChild(tituloInput);
    divCampo.appendChild(link);
    divCampo.appendChild(linkInput);
    divCampo.appendChild(img);
    divCampo.appendChild(br);      
    paginasNovas.appendChild(divCampo);
  }

  function removerCampo(img){
    campo = img.parentNode;
    campo.parentNode.removeChild(campo);
  }

</script>