@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">

    <div class="col-md-12">
      <h2 class=""> Servidores </h2>
    </div>
    <div class="col-md-2 mb-3">
      <a class="btn btn-success" href="{{route('servidor.create')}}" >Cadastrar Servidor</a>
    </div>
    @if(session('mensagem'))
      <div class="col-sm-12">
          <br>
          <div class="alert alert-success">
              <p>{{session('mensagem')}}</p>
          </div>
      </div>
    @endif
    <div class="col-md-12">
      

      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Siape</th>
            <th scope="col">Nome</th>
            <th scope="col">E-mail</th>
            <th scope="col">Data de Nascimento</th>
            <th scope="col">Opções</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($servidores as $key => $servidor)
            <tr>
              <th scope="row">{{$servidor->id}}</th>
              <td>{{ $servidor->siape }}</td>
              <td>{{ $servidor->nome }}</td>
              <td>{{ $servidor->email }}</td>
              <td>{{ $servidor->data_nascimento }}</td>
              <td>

    							<form action="{{ route('servidor.destroy', ['id'=>$servidor->id]) }}">
    								@csrf
    								@method("delete")
                    <a href="{{ route('servidor.edit', ['id'=>$servidor->id]) }}" class="btn btn-primary">Editar</a>

                    <button type="submit" class="btn btn-danger">Excluir</button>

    							</form>

              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  {{ $servidores->links() }}

</div>
@endsection
