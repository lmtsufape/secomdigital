@extends('layouts.app')

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
                      <p>Inserir em <b>"Páginas novas, atualizadas ou destaques"</b></p>
                      <label>Título da postagem</label>
                      <input name="titulo[]">
                      <label>Link</label>
                      <input name="link[]">

                    </div>
                      <a href="#" onclick="addCampo()" class="btn btn-primary" id="addCoautor">Adicionar participante</a>
                      <a href='#' onclick="removerCampo()" class="btn btn-danger mt-2 mb-2 delete">Remover participante</a>

                      <button type="submit" class="btn btn-primary">Gerar</button>
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
    
    titulo = document.createElement("LABEL");
    titulo.innerHTML = "Título da postagem";
    tituloInput = document.createElement("INPUT");
    tituloInput.setAttribute('name', 'titulo[]');
    link = document.createElement("LABEL");
    link.innerHTML = "Link";
    linkInput = document.createElement("INPUT")
    linkInput.setAttribute('name', 'link[]');;

    paginasNovas.appendChild(titulo);
    paginasNovas.appendChild(tituloInput);
    paginasNovas.appendChild(link);
    paginasNovas.appendChild(linkInput);      
  }

  function removerCampo(){
    paginasNovas = document.getElementById('paginasNovas');
    
    for(i = 0; i < 4; i++){
      length = paginasNovas.childNodes.length;
      paginasNovas.removeChild(paginasNovas.childNodes[length-1]);         
    }
  }

</script>