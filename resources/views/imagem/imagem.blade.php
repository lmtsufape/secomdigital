@extends('layouts.app')

@section('content')
    <div class="container py-12">
        <section class="jumbotron ">
            <div class="container ">
                <div class="row justify-content-center">
                    <div class="col-md-4 ">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </section>
        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @elseif(session('fail'))
            <div class="alert alert-danger">
                {{ session('fail') }}
            </div>
        @endif


        <div class="album" style="background-color: #ffffff; border-radius: 5px">
            <div class="container">
                <div class="row">
                    @if($images->count() < 1 )
                        <h1 class="text-center py-10">Envio de Background para os <b class="secom">Cartões de Aniversário</b>
                        </h1>
                        <div class="container">

                            <form action="{{ route('image.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="title" class="form-control" value="cartaobackground">
                                </div>
                                <div class="text-center">
                                    <div class="form-group">
                                            <div class="border-1" style="width: 20%; margin-left: auto; margin-right: auto">
                                                <label> Selecionar Background:</label>
                                                <label id="fileLabel" for="file" class="btn btn-primary btn-block btn-outlined" style="width: 24%"><i
                                                            class="fa-solid fa-camera fa-xl"></i></label>
                                                <input type="file" id="file" name="filename" style="display: none">
                                            </div>


                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px; margin-top: 10px;">
                                        <button class="btn btn-success" type="submit">Enviar Imagem <i
                                                    class="fa-solid fa-arrow-up-from-bracket"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="alert alert-warning">
                            Não há imagens
                        </div>
                    @endif
                    @foreach($images as $image)
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="card mb-4 shadow-sm my-4">
                                <h2 class="text-center">Background do Cartão de Aniversário</h2>
                                <img height="300" src="{{ asset($image->src) }}" alt="">
                                <div class="card-body">
                                    <div style="float: right">
                                        <a class="btn btn-md btn-danger"
                                           href="{{route('image.destroy', ['id' => $image->id])}}">Excluir Imagem</a>
                                        <a class="btn btn-md btn-success"
                                           href="{{ route('image.edit', ["id"=>$image->id]) }}"
                                        >Configurar Cartão de Aniversário</a>


                                        {{-- </div> --}}
                                        {{-- <small class="text-muted">{{ date('d/m/Y', strtotime($image->created_at)) }}</small> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    @endforeach

                </div>
            </div>
        </div>

    </div>

    <script>
        $( "#file" ).change(function() {
            $('#fileLabel').css('background-color', 'green')
        });
    </script>
@endsection
