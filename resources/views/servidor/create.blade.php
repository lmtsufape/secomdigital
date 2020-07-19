@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <h1>Cadastrar Servidor</h1>
      <form action="{{ route('servidor.store') }}" method="POST">
        @csrf
          <div class="form-group">
            <label for="">Siape:</label>
            <input type="text" name="siape" class="form-control @error('siape') is-invalid @enderror" value="{{ old('siape') }}">
              @error('siape')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
          </div>

          <div class="form-group">
            <label for="">Nome:</label>
            <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') }}">
              @error('nome')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
          </div>

          <div class="form-group">
            <label for="">E-mail:</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
              @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
          </div>

          <div class="form-group">
            <label for="">Data de Nascimento</label>
            <input type="date" name="data_nascimento" class="form-control @error('data_nascimento') is-invalid @enderror" value="{{ old('data_nascimento') }}">
              @error('data_nascimento')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
          </div>

          <div>
            <a href="#" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-primary">Cadastrar Servidor</button>
          </div>


      </form>
    </div>
  </div>
</div>
@endsection
