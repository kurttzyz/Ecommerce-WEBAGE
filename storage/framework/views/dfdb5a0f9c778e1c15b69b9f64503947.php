
<?php $__env->startSection('title_admin'); ?>
    ConnectingNotes | Admin
<?php $__env->stopSection(); ?>
<?php $__env->startSection('admin_layout'); ?>
    <div class="container">
        <h2 class="font-bold font-3xl">Archived Seller Forms</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Status</th>
                    <th>Submitted At</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $archivedForms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($form->user->full_name ?? 'N/A'); ?></td>
                        <td><?php echo e(ucfirst($form->status)); ?></td>
                        <td><?php echo e($form->created_at->format('Y-m-d')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/admin/archived.blade.php ENDPATH**/ ?>