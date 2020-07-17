@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Geração de cartões de aniversário</h5>
                <p class="card-text">Sistema para criação customizada de cartões de aniversário da UFAPE a partir de um modelo pré-definido.</p>
                <a href="{{ route('home') }}" class="btn btn-primary">Acessar</a>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Geração de clipping</h5>
                <p class="card-text">Sistema para geração automatizada de clipping de notícias a partir do portal da UFAPE.</p>
                <a href="{{ route('clipping.create') }}" class="btn btn-primary">Acessar</a> 
              </div>
            </div>
          </div>
        </div> 
</div>
@endsection
