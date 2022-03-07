@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/clipping.create.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="row" style="margin:auto;margin-top: 100px">
                <div class="col-sm-7" style="padding-left: 30px;margin:auto " align="center" >
                    <br>
                    <h2 align="center">Geração de <b class="secom">clipping</b> da UFAPE</h2>
                    <div class="balao" style="background-color: white;">

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

                                <div class="col-sm-3" align="center">
                                    <a type="button" href="javascript:history.back()" class="btn btn-danger" id="cancelar"
                                       style="margin-top: 20px;width: 100%;">Cancelar
                                    </a>
                                </div>

                                <div class="col-sm-3" align="center">
                                    <button type="submit" class="btn btn-primary" id="gerar" style="margin-top: 20px;width: 100%;">Gerar Clipping
                                    </button>
                                </div>

                            </div>
                            <br>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">


    </script>