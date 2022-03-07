@extends('layouts.app')

@section('content')
    <div class="container">
        @if(isset($imagemGerada))
            <div class="card  mb-5">
                <div class="card-header">
                    Enviar Cartão
                </div>
                <div class="card-body">
                    <h5 class="card-title">Selecione o e-mail para enviar a Imagem</h5>
                    {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
                    <form action="{{ route('servidor.enviarEmail') }}" method="post">
                        <div class="">
                            @csrf
                            <label for="email">E-mail:</label>
                            <input id="email" type="email" name="email" value="">
                            <input type="hidden" name="image" value="{{ $imagemGerada->path }}">
                            <input type="hidden" name="id" value="{{ $imagemOriginal->id }}">
                            <div class="">

                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
        <section class="jumbotron ">
            <div class="container ">
                <div class="row justify-content-center">

                    <div class="col-md-12 ">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @elseif(session('message'))
                            <div class="alert alert-info">
                                {{ session('message') }}
                            </div>
                        @endif

                        @if($cartao)
                            {{-- Editar de Cartão --}}
                            <form id="form" action="{{route('cartao.atualizar')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Texto:</label>
                                    <input type="text" name="texto" class="form-control"
                                           placeholder="Ex: Feliz Aniversário Fulano" value="{{$cartao->texto}}" required>
                                    <input type="hidden" name="image_id" value="{{ $imagemOriginal->id }}">
                                    <input type="hidden" name="cartao_id" value="{{ $cartao->id }}">
                                    <input type="hidden" name="flag" id="flag" value="0">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Font:</label>
                                    <select class="form-control" name="font_id" id="exampleFormControlSelect1" required>

                                        @foreach($fonts as $font)
                                            @if($cartao->fonte->id == $font->id)
                                                <option selected value="{{ $font->id }}">{{ $font->font_name }}</option>
                                            @else
                                                <option value="{{ $font->id }}">{{ $font->font_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-row">
                                    <div class="col-3">
                                        <label for="formGroupExampleInput">Eixo X:</label>
                                        <input type="number" class="form-control" name="eixo_x" placeholder="Ex: 4100"
                                               id="formGroupExampleInput" required value="{{$cartao->eixo_x}}">
                                    </div>
                                    <div class="col-3">
                                        <label for="formGroupExampleInput">Eixo Y:</label>
                                        <input type="number" class="form-control" name="eixo_y" placeholder="Ex: 400"
                                               id="formGroupExampleInput" required value="{{$cartao->eixo_y}}">
                                    </div>
                                    <div class="col-3">
                                        <label for="formGroupExampleInput">Tamanho:</label>
                                        <input type="number" class="form-control" name="size" placeholder="Ex: 250"
                                               id="formGroupExampleInput" required value="{{$cartao->tamanho}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <button id="atualizar" class="btn btn-success mt-2" type="submit">Atualizar dados</button>
                                    </div>
                                    <div class="col-sm-2">
                                        <button id="gerar" class="btn btn-success mt-2" type="submit">Gerar cartão</button>
                                    </div>
                                </div>
                                <br>

                            </form>

                            {{-- Fim da edição do Cartão --}}

                        @else

                            {{-- Criação de Cartão --}}

                            <form id="form2" action="{{route('cartao.criar')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Texto:</label>
                                    <input type="text" name="texto" class="form-control"
                                           placeholder="Ex: Feliz Aniversário Fulano" @if(isset($texto))value="{{$texto}}"@endif required>
                                    <input type="hidden" name="image_id" value="{{ $imagemOriginal->id }}">
                                    <input type="hidden" name="flag" id="flag" value="0">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Font:</label>
                                    <select class="form-control" name="font_id" id="exampleFormControlSelect1" required>
                                        @php $fonte = $fonte ?? 1 @endphp
                                        @foreach($fonts as $font)
                                            @if((isset($fontTestada)) && $fontTestada->id == $font->id)
                                                <option selected value="{{ $font->id }}">{{ $font->font_name }}</option>
                                            @elseif($fonte == $font->id)
                                                <option selected value="{{ $font->id }}">{{ $font->font_name }}</option>
                                            @else
                                                <option value="{{ $font->id }}">{{ $font->font_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-row">
                                    <div class="col-3">
                                        <label for="formGroupExampleInput">Eixo X:</label>
                                        <input type="number" class="form-control" name="eixo_x" placeholder="Ex: 4100"
                                               id="formGroupExampleInput" @if(isset($eixo_x))value="{{$eixo_x}}"@endif required>
                                    </div>
                                    <div class="col-3">
                                        <label for="formGroupExampleInput">Eixo Y:</label>
                                        <input type="number" class="form-control" name="eixo_y" placeholder="Ex: 400"
                                               id="formGroupExampleInput" @if(isset($eixo_y))value="{{$eixo_y}}"@endif required>
                                    </div>
                                    <div class="col-3">
                                        <label for="formGroupExampleInput">Tamanho:</label>
                                        <input type="number" class="form-control" name="size" placeholder="Ex: 250"
                                               id="formGroupExampleInput" @if(isset($size))value="{{$size}}"@endif required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <button id="salvar" class="btn btn-success mt-2" type="submit">Salvar dados</button>
                                    </div>
                                    <div class="col-sm-2">
                                        <button id="gerar" class="btn btn-success mt-2" type="submit">Gerar cartão</button>
                                    </div>
                                </div>
                                <br>

                            </form>

                            {{-- Fim da criação do Cartão--}}
                        @endif



                    </div>
                    <div class="col-md-6 ">
                        <img height="300" width="500" src="{{ asset($imagemOriginal->src) }}" alt="">
                    </div>
                    <div class="col-md-6 ">
                        @if(isset($imagemGerada))
                            <img height="300" width="500" src="{{ asset($imagemGerada->src) }}" alt="">
                            <div class="btn-group">
                                <a href="{{ route('home') }}" class="btn btn-success mt-3">Voltar </a>
                            </div>
                            <div class="btn-group">
                                <form action="{{ route('image.baixarImagem') }}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="file" value="{{ $imagemGerada->file }}">
                                    <button type="submit" class="btn btn-success mt-3 ">Baixar imagem</button>
                                </form>
                            </div>
                            <div class="btn-group">
                                {{-- <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleModal">
                                    Enviar
                                </button> --}}
                            </div>

                        @endif
                    </div>

                </div>
            </div>

        </section>

    </div>



    {{--<script type="text/javascript">
        document.getElementById('salvar').onclick = function() {
            document.getElementById('form2').action = '{{ route('cartao.criar') }}';
        }
        document.getElementById('atualizar').onclick = function() {
            document.getElementById('form').action = '{{ route('cartao.atualizar') }}';
        }
        document.getElementById('gerar').onclick = function() {
            document.getElementById('form').action = '{{ route('image.update') }}';
        }

    </script>--}}
    <script type="text/javascript">
        document.getElementById('gerar').onclick = function() {
            document.getElementById('flag').value="1";
        }
    </script>
@endsection

