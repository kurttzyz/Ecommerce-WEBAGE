
<?php $__env->startSection('title_admin'); ?>
    ConnectingNotes | Admin
<?php $__env->stopSection(); ?>
<?php $__env->startSection('admin_layout'); ?>
<center><h1>Manage Category</h1></center>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">All Category</h5>
                    <div class="card-body">
                        <?php if(session('success')): ?>
                                            <div class="alert alert-success my-2">
                                                <?php echo e(session('success')); ?>

                                            </div>
                                            <?php endif; ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category Name</th>
                                        <th>Action</th>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($cat->id); ?></td>
                                        <td><?php echo e($cat->category_name); ?></td>
                                        <td><a href="<?php echo e(route('show.cat', $cat->id)); ?>" class="btn btn-info">Edit</a>
                                            <form method="POST" action="<?php echo e(route('delete.cat', $cat->id)); ?>">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <input type="submit" value="Delete" class="btn btn-danger">
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/admin/category/manage.blade.php ENDPATH**/ ?>