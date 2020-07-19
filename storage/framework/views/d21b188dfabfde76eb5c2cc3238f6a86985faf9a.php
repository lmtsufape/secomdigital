<?php $__env->startSection('content'); ?>
<div class="container">
	<section class="jumbotron ">
    <div class="container ">
			<div class="row justify-content-center">
					<div class="col-md-4 ">
						<?php if($errors->any()): ?>
							<div class="alert alert-danger">
								<ul>
									<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<li><?php echo e($error); ?></li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</ul>
							</div>

						<?php endif; ?>

						<form action="<?php echo e(route('image.store')); ?>" method="POST" enctype="multipart/form-data">
							<?php echo csrf_field(); ?>
						  <div class="form-group">
						  	<label>Título</label>
						  	<input type="text" name="title" class="form-control">
						  </div>
						  <div class="form-group">
						  	<label> Imagem </label>
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
  <?php if(session('message')): ?>
		<div class="alert alert-success">
			<?php echo e(session('message')); ?>

		</div>
	<?php endif; ?>
  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
      <?php if($images->count() < 1 ): ?>
      	<div class="alert alert-warning">
      		Não há imagens
      	</div>
      <?php endif; ?>
			<?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-8">
          <div class="card mb-4 shadow-sm">
            <img height="300" src="<?php echo e(asset($image->src)); ?>" alt="">
            <div class="card-body">
              <p class="card-text"><?php echo e($image->title); ?></p>
              <div class="d-flex justify-content-between align-items-center">
                
                  <button type="button" class="btn btn-md btn-success">Visualizar imagem base </button>
                  <a href="<?php echo e(route('image.edit', ["id"=>$image->id])); ?>" class="btn btn-md btn-success">Gerar e enviar cartão de aniversário</a>

                  <form action="<?php echo e(route('image.destroy')); ?>" method="post">
                  	<?php echo csrf_field(); ?>
										<input type="hidden" name="id" value="<?php echo e($image->id); ?>">

                  	<button type="submit" class="btn btn-md btn-danger">Excluir imagem base</button>
                  </form>
                
                
              </div>
            </div>
          </div>
        </div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      </div>
    </div>
  </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/Mensagens/resources/views/home.blade.php ENDPATH**/ ?>