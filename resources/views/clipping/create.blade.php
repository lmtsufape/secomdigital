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
                <div class="d-flex justify-content-center">                  

                  <form method="post" id="formGerar" action="{{ route('clipping.gerar') }}">
                      @csrf
                      <br><br>  
                      <p class="card-text"><b>Digite as datas abaixo para filtrar as publicações.</b></p>
                      <div class="row d-flex">
                        <div class="col-sm-5">
                          <label>Data Inicial</label>
                          <input name="dataInicio" placeholder="dd/mm/aaaa" required class="form-control @error('dataInicio') is-invalid @enderror" value="{{old('dataInicio')}}">
                        </div>
                        <div class="col-sm-6" id="dataFinal">
                          <div class="row">
                            <div class="col-sm-10">
                              <label>Data Final</label>
                              <input name="dataFinal" placeholder="dd/mm/aaaa" required class="form-control @error('dataFinal') is-invalid @enderror" value="{{old('dataFinal')}}">
                            </div>
                            
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
                        </div>
                      </div>

                      <br><br>

                      <div id="paginasNovas">
                        <p><b>"Páginas novas, atualizadas ou destaques"</b></p>
                        @php $countCampos = 1; @endphp
                        @if(old('countCampos') != null)
                          @php $countCampos = old('countCampos') @endphp
                        @endif

                        @if ($countCampos != null && $countCampos > 0)
                          @for ($i = 0; $i < $countCampos; $i++)
                          <div class="campo row d-flex justify-content-between">  
                            <div class="col-sm-5">                      
                              <label>Título da postagem</label>
                              <input name="titulo[]" class="form-control @error('titulo.' . $i) is-invalid @enderror" value="{{old('titulo.' . $i)}}">                       
                            </div>
                            <div class="col-sm-6">      
                              <div class="row">
                                <div class="col-sm-10">
                                  <label>Link</label>
                                  <input name="link[]" class="form-control @error('link.' . $i) is-invalid @enderror" value="{{old('link.' . $i)}}">
                                </div>
                                <div class="col-sm-2">
                                  <br>
                                  <img src="{{asset('img/x-circle.svg')}}" id="delCampo" onclick="removerCampo(this)">
                                </div>
                              </div>
                            </div>

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

                      <br><br>
                      <div class="d-flex justify-content-center">
                        <img src="{{asset('img/plus-circle.svg')}}" id="imgCampo" onclick="addCampo()">
                      </div>

                      <input type="hidden" name="countCampos" id="countCampos" value="{{ old('countCampos') != null ? old('countCampos') : 1}}">
                      <br>
            
                      <button type="submit" class="btn btn-primary" id="gerar">Gerar Clipping</button>                     
                  </form>
                
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
    divCampo.setAttribute('class', 'campo row d-flex justify-content-between');

    divTitulo = document.createElement("div");
    divTitulo.setAttribute('class', 'col-sm-5');

    titulo = document.createElement("LABEL");
    titulo.innerHTML = "Título da postagem";
    tituloInput = document.createElement("INPUT");
    tituloInput.setAttribute('name', 'titulo[]');
    tituloInput.setAttribute('class', "form-control @error('titulo.' . $i) is-invalid @enderror");

    divTitulo.appendChild(titulo);
    divTitulo.appendChild(tituloInput);
    divCampo.appendChild(divTitulo);

    divRight = document.createElement("div");
    divRight.setAttribute('class', 'col-sm-6');
    divRow = document.createElement("div");
    divRow.setAttribute('class', 'row');
    divLink = document.createElement("div");
    divLink.setAttribute('class', 'col-sm-10');
    
    link = document.createElement("LABEL");
    link.innerHTML = "Link";
    linkInput = document.createElement("INPUT")
    linkInput.setAttribute('name', 'link[]');
    linkInput.setAttribute('class', "form-control @error('link.' . $i) is-invalid @enderror");


    divLink.appendChild(link);
    divLink.appendChild(linkInput);
    divRow.appendChild(divLink);

    divImg = document.createElement("div");
    divImg.setAttribute('class', 'col-sm-2');

    img = document.createElement("IMG");
    img.setAttribute('src', "{{asset('img/x-circle.svg')}}");
    img.setAttribute('onclick', "removerCampo(this)");
    img.setAttribute('style', "margin-top: 38px;");
    
    br = document.createElement("BR");

    divImg.appendChild(br);
    divImg.appendChild(img);
    divRow.appendChild(divImg);

    divRight.appendChild(divRow);
    divCampo.appendChild(divRight);

    divCampo.appendChild(br);      
    paginasNovas.appendChild(divCampo);

    var countCampos = document.getElementById('countCampos');
    countCampos.value = parseInt(countCampos.value) + 1;
  }

  function removerCampo(img){
    campo = img.parentNode.parentNode.parentNode.parentNode;
    campo.parentNode.removeChild(campo);
    var countCampos = document.getElementById('countCampos');
    countCampos.value = parseInt(countCampos.value) - 1;
  }

</script>