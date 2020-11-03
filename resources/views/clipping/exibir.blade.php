@extends('layouts.app')

{{-- @section('style')
<link href="{{ asset('css/clipping.css') }}" rel="stylesheet">
@endsection --}}

@section('content')
<div class="container">
        <div class="row">
          <div class="col-sm-12">
            
              <h2>Notícias</h2><br>
              @if(!in_array("erro", $noticias)  )
                @forelse ($noticias as $value)
                    <h5> <strong> {{ $value[0]  }} </strong>  - <a href="{{ 'http://ufape.edu.br'.$value[1] }}" target="_blank">{{ 'http://ufape.edu.br'.$value[1] }}</a>
                    </h5> <br>
                @empty
                    <p>Sem Notícias</p>
                @endforelse
              @else
                <h5 class="text-danger">Erro, recarregue a página</h5>
              @endif

              <h2>Comunicados</h2><br>
              @if(!in_array("erro", $comunicados)  )
                @forelse ($comunicados as $value)
                    <h5> <strong>{{  $value[0]  }} </strong> - <a href="{{ 'http://ufape.edu.br'.$value[1] }}" target="_blank">{{ 'http://ufape.edu.br'.$value[1] }}</a></h5><br>
                @empty
                    <p>Sem Comunicados</p>
                @endforelse
              @else
                <h5 class="text-danger">Erro, recarregue a página</h5>
              @endif

              <h2>Agenda</h2><br>
              @if(!in_array("erro", $agenda)   )             
                @forelse ($agenda as $value) 
                      <h5> <strong>{{ $value[0]  }}  {{ $value[1] }} </strong> -  <a href="{{ 'http://ufape.edu.br'.$value[2] }}" target="_blank">{{ 'http://ufape.edu.br'.$value[2] }}</a></h5><br>
                @empty
                    <p>Sem Agenda</p>
                @endforelse
              @else
                <h5 class="text-danger">Erro, recarregue a página</h5>
              @endif                          

              <h2>Editais e Seleções</h2><br>
              @if(!in_array("erro", $editais) )
                @forelse ($editais as $edital)
                    <h5> <strong> {{ $edital[0]  }}  </strong> - 
                      <a href="{{ 'http://ufape.edu.br'.$edital[1] }}" target="_blank">{{ 'http://ufape.edu.br'.$edital[1] }}</a>
                    </h5><br>                                
                @empty
                    <p>Sem Editais</p>
                @endforelse
              @else
                <h5 class="text-danger">Erro, recarregue a página</h5>
              @endif       

          </div>          
        </div> 
</div>
@endsection

@section('javascript')
<script type="text/javascript">
  
  
</script>