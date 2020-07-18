<?php $__env->startSection('content'); ?>
<div class="container">
	<section class="jumbotron ">
    <div class="container ">
			<div class="row justify-content-center">
				
					
					<div class="col-md-8 ">
						<img height="400" width="600" src="<?php echo e($imagem->src); ?>" alt="Imagem">
						<form action="<?php echo e(route('image.baixarImagem')); ?>" method="post">
							<?php echo csrf_field(); ?>
							<input type="hidden" name="file" value="<?php echo e($imagem->file); ?>">
							<button type="submit" class="btn btn-success mt-3">Baixar imagem </button>
						</form>
					</div>
					
							
			</div>
    </div>
  </section> 
    
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/Mensagens/resources/views/imagem/baixar.blade.php ENDPATH**/ ?>