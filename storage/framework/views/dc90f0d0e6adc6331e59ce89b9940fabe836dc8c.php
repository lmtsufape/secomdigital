<?php $__env->startSection('content'); ?>
<div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Geração de clipping da UFAPE</h5>
                <p class="card-text">Digite abaixo as datas para filtrar as publicações.</p>

                <form method="post" action="<?php echo e(route('clipping.gerar')); ?>">
                    <?php echo csrf_field(); ?>

                    <label>Data Inicial</label>
                    <input name="dataInicio" value="<?php echo e($dataInicio); ?>">

                    <label>Data Final</label>
                    <input name="dataFinal" value="<?php echo e($dataFinal); ?>">

                    <button type="submit" class="btn btn-primary">Gerar</button>
                </form>

                <br><br><hr><br>

                <div>
                    <?php $resultado = ""; ?> 
                    
                    <?php $__currentLoopData = $textoArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <h4> <?php echo e($categoria[1]); ?> </h4>
                        
                        <?php $__currentLoopData = $categoria[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $publicacao): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <b><?php echo e($publicacao[0]); ?></b> - 
                            <a href="<?php echo e($publicacao[1]); ?>"> <?php echo e($publicacao[1]); ?></a><br><br>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                </div>
              </div>
            </div>
          </div>          
        </div> 
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/Mensagens/resources/views/clipping/show.blade.php ENDPATH**/ ?>