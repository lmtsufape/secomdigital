@extends('layouts.app')

{{-- @section('style')
<link href="{{ asset('css/clipping.css') }}" rel="stylesheet">
@endsection --}}

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                Saudações, <br><br>
                Segue o nosso <i>clipping</i> semanal das publicações realizadas no portal da UFAPE:<br><br>


                <font face="sans-serif" style="box-sizing:border-box" size="4">
                    <h4 class="titulo" style="box-sizing:border-box">
                        <b>Notícias</b>
                    </h4>
                </font>
                <br>

                @if(!in_array("erro", $noticias)  )
                    @forelse ($noticias as $value)

                        <p>
                            <b><a class="link" href="{{ 'http://ufape.edu.br'.$value[1] }}"
                                  target="_blank">{{ $value[0]}}</a></b> -
                            <i>
                                {{$value[2]}} <a class="link" href="{{ 'http://ufape.edu.br'.$value[1] }}"
                                                 target="_blank">(Leia mais) </a>
                            </i>
                        </p>

                    @empty
                        <p>Sem Notícias</p>
                    @endforelse
                @else
                    <h5 class="text-danger">Erro, recarregue a página</h5>
                @endif

                <font face="sans-serif" style="box-sizing:border-box" size="4">
                    <h4 class="titulo" style="box-sizing:border-box">
                        <b>Comunicados</b>
                    </h4>
                </font>
                <br>
                @if(!in_array("erro", $comunicados)  )
                    @forelse ($comunicados as $value)
                        <p>
                            <b><a class="link" href="{{ 'http://ufape.edu.br'.$value[1] }}"
                                  target="_blank">{{ $value[0]}}</a></b> -
                            <i>
                                {{$value[2]}} <a class="link" href="{{ 'http://ufape.edu.br'.$value[1] }}"
                                                 target="_blank">(Leia mais) </a>
                            </i>
                        </p>
                    @empty
                        <p>Sem Comunicados</p>
                    @endforelse
                @else
                    <h5 class="text-danger">Erro, recarregue a página</h5>
                @endif

                <font face="sans-serif" style="box-sizing:border-box" size="4">
                    <h4 class="titulo" style="box-sizing:border-box">
                        <b>Agenda</b>
                    </h4>
                </font>
                <br>
                @if(!in_array("erro", $agenda)   )
                    @forelse ($agenda as $value)
                        <p>
                            <b>{{ $value[0] }}</b> -
                            <a class="link" href="{{ 'http://ufape.edu.br'.$value[2] }}"
                               target="_blank"> {{ $value[1] }}</a> - <i>{{$value[3]}} <a class="link"
                                                                                          href="{{ 'http://ufape.edu.br'.$value[2] }}"
                                                                                          target="_blank">(Leia
                                    mais) </a></i></p>
                    @empty
                        <p>Sem Agenda</p>
                    @endforelse
                @else
                    <h5 class="text-danger">Erro, recarregue a página</h5>
                @endif

                <font face="sans-serif" style="box-sizing:border-box" size="4">
                    <h4 class="titulo" style="box-sizing:border-box">
                        <b>Editais e Seleções</b>
                    </h4>
                </font>
                <br>
                @if(!in_array("erro", $editais) )
                    @forelse ($editais as $value)
                        <p>
                            <a class="link" href="{{ 'http://ufape.edu.br'.$value[1] }}"
                           target="_blank"> <b>{{ $value[0]  }}</b> </a>
                        </p>
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