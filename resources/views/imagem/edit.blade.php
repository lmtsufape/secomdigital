@extends('layouts.app')

@section('content')
<div class="container">
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
						@elseif(session('message'))
							<div class="alert alert-info">
								{{ session('message') }}
							</div>
						@endif

					<form action="{{ route('image.update') }}" method="POST" enctype="multipart/form-data">	
							@csrf							
						  <div class="form-group">
						  	<label>Nome</label>
						  	<input type="text" name="nome" class="form-control">
						  	<input type="hidden" name="image_id" value="{{ $imagemGerada->id }}">
						  </div>
						  
						  <div class="form-group" >
						  	<button class="btn btn-success"  type="submit">Gerar cartão</button>
						  	{{-- <a href="#" >Open in a new tab</a> --}}
						  </div>
					</form>		
					</div>
					<div class="col-md-6 ">
						<img height="300" width="500" src="{{ $imagemGerada->src}}" alt="">
						<div class="btn-group">		                	
		                	<form action="{{ route('image.baixarImagem') }}" method="post">
								@csrf
								<input type="hidden" name="file" value="{{ $imagemGerada->file }}">
								<button type="submit" class="btn btn-success mt-3 ">Baixar imagem </button>
							</form>							
		                </div>
		                <div class="btn-group">
							<a href="{{ route('home') }}" class="btn btn-success mt-3">Voltar </a>
		                </div>
		                <div class="btn-group">
							<a href="{{ route('home') }}" class="btn btn-danger mt-3">Apagar </a>
		                </div>							
					</div>	
			</div>
    </div>
  </section> 
    
</div>
@endsection
