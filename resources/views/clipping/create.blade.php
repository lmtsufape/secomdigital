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

                    <label>Data Inicial</label>
                    <input name="dataInicio" placeholder="dd/mm/aaaa">

                    <label>Data Final</label>
                    <input name="dataFinal" placeholder="dd/mm/aaaa">

                    <button type="submit" class="btn btn-primary">Gerar</button>
                </form>
              </div>
            </div>
          </div>          
        </div> 
</div>
@endsection