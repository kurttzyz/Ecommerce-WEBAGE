

<?php $__env->startSection('title_admin'); ?>
    ConnectingNotes | Admin
<?php $__env->stopSection(); ?>

<?php $__env->startSection('admin_layout'); ?>


    <div class="container mt-4">
        <div>
            <a href="<?php echo e(url()->previous()); ?>"
                class="inline-flex items-center text-black hover:text-blue transition duration-200 mb-2">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back
            </a>  </div>
        <h2 class="font-bold text-3xl">All Achievements</h2>
 
        <?php $__empty_1 = true; $__currentLoopData = $achievements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $achievement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="card mt-4">
                <div class="card-body">
                    <h4 class="card-title"><?php echo e($achievement->title ?? 'No Title'); ?></h4>
                    <p><strong>ID:</strong> <?php echo e($achievement->id); ?></p>
                    <p><strong>Description:</strong> <?php echo e($achievement->description); ?></p>
                    <p><strong>Issued By:</strong> <?php echo e($achievement->issued_by); ?></p>
                    <p><strong>Date Issued:</strong> <?php echo e($achievement->created_at->format('F d, Y')); ?></p>
                </div>
            </div>

            <h5 class="mt-3">Users who received this achievement</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Progress</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_2 = true; $__currentLoopData = $achievement->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                        <tr>
                            <td><?php echo e($user->id); ?></td>
                            <td><?php echo e($user->full_name); ?></td>
                            <td><?php echo e($user->email); ?></td>
                            <td><?php echo e($user->pivot->progress); ?>%</td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                        <tr>
                            <td colspan="4">No users assigned this achievement.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="alert alert-warning mt-4">No achievements found.</div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/admin/product/display_achievements.blade.php ENDPATH**/ ?>