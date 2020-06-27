@extends('layouts.app')

@section('content')
<div class="container">
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

						<form action="{{ route('image.update') }}" method="POST" enctype="multipart/form-data">	
								@csrf							
							  <div class="form-group">
							  	<label>Nome:</label>
							  	<input type="text" name="nome" value="{{ $nome ?? ''  }}" class="form-control">
							  	<input type="hidden" name="image_id" value="{{ $imagemOriginal->id }}">
							  </div>
							  <div class="form-group">
							    <label for="exampleFormControlSelect1">Font:</label>
							    <select class="form-control" name="font_id" id="exampleFormControlSelect1">
							    @foreach($fonts as $font)
							      <option value="{{ $font->id }}" >{{ $font->font_name }}</option>
							    @endforeach						      
							    </select>
							  </div>
							  <div class="form-row">
							    <div class="col-3">
							  		<label for="formGroupExampleInput">Eixo x:</label>
							      <input type="text" class="form-control" name="eixo_x" value="{{ $eixo_x ?? '' }}" id="formGroupExampleInput" >
							    </div>
							    <div class="col-3">
							      <label for="formGroupExampleInput">Eixo y:</label>
							      <input type="text" class="form-control" name="eixo_y"  value="{{ $eixo_y ?? '' }}" id="formGroupExampleInput" >
							    </div>
							  </div>					  
							  <div class="form-group" >
							  	<button class="btn btn-success mt-2"  type="submit">Gerar cartão</button>
							  	{{-- <a href="#" >Open in a new tab</a> --}}
							  </div>
						</form>	
					</div>
					<div class="col-md-6 ">
						<img height="300" width="500" src="{{ $imagemOriginal->src}}" alt="">
					</div>							
					<div class="col-md-6 ">
					@if(isset($imagemGerada))
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
		            		
					@endif
					</div>	

			</div>
    </div>
  </section> 
    
</div>
@endsection