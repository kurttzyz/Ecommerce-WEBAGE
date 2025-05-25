
<?php $__env->startSection('title_admin'); ?>
    ConnectingNotes | Admin
<?php $__env->stopSection(); ?>
<?php $__env->startSection('admin_layout'); ?>
<center><h1>Edit Sub Category</h1></center>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                            <form action="<?php echo e(route('update.subcat', $subcategory_info->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <label for="subcategory_name" class="fw-bold-mb-2">Give the name of your sub category</label>
                                <input type="text" name="subcategory_name" class="form-control" value="<?php echo e($subcategory_info->subcategory_name); ?>">
                                <?php if($errors->any()): ?>
                                    <div class="alert alert-warning alert-dismissible fade show">
                                        <ul>
                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($error); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <?php if(session('success')): ?>
                                    <div class="alert alert-success">
                                        <?php echo e(session('success')); ?>

                                    </div>
                                <?php endif; ?>
                                <button type="submit" class="btn btn-primary w-100 mt-2">Update Sub Category</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/admin/sub_category/edit.blade.php ENDPATH**/ ?>