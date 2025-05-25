
<?php $__env->startSection('title_admin'); ?>
    ConnectingNotes | Admin
<?php $__env->stopSection(); ?>
<?php $__env->startSection('admin_layout'); ?>


    <div class="container">
       <h2 class="text-3xl font-bold">Achievements Overview</h2>




        
        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Progress</th>
                    <th>Issued By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $achievements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $a->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($a->id); ?></td>
                            <td><?php echo e($user->full_name); ?></td>
                            <td><?php echo e($user->pivot->progress); ?>%</td>
                            <td><?php echo e($a->issued_by); ?></td>
                            <td>

                                    <a href="<?php echo e(route('achievements.show', ['achievement' => $a->id, 'user' => $user->id])); ?>"
                                        class="btn btn-info btn-sm">View</a>


                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>
        </table>
    </div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/admin/product/manage_product_review.blade.php ENDPATH**/ ?>