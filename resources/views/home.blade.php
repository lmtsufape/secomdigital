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
						
						@endif

						<form action="{{ route('image.store') }}" method="POST" enctype="multipart/form-data">
							@csrf							
						  <div class="form-group">
						  	<label>Título</label>
						  	<input type="text" name="title" class="form-control">
						  </div>
						  <div class="form-group">
						  	<label> Image </label>
						  	<input type="file" name="filename">
						  </div>
						  <div class="form-group" >
						  	<button class="btn btn-success" type="submit">Upload</button>
						  </div>
						</form>
					</div>		
			</div>
    </div>
  </section>
  @if(session('message'))
		<div class="alert alert-success">
			{{ session('message') }}
		</div>
	@endif
  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
      @if($images->count() < 1 )
      	<div class="alert alert-warning">
      		Não há imagens
      	</div>
      @endif
			@foreach($images as $image)
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img height="300" src="{{ $image->src}}" alt="">
            <div class="card-body">
              <p class="card-text">{{ $image->title }}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-success">Ver</button>
                  <a href="{{ route('image.edit', ["id"=>$image->id]) }}" class="btn btn-sm btn-outline-success">Editar</a>
                  <button type="button" class="btn btn-sm btn-outline-success">Enviar</button>
                  <form action="{{ route('image.destroy') }}" method="post">
                  	@csrf
										<input type="hidden" name="id" value="{{ $image->id }}">
                  	
                  	<button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                  </form>
                </div>
                <small class="text-muted">{{ date('d/m/Y', strtotime($image->created_at)) }}</small>
              </div>
            </div>
          </div>
        </div> 
			@endforeach

      </div>
    </div>
  </div>
    
</div>
@endsection
