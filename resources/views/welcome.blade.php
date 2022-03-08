@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm" align="justify" style="margin-top: 15px; margin-bottom: 15px">
                <h2 class="titulo" align="center">Bem Vindo!</h2>
            </div>
        </div>

        {{--Imagem alinhada--}}
        <div class="row">
            <div class="col-sm-6" style="padding-right: 30px" >
                <div class="crop imgHome" >
                    <img src="{{asset('imagens/letreiro.jpg')}}" class="rounded imgHome">
                </div>
            </div>

            <div class="col-sm-6" style="padding-left: 30px;margin:auto " align="center" >
                <br>
                <h2 class="titulo" align="center">Geração de <b class="secom">clipping</b></h2>
                <div class="balao">
                    <p class="paragrafo balaoText" style="text-align: justify">Sistema spara geração automatizada de
                        clipping de notícias a partir do portal
                        da UFAPE.</p>


                    <h3 class="mx-3" style="margin-top: 10px;" align="center">Selecione um periodo</h3>
                    <hr style="border-color: white; width: 92%; padding: 0px; margin-top: -10px;  margin: auto; margin-bottom: 10px" ></hr>
                    <form method="post" id="formGerar" action="{{ route('clipping.gerar') }}">
                        @csrf
                        <div class="row d-flex mx-1">
                            <div class="col-sm-3">
                                <label><b>De:</b></label>
                                <input name="dataInicio" placeholder="dd/mm/aaaa" style="width: 120px" required
                                       class="form-control @error('dataInicio') is-invalid @enderror"
                                       value="{{date("d/m/Y", strtotime("-1 week"))}}">
                            </div>
                            <div class="col-sm-3">
                                <label><b>Até:</b></label>
                                <input name="dataFinal" placeholder="dd/mm/aaaa" style="width: 120px" required
                                       class="form-control @error('dataFinal') is-invalid @enderror"
                                       value="{{date("d/m/Y")}}">
                            </div>
                            <div class="col-sm-6" align="center">
                                <button type="submit" class="btn btn-primary buttonHome" id="gerar" style=" margin-top: 20px">Gerar Clipping
                                </button>
                            </div>
                        </div>
                        <br>
                    </form>
                </div>
            </div>

        </div>

        <br>
        <br>

        {{--Imagem alinhada--}}
        <div class="row">

            <div class="col-sm-6" style="padding-right: 30px; margin: auto" >
                <div class="crop imgHome">
                    <img src="{{asset('imagens/balao.jpg')}}" class="rounded imgHome">
                </div>
            </div>

            <div class="col-sm-6" style="padding-left: 30px; margin: auto" align="center">
                <br>
                <h2 class="titulo">Geração de <b class="secom">cartões de aniversario</b></h2>
                <div class="balao">
                    <p class="paragrafo balaoText">Lorem Ipsum é simplesmente uma
                        simulação de texto da indústriass
                        tipográfica e de impressos, e vem
                        sendo utilizado desde o século XVI,d
                        quando um impressor desconhecidoo pegou uma bandeja
                        de tipos e os embaralhou para fazer um livro de modelos de tipos.</p>

                    <hr style="border-color: white; width: 92%; padding: 0px; margin-top: -10px;  margin: auto; margin-bottom: 10px" ></hr>

                    <div class="col-sm-6" align="center">
                        <a type="button" href="{{ route('imagem') }}" class="btn btn-primary buttonHome" id="gerar" style="margin-top: 20px;margin-bottom: 20px">Gerar Cartões
                        </a>
                    </div>
                </div>
            </div>


        </div>

        <br>
    </div>
@endsection