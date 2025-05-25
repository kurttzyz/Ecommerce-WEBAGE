
<?php $__env->startSection('title_seller'); ?>
Manage Course - ConnectingNotes 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('seller_layout'); ?>
    <center><h1 class="text-black">All Of Your Course</h1></center>
    <hr class="my-4 border-black animate-fade-in-up">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Course</h5>
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
                                            <th>Course Name</th>
                                            <th>Course Image</th>
                                            <th>Sessions</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($product->id); ?></td>
                                            <td><?php echo e($product->product_name); ?></td>
                                            <td>
                                                <?php
    $primaryImage = $product->images()->where('is_primary', true)->first();
                                                ?>

                                                <?php if($primaryImage && $primaryImage->img_path): ?>
                                                <img src="<?php echo e(Storage::url($primaryImage->img_path)); ?>" width="80" height="80" alt="Product Image">
                                            <?php else: ?>
                                                <span>No Image</span>
                                            <?php endif; ?>
                                            </td>
                                            <td><?php echo e($product->stock_quantity); ?></td>
                                            <td><?php echo e($product->regular_price); ?></td>
                                            <td>
                                                <a href="<?php echo e(route('seller.product.edit', $product->id)); ?>" class="btn btn-info">Edit</a>
                                                <form method="POST" action="<?php echo e(route('delete.product', $product->id)); ?>">
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



<?php echo $__env->make('seller.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/seller/product/manage.blade.php ENDPATH**/ ?>