

<?php $__env->startSection('title_seller'); ?>
ConnectingNotes
<?php $__env->stopSection(); ?>

<?php $__env->startSection('seller_layout'); ?>

    <center>
        <h1 class="text-black text-2xl font-bold animate-fade-in-up">Explore Our All Courses In <?php echo e($category->category_name); ?> Category</h1>
    </center>
    <hr class="my-4 border-black animate-fade-in-up">

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
        <?php $__empty_1 = true; $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-black shadow rounded overflow-hidden transform hover:scale-105 transition duration-300 ease-in-out animate-fade-in-up">
                <img 
                    src="<?php echo e(asset('storage/' . $pro->images->first()->img_path)); ?>" 
                    class="w-full h-32 sm:h-36 md:h-40 object-cover"
                >
                <div class="p-2 text-center">
                    <h2 class="text-white text-sm font-medium truncate">
                        <?php echo e($pro->product_name); ?>

                    </h2>
                    <div class="text-white font-bold text-sm mt-1">
                        ₱ <?php echo e(number_format($pro->regular_price, 2)); ?>

                    </div>
                    <a href="<?php echo e(route('seller.category.view', ['product_name' => $pro->product_name])); ?>"
                       class="mt-2 inline-block bg-white text-black hover:bg-green-500 hover:text-white text-xs px-3 py-1 rounded transition duration-300">
                        View Details
                    </a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="col-span-full text-gray-500 animate-fade-in-up">No courses available.</p>
        <?php endif; ?>
    </div>

    <!-- Fade Animation Style -->
    <style>
    @keyframes fadeInUp {
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
        animation: fadeInUp 0.6s ease-out both;
    }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('seller.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/seller/category/showproduct.blade.php ENDPATH**/ ?>