


<?php $__env->startSection('title_seller'); ?>
Edit Mentor - ConnectingNotes
<?php $__env->stopSection(); ?>
<?php $__env->startSection('seller_layout'); ?>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <center>
                            <h1 class="text-black">Edit Mentor</h1>
                        </center>
                        <hr class="my-4 border-black animate-fade-in-up">
                        <form action="<?php echo e(route('update.store', $store->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <label for="store_name" class="fw-bold-mb-2">Give the new name of your Mentor</label>
                                <input type="text" name="store_name" class="form-control" value="<?php echo e($store->store_name); ?>">

                                <label for="details" class="fw-bold-mb-2">Give the new Description of your Mentor</label>
                                <textarea cols="30" rows="10" name="details" class="form-control"><?php echo e($store->details); ?></textarea>


                                <label for="slug" class="fw-bold-mb-2">Give the new slug of your Mentor</label>
                                <input type="text" name="slug" class="form-control" value="<?php echo e($store->slug); ?>">

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
                                <button type="submit" class="btn btn-primary w-100 mt-2">Update Mentor</button>
                            </form>
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


<?php echo $__env->make('seller.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/seller/store/edit.blade.php ENDPATH**/ ?>