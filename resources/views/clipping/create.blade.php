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
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="post" id="formGerar" action="{{ route('clipping.gerar') }}">
                                @csrf
                                <br>
                                <div class="row d-flex">
                                    <div class="col-sm-5">
                                        <label>Data Inicial</label>
                                        <input readonly name="dataInicio" placeholder="dd/mm/aaaa" required
                                               class="form-control @error('dataInicio') is-invalid @enderror"
                                               value="{{date("d/m/Y", strtotime("-1 week"))}}">
                                    </div>
                                    <div class="col-sm-6" id="dataFinal">
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <label>Data Final</label>
                                                <input readonly name="dataFinal" placeholder="dd/mm/aaaa" required
                                                       class="form-control @error('dataFinal') is-invalid @enderror"
                                                       value="{{date("d/m/Y")}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

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


    </script>