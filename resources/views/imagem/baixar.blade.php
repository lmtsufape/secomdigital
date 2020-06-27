@extends('layouts.app')

@section('content')
<div class="container">
	<section class="jumbotron ">
    <div class="container ">
			<div class="row justify-content-center">
				
					
					<div class="col-md-8 ">
						<img height="400" width="600" src="{{ $imagem->src }}" alt="Imagem">
						<form action="{{ route('image.baixarImagem') }}" method="post">
							@csrf
							<input type="hidden" name="file" value="{{ $imagem->file }}">
							<button type="submit" class="btn btn-success mt-3">Baixar imagem </button>
						</form>
					</div>
					
							
			</div>
    </div>
  </section> 
    
</div>
@endsection
