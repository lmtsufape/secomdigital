<?php $__env->startSection('content'); ?>
<div class="container">
	<?php if(isset($imagemGerada)): ?>
		<div class="card  mb-5">
			<div class="card-header">
				Enviar Cartão
			</div>
			<div class="card-body">
				<h5 class="card-title">Selecione o e-mail para enviar a Imagem</h5>
				
				<form action="<?php echo e(route('servidor.enviarEmail')); ?>" method="post">
					<div class="">
						<?php echo csrf_field(); ?>
						<label for="email">E-mail:</label>
						<input id="email" type="email" name="email" value="">
						<input type="hidden" name="image" value="<?php echo e($imagemGerada->path); ?>">
						<input type="hidden" name="id" value="<?php echo e($imagemOriginal->id); ?>">
						<div class="">

							<button type="submit" class="btn btn-primary">Enviar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php endif; ?>
	<section class="jumbotron ">
    <div class="container ">
			<div class="row justify-content-center">

					<div class="col-md-12 ">
						<?php if($errors->any()): ?>
							<div class="alert alert-danger">
								<ul>
									<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<li><?php echo e($error); ?></li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</ul>
							</div>
						<?php elseif(session('message')): ?>
							<div class="alert alert-info">
								<?php echo e(session('message')); ?>

							</div>
						<?php endif; ?>

						<form action="<?php echo e(route('image.update')); ?>" method="POST" enctype="multipart/form-data">
								<?php echo csrf_field(); ?>
							  <div class="form-group">
							  	<label>Nome:</label>
							  	<input type="text" name="nome" value="<?php echo e($nome ?? 'Texto'); ?>" class="form-control">
							  	<input type="hidden" name="image_id" value="<?php echo e($imagemOriginal->id); ?>">
							  </div>
							  <div class="form-group">
							    <label for="exampleFormControlSelect1">Font:</label>
							    <select class="form-control" name="font_id" id="exampleFormControlSelect1">
							    <?php $fonte = $fonte ?? 1 ?>
							    <?php $__currentLoopData = $fonts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $font): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							    	<?php if($fonte == $font->id): ?>
							      	<option selected value="<?php echo e($font->id); ?>" ><?php echo e($font->font_name); ?></option>
							      <?php else: ?>
							      	<option value="<?php echo e($font->id); ?>" ><?php echo e($font->font_name); ?></option>
							      <?php endif; ?>
							    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							    </select>
							  </div>
							  <div class="form-row">
							    <div class="col-3">
							  		<label for="formGroupExampleInput">Eixo x:</label>
							      <input type="text" class="form-control" name="eixo_x" value="<?php echo e($eixo_x ?? 4100); ?>" id="formGroupExampleInput" >
							    </div>
							    <div class="col-3">
							      <label for="formGroupExampleInput">Eixo y:</label>
							      <input type="number" class="form-control" name="eixo_y"  value="<?php echo e($eixo_y ?? 400); ?>" id="formGroupExampleInput" >
							    </div>
							    <div class="col-3">
							      <label for="formGroupExampleInput">Tamanho:</label>
							      <input type="number" class="form-control" name="size"  value="<?php echo e($size ?? 250); ?>" id="formGroupExampleInput" >
							    </div>
							  </div>
							  <div class="form-group" >
							  	<button class="btn btn-success mt-2"  type="submit">Gerar cartão</button>
							  	
							  </div>
						</form>
					</div>
					<div class="col-md-6 ">
						<img height="300" width="500" src="<?php echo e(asset($imagemOriginal->src)); ?>" alt="">
					</div>
					<div class="col-md-6 ">
					<?php if(isset($imagemGerada)): ?>
						<img height="300" width="500" src="<?php echo e(asset($imagemGerada->src)); ?>" alt="">
						<div class="btn-group">
							<a href="<?php echo e(route('home')); ?>" class="btn btn-success mt-3">Voltar </a>
						</div>
						<div class="btn-group">
	              <form action="<?php echo e(route('image.baixarImagem')); ?>" method="post" enctype="multipart/form-data">
									<?php echo csrf_field(); ?>
									<input type="hidden" name="file" value="<?php echo e($imagemGerada->file); ?>">
									<button type="submit" class="btn btn-success mt-3 ">Baixar imagem </button>
								</form>
            </div>
						<div class="btn-group">
							
            </div>



					<?php endif; ?>
					</div>

			</div>
    </div>

  </section>

</div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/Mensagens/resources/views/imagem/edit.blade.php ENDPATH**/ ?>