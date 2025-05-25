

<?php $__env->startSection('title_seller'); ?>
    Update Mentor - ConnectingNotes
<?php $__env->stopSection(); ?>
<?php $__env->startSection('seller_layout'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4 ">
                    <center>
                        <h1>All Mentor</h1>
                    </center>
                    <hr class="my-4 border-black animate-fade-in-up">
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
                                        <th>Mentor Name</th>
                                        <th>Description</th>
                                        <th>Slug</th>
                                        <th>Action</th>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($store->id); ?></td>
                                            <td><?php echo e($store->store_name); ?></td>
                                            <td><?php echo e($store->slug); ?></td>
                                            <td><?php echo e($store->details); ?></td>
                                            <td>
                                                <div class="d-flex py-0">
                                                    <a href="<?php echo e(route('edit.store', $store->id)); ?>" class="btn btn-info mb-4">Edit</a>
                                                    <form method="POST" action="<?php echo e(route('delete.store', $store->id)); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete the mentor?')">
                                                            Delete
                                                        </button>
                                                    </form>

                                                </div>
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

<style>
    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-up {
        animation: fadeIn 1s ease-out forwards;
    }
</style>
<?php echo $__env->make('seller.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/seller/store/manage.blade.php ENDPATH**/ ?>