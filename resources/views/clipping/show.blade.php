@extends('layouts.app')

@section('style')
<link href="{{ asset('css/clipping.css') }}" rel="stylesheet">
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
                      <input name="dataInicio" value="{{ $dataInicio }}"  required class="@error('dataInicio') is-invalid @enderror" value="{{old('dataInicio')}}">

                      <label>Data Final</label>
                      <input name="dataFinal" value="{{ $dataFinal }}" required class="@error('dataFinal') is-invalid @enderror" value="{{old('dataFinal')}}">

                      @if(!$errors->has('dataFinal') && $errors->has('dataInicio'))
                        @error('dataInicio')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      @endif
                      @error('dataFinal')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>

                    <br>

                    <div id="paginasNovas">
                    <p><b>"Páginas novas, atualizadas ou destaques"</b></p>
                      
                      @if(old('countCampos') != null)
                        @php $countCampos = old('countCampos') @endphp
                      @endif

                      @if ($countCampos != null && $countCampos > 0)
                        @for ($i = 0; $i < $countCampos; $i++)
                        <div class="campo">                        
                          <label>Título da postagem</label>
                          <input name="titulo[] " value="{{ $titulo[$i] }}" class="@error('titulo.' . $i) is-invalid @enderror" value="{{old('titulo.' . $i)}}">                       

                          <label>Link</label>
                          <input name="link[]" value="{{ $link[$i] }}" class="@error('link.' . $i) is-invalid @enderror" value="{{old('link.' . $i)}}">
                          
                          <img src="{{asset('img/x-circle.svg')}}" onclick="removerCampo(this)">

                          @error('titulo.' . $i)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                          @error('link.' . $i)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                          <br>
                        </div>
                        @endfor
                      @endif
                    </div>
                    
                    <input type="hidden" name="countCampos" id="countCampos" value="{{ old('countCampos') != null ? old('countCampos') : $countCampos}}">
                  
                    <a href="#" onclick="addCampo()" class="btn btn-primary" id="addCoautor">Adicionar campo</a>
                  
                    <button type="submit" class="btn btn-primary">Gerar</button>
                </form>

                <br><br><hr><br>

                <div>
                    @php $resultado = ""; @endphp 
                    
                    @foreach($textoArray as $categoria)
                        <font face="arial, sans-serif" style="box-sizing:border-box" size="4">
                          <h4 class="titulo" style="box-sizing:border-box">
                            <b>{{ $categoria[1] }}</b>
                          </h4>
                        </font> 
                        
                        @foreach($categoria[0] as $publicacao)
                            <b>{{ $publicacao[0] }}</b> - 
                            <a class="link" href="{{ $publicacao[1] }}"> {{ $publicacao[1] }}</a><br><br>
                        @endforeach
                        
                    @endforeach
                    
                </div>
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

    var countCampos = document.getElementById('countCampos');
    countCampos.value = parseInt(countCampos.value) + 1;
  }

  function removerCampo(img){
    campo = img.parentNode;
    campo.parentNode.removeChild(campo);
    var countCampos = document.getElementById('countCampos');
    countCampos.value = parseInt(countCampos.value) - 1;
  }

</script>