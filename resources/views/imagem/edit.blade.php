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

						<form action="{{ route('image.update') }}" method="POST" enctype="multipart/form-data">
								@csrf
							  <div class="form-group">
							  	<label>Nome:</label>
							  	<input type="text" name="nome" value="{{ $nome ?? 'Texto'  }}" class="form-control">
							  	<input type="hidden" name="image_id" value="{{ $imagemOriginal->id }}">
							  </div>
							  <div class="form-group">
							    <label for="exampleFormControlSelect1">Font:</label>
							    <select class="form-control" name="font_id" id="exampleFormControlSelect1">
							    @php $fonte = $fonte ?? 1 @endphp
							    @foreach($fonts as $font)
							    	@if($fonte == $font->id)
							      	<option selected value="{{ $font->id }}" >{{ $font->font_name }}</option>
							      @else
							      	<option value="{{ $font->id }}" >{{ $font->font_name }}</option>
							      @endif
							    @endforeach
							    </select>
							  </div>
							  <div class="form-row">
							    <div class="col-3">
							  		<label for="formGroupExampleInput">Eixo x:</label>
							      <input type="text" class="form-control" name="eixo_x" value="{{ $eixo_x ?? 4100 }}" id="formGroupExampleInput" >
							    </div>
							    <div class="col-3">
							      <label for="formGroupExampleInput">Eixo y:</label>
							      <input type="number" class="form-control" name="eixo_y"  value="{{ $eixo_y ?? 400 }}" id="formGroupExampleInput" >
							    </div>
							    <div class="col-3">
							      <label for="formGroupExampleInput">Tamanho:</label>
							      <input type="number" class="form-control" name="size"  value="{{ $size ?? 250 }}" id="formGroupExampleInput" >
							    </div>
							  </div>
							  <div class="form-group" >
							  	<button class="btn btn-success mt-2"  type="submit">Gerar cartão</button>
							  	{{-- <a href="#" >Open in a new tab</a> --}}
							  </div>
						</form>
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
	              <form action="{{ route('image.baixarImagem') }}" method="post" enctype="multipart/form-data">
									@csrf
									<input type="hidden" name="file" value="{{ $imagemGerada->file }}">
									<button type="submit" class="btn btn-success mt-3 ">Baixar imagem </button>
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



@endsection
