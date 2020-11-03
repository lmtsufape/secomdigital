<?php $__env->startSection('style'); ?>
<link href="<?php echo e(asset('css/clipping.create.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Geração de clipping da UFAPE</h5>                
                <div class="d-flex justify-content-center">                  
                  <?php if(session('status')): ?>
                      <div class="alert alert-success">
                          <?php echo e(session('status')); ?>

                      </div>
                  <?php endif; ?>
                  <form method="post" id="formGerar" action="<?php echo e(route('clipping.gerar')); ?>">
                      <?php echo csrf_field(); ?>
                      <br><br>  
                      <p class="card-text"><b>Digite as datas abaixo para filtrar as publicações.</b></p>
                      <div class="row d-flex">
                        <div class="col-sm-5">
                          <label>Data Inicial</label>
                          <input name="dataInicio" placeholder="dd/mm/aaaa" required class="form-control <?php $__errorArgs = ['dataInicio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('dataInicio')); ?>">
                        </div>
                        <div class="col-sm-6" id="dataFinal">
                          <div class="row">
                            <div class="col-sm-10">
                              <label>Data Final</label>
                              <input name="dataFinal" placeholder="dd/mm/aaaa" required class="form-control <?php $__errorArgs = ['dataFinal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('dataFinal')); ?>">
                            </div>
                            
                            <?php if(!$errors->has('dataFinal') && $errors->has('dataInicio')): ?>
                              <?php $__errorArgs = ['dataInicio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <?php endif; ?>
                            <?php $__errorArgs = ['dataFinal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                              <span class="invalid-feedback" role="alert">
                                  <strong><?php echo e($message); ?></strong>
                              </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>                          
                          </div>
                        </div>
                      </div>

                      <br>
            
                      <button type="submit" class="btn btn-primary" id="gerar">Gerar Clipping</button>                     
                  </form>
                
                </div>
              </div>
            </div>
          </div>          
        </div> 
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
  


</script>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/Mensagens/resources/views/clipping/create.blade.php ENDPATH**/ ?>