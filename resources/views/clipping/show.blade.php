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

                    <label>Data Inicial</label>
                    <input name="dataInicio" value="{{ $dataInicio }}">

                    <label>Data Final</label>
                    <input name="dataFinal" value="{{ $dataFinal }}">

                    <button type="submit" class="btn btn-primary">Gerar</button>
                </form>

                <br><br><hr><br>

                <div>
                    @php $resultado = ""; @endphp 
                    
                    @foreach($textoArray as $categoria)
                        <h4><font face="arial, sans-serif"><b style="">{{ $categoria[1] }}</b></font> </h4>
                        
                        @foreach($categoria[0] as $publicacao)
                            <b>{{ $publicacao[0] }}</b> - 
                            <a href="{{ $publicacao[1] }}"> {{ $publicacao[1] }}</a><br><br>
                        @endforeach
                        
                    @endforeach
                    
                </div>
              </div>
            </div>
          </div>          
        </div> 
</div>
@endsection